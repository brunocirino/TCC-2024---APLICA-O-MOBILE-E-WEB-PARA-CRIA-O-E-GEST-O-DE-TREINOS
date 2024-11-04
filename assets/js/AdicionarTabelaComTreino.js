const tabela = document.getElementById('tabela');
const tabelaGestaoTreino = document.getElementById('tabelaGestaoTreino');
var id_identificador; 

console.log(tabela);

function MostrarTabela(url, aba, id_identificador) {
    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json', // Especificar o tipo de dados esperado como JSON
        success: function(response) {
            let tbody;

            // Verifica o valor de 'aba' e seleciona o tbody correto
            if (aba ==
                 'treino') {
                console.log('treino')
                tbody = document.querySelector('#tabela .TreinoSelecionado table tbody');
                tbody.innerHTML = '';
                  // Verificar se a resposta é um array
            if (Array.isArray(response)) {
                // Itera sobre os dados recebidos da API
                response.forEach(function(item) {
                    // Cria uma nova linha
                    var tr = document.createElement('tr');
                    
                    // Cria e adiciona as células à linha
                    var tdcodigo = document.createElement('td');
                    tdcodigo.textContent = item.id;
                    tr.appendChild(tdcodigo);

                    var tdExercicios = document.createElement('td');
                    tdExercicios.textContent = item.exercicios;
                    tr.appendChild(tdExercicios);

                    var tdSeries = document.createElement('td');
                    tdSeries.textContent = item.series;
                    tr.appendChild(tdSeries);

                    var tdRepeticoes = document.createElement('td');
                    tdRepeticoes.textContent = item.repeticoes;
                    tr.appendChild(tdRepeticoes);

                    var tdPeso = document.createElement('td');
                    tdPeso.textContent = item.peso;
                    tr.appendChild(tdPeso);

                    var tdComentarios = document.createElement('td');
                    tdComentarios.textContent = item.count; // Ou algum valor específico se você tiver
                    tr.appendChild(tdComentarios);

                    // Adiciona a linha ao corpo da tabela
                    tbody.appendChild(tr);
                    tabela.style.display = 'initial'; 
                });
            } else {
                console.error('A resposta não é um array:', response);
            }
            } else if (aba == 'gestao') {
                console.log('gestao')
                tbody = document.querySelector('#tabelaGestaoTreino .TreinoSelecionado table tbody');
                tbody.innerHTML = '';
                  // Verificar se a resposta é um array
            if (Array.isArray(response)) {
                console.log(response)
                // Itera sobre os dados recebidos da API
                response.forEach(function(item) {
                    console.log('gestao2')
                    // Cria uma nova linha
                    var tr = document.createElement('tr');

                    // Cria e adiciona as células à linha

                    var tdid = document.createElement('td');
                    tdid.textContent = item.id;
                    tr.appendChild(tdid);

                    var tdaluno = document.createElement('td');
                    tdaluno.textContent = item.nm_aluno;
                    tr.appendChild(tdaluno);

                    // Adiciona a linha ao corpo da tabela
                    tbody.appendChild(tr);
                    tabelaGestaoTreino.style.display = 'initial'; 
                });
            } else {
                console.error('A resposta não é um array:', response);
            }
            } else {
                console.error('Aba inválida:', aba);
                return;
            }
          
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição AJAX:', error);
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    $(document).on('change', '.Treino', function() {
        var selectElement = $(this); // O elemento <select> que disparou o evento
        var selectedValue = selectElement.val(); // Obtém o valor selecionado
        var selectedText = selectElement.find('option:selected').text(); // Obtém o texto da opção selecionada
        var url = `http://localhost:3001/trazerTreinos/${selectedText}/${idProfessor}`;
        // Chama a função com o valor selecionado
        var aba = 'treino';
        MostrarTabela(url, aba);
    });

    $(document).on('change', '.GestaoTreino', function() {

        var selectElement = $(this); // O elemento <select> que disparou o evento
        var selectedValue = selectElement.val(); // Obtém o valor selecionado
        var selectedText = selectElement.find('option:selected').text(); // Obtém o texto da opção selecionada
        var url = `http://localhost:3001/ConsultarAlunosAtribuidos/${idProfessor}/${id_identificador}`;
        // Chama a função com o valor selecionado
        var aba = 'gestao';
        console.log(url)
        id_identificador = this.value; // Armazena o ID do treino selecionado na variável
        console.log("Treino selecionado: " + id_identificador);
        MostrarTabela(url, aba, id_identificador);
    });
});

document.addEventListener('mostrarTabela', function(event) {
    var url = event.detail.url;
    var aba = event.detail.aba; // Adiciona a aba aqui
    MostrarTabela(url, aba);
});
