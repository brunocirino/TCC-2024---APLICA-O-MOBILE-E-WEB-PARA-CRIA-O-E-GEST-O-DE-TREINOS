<?php
    require_once('../model/TreinoExistenteDAO.php');

    session_start();

    
    // Verifica se a sessão do ID está definida
    if(!isset($_SESSION['id'])) {
        // Se não estiver definida, retorna uma resposta vazia
        echo json_encode([]);
        exit();
    }

    $id_prof = $_SESSION['id'];

    $consulta = new TreinoExistenteDAO();

    //echo $consulta;

    $resultado = $consulta->ConsultaTreinoExist_idProf($id_prof);

    header('Content-Type: application/json');

    // Envie os resultados como JSON
    echo json_encode($resultado);

?>