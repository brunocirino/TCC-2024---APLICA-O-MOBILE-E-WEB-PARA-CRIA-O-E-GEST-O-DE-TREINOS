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
            toastr.success('Treino Cadastrado com sucesso.', 'Sucesso');
            setTimeout(function() {
                window.location.href = '../view/CriarTreino.php';
            }, 3000);
        } else if (success === 2) {
            alert('Opss.. Ocorreu um erro inesperado');
            window.location.href = '../view/CriarTreino.php';
        }
    });
</script>";

echo "<script>var idProfessor = " . $_SESSION['id'] . ";</script>";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/nav-bar_Logado.css">
    <link rel="stylesheet" href="../assets/css/TreinosCriados.css">
    <link rel="stylesheet" href="../assets/css/Modal_AlterarExcluirTreinos.css">
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
                    <li class="nav-item"><a href="CadastroAcademia.php" class="nav-link">Cadastrar academias</a></li>
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
        <form>    
            <div class="tbs-buttons">
                <button class="tab-btn active" content-id="Aluno">
                    Atribuir Aluno
                </button>
                <button class="tab-btn" content-id="Treino">
                    Alterar Treino
                </button>
                <button class="tab-btn" content-id="GestaoAcessoTreino">
                    Gerir acesso ao treino
                </button>
            </div>      

            <div class="tbs-content">
                <div class="conteudo show"  id="Aluno">
                    <div class="titulo">
                        <div class="input-box-titulo">
                        <div class="title">
                                <a>Atribua seu aluno ao treino</a>
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
                    
                        
                        <div class="input-box">
                            <div class="title">
                                <a>Atribuir para:</a>
                            </div>
                            
                            <div class="input-titulo">
                                <input type="text" id="AlunoTreino" name="AlunoTreino" placeholder="Digite aqui" required>
                            </div>

                            <div class="alunoSelecionado" id="alunoSelecionado">
                                <p></p>
                            </div>
                        </div>    
                    </div>
                </div>

                <div class="conteudo"  id="Treino">
                
                    <div class="titulo">
                        <div class="input-box-titulo">
                            <div class="title">
                                <a>Altere seu treino</a>
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
                                <select class="Treino" name="grupo" id="grupo1">
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tabela" id="tabela">
                        <div class="cabecalho">
                            <div class="row-input">
                                <input type="text" class="product-id" placeholder="Digite o codigo da linha">
                            </div>

                            <div class="titulo-tabela">
                                <h1>Treino: </h1>
                            </div>
                           
                            <div class="row-buttons">
                                <button id="btn-adicionar">Adicionar</button>
                                <button id="btn-editar">Editar</button>
                                <button id="btn-Excluir">Excluir</button>
                            </div>
                        </div>

                        
                        <div class="TreinoSelecionado">
                            
                            <table>
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Exercicios</th>
                                        <th>Series</th>
                                        <th>Repetições</th>
                                        <th>Peso</th>
                                        <th>Comentários</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- As linhas de dados serão inseridas aqui -->
                                </tbody>
                            </table>
                            
                        </div>

                    </div>
                </div>

                <div class="conteudo" id="GestaoAcessoTreino">
                    <div class="titulo">
                            <div class="input-box-titulo">
                                <div class="title">
                                    <a>Gestão de acesso ao treino</a>
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
                                    <select class="GestaoTreino" name="GestaoTreino" id="GestaoTreino1">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tabela" id="tabelaGestaoTreino">
                        <div class="cabecalho">
                            <div class="row-input-gestao">
                                <input type="text" class="product-id-gestao" placeholder="ID">
                            </div>

                            <div class="titulo-tabela">
                                <h1>Gestão de acesso ao treino: </h1>
                            </div>
                           
                            <div class="row-buttons">
                                <button id="btn-Excluir-gestao">Excluir</button>
                            </div>
                        </div>

                        
                        <div class="TreinoSelecionado" id="GestaoTreinoTable">
                            
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Aluno</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- As linhas de dados serão inseridas aqui -->
                                </tbody>
                            </table>
                            
                        </div>

                    </div>
                </div>
            </div>

            <div class="submit-button" id="button">
                <button type="submit"><a class="btn">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Atribuir
                </a></button>
            </div>
        </form>
    </div>
        
    </div>
    </main>

    
<!-- Modal para editar usuário -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modal-title">Editar treino</h2>
        <form id="form-editar-usuario">
            <input type="hidden" id="edit-codigo">
            <div id="model-titulo">
                <label for="edit-titulo">Titulo:</label>
                <input type="text" id="edit-titulo" name="edit-titulo">
            </div>
            <div>
                <label for="edit-exercicios">Exercicio:</label>
                <input type="text" id="edit-exercicios" name="edit-exercicios">
            </div>
            <div>
                <label for="edit-series">Series:</label>
                <input type="text" id="edit-series" name="edit-series">
            </div>
            <div>
                <label for="edit-repeticoes">Repetições:</label>
                <input type="text" id="edit-repeticoes" name="edit-repeticoes">
            </div>

            <div>
                <label for="edit-peso">Peso:</label>
                <input type="text" id="edit-peso" name="edit-peso">
            </div>
            <div>
                <label for="edit-comentarios">Comentários:</label>
                <input type="text" id="edit-comentarios" name="edit-comentarios">
            </div>

            <button id="btn-salvar">Salvar</button>
        </form>
    </div>
</div>

</body>
    <script src="../assets/js/AdicionarTabelaComTreino.js"></script>
    <script src="../assets/js/TreinoCriados.js"></script>
    <script src="../assets/js/Consultar-Treino-tabs.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/dropdownMenu.js"></script>
    <script src="../assets/js/AlterarExcluirEditarTreino.js"></script>
    <script type="module" src="../assets/js/CaixaDePesquisaAluno.js"> </script>
    <script src="../assets/js/ExcluirAcessoTreino.js"></script>

    
</html>