<?php
    require_once('../model/TreinoExistenteDAO.php');
    require_once('../model/userDAO.php');

    $IDgrupo = $_POST['IDgrupo'];
    $exercicios = $_POST['exercicio'];   

    $userDAO = new UserDAO();

    $consulta = new TreinoExistenteDAO();

    $resultado = $consulta->ConsultaTreinoExist($IDgrupo, $exercicios);

    header('Content-Type: application/json');

    // Envie os resultados como JSON
    echo trim(json_encode($resultado));

?>