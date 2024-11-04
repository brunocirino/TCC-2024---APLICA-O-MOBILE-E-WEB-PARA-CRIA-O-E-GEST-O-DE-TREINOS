<?php

    class TreinoCriadoDAO{

        public function cadastrarTreino($Treino){

            $id_prof = urlencode($Treino->get_ID_Prof());
            $nm_treino = urlencode($Treino->get_NomeTeino());
            $exercicio = urlencode($Treino->get_Exercicios());
            $series = urlencode($Treino->get_Series());
            $repeticoes = urlencode($Treino->get_Repeticoes());
            $peso = urlencode($Treino->get_pesos());
            $comentarios = $Treino->get_Comentarios() ? urlencode($Treino->get_Comentarios()) : 'null';
            $id_identificador = urlencode($Treino->get_id_TreinoCriado());

            $url = "http://localhost:3001/CadastrarTreino/{$id_prof}/{$nm_treino}/{$exercicio}/{$series}/{$repeticoes}/{$peso}/{$comentarios}/{$id_identificador}";

           $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

           // Verificar se o arquivo está acessível e pode ser escrito
           if (is_writable($filePath)) {
               file_put_contents($filePath, "cadastrarTreino: " . $url . "\n", FILE_APPEND);
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

        public function AtribuirAluno($id_prof, $id_aluno, $id_treino){

            $url = "http://localhost:3001/AtribuirAluno/{$id_prof}/{$id_aluno}/{$id_treino}";

           $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

           // Verificar se o arquivo está acessível e pode ser escrito
           if (is_writable($filePath)) {
               file_put_contents($filePath, "AtribuirAluno: " . $url . "\n", FILE_APPEND);
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

        public function TrazerTreinos($Nm_treino, $id_professor){
            $url = 'http://localhost:3001/TrazerTreinos/' 
            . urlencode($Nm_treino). '/'
            . urlencode($id_professor);

            $filePath = 'C:\Users\bruno\OneDrive\Área de Trabalho\Log_Erro_TCC\Log_Erro_TCC.txt';

            // Verificar se o arquivo está acessível e pode ser escrito
            if (is_writable($filePath)) {
                file_put_contents($filePath, "ConsultarNomeProf TrazerTreinos: " . $url . "\n", FILE_APPEND);
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
            
            return $result;
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

        public function ConsultarIdTreino(){
            $url = 'http://localhost:3001/ConsultarIdTreino/';

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