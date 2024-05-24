<?php
    require_once('../model/TreinoCriado.php');
    require_once('../model//treinoCriadoDAO.php');

    $from = isset($_POST["from"]) ? $_POST["from"] : '';    
    
    if($from == 'VerificarNome'){
        $nomeTreino = isset($_POST['NomeInserido']) ? $_POST['NomeInserido'] : '';
        $id_aluno = isset($_POST['id_aluno']) ? $_POST['id_aluno'] : '';
        $id_professor = isset($_POST['id_professor']) ? $_POST['id_professor'] : '';

        $VerificarNome = new TreinoCriadoDAO();

        $resultado = $VerificarNome->ConsultarNomeProf($nomeTreino, $id_professor);



        echo json_encode($resultado);
        return;
    }else{

    $exercicios = $_POST['exercicios'];
    $series = $_POST['series'];
    $reps = $_POST['reps'];
    $comentarios = $_POST['comentario'];
    $NomeTreino = $_POST['NomeTreino'];

    session_start();
    
    $id_prof = $_SESSION['id'];

    $TreinoCriadoDAO = new TreinoCriadoDAO();

    $ultimo_id_treino = $TreinoCriadoDAO->ConsultarIdTreino();

    echo $ultimo_id_treino;

    $id_treino = intval($ultimo_id_treino['MAX(id_identificador)']) + 1;




    for ($i = 0; $i < count($exercicios); $i++) {
       $treino = new TreinoCriado(
        $id_treino,
        $id_prof,
        $NomeTreino,
        $exercicios[$i],
        $series[$i],
        $reps[$i],
        $comentarios[$i]
        );

       $TreinoCriadoDAO = new TreinoCriadoDAO();

       $resultado = $TreinoCriadoDAO->cadastrarTreino($treino);

        if($resultado){
            header("Location: ../view/CriarTreino.php?success=1");
        }else{
            header("Location: ../view/CriarTreino.php?success=2");
        }
    }

}


   
?>