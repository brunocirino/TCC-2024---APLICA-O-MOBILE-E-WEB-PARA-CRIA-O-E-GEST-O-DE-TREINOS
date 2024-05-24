<?php

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'web_tcc');

    require_once("user.php");
    require_once("Endereco.php");
    

    class UserDAO{

        private $banco;

        public function __construct(){
            $this->banco = new PDO('mysql:host='.HOST.'; dbname='.DB_NAME,USER,PASSWORD);
        }

        public function cadastrarUsuario($usuario){

            $inserir = $this->banco->prepare("INSERT INTO usuários (email, senha, primeiroNome, Sobrenome, Celular, genero) VALUES (?,?,?,?,?,?);");

            $novo_usuario = array($usuario->get_email(), $usuario->get_senha(), $usuario->get_PrimeiroNome(), $usuario->get_Sobrenome(), $usuario->get_telefone(), $usuario->get_Genero());

            if($inserir->execute($novo_usuario)){
                return true;
            }
            
            return false;
        }

        public function cadastrarEndereco($endereco){

            $inserir = $this->banco->prepare("INSERT INTO endereços (id_usuario, cep, cidade, estado, bairro, numero, logradouro) VALUES (?,?,?,?,?,?,?);");

            $novo_endereco = array($endereco->get_ID_usuario(), $endereco->get_cep(), $endereco->get_cidade(), $endereco->get_estado(), $endereco->get_bairro(), $endereco->get_numero(), $endereco->get_logradouro());

            if($inserir->execute($novo_endereco)){
                return true;
            }
            
            return false;
        }

        public function login($email, $senha){

            $query = $this->banco->prepare("SELECT COUNT(id) as count FROM usuários WHERE email = :email AND senha = :senha");
            $query->bindParam(":email", $email);
            $query->bindParam(":senha", $senha);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            if($result['count'] > 0) {
                return true;
            } 
            
            return false;
        }

        public function excluir_usuario($documento){    

            $delete = $this->banco->prepare("DELETE FROM cadastro WHERE DOCUMENTO=?");
            $cadastro = array($documento);

            if($delete->execute($cadastro)){
                return true;
            }
        
            return false;
        }

        public function ConsultarIDUsuario($email){    

            $consulta = $this->banco->prepare('SELECT ID FROM usuários WHERE email = :email');
            $consulta->bindParam(':email', $email);
            $consulta->execute();

            $idUsuario = $consulta->fetchColumn();
            
            return $idUsuario;
        }

        public function Atualizar_ID_usuario($idUsuario, $email){

            $update = $this->banco->prepare("UPDATE usuários SET id=? WHERE email=?");
            $editar_endereco = array($idUsuario, $email);

            if($update->execute($editar_endereco)){
                return true;
            }
            
            return false;
        }

    }

?>