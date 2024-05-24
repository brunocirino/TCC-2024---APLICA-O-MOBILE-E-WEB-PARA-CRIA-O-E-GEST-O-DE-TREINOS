var GrupoIds = [];

function ConsultarExercicios(id_linha, opcao, valorSelecionado) {

    console.log(GrupoIds);
    if(opcao == 's'){
        var DivOpcao = document.getElementById(id_linha);
        var exercicio = document.getElementById('exercicios' + id_linha);
        var div = document.getElementById('opcoes-exercicios' + id_linha);

       
        exercicio.value = valorSelecionado;
        //limpando menu suspenso

        div.innerHTML = '';
        div.style.background = 'transparent';
        return;
    }
    
    var grupo = document.getElementById('grupo' + id_linha).value;
    var exercicio = document.getElementById('exercicios' + id_linha).value;
    var div = document.getElementById('opcoes-exercicios' + id_linha);
    var IDGrupo = 0;

    //coletando id do array retornado da consulta
    for (let i = 0; i < GrupoIds.length; i++){
        if(GrupoIds[i].Nome == grupo){
            IDGrupo = GrupoIds[i].id;
        }
    }

    // Limpar o menu suspenso se a caixa de pesquisa estiver vazia
    if (exercicio === '') {

        div.innerHTML = '';
        div.style.background = 'transparent';

        return; // Sai da função para evitar a solicitação AJAX desnecessária
    }
    console.log(exercicio, grupo)
    // Enviar uma requisição AJAX para buscar os exercícios correspondentes
    $.ajax({
        url: '../controller/CaixaDePesquisa.php',
        method: 'POST',
        data: { exercicio: exercicio, IDgrupo: IDGrupo },
        dataType: 'json', // Especificar o tipo de dados esperado como JSON
        success: function(response) {

            // Verificar se a resposta é um array
            if (Array.isArray(response)) {
                // Adicionar as opções retornadas pela consulta ao menu suspenso
                response.forEach(function(opcao) {
                
                    div.innerHTML = '';  
                    var cont = 0;           
                    response.forEach(function(opcao) {
                        cont = cont +1;
                        var novoElemento = document.createElement('div');
                        novoElemento.className = 'option';
                        novoElemento.id = cont;
                        novoElemento.textContent = opcao.nome;
                        div.appendChild(novoElemento);

                        div.style.background = '#464646';
                        div.style.padding = '5px';
                        div.style.borderRadius = '8px';
                        div.style.zIndex = '2';
                        div.style.position = 'relative';
                    });

                });
            } else {
                console.error('A resposta não é um array:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição AJAX:', error);
        }
    });
}

function Grupo_Exercicio(id_linha){

    var grupo = document.getElementById('grupo' + id_linha);
    console.log(grupo);

    $.ajax({
        url: '../controller/GrupoTreino.php',
        method: 'POST',
        dataType: 'json', // Especificar o tipo de dados esperado como JSON
        success: function(response) {
            
            // Verificar se a resposta é um array
            if (Array.isArray(response)) {
                
                // Adicionar as opções retornadas pela consulta ao menu suspenso
                console.log(response);
                GrupoIds = response;
                console.log(GrupoIds);
                grupo.innerHTML = ''; 
                response.forEach(function(item) {
                    var novoElemento = document.createElement('option');
                    novoElemento.textContent = item.Nome;
                    grupo.appendChild(novoElemento);
                    
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

document.addEventListener("DOMContentLoaded", function() {
    // Defina a função para manipular o clique na caixa de pesquisa
    function Get_nome_input(opcao) {
        // Obter o nome da caixa de pesquisa clicada


        if(this.className == 'option'){
            var idDaDiv = this.closest('.opcoes-exercicios').id;
            var numero = idDaDiv.match(/\d+$/)[0];
            var valorSelecionado = this.textContent;
            ConsultarExercicios(numero,'s', valorSelecionado);
            return;
        }

        if(this.className == 'grupo'){
            var idDaCaixa = $(this).attr('id');
            var numero = idDaCaixa.match(/\d+$/)[0];
            
            Grupo_Exercicio(numero);
            return;
        }
        
        var idDaCaixa = $(this).attr('id');
        var numero = idDaCaixa.match(/\d+$/)[0];
        console.log('Número no click', numero);
        ConsultarExercicios(numero);
    }

    // Ouvinte de evento de clique às caixas de pesquisa
    $(document).on('click', 'input[name^="exercicios"]', Get_nome_input);


    $(document).on('keyup', 'input[name^="exercicios"]', Get_nome_input);

    $(document).on('click', '.option', Get_nome_input);

    //$(document).on('click', '.grupo', Get_nome_input);
    $(document).on('mousedown', '.grupo', function() {
        var idDaCaixa = $(this).attr('id');
        var numero = idDaCaixa.match(/\d+$/)[0];
        
        Grupo_Exercicio(numero);
    });

});