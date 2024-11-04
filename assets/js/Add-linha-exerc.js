// Definindo a função para consultar exercícios
function Linha_adicional() {
    var id_linha = $('.input-group').length + 1;

    // HTML a ser adicionado
    var htmlToAdd = `
        <div class="input-group">
            <div class="input-box">
                <div class="title">
                    <a>Grupo</a>
                </div>
                
                <div class="input-select">
                    <select class="grupo" name="grupo" id="grupo${id_linha}">
                        <option value="SUP">Superior</option>
                        <option value="INFER">Inferior</option>
                    </select>
                </div>
            </div>

            <div class="divisoria">

            </div>

            <div class="input-box">
                <div class="title">
                    <a>Exercicio</a>
                </div>

                <div class="input-exercicios">
                    <input type="text" name="exercicios[]" id="exercicios${id_linha}" placeholder="Digite aqui" required>
                    <div class="opcoes-exercicios" id="opcoes-exercicios${id_linha}"">

                    </div>
                </div>
            </div>

            <div class="input-box">
                <div class="title">
                    <a>Series</a>
                </div>

                <div class="input-series">
                    <input type="text" name="series[]" required>
                </div>
            </div>

            <div class="input-box">
                <div class="title">
                    <a>Repetições</a>
                </div>
                
                
                <div class="input-reps">
                    <input type="text" name="reps[]" required>    
                </div>
            </div>

            <div class="input-box">
                    <div class="title">
                        <a>Peso</a>
                    </div>
                
                
                    <div class="input-peso">
                        <input type="text" name="peso[]" required>    
                    </div>
            </div>

            <div class="input-box">
                <div class="title">
                    <a>Comentarios:</a>
                </div>

                <div class="comentarios">
                    <textarea name="comentario[]" class="input-comentarios" rows="4" cols="30" placeholder="Digite aqui..."></textarea>
                </div>
            </div>
        </div>
    `;

    // Adicionando o HTML após o elemento com a classe input-group
    $('.input-group').last().after(htmlToAdd);
    $('.remover-linha-Exercicio').show();

}

// Associando a função ao evento de clique do botão
$(document).on('click', '.adicionar-linha-Exercicio', Linha_adicional);

