export default function ConsultarNomeTreino(){

    var nomeTreinoInput = document.getElementById('NomeTreino');
    var inputIDAluno = document.getElementById('Aluno');
    var id_aluno = inputIDAluno.value;
    var valor = nomeTreinoInput.value;
        
            $.ajax({
                url: '../controller/CadastroTreino.php',
                method: 'POST',
                data: { NomeInserido: valor , from: 'VerificarNome', id_aluno: id_aluno, id_professor: idProfessor},
                dataType: 'json', // Especificar o tipo de dados esperado como JSON
                success: function(response) {
                    // Faça algo com a resposta JSON recebida
                    
                    if(response == false){
                        nomeTreinoInput.style.borderColor = 'red';
                        alert('Você não pode criar treinos com o nome igual!, Altere o nome do treino')
                    }else{
                        nomeTreinoInput.style.borderColor = '#f78113';
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição AJAX:', error);
                }
            });

            
        
   
}

document.addEventListener("DOMContentLoaded", function() {
    var nomeTreinoInput = document.getElementById('NomeTreino');

    nomeTreinoInput.addEventListener('blur', function(event) {
        var inputIDAluno = document.getElementById('Aluno');

       
        if (event.target.value.trim() !== '' ) {
            // Faça algo aqui, pois o campo NomeTreino foi preenchido
            var valor = event.target.value;
            $.ajax({
                url: '../controller/CadastroTreino.php',
                method: 'POST',
                data: { NomeInserido: valor , from: 'VerificarNome', id_professor: idProfessor},
                dataType: 'json', // Especificar o tipo de dados esperado como JSON
                success: function(response) {
                    // Faça algo com a resposta JSON recebida
                    
                    if(response == false){
                        console.log(response);
                        nomeTreinoInput.style.borderColor = 'red';
                        alert('Você não pode criar treinos com o nome igual!, Altere o nome do treino')
                    }else{
                        nomeTreinoInput.style.borderColor = '#f78113';
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição AJAX:', error);
                }
            });

            
        }
    });
});
