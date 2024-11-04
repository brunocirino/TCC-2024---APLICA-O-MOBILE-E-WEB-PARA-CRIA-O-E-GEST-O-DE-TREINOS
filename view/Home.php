<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/nav-bar.css">
    <link rel="stylesheet" href="../assets/css/Section_CriarTreinos.css">
    <link rel="stylesheet" href="../assets/css/inicio.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    <li class="nav-item active"><a href="Home.php" class="nav-link">Início</a></li>
                    <li class="nav-item"><a href="CriarTreino.php" class="nav-link">Criar treino</a></li>
                    <li class="nav-item"><a href="CadastroAcademia.php" class="nav-link">Cadastrar academias</a></li>
                    <li class="nav-item"><a href="TreinosCriados.php" class="nav-link">Consultar treinos</a></li>
                    <li class="nav-item"><a href="CriarGrupo.php" class="nav-link">Criar Grupo</a></li>
                </ul>
            </div>

            <div class="login-botton">
                <button><a href="Login.php">Entrar</a></button>
            </div>

            <div class="mobile-menu-icon">
                <button onclick="menuShow()"><img class="icon" src="../assets/img/menu_white_36dp.svg"></button>
            </div>
        </nav>

        <div class="mobile-menu">
            <ul>
                <li class="nav-item"><a href="Home.php" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="CriarTreino.php" class="nav-link">Criar treino</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Configurações</a></li>
            </ul>

            <div class="login-botton">
                <button><a href="Login.php">Entrar</a></button>
            </div>
        </div>

        
    </header>
    
    <main id="content">
        <section id="inicio">
            <div id="cta-inicio">
                <h1 class="title">
                    Sua nova ferramenta de treino
                </h1>

                <p class="description">
                    Nossa ferramento irá te ajudar a ser um profissional atualizado no mercado de trabalho.

                </p>

                <p class="description">
                    Um profissinal que utiliza a tecnologia a seu favor, para facilitar o dia a dia.

                </p>

                <p class="description">
                    Cadastre-se já em nossa plataforma para utilizar suas funcionalidades.

                </p>

                <div class="inicio-botton">
                <button><a href="cadastro.php">cadastre-se</a></button>
                </div>
            </div>

            <div id="banner">
                <img class="img-inicio" src="../assets/img/inicio.png">
            </div>
        </section>

        <section id="criarTreinos">
            <div id="cta">
                <h1 class="title">
                    Monte seu treino com facilidade e <span>praticidade</span>
                </h1>

                <p class="description">
                    Nossa plataforma tem como objetivo te auxiliar na gestão dos treinos de seus alunos.
                </p>

                <p class="description">
                    Aqui você podera montar rotinas de treino, escolhendo equipamentos, estilos, séries e repetições.
                </p>

                <p class="description">
                    Para além disso, você podera acompanhar o progresso dos seus alunos visualizando os treinos marcados como feitos.
                </p>

                <p class="description">
                    E caso haja a necessidade, poderá editar ou criar novas rotinas que se adaptem ao estilo de cada um.
                </p>
                <div class="login-botton">
                    <button><a href="Login.php">Criar Treinos</a></button>
                </div>
            </div>

            <div id="banner">
                <img class="img-inicio" src="">
            </div>
        </section>
    </main>
    <footer>
        <img src="assets/img/wave.svg" alt="">
        <div id="footer_items">
            <span id="copyright">
                NO SKIP | 2024
            </span>
        </div>
    </footer>
    <script src="../assets/js/script.js"></script>
</body>
</html>