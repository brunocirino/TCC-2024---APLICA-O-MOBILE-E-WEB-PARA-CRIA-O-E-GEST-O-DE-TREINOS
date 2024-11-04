<?php  

require_once("UserDAO.php"); 

    class GrupoExistenteDAO{
        
        public function ConsultaGrupoExist(){
             
            $url = 'http://localhost:3001/ConsultaGrupoExist';
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

            // Retornar os resultados como JSON
            echo json_encode($resultados);

        }

        public function CriarGrupo($nome){

            $url = 'http://localhost:3001/CriarGrupo/' . urlencode($nome);;
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

            // Retornar os resultados como JSON
            echo json_encode($resultados);
            
        }

        public function cadastrarTreino($Treino){

            $url = 'http://localhost:3001/CadastrarTreino/' 
            . urlencode($Treino->get_ID_Prof()). '/'
            . urlencode( $Treino->get_NomeTreino()). '/'
            . urlencode($Treino->get_Exercicios()). '/'
            . urlencode($Treino->get_Series()) . '/'
            . urlencode($Treino->get_Repeticoes()) . '/'
            . urlencode($Treino->get_Comentarios()) . '/';

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

            // Retornar os resultados como JSON
              // Verificar se a propriedade 'sucesso' está presente e é 'true'
            if (isset($resultados['sucesso']) && $resultados['sucesso'] === true) {
                echo json_encode(true); // Retorna true se 'sucesso' for true
            } else {
                echo json_encode(false); // Retorna false se 'sucesso' for false ou se não estiver presente
            }
        }

    }
?>