<?php  

    class AlunoExistenteDAO{
    

        public function ConsultarAlunoExistente($idAluno){
     
            $url = 'http://localhost:3001/ConsultarAlunoExistente/' 
            . urlencode($idAluno);

            $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

            // Verificar se o arquivo está acessível e pode ser escrito
            if (is_writable($filePath)) {
                file_put_contents($filePath, "ConsultarAlunoExistente: " . $url . "\n", FILE_APPEND);
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
        
    }
?>