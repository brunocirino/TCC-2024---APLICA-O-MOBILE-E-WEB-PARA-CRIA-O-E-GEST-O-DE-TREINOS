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
    <link rel="stylesheet" href="../assets/css/CriarTreinos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Criar treinos personalizados</title>
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
                    <li class="nav-item active"><a href="CriarTreino.php" class="nav-link">Criar treino</a></li>
                    <li class="nav-item"><a href="TreinosCriados.php" class="nav-link">Consultar treinos</a></li>
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


                <div class="input-add-linha">
                    <a class="remover-linha-Exercicio"><ion-icon name="remove"></ion-icon></a>   
                    <a class="adicionar-linha-Exercicio"><ion-icon name="add-circle"></ion-icon></a>                     
                </div>

            </div>
            
            <div class="divisoria-deitada">

            </div>

            <div class="input-group">
                <div class="input-box">
                    <div class="title">
                        <a>Grupo</a>
                    </div>
                    
                    <div class="input-select">
                        <select class="grupo" name="grupo" id="grupo1">
                            
                        </select>
                    </div>
                </div>

                <div class="divisoria">

                </div>

                <div class="input-box">
                    <div class="title">
                        <a>Exercicio</a>
                    </div>

                    <div class="input-exercicios">
                        <input type="text" name="exercicios[]" id="exercicios1" placeholder="Digite aqui" required>
                        <div class="opcoes-exercicios" id="opcoes-exercicios1">

                        </div>
                    </div>
                </div>

                <div class="input-box">
                    <div class="title">
                        <a>Series</a>
                    </div>

                    <div class="input-series">
                        <input type="text" name="series[]" required>
                    </div>
                </div>

                <div class="input-box">
                    <div class="title">
                        <a>Repetições</a>
                    </div>
                
                
                    <div class="input-reps">
                        <input type="text" name="reps[]" required>    
                    </div>
                </div>

                <div class="input-box">
                    <div class="title">
                        <a>Comentarios:</a>
                    </div>

                    <div class="comentarios">
                        <textarea name="comentario[]" class="input-comentarios" rows="4" cols="30" placeholder="Digite aqui..."></textarea>
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
    <script src="../assets/js/CaixaDePesquisaExer.js"></script>
    <script src="../assets/js/add-grupo-exerc.js"></script>
    <script type="module" src="../assets/js/CaixaDePesquisaAluno.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/dropdownMenu.js"></script>
    <script type="module" src="../assets/js/VerificarNomeTreino.js"></script>
</html>