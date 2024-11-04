var id_identificador; 
var id_aluno; 

function Treinos_Id_prof(treinoId){

    var grupo = document.getElementById(treinoId);

    $.ajax({
        url: '../controller/TreinosCriados.php',
        method: 'GET',
        dataType: 'json', // Especificar o tipo de dados esperado como JSON
        success: function(response) {
            
            // Verificar se a resposta é um array
            if (Array.isArray(response)) {
                // Adicionar as opções retornadas pela consulta ao menu suspenso
                //console.log(response);
                grupo.innerHTML = ''; 

                 // Adiciona uma opção "placeholder" no início
                var placeholderOption = document.createElement('option');
                placeholderOption.textContent = 'Selecione um treino'; // Texto da opção placeholder
                placeholderOption.value = ''; // Valor da opção placeholder
                placeholderOption.disabled = true; // Desabilita a opção para que não possa ser selecionada depois
                placeholderOption.selected = true; // Define como a opção selecionada inicialmente
                grupo.appendChild(placeholderOption);
                
                response.forEach(function(item) {
                    var novoElemento = document.createElement('option');
                    novoElemento.textContent = item.nm_treino;
                    novoElemento.value = item.id_treino
                    grupo.appendChild(novoElemento);
                    
                });

                grupo.addEventListener('change', function() {
                    id_identificador = this.value; // Armazena o ID do treino selecionado na variável
                    //console.log("Treino selecionado: " + id_identificador);
                });
            }
            else {
                console.error('A resposta não é um array:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição AJAX:', error);
        }
    });
}


function Buscar_Aluno(ID_Aluno){

    var div = document.getElementById('alunoSelecionado');
    var p = div.querySelector('p'); // Seleciona o elemento <p> dentro da div

    $.ajax({
        url: '../controller/ConsultarAlunoExist.php',
        method: 'GET',
        data: { ID_Aluno: ID_Aluno},
        dataType: 'json', // Especificar o tipo de dados esperado como JSON
        success: function(response) {
            
            // Verificar se a resposta é um array
            if (Array.isArray(response)) {
                // Adicionar as opções retornadas pela consulta ao menu suspenso
                console.log(response);
                p.textContent = '';
                response.forEach(function(item) {
                    p.textContent = response[0].nm_aluno;
                    div.style.display = 'initial'; 
                    id_aluno = response[0].id_aluno;
                });
            }
            else {
                console.error('A resposta não é um array:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição AJAX:', error);
        }
    });
}

function Atribuir_Aluno(ID_Aluno){

    var div = document.getElementById('alunoSelecionado');
    var p = div.querySelector('p'); // Seleciona o elemento <p> dentro da div

    $.ajax({
        url: '../controller/AtribuirAlunoTreino.php',
        method: 'POST',
        data: {ID_Aluno: ID_Aluno, ID_Treino: id_identificador},
        dataType: 'json', // Especificar o tipo de dados esperado como JSON
        success: function(response) {
            
                // Verificar se a resposta contém a propriedade 'sucesso'
            if (response.sucesso) {
                // Atualiza a interface com base na resposta
                console.log(response);
                alert(response.mensagem)
                div.style.display = 'initial';
                  p.textContent = '';
            } else {
                console.error('Resposta não contém sucesso:', response);
            }
            },
            error: function(xhr, status, error) {
                console.error('Erro na requisição AJAX:', error);
            }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    
    $(document).on('mousedown', '.Treino', function() {
        var idDaClasse = $(this).attr('id');
        //console.log(idDaClasse);
        Treinos_Id_prof(idDaClasse);
        
    });

    $(document).on('mousedown', '.GestaoTreino', function() {
        var idDaClasse = $(this).attr('id');
        //console.log(idDaClasse);
        Treinos_Id_prof(idDaClasse);
        
    });

    document.getElementById("AlunoTreino").addEventListener("input", function() {
        var valorDigitado = this.value;
        console.log("Valor digitado: " + valorDigitado);
        // Chama a função desejada passando o valor digitado
        Buscar_Aluno(valorDigitado);
    });

    $(document).on('click', '.submit-button .btn', function() {
        event.preventDefault();
        console.log("Botão clicado com o valor: " + id_aluno);
        Atribuir_Aluno(id_aluno);
    });

});