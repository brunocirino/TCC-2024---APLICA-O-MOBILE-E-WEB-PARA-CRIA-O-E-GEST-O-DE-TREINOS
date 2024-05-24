import ConsultarNomeTreino from "../js/VerificarNomeTreino.js";

function ConsultarAluno(){

    console.log("entrei")
    var div = document.getElementById('opcoes-alunos');
    var input = document.getElementById('Aluno').value;
    var a = document.getElementById('AlunoSelecionado');

    if(input == ''){
        a.style.display = 'none';
    }

    $.ajax({
        url: '../controller/CaixaDePesquisaAluno.php',
        method: 'POST',
        data: { idAluno: input },
        dataType: 'json', // Especificar o tipo de dados esperado como JSON
        success: function(response){

            div.innerHTML = ''; 
            div.style.display = 'none'; 
            var cont = 0; 
            // Verificar se a resposta é válida
            if(Array.isArray(response)){
                response.forEach(function(Aluno) {
                    var nome = Aluno.nome;

                    var nomeFormatado = nome.toLowerCase().replace(/\b\w/g, function(match) {
                        return match.toUpperCase();
                    });
                    
                    cont = cont +1;
                        var novoElemento = document.createElement('div');
                        novoElemento.className = 'optionAluno';
                        novoElemento.id = cont;
                        novoElemento.textContent = nomeFormatado;
                        div.appendChild(novoElemento);

                        
                        div.style.background = '#464646';
                        div.style.padding = '7px';
                        div.style.borderRadius = '8px';
                        div.style.zIndex = '2';
                        div.style.position = 'absolute';
                        div.style.display = 'flex';
                        div.style.color = '#fff';
                        div.style.transition = 'color 0.3s ease'; // Adiciona uma transição suave para a mudança de cor
                        div.style.cursor = 'pointer'; // Altera o cursor para indicar que a div é clicável
                        div.addEventListener('mouseover', function() {
                            div.style.color = '#f78113'; // Muda a cor quando o mouse está sobre a div
                        });
                        div.addEventListener('mouseout', function() {
                            div.style.color = 'white'; // Restaura a cor original quando o mouse deixa a div
                        });
                }
            )}
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição AJAX:', error);
        }
    });
}

function SelecionarValorClick(conteudo_Selecionado){
    var input = document.getElementById('Aluno');
    var div = document.getElementById('opcoes-alunos');
    var a = document.getElementById('AlunoSelecionado');

    console.log(input,a);

    a.textContent = conteudo_Selecionado;

    div.innerHTML = ''; 
    div.style.display = 'none';
    a.style.display = 'flex'; 

    ConsultarNomeTreino();
}

function Get_ID_input(){
    if(this.className == 'optionAluno'){

        var value_option = this.textContent;
        console.log(value_option);
        SelecionarValorClick(value_option);
        
    }
}



document.addEventListener("DOMContentLoaded", function() {

    $(document).on('keyup', 'input[name="AlunoTreino"]', ConsultarAluno);

    $(document).on('click', '.optionAluno', Get_ID_input);

});