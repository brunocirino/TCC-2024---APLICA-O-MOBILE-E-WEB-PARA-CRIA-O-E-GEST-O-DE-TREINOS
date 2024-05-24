<?php

    class TreinoCriado{
        protected $id;
        protected $ID_Prof;
        protected $Exercicios;
        protected $Series;
        protected $Reps;
        protected $comentarios;
        protected $Nm_treino;
        protected $linha = [];
       

        public function __construct($ID_treino, $ID_Prof, $Nm_treino, $Exercicio, $serie, $reps, $comentario){
            $this->id = $ID_treino;
            $this->ID_Prof = $ID_Prof;
            $this->Nm_treino = $Nm_treino;
            $this->Exercicios = $Exercicio;
            $this->Series = $serie;
            $this->Reps = $reps;
            $this->comentarios = $comentario;
            array_push($this->linha, $Exercicio);
            array_push($this->linha, $serie);
            array_push($this->linha, $reps);
            array_push($this->linha, $comentario);

        }

        public function get_id_TreinoCriado(){
            return $this->id;
        }

        public function set_id_TreinoCriado($id){
            $this->id = $id;
        }

        public function get_ID_Prof(){
            return $this->ID_Prof;
        }

        public function get_Array_linha(){
            return $this->linha;
        }

        public function get_NomeTeino(){
            return $this->Nm_treino;
        }

        public function get_Exercicios(){
            return $this->Exercicios;
        }

        public function get_Series(){
            return $this->Series;
        }

        public function get_Repeticoes(){
            return $this->Reps;
        }

        public function get_Comentarios(){
            return $this->comentarios;
        }

    }

?>