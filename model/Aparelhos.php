<?php

    class Aparelho{
        protected $ID;
        protected $nm_aparelho;
        protected $id_tipo;
        protected $id_academia;
           

        public function __construct($nm_aparelho, $id_tipo , $id_academia){
            $this->nm_aparelho = $nm_aparelho;
            $this->id_tipo = $id_tipo;
            $this->id_academia = $id_academia;

        }

        public function get_id_academia(){
            return $this->id_academia;
        }

        public function set_id_academia($id_academia){
            $this->id_academia = $id_academia;
        }

        public function get_NM_Aparelho(){
            return $this->nm_aparelho;
        }

        public function get_id_tipo(){
            return $this->id_tipo;
        }

    }

?>