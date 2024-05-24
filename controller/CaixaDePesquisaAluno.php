<?php
    require_once('../model/AlunoExistenteDAO.php');
    require_once('../model/userDAO.php');

    $idAluno = $_POST['idAluno'];

    $userDAO = new UserDAO();

    $consulta = new AlunoExistenteDAO();

    $resultado = $consulta->ConsultarAlunoExistente($idAluno);

    header('Content-Type: application/json');
    
    // Envie os resultados como JSON
    echo trim(json_encode($resultado));


?>