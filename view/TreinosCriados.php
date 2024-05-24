<?php
    session_start();

    $success = isset($_GET['success']) ? $_GET['success'] : null;

    // Verifica se a sessão do id está definida
    if(!isset($_SESSION['id'])) {
        // Se não estiver definida, redireciona para a página de login
        
        header("Location: ../view/Login.php?from=criar_treinos");
        exit();
    } 

    if ($success == 1) {
        ?>
        <script>alert('Treino Cadastrado com sucesso');</script>
        <script> window.location.href = "../view/CriarTreino.php";</script>
        <?php
        
    } elseif ($success == 2) {
        ?>
        <script>alert('Opss.. Ocorreu um erro inesperado');</script>
        <script> window.location.href = "../view/CriarTreino.php";</script>
        <?php
    }

    echo "<script>var idProfessor = " . $_SESSION['id'] . ";</script>";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/nav-bar_Logado.css">
    <link rel="stylesheet" href="../assets/css/TreinosCriados.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Treinos Criados</title>
</head>
<body>
<header>
        <nav class="nav-bar">
            <div class="logo">
                <img class="img-logo" src="../assets/img/Logo_sapo.png">
            </div>

            <div class="nav-list">
                <ul>
                    <li class="nav-item"><a href="Home_Logado.php" class="nav-link">Início</a></li>
                    <li class="nav-item"><a href="CriarTreino.php" class="nav-link">Criar treino</a></li>
                    <li class="nav-item active"><a href="TreinosCriados.php" class="nav-link">Consultar treinos</a></li>
                    <li class="nav-item"><a href="CriarGrupo.php" class="nav-link">Criar Grupo</a></li>
                </ul>
            </div>

            <div class="img-logado" id="img-logado">
                <img src="../assets/img/perfil_branco.png" alt="">
            </div>

           

            <div class="mobile-menu-icon">
                <button onclick="menuShow()"><img class="icon" src="../assets/img/menu_white_36dp.svg"></button>
            </div>
        </nav>

        <div class="dropdown-perfil">
                <a href="../view/logout.php">Sair</a>
                <a href="">Perfil</a>
        </div>

        <div>
            <span><br></span>
        </div>

        <div class="mobile-menu">
            <ul>
                <li class="nav-item"><a href="Home.php" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="CriarTreino.php" class="nav-link">Criar treino</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Configurações</a></li>
            </ul>

            <div class="img-logado">
                <img src="../assets/img/perfil_branco.png" alt="">
            </div>
        </div>

        
</header>

    <main>
    <div class="container">
        <form action="../controller/CadastroTreino.php" method="post">          
            <div class="titulo">
                <div class="input-box-titulo">
                    <div class="title">
                        <a>Qual será o nome do treino? </a>
                    </div>
                    
                    <div class="input-titulo">
                        <input type="text" id="NomeTreino" name="NomeTreino" placeholder="Digite aqui" required>
                    </div>
                    
                </div>


                

            </div>
            
            <div class="divisoria-deitada">

            </div>

            <div class="input-group">
                <div class="input-box">
                    <div class="title">
                        <a>Selecione o treino:</a>
                    </div>
                    
                    <div class="input-select">
                        <select class="Treino" name="grupo" id="grupo">
                            
                        </select>
                    </div>
                </div>
            
                <div class="divisoria">

                </div>
            
                <div class="input-group">
                <div class="input-box">
                    <div class="title">
                        <a>Atribuir para:</a>
                    </div>
                    
                    <div class="input-titulo">
                        <input type="text" id="AlunoTreino" name="AlunoTreino" placeholder="Digite aqui" required>
                    </div>

                    <div class="alunoSelecionado">
                        <p></p>
                    </div>
                </div>    
                </div>
            </div>

            <div class="submit-button">
                <button type="submit"><a class="btn">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Enviar
                </a></button>
            </div>
        </form>
    </div>
        
    </div>
    </main>

    


</body>
    <script src="../assets/js/Add-linha-exerc.js"></script>
    <script src="../assets/js/Remover-linha.js"></script>
    <script src="../assets/js/TreinoCriados.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/dropdownMenu.js"></script>
    <script type="module" src="../assets/js/CaixaDePesquisaAluno.js></script>
</html>