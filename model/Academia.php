<?php

    class Academia{
        protected $ID;
        protected $nm_academia;
           

        public function __construct($id_academia, $NomeAcademia, ){
            $this->ID = $id_academia;
            $this->nm_academia = $NomeAcademia;

        }

        public function get_id_academia(){
            return $this->ID;
        }

        public function set_id_academia($id){
            $this->ID = $id;
        }

        public function get_NM_Academia(){
            return $this->nm_academia;
        }

    }

?>