<?php

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'web_tcc');


    class TreinoCriadoDAO{

        private $banco;

        public function __construct(){
            $this->banco = new PDO('mysql:host='.HOST.'; dbname='.DB_NAME,USER,PASSWORD);
        }

        public function cadastrarTreino($Treino){

            $inserir = $this->banco->prepare("INSERT INTO treinos_criados (id_prof, nm_treino, exercicios, series, repeticoes, comentarios, id_identificador) VALUES (?,?,?,?,?,?,?);");

            $novo_treino = array($Treino->get_ID_Prof(), $Treino->get_NomeTeino(), $Treino->get_Exercicios(), $Treino->get_Series(), $Treino->get_Repeticoes(), $Treino->get_Comentarios(), $Treino->get_id_TreinoCriado());

            if($inserir->execute($novo_treino)){
                return true;
            }
            
            return false;
        }

        public function TrazerTreinos($Nm_treino, $id_professor){
            $query = $this->banco->prepare("SELECT nm_treino, exercicios, series, repeticoes, comentarios  as count FROM treinos_criados WHERE nm_treino = :nmTreino AND id_prof = :idProfessor");
            $query->bindParam(":nmTreino", $Nm_treino);
            $query->bindParam(":idProfessor", $id_professor);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            
            return $result;
        }

        public function ConsultarNomeProf($Nm_treino, $id_professor){
            $query = $this->banco->prepare("SELECT COUNT(nm_treino) as count FROM treinos_criados WHERE nm_treino = :nmTreino AND id_prof = :idProfessor");
            $query->bindParam(":nmTreino", $Nm_treino);
            $query->bindParam(":idProfessor", $id_professor);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            if($result['count'] == '0') {
                return true;
            } 
            
            return false;
        }

        public function ConsultarIdTreino(){
            $query = $this->banco->prepare("SELECT MAX(id_identificador) FROM treinos_criados");
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        
    }

?>