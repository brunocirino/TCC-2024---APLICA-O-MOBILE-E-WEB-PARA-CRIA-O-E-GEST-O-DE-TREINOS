<?php
    require_once('../model/treinoCriadoDAO.php');

    $id_aluno = $_POST['ID_Aluno'];
    $id_treino = $_POST['ID_Treino'];

    session_start();

    // Verifica se a sessão do ID está definida
    if(!isset($_SESSION['id'])) {
        // Se não estiver definida, retorna uma resposta vazia
        echo json_encode([]);
        exit();
    }

    $id_prof = $_SESSION['id'];

    $consulta = new treinoCriadoDAO();

    $resultado = $consulta->AtribuirAluno($id_prof, $id_aluno, $id_treino);

    // Envie os resultados como JSON
    if ($resultado) {
        echo json_encode(['sucesso' => true, 'mensagem' => 'Aluno atribuído com sucesso', 'id' => $resultado]);
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao atribuir aluno']);
    }

?>