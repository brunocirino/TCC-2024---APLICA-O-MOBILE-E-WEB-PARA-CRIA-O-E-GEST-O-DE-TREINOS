<?php  

require_once("UserDAO.php"); 

    class TreinoExistenteDAO{
        private $banco;

        public function __construct(){
            $this->banco = new PDO('mysql:host='.HOST.'; dbname='.DB_NAME,USER,PASSWORD);
        }

        public function ConsultaTreinoExist($IDgrupo, $valueCampo){
                 
                $consulta = $this->banco->prepare('SELECT nome FROM tipos_treinos WHERE nome LIKE :valueCampo AND id_tipo = :IDgrupo');
                $consulta->bindValue(':valueCampo', '%' . $valueCampo . '%', PDO::PARAM_STR);
                $consulta->bindValue(':IDgrupo',$IDgrupo);
                $consulta->execute();
                $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
                return $resultados;
            
        }

        public function ConsultaTreinoExist_idProf($ID_prof){
                 
            $consulta = $this->banco->prepare('SELECT DISTINCT nm_treino FROM treinos_criados WHERE id_prof = :ID_prof');
            $consulta->bindValue(':ID_prof',$ID_prof);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
            
        }
        
    }
?>