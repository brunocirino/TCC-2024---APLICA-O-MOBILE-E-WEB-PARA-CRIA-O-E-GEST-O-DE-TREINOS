var id_identificador; 
var idUser;
var nmTreino;

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('editModal');
    var btnEditar = document.getElementById('btn-editar');
    var spanClose = document.getElementsByClassName('close')[0];
    var model_titulo = document.getElementById('model-titulo');
    var btnSalvar = document.getElementById('btn-salvar');
    var btnExcluir = document.getElementById('btn-Excluir');
    var btnAdicionar = document.getElementById('btn-adicionar');
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

    btnAdicionar.addEventListener('click', function() {
        isEditMode = false;  // Definir modo de adição
        model_titulo.style.display = 'none';
        modal.style.display = 'block';
        Titulo.textContent = "Adicionar exercicio";

        document.getElementById('edit-exercicios').value = '';
        document.getElementById('edit-series').value = '';
        document.getElementById('edit-repeticoes').value = '';
        document.getElementById('edit-peso').value = '';
        document.getElementById('edit-comentarios').value = '';
    });

    btnEditar.addEventListener('click', function() {
        var CodigoMat = document.querySelector('.product-id').value;
        
        var url = `http://localhost:3001/ConsultaTreinoExist/${CodigoMat}`;
        
        isEditMode = true;  // Definir modo de edição
       
        if (CodigoMat) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Requisição AJAX bem sucedida:', response);
                    var Treino = response[0];

                    var titulo = Treino.Titulo;
                    var exercicio = Treino.Exercicio;
                    var series = Treino.Serie;
                    var repeticoes = Treino.Repetição;
                    var peso = Treino.peso;
                    var comentarios = Treino.Comentario;


                    document.getElementById('edit-titulo').value = titulo;
                    document.getElementById('edit-exercicios').value = exercicio;
                    document.getElementById('edit-series').value = series;
                    document.getElementById('edit-repeticoes').value = repeticoes;
                    document.getElementById('edit-peso').value = peso;
                    document.getElementById('edit-comentarios').value = comentarios;

                    Titulo.textContent = "Editar treino";
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição AJAX:', error);
                }
            });
            modal.style.display = 'block';
        } else {
            toastr.options.positionClass = 'toast-bottom-right'; // Define a posição
                toastr.options.timeOut = 5000; // Tempo antes de esconder

                // Chama a notificação com opacidade específica
                toastr.warning('Por favor, digite o código do exercicio.', 'Aviso!', {
                    "opacity": 0.9 // Definindo a opacidade diretamente aqui
                });
                
        }
    });

    btnSalvar.addEventListener('click', function(){
        var modal = document.getElementById('editModal');
        var CodigoTreino = document.querySelector('.product-id').value;
        var TreinoSelecionado = document.getElementById('grupo1');
        

        event.preventDefault();
        
        var titulo = document.getElementById('edit-titulo').value
        var exercicio = document.getElementById('edit-exercicios').value;
        var series = document.getElementById('edit-series').value;
        var repeticoes = document.getElementById('edit-repeticoes').value;
        var peso = document.getElementById('edit-peso').value;
        var comentarios = document.getElementById('edit-comentarios').value;

        var urlAdicionar = `http://localhost:3001/CadastrarTreino/${idUser}/${nmTreino}/${exercicio}/${series}/${repeticoes}/${peso}/${comentarios}/${id_identificador}`;

        var urleditar = `http://localhost:3001/AlterarTreinoExist/${CodigoTreino}`;


        // Verifica se o nome do treino foi alterado
        var dataToSend = {
            nm_treino: titulo,
            exercicios: exercicio,
            series: series,
            repeticoes: repeticoes,
            peso: peso,
            comentarios: comentarios,
            id_identificador: id_identificador
        };        

        console.log(urleditar);
       if(isEditMode){
        $.ajax({
            url: urleditar,
            method: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify(dataToSend),
            success: function(response) {
                console.log('Requisição AJAX bem sucedida:', response);
                
                toastr.options.positionClass = 'toast-bottom-right'; // Define a posição
                toastr.options.timeOut = 5000; // Tempo antes de esconder

                // Chama a notificação com opacidade específica
                toastr.success('Treino alterado com sucesso', 'Sucesso!', {
                    "opacity": 0.9 // Definindo a opacidade diretamente aqui
                });
                
                modal.style.display = 'none';

                var url = `http://localhost:3001/trazerTreinos/${titulo}/${idUser}`;
        
                // Dispara um evento personalizado com a URL
                var event = new CustomEvent('mostrarTabela', { detail: { url: url , aba: 'treino'} });
                document.dispatchEvent(event);
                var value = TreinoSelecionado.value
                 // Atualiza o texto da opção correspondente no select
                var options = selectElement.options;
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value === value) {
                        console.log(options[i])
                        options[i].text = titulo;
                        break; 
                    }
                }
                
                
            },
            error: function(xhr, status, error) {
                console.error('Erro na requisição AJAX:', error);
            }
        });
       }else{
        $.ajax({
            url: urlAdicionar,
            method: 'POST',
            success: function(response) {
                console.log('Requisição AJAX bem sucedida:', response);
                // Notificação de sucesso no canto inferior direito
                toastr.options.positionClass = 'toast-bottom-right'; // Define a posição
                toastr.options.timeOut = 5000; // Tempo antes de esconder

                // Chama a notificação com opacidade específica
                toastr.success('Exercício adicionado com sucesso.', 'Sucesso!', {
                    "opacity": 0.9 // Definindo a opacidade diretamente aqui
                });
                modal.style.display = 'none';

                var url = `http://localhost:3001/trazerTreinos/${nmTreino}/${idUser}`;
        
                // Dispara um evento personalizado com a URL
                var event = new CustomEvent('mostrarTabela', { detail: { url: url , aba: 'treino'} });
                document.dispatchEvent(event);
            },
            error: function(xhr, status, error) {
                console.error('Erro na requisição AJAX:', error);
            }
        });
       }
    })

    btnExcluir.addEventListener('click', function() {
        var CodigoTreino = document.querySelector('.product-id').value;

        var url = `http://localhost:3001/excluir_exercicio/${CodigoTreino}`;

        console.log(CodigoTreino);
        if (CodigoTreino) {
            if (confirm("Tem certeza que deseja excluir este exercicio?")) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function(response) {
                        console.log('Exercicio excluído com sucesso:', response);
                        toastr.options.positionClass = 'toast-bottom-right'; // Define a posição
                        toastr.options.timeOut = 5000; // Tempo antes de esconder

                        // Chama a notificação com opacidade específica
                        toastr.success('Excluído com sucesso!', 'Sucesso!', {
                            "opacity": 0.9 // Definindo a opacidade diretamente aqui
                        });
                
                        modal.style.display = 'none';
                        var url = `http://localhost:3001/trazerTreinos/${nmTreino}/${idUser}`;
        
                        // Dispara um evento personalizado com a URL
                        var event = new CustomEvent('mostrarTabela', { detail: { url: url , aba: 'treino'} });
                        document.dispatchEvent(event);
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro na requisição AJAX:', error);
                    }
                });
            }
        } else {
            toastr.options.positionClass = 'toast-bottom-right'; // Define a posição
                toastr.options.timeOut = 5000; // Tempo antes de esconder

                // Chama a notificação com opacidade específica
                toastr.warning('Por favor, digite o código do exercicio.', 'Aviso!', {
                    "opacity": 0.9 // Definindo a opacidade diretamente aqui
                });
                
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
