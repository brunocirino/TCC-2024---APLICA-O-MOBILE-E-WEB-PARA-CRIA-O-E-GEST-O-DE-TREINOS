<?php  

    class TreinoExistenteDAO{
       

        public function ConsultaTreinoExist($IDgrupo, $valueCampo, $id_academia){
   
            $url = 'http://localhost:3001/ConsultaTreinoExist/' 
            . urlencode($IDgrupo). '/'
            . urlencode($valueCampo). '/'
            . urlencode($id_academia);
           

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


            //file_put_contents('C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt', "URL: " . $url . "\n", FILE_APPEND);

            // Definir o cabeçalho Content-Type como JSON
            header('Content-Type: application/json');

            echo json_encode($resultados);
            
        }

        public function ConsultaTreinoExist_idProf($ID_prof){
                 
            $url = 'http://localhost:3001/ConsultaTreinoExist_idProf/' 
            . urlencode($ID_prof);

            $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

            // Verificar se o arquivo está acessível e pode ser escrito
            if (is_writable($filePath)) {
                file_put_contents($filePath, "ConsultarTreinoExist_IdProf: " . $url . "\n", FILE_APPEND);
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

            return $resultados;
            
        }

        
        
    }
?>