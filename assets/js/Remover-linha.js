// Definindo a função para remover a linha
function removerLinha() {
    // Verificar quantos elementos .input-group existem após a remoção
    if ($('.input-group').length == 1) {
        $('#remover-linha-Exercicio').hide(); // Ocultar o botão de remoção
        return;
    }
    // Remover a última div com a classe input-group
    $('.input-group').last().remove();
}

// Associando a função ao evento de clique do botão de remover
$(document).on('click', '.remover-linha-Exercicio', removerLinha);
