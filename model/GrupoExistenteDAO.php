<?php  

require_once("UserDAO.php"); 

    class GrupoExistenteDAO{
        private $banco;

        public function __construct(){
            $this->banco = new PDO('mysql:host='.HOST.'; dbname='.DB_NAME,USER,PASSWORD);
        }

        public function ConsultaGrupoExist(){
             
                $consulta = $this->banco->prepare('SELECT id, Nome FROM grupo_treino');
                $consulta->execute();
                $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

                
                return $resultados;

        }

        public function CriarGrupo($nome){
             
            $consulta = $this->banco->prepare('INSERT INTO grupo_treino (Nome) VALUES (?)');
            $valor = array($nome);
            
            if($consulta->execute($valor)){
                return true;
            }

            return false;
            

        }

        public function cadastrarTreino($Treino){

            $inserir = $this->banco->prepare("INSERT INTO treinos_criados (id_prof, nm_treino, exercicios, series, repeticoes, comentarios) VALUES (?,?,?,?,?,?);");

            $novo_treino = array($Treino->get_ID_Prof(), $Treino->get_NomeTeino(), $Treino->get_Exercicios(), $Treino->get_Series(), $Treino->get_Repeticoes(), $Treino->get_Comentarios());

            if($inserir->execute($novo_treino)){
                return true;
            }
            
            return false;
        }

    }
?>