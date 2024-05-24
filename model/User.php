<?php

    class User{
        protected $id;
        protected $PrimeiroNome;
        protected $Sobrenome;
        protected $email;
        protected $telefone;
        protected $idEndereco;
        protected $senha;

        public function __construct($PrimeiroNome, $Sobrenome, $email, $senha, $telefone){
            $this->PrimeiroNome = $PrimeiroNome;
            $this->Sobrenome = $Sobrenome;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->senha = $senha;
        }

        public function get_id(){
            return $this->id; 
        }

        public function set_id($id){
            $this->id = $id;
        }

        public function get_PrimeiroNome(){
            return $this->PrimeiroNome;
        }


        public function get_Sobrenome(){
            return $this->Sobrenome;
        }

        public function get_Genero(){
            return 'outros';
        }

        public function get_email(){
            return $this->email;
        }

        public function get_telefone(){
            return $this->telefone;
        }

        public function get_idEndereco(){
            return $this->idEndereco;
        }

        public function get_senha(){
            return $this->senha;
        }

    }

?>