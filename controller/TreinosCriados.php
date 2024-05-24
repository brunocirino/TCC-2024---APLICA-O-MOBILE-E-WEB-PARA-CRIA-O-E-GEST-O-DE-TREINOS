<?php
    require_once('../model/TreinoExistenteDAO.php');
    require_once('../model/userDAO.php');
    
    session_start();

    // Verifica se a sessão do ID está definida
    if(!isset($_SESSION['id'])) {
    // Se não estiver definida, retorna uma resposta vazia
    echo json_encode([]);
    exit();
    }

    $id_professor = $_SESSION['id'];
    
    $userDAO = new UserDAO();

    $consulta = new TreinoExistenteDAO();

    $resultado = $consulta->ConsultaTreinoExist_idProf($id_professor);

    header('Content-Type: application/json');

    // Envie os resultados como JSON
    echo trim(json_encode($resultado));

?>