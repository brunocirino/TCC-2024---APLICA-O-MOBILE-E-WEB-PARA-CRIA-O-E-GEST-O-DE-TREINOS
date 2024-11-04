<?php

    class AparelhoDAO{

        public function CadastrarAparelhos($Aparelhos){

            $url = 'http://localhost:3001/CadastrarAparelhos/' 
            . urlencode($Aparelhos->get_id_tipo()). '/'
            . urlencode($Aparelhos->get_NM_Aparelho()). '/'
            . urlencode($Aparelhos->get_id_academia());

           $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

           // Verificar se o arquivo está acessível e pode ser escrito
           if (is_writable($filePath)) {
               file_put_contents($filePath, "CadastroAparelhos: " . $url . "\n", FILE_APPEND);
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

        public function ConsultaAcademiaExist(){
            $url = 'http://localhost:3001/ConsultaAcademiaExist/';

            $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

            // Verificar se o arquivo está acessível e pode ser escrito
            if (is_writable($filePath)) {
                file_put_contents($filePath, "Consultar Academias ConsultaAcademiaExist: " . $url . "\n", FILE_APPEND);
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

        public function ConsultarNomeProf($Nm_treino, $id_professor){
            $url = 'http://localhost:3001/ConsultarNomeProf/' 
            . urlencode($Nm_treino). '/'
            . urlencode($id_professor);

             // Tente mudar o caminho do arquivo para simplificar
            $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

            // Verificar se o arquivo está acessível e pode ser escrito
            if (is_writable($filePath)) {
                file_put_contents($filePath, "ConsultarNomeProf URL: " . $url . "\n", FILE_APPEND);
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
            $resultados = json_decode($response, true);

            return json_encode($resultados);
            
        }

        public function ConsultarIdAcademia(){
            $url = 'http://localhost:3001/ConsultarIdAcademia/';

            file_put_contents('C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC.txt', "URL: " . $url , FILE_APPEND);

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

        
    }

?>