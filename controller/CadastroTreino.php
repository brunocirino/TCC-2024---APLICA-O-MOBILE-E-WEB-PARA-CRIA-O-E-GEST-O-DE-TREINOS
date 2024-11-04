<?php
    require_once('../model/TreinoCriado.php');
    require_once('../model//treinoCriadoDAO.php');

    $from = isset($_GET["from"]) ? $_GET["from"] : '';    
    
    if($from == 'VerificarNome'){
        $nomeTreino = isset($_GET['NomeInserido']) ? $_GET['NomeInserido'] : '';
        $id_aluno = isset($_GET['id_aluno']) ? $_GET['id_aluno'] : '';
        $id_professor = isset($_GET['id_professor']) ? $_GET['id_professor'] : '';

        $VerificarNome = new TreinoCriadoDAO();

        $resultado = $VerificarNome->ConsultarNomeProf($nomeTreino, $id_professor);

        header('Content-Type: application/json');

        echo json_encode($resultado);

    }else{

    $exercicios = $_POST['exercicios'];
    $series = $_POST['series'];
    $reps = $_POST['reps'];
    $peso = $_POST['peso'];
    $comentarios = $_POST['comentario'];
    $NomeTreino = $_POST['NomeTreino'];

    session_start();

    $id_prof = $_SESSION['id'];
    if (is_string($id_prof)) {
    $decoded_id_prof = json_decode($id_prof, true);
    if (json_last_error() === JSON_ERROR_NONE && isset($decoded_id_prof[0]['ID'])) {
        $id_prof = $decoded_id_prof[0]['ID'];
    } else {
        // Se o JSON não puder ser decodificado, trate o erro aqui
        $id_prof = null;
    }
    }

    
    $TreinoCriadoDAO = new TreinoCriadoDAO();

    $ultimo_id_treino = $TreinoCriadoDAO->ConsultarIdTreino();

    $id_treino = intval($ultimo_id_treino) + 1;

    for ($i = 0; $i < count($exercicios); $i++) {
        
        $treino = new TreinoCriado(
        $id_treino,
        $id_prof,
        $NomeTreino,
        $exercicios[$i],
        $series[$i],
        $reps[$i],
        $peso[$i],
        $comentarios[$i]
        );

       $resultadoTreino = $TreinoCriadoDAO->cadastrarTreino($treino);


    }

        if($resultadoTreino){
            header("Location: ../view/CriarTreino.php?success=1");
        }else{
            header("Location: ../view/CriarTreino.php?success=2");
        }
    

}
?>