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

         // Verifique o conteúdo de $ID_User
        $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\id_sessao';
        file_put_contents($filePath, "Valor retornado por ConsultarIDUsuario: " . print_r($ID_User, true) . PHP_EOL, FILE_APPEND);

      
        $ID_User = json_decode($ID_User, true);

        if (is_array($ID_User) && isset($ID_User['ID'])) {
            $ID_User = $ID_User['ID'];
        } else {
            $ID_User = null;
        }

        session_set_cookie_params(15);
        session_start();
        
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

    

    

  
