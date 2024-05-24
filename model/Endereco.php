<?php

    class Endereco{
        protected $id;
        protected $ID_usuario;
        protected $cep;
        protected $cidade;
        protected $estado;
        protected $bairro;
        protected $numero;
        protected $logradouro;
        protected $complemento;

        public function __construct($ID_usuario, $cep, $cidade, $estado, $bairro, $numero, $logradouro){
            $this->ID_usuario = $ID_usuario;
            $this->cep = $cep;
            $this->cidade = $cidade;
            $this->estado = $estado;
            $this->bairro = $bairro;
            $this->numero = $numero;
            $this->logradouro = $logradouro;
        }

        public function get_id(){
            return $this->id;
        }

        public function set_id($id){
            $this->id = $id;
        }

        public function get_ID_usuario(){
            return $this->ID_usuario;
        }


        public function get_cep(){
            return $this->cep;
        }

        public function get_cidade(){
            return $this->cidade;
        }

        public function get_estado(){
            return $this->estado;
        }

        public function get_bairro(){
            return $this->bairro;
        }

        public function get_numero(){
            return $this->numero;
        }

        public function get_logradouro(){
            return $this->logradouro;
        }

    }

?>