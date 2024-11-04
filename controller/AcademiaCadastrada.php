<?php
    require_once('../model/AcademiaDAO.php');

    $consulta = new AcademiaDAO();

    $resultado = $consulta->ConsultaAcademiaExist();

    // Envie os resultados como JSON
    header('Content-Type: application/json');
    echo json_encode($resultado);

?>