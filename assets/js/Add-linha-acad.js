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
                    <select class="grupo" name="grupos[]" id="grupo${id_linha}">
                            
                    </select>
                </div>

                </div>

                <div class="divisoria">

                </div>
                

                <div class="input-box">
                    <div class="title">
                        <a>Aparelho</a>
                    </div>

                    <div class="input-academia">
                        <input type="text" name="aparelhos[]" id="aparelho${id_linha}" placeholder="Digite aqui" required>
                    </div>

                    <div class="input-add-linha">
                    <a class="remover-linha-Exercicio"><ion-icon name="remove"></ion-icon></a>   
                    <a class="adicionar-linha-Exercicio"><ion-icon name="add-circle"></ion-icon></a>                     
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

