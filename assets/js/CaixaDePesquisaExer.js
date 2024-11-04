var GrupoIds = [];
var Id_academia;


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

    if (Id_academia == null){
        Id_academia = 0;
    }
    console.log(exercicio, grupo)
    // Enviar uma requisição AJAX para buscar os exercícios correspondentes
    $.ajax({
        url: '../controller/CaixaDePesquisa.php',
        method: 'GET',
        data: { exercicio: exercicio, IDgrupo: grupo, IdAcademia: Id_academia },
        dataType: 'json',
        success: function(response) {
            console.log('Resposta recebida:', response); // Veja o que está sendo retornado
    
            // Verifique se a resposta é um array
            if (Array.isArray(response)) {
                div.innerHTML = '';
                let cont = 0;
                response.forEach(function(opcao) {
                    cont++;
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
                    div.style.hover = '#f78113';
                });
            } else {
                console.error('A resposta não é um array:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição AJAX:', error);
            console.log('Resposta do servidor:', xhr.responseText); // Mostra a resposta do servidor
        }
    });
    
    
    
    
   
}

function Grupo_Exercicio(id_linha){

    var grupo = document.getElementById('grupo' + id_linha);
    console.log(grupo);

    $.ajax({
        url: '../controller/GrupoTreino.php',
        method: 'GET',
        dataType: 'json', // Especificar o tipo de dados esperado como JSON
        success: function(response) {
            console.log('Resposta recebida:', response);
            
            // Verificar se a resposta é um array e contém objetos com as propriedades id e Nome
            if (Array.isArray(response) && response.length > 0 && response.every(item => item && typeof item === 'object' && item.hasOwnProperty('id') && item.hasOwnProperty('Nome'))) {
                grupo.innerHTML = ''; 
                response.forEach(function(item) {
                    var novoElemento = document.createElement('option');
                    novoElemento.value = item.id;
                    novoElemento.textContent = item.Nome;
                    grupo.appendChild(novoElemento);
                });
            } else {
                console.error('A resposta não é um array ou não contém objetos com as propriedades esperadas:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição AJAX:', error);
        }
    });
}

function Academia(){

    var academia = document.getElementById('Academia');
    console.log(academia);

    $.ajax({
        url: '../controller/AcademiaCadastrada.php',
        method: 'GET',
        dataType: 'json', // Especificar o tipo de dados esperado como JSON
        success: function(response) {
            console.log('Resposta recebida:', response);
            
            // Verificar se a resposta é um array e contém objetos com as propriedades id e Nome
            if (Array.isArray(response) && response.every(item => item && item.hasOwnProperty('Nome'))) {
                academia.innerHTML = ''; 
                response.forEach(function(item) {
                    var novoElemento = document.createElement('option');
                    novoElemento.value = item.id;
                    novoElemento.textContent = item.Nome;
                    academia.appendChild(novoElemento);
                });
            } else {
                console.error('A resposta não é um array ou não contém objetos com as propriedades esperadas:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição AJAX:', error);
        }
    });
}

function getAcademiaSelecionada(event) {
    var selectElement = event.target; // O elemento <select> que foi clicado
    var selectedOption = selectElement.options[selectElement.selectedIndex]; // A opção selecionada
    var academiaSelecionada = selectedOption.value; // Obtém o valor da opção selecionada
    console.log('Academia Selecionada:', academiaSelecionada);
    Id_academia = academiaSelecionada;
    return academiaSelecionada;
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

    $(document).on('change click', 'select[name="Academia"]', getAcademiaSelecionada);

    $(document).on('keyup', 'input[name^="exercicios"]', Get_nome_input);

    $(document).on('click', '.option', Get_nome_input);

    //$(document).on('click', '.grupo', Get_nome_input);
    $(document).on('mousedown', '.grupo', function() {
        var idDaCaixa = $(this).attr('id');
        var numero = idDaCaixa.match(/\d+$/)[0];
        
        Grupo_Exercicio(numero);
    });

    $(document).on('mousedown', '.Academia', function() {
        
        Academia();
    });

});

//ao clicar fora do menu suspenso ele limpa da tela
document.addEventListener('click', function(event) {
    var divs = document.querySelectorAll('.opcoes-exercicios');
    var clickedInside = Array.from(divs).some(function(div) {
        return div.contains(event.target);
    });

    if (!clickedInside) {
        // Limpa todos os menus suspensos
        divs.forEach(function(div) {
            div.innerHTML = '';
            div.style.background = 'transparent';
        });
    }
});