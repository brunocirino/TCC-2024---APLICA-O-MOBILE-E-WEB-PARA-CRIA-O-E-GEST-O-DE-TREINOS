<?php
    require_once('../model/TreinoExistenteDAO.php');
    require_once('../model/userDAO.php');

    $IDgrupo = $_GET['IDgrupo'];
    $exercicios = $_GET['exercicio'];   
    $id_Academia = $_GET['IdAcademia'];


    $consulta = new TreinoExistenteDAO();

    $resultado = $consulta->ConsultaTreinoExist($IDgrupo, $exercicios, $id_Academia);

    header('Content-Type: application/json');

    // Envie os resultados como JSON
    return json_encode($resultado);


?>