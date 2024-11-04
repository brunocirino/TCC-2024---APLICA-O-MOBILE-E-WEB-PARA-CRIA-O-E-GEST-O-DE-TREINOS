var id_identificador; 
var idUser;
var nmTreino;

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('editModal');
    var spanClose = document.getElementsByClassName('close')[0];
    var model_titulo = document.getElementById('model-titulo');
    var btnExcluir = document.getElementById('btn-Excluir-gestao');
    var Titulo = document.getElementById('modal-title');
    var TreinoSelecionado = document.getElementById('grupo1');
    var isEditMode = false;  // Variável para rastrear o modo atual

    
    $.ajax({
        url: '../controller/get_user_id.php', // Caminho para o seu script PHP
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.id) {
                idUser = response.id;
                console.log("ID do Usuário:", idUser);
                // Agora você pode usar a variável idUser no seu JS
            } else {
                console.log("Usuário não está logado ou ID não disponível.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Erro ao obter o ID do usuário:", error);
        }
    });
    
    TreinoSelecionado.addEventListener('change', function() {
        id_identificador = this.value; // Armazena o ID do treino selecionado na variável
        //console.log("Treino selecionado: " + id_identificador);
        nmTreino = this.options[this.selectedIndex].text;
        //console.log("Treino selecionado:", treinoTexto);
    });

    btnExcluir.addEventListener('click', function() {
        var CodigoAcesso = document.querySelector('.product-id-gestao').value;

        var url = `http://localhost:3001/excluir_acesso_aluno/${CodigoAcesso}`;

        console.log(CodigoAcesso);
        if (CodigoAcesso) {
            if (confirm("Tem certeza que deseja excluir o acesso desse aluno?")) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function(response) {
                        console.log('Exercicio excluído com sucesso:', response);
                        alert("Excluído com sucesso!");
                        modal.style.display = 'none';
                        var url = `http://localhost:3001/ConsultarAlunosAtribuidos/${idUser}`;
        
                        // Dispara um evento personalizado com a URL
                        var event = new CustomEvent('mostrarTabela', { detail: { url: url ,aba: 'gestao'} });
                        document.dispatchEvent(event);

                        CodigoAcesso = '';
                        document.querySelector('.product-id-gestao').value = CodigoAcesso;
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro na requisição AJAX:', error);
                    }
                });
            }
        } else {
            alert('Por favor, digite o código do aluno.');
        }  
    });

    spanClose.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    var productIdInput = document.querySelector('.product-id');
    productIdInput.addEventListener('input', function(event) {
        var valorDigitado = event.target.value;
        console.log('Valor digitado:', valorDigitado);
    });
});
