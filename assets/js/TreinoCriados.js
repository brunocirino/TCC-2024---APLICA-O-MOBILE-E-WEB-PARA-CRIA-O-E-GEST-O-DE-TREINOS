
function Treinos_Id_prof(){

    var grupo = document.getElementById('grupo');
    console.log(grupo);

    $.ajax({
        url: '../controller/TreinosCriados.php',
        method: 'POST',
        dataType: 'json', // Especificar o tipo de dados esperado como JSON
        success: function(response) {
            
            // Verificar se a resposta é um array
            if (Array.isArray(response)) {
                // Adicionar as opções retornadas pela consulta ao menu suspenso
                console.log(response);
                grupo.innerHTML = ''; 
                response.forEach(function(item) {
                    var novoElemento = document.createElement('option');
                    novoElemento.textContent = item.nm_treino;
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
    
    $(document).on('mousedown', '.Treino', function() {
        Treinos_Id_prof();
    });

});