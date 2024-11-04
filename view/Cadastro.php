<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/nav-bar.css">
    <link rel="stylesheet" href="../assets/css/cadastro.css">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
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
                <button><a href="login.php">Entrar</a></button>
            </div>

            <div class="mobile-menu-icon">
                <button onclick="menuShow()"><img class="icon" src="assets/img/menu_white_36dp.svg"></button>
            </div>
        </nav>

        <div class="mobile-menu">
            <ul>
                <li class="nav-item"><a href="Home.php" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="CriarTreino.php" class="nav-link">Criar treino</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Configurações</a></li>
            </ul>

            <div class="login-botton">
                <button><a href="login.php">Entrar</a></button>
            </div>
        </div>

        
    </header>
    
    <main id="content">
        
        <form action="../controller/UserCadastro.php" method="post" class="login">
            <div class="title">
            <h2>Cadastre-se</h2>
            </div>
        <div class="entradas">
            
            <div class="SubTitulo-1">    
                <a>Informações pessoais</a> <a class="linha1"><ion-icon name="arrow-dropdown"></ion-icon></a>
            </div>

            <div class="input-group-pessoal">
                <div class="divisoria">
                
                </div>

                <div class="input-box">
                    <label for="firstname">Primeiro nome</label>
                    <input id="firstname" type="text" name="firstname" placeholder="Digite seu primeiro nome" required>
                </div>

                <div class="input-box">
                        <label for="lastname">Sobrenome</label>
                        <input id="lastname" type="text" name="lastname" placeholder="Digite seu sobrenome" required>
                </div>

                <div class="input-box">
                    <label for="number">Celular</label>
                    <input id="number" type="text" name="number" placeholder="(xx) xxxx-xxxx" required>
                </div>

                <div class="gender-group">
                    
                    <div class="gender-title">
                        <h6>Gênero</h6> 
                    </div>
                    
                <div class="format-gender-input">

                    <div class="gender-input">
                        <input type="radio" id="female" name="gender">
                        <label for="female">Feminino</label>
                    </div>

                    <div class="gender-input">
                        <input type="radio" id="male" name="gender">
                        <label for="male">Masculino</label>
                    </div>

                    <div class="gender-input">
                        <input type="radio" id="others" name="gender">
                        <label for="others">Outros</label>
                    </div>

                    <div class="gender-input">
                        <input type="radio" id="none" name="gender">
                        <label for="none">Prefiro não dizer</label>
                    </div>
                </div>
                </div>
            </div>

            <div class="SubTitulo-2">    
                <a>Informações para login</a> <a class="linha2"><ion-icon name="arrow-dropdown"></ion-icon></a>
            </div>

            <div class="input-group-login">
                <div class="divisoria">
                
                </div>
                <div class="input-box">
                        <label for="email">E-mail</label>
                        <input id="email" type="text" name="email" placeholder="Digite seu email" required>
                </div>

                <div class="input-box">
                    <label for="senha">Senha</label>
                    <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required>
                </div>

                <div class="input-box">
                    <label for="ConfirmarSenha">Confirmar Senha</label>
                    <input id="ConfirmarSenha" type="password" name="confirmarSenha" placeholder="Digite sua senha" required>
                </div>
                
            </div>

            <div class="SubTitulo-3">    
                <a>Informações para endereço</a> <a class="linha3"><ion-icon name="arrow-dropdown"></ion-icon></a>
            </div>

            <div class="input-group-endereco">  

                <div class="divisoria">
                
                </div>
                    
                <div class="input-box">
                    <label for="cep">CEP</label>
                    <input id="cep" type="text" name="cep" placeholder="Insira seu cep" required>
                </div>

                <div class="input-box">
                    <label for="cidade">Cidade</label>
                    <input id="cidade" type="text" name="cidade" placeholder="Insira sua cidade" required>
                </div>

                <div class="input-box">
                    <label for="estado">Estado</label>
                    <input id="estado" type="text" name="estado" placeholder="Insira seu estado" required>
                </div>

                <div class="input-box">
                    <label for="bairro">Bairro</label>
                    <input id="bairro" type="text" name="bairro" placeholder="Insira seu bairro" required>
                </div>

                <div class="input-box">
                    <label for="numero">Numero</label>
                    <input id="numero" type="number" name="numeroEndereco" placeholder="Insira o numero" required>
                </div>

                <div class="input-box">
                    <label for="logradouro">Logradouro</label>
                    <input id="logradouro" type="text" name="logradouro" placeholder="Insira o logradouro" required>
                </div>

                <div class="input-box">
                    <label for="complemento">Complemento</label>
                    <input id="complemento" type="text" name="complemento" placeholder="Insira o complemento" required>
                </div>
            </div>
        </div>
        </div>
            <div class="container-button">
                <button type="submit"><a class="btn">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Cadastrar
                </a></button>
            </div>

        </form>
    </main>

    <script type="module" src="../assets/js/script-senha.js"></script>
    <script src="../assets/js/eye-button.js"></script>
    <script src="../assets/js/api-cep.js"></script>
    <script src="../assets/js/input-mask.js"></script>
    <script src="../assets/js/Fechar-AbrirLinha.js"></script>
    <script src="../assets/js/notificacao.js"></script>
</body>
</html>
