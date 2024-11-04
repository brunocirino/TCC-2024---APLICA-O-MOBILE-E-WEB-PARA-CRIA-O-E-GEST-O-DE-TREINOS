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

            $url = 'http://localhost:3001/cadastrarUsuario/' 
            . urlencode($usuario->get_email()). '/'
            . urlencode($usuario->get_senha()). '/'
            . urlencode($usuario->get_PrimeiroNome()). '/'
            . urlencode($usuario->get_Sobrenome()). '/'
            . urlencode($usuario->get_telefone()). '/'
            . urlencode($usuario->get_Genero());

           $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

           // Verificar se o arquivo está acessível e pode ser escrito
           if (is_writable($filePath)) {
               file_put_contents($filePath, "cadastrarUSER: " . $url . "\n", FILE_APPEND);
           } else {
               echo "Não foi possível escrever no arquivo de log.";
           }

            $ch = curl_init();

            // Configurar cURL para a solicitação HTTP
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, 1); // Define a requisição como POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, []); // Pode ser necessário incluir dados adicionais se necessário
    
            // Executar a solicitação
            $response = curl_exec($ch);
    
            // Verificar se houve erro na solicitação
            if (curl_errno($ch)) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Erro no cURL: ' . curl_error($ch)]);
                curl_close($ch);
                return;
            }
    
            // Fechar a conexão cURL
            curl_close($ch);
    
             // Decodificar a resposta JSON
            $resultados = json_decode($response, true);

            // Definir o cabeçalho Content-Type como JSON
            header('Content-Type: application/json');

            return json_encode($resultados);
        }

        public function cadastrarEndereco($endereco){

            $url = 'http://localhost:3001/cadastrarEndereco/' 
            . urlencode($endereco->get_ID_usuario()). '/'
            . urlencode($endereco->get_cep()). '/'
            . urlencode($endereco->get_cidade()). '/'
            . urlencode($endereco->get_estado()). '/'
            . urlencode($endereco->get_bairro()). '/'
            . urlencode($endereco->get_numero()). '/'
            . urlencode($endereco->get_logradouro());

           $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

           // Verificar se o arquivo está acessível e pode ser escrito
           if (is_writable($filePath)) {
               file_put_contents($filePath, "CadastrarEndereco: " . $url . "\n", FILE_APPEND);
           } else {
               echo "Não foi possível escrever no arquivo de log.";
           }

            $ch = curl_init();

            // Configurar cURL para a solicitação HTTP
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, 1); // Define a requisição como POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, []); // Pode ser necessário incluir dados adicionais se necessário
    
            // Executar a solicitação
            $response = curl_exec($ch);
    
            // Verificar se houve erro na solicitação
            if (curl_errno($ch)) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Erro no cURL: ' . curl_error($ch)]);
                curl_close($ch);
                return;
            }
    
            // Fechar a conexão cURL
            curl_close($ch);
    
             // Decodificar a resposta JSON
            $resultados = json_decode($response, true);

            // Definir o cabeçalho Content-Type como JSON
            header('Content-Type: application/json');

            return json_encode($resultados);
        }

        public function login($email, $senha){

            $url = 'http://localhost:3001/login/' 
            . urlencode($email). '/'
            . urlencode($senha);

            $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

            // Verificar se o arquivo está acessível e pode ser escrito
            if (is_writable($filePath)) {
                file_put_contents($filePath, "Login: " . $url . "\n", FILE_APPEND);
            } else {
                echo "Não foi possível escrever no arquivo de log.";
            }

            $ch = curl_init();

            // Configurar cURL para a solicitação HTTP
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            
    
            // Executar a solicitação
            $response = curl_exec($ch);
    
            // Verificar se houve erro na solicitação
            if (curl_errno($ch)) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Erro no cURL: ' . curl_error($ch)]);
                curl_close($ch);
                return;
            }
    
            // Fechar a conexão cURL
            curl_close($ch);
    
             // Decodificar a resposta JSON
            $resultados = json_decode($response, true);

            // Definir o cabeçalho Content-Type como JSON
            header('Content-Type: application/json');

            return json_encode($resultados);
            
            return $result;
        }

        public function excluir_usuario($idUsuario){    

            $url = 'http://localhost:3001/excluir_usuario/' 
            . urlencode($idUsuario);

            $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

            // Verificar se o arquivo está acessível e pode ser escrito
            if (is_writable($filePath)) {
                file_put_contents($filePath, "excluir_usuario: " . $url . "\n", FILE_APPEND);
            } else {
                echo "Não foi possível escrever no arquivo de log.";
            }

            $ch = curl_init();

            // Configurar cURL para a solicitação HTTP
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // Especifica o método DELETE
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
            // Executar a solicitação
            $response = curl_exec($ch);
    
            // Verificar se houve erro na solicitação
            if (curl_errno($ch)) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Erro no cURL: ' . curl_error($ch)]);
                curl_close($ch);
                return;
            }
    
            // Fechar a conexão cURL
            curl_close($ch);
    
             // Decodificar a resposta JSON
            $resultados = json_decode($response, true);

            // Definir o cabeçalho Content-Type como JSON
            header('Content-Type: application/json');

            return json_encode($resultados);
        }

        public function ConsultarIDUsuario($email){    

            $url = 'http://localhost:3001/ConsultarIDUsuario/' 
            . urlencode($email);

            $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

            // Verificar se o arquivo está acessível e pode ser escrito
            if (is_writable($filePath)) {
                file_put_contents($filePath, "ConsultarIDUsuario: " . $url . "\n", FILE_APPEND);
            } else {
                echo "Não foi possível escrever no arquivo de log.";
            }

            $ch = curl_init();

            // Configurar cURL para a solicitação HTTP
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            
    
            // Executar a solicitação
            $response = curl_exec($ch);
    
            // Verificar se houve erro na solicitação
            if (curl_errno($ch)) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Erro no cURL: ' . curl_error($ch)]);
                curl_close($ch);
                return;
            }
    
            // Fechar a conexão cURL
            curl_close($ch);
    
             // Decodificar a resposta JSON
            $resultados = json_decode($response, true);

            // Definir o cabeçalho Content-Type como JSON
            header('Content-Type: application/json');

            return json_encode($resultados);
        }

        public function Atualizar_ID_usuario($idUsuario, $email){

            $url = 'http://localhost:3001/Atualizar_ID_usuario/' 
            . urlencode($idUsuario). '/'
            . urlencode($email);

            $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

            // Verificar se o arquivo está acessível e pode ser escrito
            if (is_writable($filePath)) {
                file_put_contents($filePath, "Atualizar_ID_usuario: " . $url . "\n", FILE_APPEND);
            } else {
                echo "Não foi possível escrever no arquivo de log.";
            }

            $ch = curl_init();

            // Configurar cURL para a solicitação HTTP
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH'); // Método PATCH
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            
    
            // Executar a solicitação
            $response = curl_exec($ch);
    
            // Verificar se houve erro na solicitação
            if (curl_errno($ch)) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Erro no cURL: ' . curl_error($ch)]);
                curl_close($ch);
                return;
            }
    
            // Fechar a conexão cURL
            curl_close($ch);
    
             // Decodificar a resposta JSON
            $resultados = json_decode($response, true);

            // Definir o cabeçalho Content-Type como JSON
            header('Content-Type: application/json');

            return json_encode($resultados);
        }

    }

?>