<?php
    require_once('../model/AlunoExistenteDAO.php');

    $id_aluno = $_GET['ID_Aluno'];

    $consulta = new AlunoExistenteDAO();

    $resultado = $consulta->ConsultarAlunoExistente($id_aluno);

    header('Content-Type: application/json');

    // Envie os resultados como JSON
    echo $resultado;

?>