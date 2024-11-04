<?php
    require_once('../model/Academia.php');
    require_once('../model/Aparelhos.php');
    require_once('../model/AcademiaDAO.php');
    require_once('../model/AparelhosDAO.php');
    

    $from = isset($_GET["from"]) ? $_GET["from"] : '';    

    
    $NomeAcademia = $_POST['NomeAcademia'];
    $Aparelhos = $_POST['aparelhos'];    
    $Grupos = $_POST['grupos']; 

    $AcademiaDAO = new AcademiaDAO();
    

    $ultimo_id_academia_json  = $AcademiaDAO->ConsultarIdAcademia();

    $ultimo_id_academia_array = json_decode($ultimo_id_academia_json, true);

    // Acessa o valor do campo 'idAcademia'
    $ultimo_id_academia = $ultimo_id_academia_array[0]['idAcademia'];

    $id_academia = intval($ultimo_id_academia) + 1;

    $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

    // Verificar se o arquivo está acessível e pode ser escrito
    if (is_writable($filePath)) {
        file_put_contents($filePath, "id retornado: " . $id_academia . "\n", FILE_APPEND);
    } else {
        echo "Não foi possível escrever no arquivo de log.";
    }

    $Academia = new Academia(
        $id_academia,
        $NomeAcademia,
        );

    $result = $AcademiaDAO->CadastrarAcademia($Academia);

    $id_academia = $AcademiaDAO->ConsultarIdAcademia();

    for ($i = 0; $i < count($Aparelhos); $i++) {

        $AparelhosClasse = new Aparelho(
            $Aparelhos[$i],
            $Grupos[$i],
            $id_academia);

        $aparelhoDAO = new AparelhoDAO();

        $resultAparelhos = $aparelhoDAO->CadastrarAparelhos($AparelhosClasse);

       $resultArray = json_decode($result, true);

    }

       if ($resultArray && isset($resultArray['sucesso']) && $resultArray['sucesso'] == 'true') {
        // Redireciona em caso de sucesso
        header("Location: ../view/CadastroAcademia.php?success=1");
        exit();
    } else {
        // Lida com o caso de falha ou resposta inesperada
        header("Location: ../view/CadastroAcademia.php?success=2");
    }
    
?>