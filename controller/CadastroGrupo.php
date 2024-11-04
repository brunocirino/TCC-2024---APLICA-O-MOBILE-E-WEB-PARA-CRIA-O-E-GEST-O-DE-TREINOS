<?php
    require_once('../model/GrupoExistenteDAO.php');
  
    $nome = $_POST['nome'];

    $Criar = new GrupoExistenteDAO();


    if($Criar->CriarGrupo($nome)){
        header("Location: ../view/CriarGrupo.php?success=1");     
    }else{
        header("Location: ../view/CriarGrupo.php?success=1");
    }

    

?>