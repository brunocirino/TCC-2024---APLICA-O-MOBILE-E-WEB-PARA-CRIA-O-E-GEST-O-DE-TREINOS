<?php
$error = isset($_GET['error']) ? $_GET['error'] : null;



if ($error == 1) {
    ?>
    <script>alert('Erro ao logar, E-mail ou senha invalida');</script>
    <?php
}else{
    if (isset($_SESSION['id'])) {
        ?>
        <script>console.log($id);</script>
        <?php
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/nav-bar.css">
    <link rel="stylesheet" href="../assets/css/CriarTreinos.css">
    <link rel="stylesheet" href="../assets/css/inicio.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Toastify/1.11.2/Toastify.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Toastify/1.11.2/Toastify.min.js"></script>
    <title>TCC</title>
</head>
<body>
    <header>
        <nav class="nav-bar">
            <div class="logo">
                <img class="img-logo" src="../assets/img/Logo_sapo.png">
            </div>

            <div class="nav-list">
                <ul>
                    <li id="home" class="nav-item active"><a href="Home.php" class="nav-link">Início</a></li>
                    <li id="CriarTreino"class="nav-item"><a href="CriarTreino.php" class="nav-link">Criar treino</a></li>
                    <li class="nav-item"><a href="CadastroAcademia.php" class="nav-link">Cadastrar academias</a></li>
                    <li class="nav-item"><a href="TreinosCriados.php" class="nav-link">Consultar treinos</a></li>
                    <li class="nav-item"><a href="CriarGrupo.php" class="nav-link">Criar Grupo</a></li>
                </ul>
            </div>

            <div class="login-botton">
                <button><a href="../controller/UserLogin.php">Entrar</a></button>
            </div>

            <div class="mobile-menu-icon">
                <button onclick="menuShow()"><img class="icon" src="../assets/img/menu_white_36dp.svg"></button>
            </div>
        </nav>

        <div class="mobile-menu">
            <ul>
                <li class="nav-item"><a href="Home.php" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="CriarTreino.php" class="nav-link">Criar treino</a></li>
                <li class="nav-item"><a href="ConsultarTreinos.php" class="nav-link">Configurações</a></li>
            </ul>

           
        </div>

        
    </header>
    
    <main id="content">
        
        <form id="loginForm" action="" method="post" class="login">
       
            <h2>Login</h2>
            <div class="box-user">
                <input type="text" name="email" required>
                <label>Usuário</label>
            </div>
            <div class="box-user">
                <input type="password" name="senha" required>
                <label>Senha</label>
            </div>
            <div>
                <a href="#" class="forget"> Esqueceu a senha?</a>
            </div>

            <div class="container-button">
            <button type="submit"><a class="btn">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Entrar
            </a></button>

            <button type=""><a href="cadastro.php" class="btn-cadastrar">
                Cadastrar
            </a></button>
            </div>
        </form>
    </main>
</body>
<script src="../assets/js/formAction.js"></script>
<script src="../assets/js/notificacao.js"></script>
</html>
