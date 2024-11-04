<?php
session_start();

$success = isset($_GET['success']) ? $_GET['success'] : null;

if (!isset($_SESSION['id'])) {
    header("Location: ../view/Login.php?from=criar_treinos");
    exit();
}


echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>';

echo "<style>
    /* Estilo personalizado para o Toastr */
    .toast {
        opacity: 0.9 !important; /* Ajusta a opacidade (0.0 a 1.0) */
    }
</style>";

echo "<script>
    $(document).ready(function() {
        const success = $success;
        if (success === 1) {
            toastr.options.positionClass = 'toast-bottom-right';
            toastr.success('Grupo Cadastrado com sucesso.', 'Sucesso');
            setTimeout(function() {
                window.location.href = '../view/CriarGrupo.php';
            }, 3000);
        } else if (success === 2) {
            alert('Opss.. Ocorreu um erro inesperado');
            window.location.href = '../view/CriarGrupo.php';
        }
    });
</script>";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/nav-bar_Logado.css">
    <link rel="stylesheet" href="../assets/css/CriarGrupo.css">
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
                    <li class="nav-item "><a href="CriarTreino.php" class="nav-link">Criar treino</a></li>
                    <li class="nav-item "><a href="CadastroAcademia.php" class="nav-link">Cadastrar academias</a></li>
                    <li class="nav-item"><a href="TreinosCriados.php" class="nav-link">Consultar treinos</a></li>
                    <li class="nav-item active"><a href="CriarGrupo.php" class="nav-link">Criar Grupo</a></li>
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
        <form action="../controller/CadastroGrupo.php" method="post">          
            <div class="titulo">
                <div class="input-box-titulo">
                    <div class="title">
                        <a>Criação de grupo de treino</a>
                    </div>
                    
                    
                    
                </div>


               

            </div>
            
            <div class="divisoria-deitada">

            </div>

            <div class="input-group">
               

                

                <div class="input-box">
                    <div class="title">
                        <a>Nome do grupo</a>
                    </div>

                    <div class="input-exercicios">
                        <input type="text" name="nome" id="exercicios1" placeholder="Digite aqui" required>
                    </div>
                </div>

                <div class="divisoria">

                </div>

                
            
            <div class="submit-button">
                <button type="submit"><a class="btn">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Adicionar
                </a></button>
            </div>
        </form>
    </div>
        
    </div>
    </main>

    


</body>
</html>