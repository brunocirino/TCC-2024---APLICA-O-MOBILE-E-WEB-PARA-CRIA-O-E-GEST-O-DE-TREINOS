<?php  

require_once("UserDAO.php"); 

    class AlunoExistenteDAO{
        private $banco;

        public function __construct(){
            $this->banco = new PDO('mysql:host='.HOST.'; dbname='.DB_NAME,USER,PASSWORD);
        }

        public function ConsultarAlunoExistente($idAluno){
     
            $consulta = $this->banco->prepare('SELECT nome FROM alunos WHERE id_aluno = :idAluno');
            $consulta->bindValue(':idAluno', $idAluno);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
            
        }
        
    }
?>