<?php
    require_once('../model/GrupoExistenteDAO.php');
    require_once('../model/userDAO.php');
  
    $nome = $_POST['nome'];

    $userDAO = new UserDAO();

    $Criar = new GrupoExistenteDAO();


    if($Criar->CriarGrupo($nome)){
        header("Location: ../view/CriarGrupo.php?success=1");     
    }else{
        header("Location: ../view/CriarGrupo.php?success=1");
    }

    

?>