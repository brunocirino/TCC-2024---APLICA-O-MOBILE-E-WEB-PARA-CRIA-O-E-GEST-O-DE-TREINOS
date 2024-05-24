<?php
require_once('../model/user.php');
require_once('../model/userDAO.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $from = isset($_GET['from']) ? $_GET['from'] : '';
           
    $userDAO = new UserDAO();
    
    $resultado = $userDAO->login($email, $senha);


    
    
    if($resultado){
       
        $ID_User = $userDAO->ConsultarIDUsuario($email);
        session_set_cookie_params(15);
        session_start();
        echo $ID_User;
       
        $_SESSION['id'] = $ID_User;
        
        if($from == 'criar_treinos'){
            header("Location: ../view/CriarTreino.php");
        } else{
            header("Location: ../view/Home_Logado.php");
        }
        exit();
        
    } else{

        header("Location: ../view/login.php?error=1");
    }

    

    

  
