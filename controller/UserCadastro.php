<?php
require_once('../model/user.php');
require_once('../model/userDAO.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $PrimeiroNome = $_POST['firstname'];
    $Sobrenome = $_POST['lastname'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $numeroEndereco = $_POST['numeroEndereco'];
    $logradouro = $_POST['logradouro'];
    $complemento = $_POST['complemento'];
    $NumeroCelular = $_POST['number'];
        
    $user = new User($PrimeiroNome, $Sobrenome, $email, $senha, $NumeroCelular);
    $userDAO = new UserDAO();
    

    if($userDAO->cadastrarUsuario($user)){

        $iduserconsulta = $userDAO->ConsultarIDUsuario($email);

        $iduserconsulta = json_decode($iduserconsulta, true);

        $iduser = ($iduserconsulta[0]['ID']);

        $user->set_id($iduser);
        var_dump($iduser);

        
        
        $endereco = new Endereco($user->get_id(), $cep, $cidade, $estado, $bairro, $numeroEndereco, $logradouro);

        $id_usuario = $user->get_id();
        echo "ID do usuário: $id_usuario\n";

        //erro de proposito para debug  
        //echo $userDAO;
    
        $userDAO->cadastrarEndereco($endereco);

        session_start();
        
        $_SESSION['primeiroNome'] = $usuario['primeiroNome'];
        $_SESSION['id'] = $usuario['id'];

        ?>
        echo "<script>showToast('Cadastro realizado com sucesso!');</script>";
        <?php

        header("Location: ../view/Login.php");
    } else {
        ?>
            cho "<script>showToast('Erro inesperado ao cadastrar');</script>";
        <?php
    }
    
   