var mysql = require('mysql');
var express = require('express');
const server = express();
const cors = require('cors'); 


server.use(express.json()); 
server.use(express.urlencoded({ extended: true })); 
server.use(cors()); 

var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: null,
    database: 'web_tcc'
});

connection.connect(function(err){
    if(err){
        console.log(err.code);
        console.log(err.fatal);
    }
})

server.get('/', (req,res) =>{
    return res.json({mensagem: 'Sou foda'})
});

server.get('/ConsultaGrupoExist', (req, res) => {
    let query = "SELECT id, Nome FROM grupo_treino";

    connection.query(query, (err, rows) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        
        const results = rows.map(row => ({
            id: row.id,
            Nome: row.Nome
        }));

        console.log('Resultados:', results);
        
        res.json(results); 
    });
});

server.get('/ConsultaAcademiaExist', (req, res) => {
    let query = "SELECT DISTINCT id, Nome FROM academias";

    connection.query(query, (err, rows) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

    
        const results = rows.map(row => ({
            id: row.id,
            Nome: row.Nome
        }));

        console.log('Resultados:', results);
        
        res.json(results); 
    });
});


server.post('/CriarGrupo/:nome', (req, res) => {

    let query = "INSERT INTO grupo_treino (Nome) VALUES (?)";

    const params = req.params

    connection.query(query, [params.nome], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        console.log('Grupo criado com sucesso', result.insertId);

        res.status(201).json({ mensagem: 'Grupo criado com sucesso', id: result.insertId });
    });
});

server.post('/CadastrarTreino/:id_prof/:nm_treino/:exercicio/:series/:repeticoes/:peso/:comentarios/:id_identificador', (req, res) => {

    let query = "INSERT INTO treinos_criados (id_prof, nm_treino, exercicios, series, repeticoes, peso, comentarios, id_identificador) VALUES (?,?,?,?,?,?,?,?)";

    const params = req.params

    const Nm_Treino_tratado = decodeURIComponent(params.nm_treino.replace(/\+/g, " "));
    const Nm_exercicio_tratado = decodeURIComponent(params.exercicio.replace(/\+/g, " "));
    const Nm_comentario_tratado = decodeURIComponent(params.comentarios.replace(/\+/g, " "));
    

    connection.query(query, [params.id_prof, Nm_Treino_tratado, Nm_exercicio_tratado, params.series, params.repeticoes, params.peso, Nm_comentario_tratado, params.id_identificador], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }

        console.log("Treino cadastrado", Nm_comentario_tratado);

        res.status(201).json({ sucesso: true, mensagem: 'Treino criado com sucesso', id: result.insertId });
    });
});

server.post('/CadastrarAcademia/:id_academia/:nm_academia/', (req, res) => {

    let query = "INSERT INTO academias (id, Nome) VALUES (?,?)";

    const params = req.params

    const Id_academia = decodeURIComponent(params.id_academia.replace(/\+/g, " "));
    const nm_academia = decodeURIComponent(params.nm_academia.replace(/\+/g, " "));

    connection.query(query, [Id_academia, nm_academia], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }

        console.log('Cadastro academia feito');

        res.status(201).json({ sucesso: true, mensagem: 'Academia cadastrada com sucesso', id: result.insertId });
    });
});

server.post('/AtribuirAluno/:id_prof/:id_aluno/:id_treino', (req, res) => {

    let query = "INSERT into treinos_atribuidos (id_prof, id_aluno, id_treino) VALUES (?,?,?)";

    const params = req.params

    const id_prof = decodeURIComponent(params.id_prof.replace(/\+/g, " "));
    const id_aluno = decodeURIComponent(params.id_aluno.replace(/\+/g, " "));
    const id_treino = decodeURIComponent(params.id_treino.replace(/\+/g, " "));

    connection.query(query, [id_prof, id_aluno, id_treino], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }

        console.log('Aluno atribuído com sucesso');

        res.status(201).json({ sucesso: true, mensagem: 'Aluno atribuído com sucesso', id: result.insertId });
    });
});

server.post('/CadastrarAparelhos/:id_tipo/:nm_aparelhos/:id_academia', (req, res) => {

    let query = "INSERT INTO tipos_treinos (id_tipo, nome, id_academia) VALUES (?,?,?)";

    const params = req.params

    const id_tipo = decodeURIComponent(params.id_tipo.replace(/\+/g, " "));
    const Id_academia = decodeURIComponent(params.id_academia.replace(/\+/g, " "));
    const nm_aparelhos = decodeURIComponent(params.nm_aparelhos.replace(/\+/g, " "));

    connection.query(query, [id_tipo,nm_aparelhos, Id_academia], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }

        console.log('Cadastro Aparelho feito');

        res.status(201).json({ sucesso: true, mensagem: 'Academia cadastrada com sucesso', id: result.insertId });
    });
});

server.post('/CadastrarUsuario/:email/:senha/:PrimeiroNome/:Sobrenome/:Telefone/:Genero', (req, res) => {

    let query = "INSERT INTO usuários (email, senha, primeiroNome, Sobrenome, Celular, genero) VALUES (?,?,?,?,?,?)";

    const params = req.params

    const email = decodeURIComponent(params.email.replace(/\+/g, " "));
    const senha = decodeURIComponent(params.senha.replace(/\+/g, " "));
    const PrimeiroNome = decodeURIComponent(params.PrimeiroNome.replace(/\+/g, " "));
    const Sobrenome = decodeURIComponent(params.Sobrenome.replace(/\+/g, " "));
    const Telefone = decodeURIComponent(params.Telefone.replace(/\+/g, " "));
    const Genero = decodeURIComponent(params.Genero.replace(/\+/g, " "));

    connection.query(query, [email, senha, PrimeiroNome, Sobrenome, Telefone, Genero], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }

        console.log(result);

        if (result.affectedRows > 0) {
            res.status(201).json({ sucesso: true, mensagem: 'Usuário cadastrado com sucesso', id: result.insertId });
        } else {
            res.status(500).json({ sucesso: false, mensagem: 'Erro ao cadastrar usuário no banco de dados' });
        }
    });
});

server.post('/CadastrarEndereco/:idUsuario/:cep/:cidade/:estado/:bairro/:numero/:logradouro', (req, res) => {

    let query = "INSERT INTO endereços (id_usuario, cep, cidade, estado, bairro, numero, logradouro) VALUES (?,?,?,?,?,?,?)";

    const params = req.params

    const idUsuario = decodeURIComponent(params.idUsuario.replace(/\+/g, " "));
    const CEP = decodeURIComponent(params.cep.replace(/\+/g, " "));
    const Cidade = decodeURIComponent(params.cidade.replace(/\+/g, " "));
    const Estado = decodeURIComponent(params.estado.replace(/\+/g, " "));
    const Bairro = decodeURIComponent(params.bairro.replace(/\+/g, " "));
    const Numero = decodeURIComponent(params.numero.replace(/\+/g, " "));
    const Logradouro = decodeURIComponent(params.logradouro.replace(/\+/g, " "));

    connection.query(query, [idUsuario, CEP, Cidade, Estado, Bairro, Numero, Logradouro], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }

        console.log(result);

        if (result.affectedRows > 0) {
            res.status(201).json({ sucesso: true, mensagem: 'Endereco cadastrado com sucesso', id: result.insertId });
        } else {
            res.status(500).json({ sucesso: false, mensagem: 'Erro ao cadastrar Endereco no banco de dados' });
        }
    });
});

server.get('/ConsultarIDUsuario/:email', (req, res) => {

    let query = "SELECT ID FROM usuários WHERE email = ?";

    const Email = decodeURIComponent(req.params.email.replace(/\+/g, " "));

    connection.query(query, [Email], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        id = result[0];

        console.log('Consultei ID login', id);
        res.json(id);
    });
});

server.get('/ConsultarCadastroProf/:email', (req, res) => {

    let query = "SELECT COUNT(email)  AS emailCount FROM `usuários` WHERE email = ?";

    const Email = decodeURIComponent(req.params.email.replace(/\+/g, " "));

    const EmailTradado = `'${Email}'`;

    connection.query(query, [EmailTradado], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }
        
        const emailCount = result[0].emailCount;

        if (emailCount == '0') {
            res.status(201).json({ sucesso: true, mensagem: 'Liberado para cadastro' });
        } else {
            res.status(500).json({ sucesso: false, mensagem: 'Já existe um usuário cadastrado com essas informações' });
            console.log(result);
        }
    });
});

server.get('/ConsultarCadastroAluno/:cpf', (req, res) => {

    let query = "SELECT COUNT(cpf) FROM `alunos` WHERE cpf = '?';";

    const CPF = decodeURIComponent(req.params.cpf.replace(/\+/g, " "));

    connection.query(query, [CPF], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        const CPFCont = result[0].CPFCont;

        if (CPFCont == 0) {
            res.status(201).json({ sucesso: true, mensagem: 'Liberado para cadastro', id: result.insertId });
        } else {
            res.status(500).json({ sucesso: false, mensagem: 'Já existe um usuário cadastrado com essas informações' });
        }
    });
});

server.patch('/Atualizar_ID_usuario/:idUsuario/:email', (req, res) => {

    let query = "UPDATE usuários SET id=? WHERE email=?";

    const ID_usuario = decodeURIComponent(req.params.idUsuario.replace(/\+/g, " "));
    const Email = decodeURIComponent(req.params.email.replace(/\+/g, " "));

    connection.query(query, [ID_usuario, Email], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        console.log('Resultados:',result);
        if (result.affectedRows > 0) {
            res.status(201).json({ sucesso: true, mensagem: 'ID atualizdo com sucesso', id: result.insertId });
        } else {
            res.status(500).json({ sucesso: false, mensagem: 'Erro ao atualizar ID no banco de dados' });
        }
    });
});

server.get('/login/:email/:senha', (req, res) => {

    let query = "SELECT COUNT(id) as count FROM usuários WHERE email = ? AND senha = ?";

    const Email = decodeURIComponent(req.params.email.replace(/\+/g, " "));
    const Senha = decodeURIComponent(req.params.senha.replace(/\+/g, " "));

    connection.query(query, [Email, Senha], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        console.log('Resultados:',result);
        if (result[0].count > 0) {
            res.status(200).json({ sucesso: true, mensagem: 'login realizado com sucesso' });
        } else {
            res.status(404).json({ sucesso: false, mensagem: 'Erro ao realizar login no banco de dados' });
        }
    });
});

server.get('/login/APP/:CPF/:senha', (req, res) => {

    let query = "SELECT id_aluno FROM alunos WHERE cpf = ? AND senha = ?";

    const CPF = decodeURIComponent(req.params.CPF.replace(/\+/g, " "));
    const Senha = decodeURIComponent(req.params.senha.replace(/\+/g, " "));

    connection.query(query, [CPF, Senha], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        const results = result.map(row => ({
            id: row.id_aluno
        }));

        console.log('Resultados:',results);
        if (result.length > 0) {
            res.status(200).json({ sucesso: true, mensagem: 'Login realizado com sucesso' , results});
        } else {
            res.status(404).json({ sucesso: false, mensagem: 'CPF ou senha incorretos' });
        }
    });
});

server.get('/GetTreinos/APP/:id_aluno', (req, res) => {

    let query = "SELECT  t.nm_treino, t.id_identificador, t.exercicios, t.series, t.repeticoes, t.peso, t.comentarios from treinos_atribuidos as a INNER JOIN treinos_criados as t ON a.id_treino = t.id_identificador where a.id_aluno = ?";

    const id_aluno = decodeURIComponent(req.params.id_aluno.replace(/\+/g, " "));

    connection.query(query, [id_aluno], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        // Estruturar os dados no formato JSON desejado
        const treinoData = {};

        result.forEach(row => {
            const treinoName = row.nm_treino;

            if (!treinoData[treinoName]) {
                treinoData[treinoName] = [];
            }

            treinoData[treinoName].push({
                id_identificador: row.id_identificador,
                Exercício: row.exercicios,
                Series: row.series,
                Repetições: row.repeticoes,
                Peso: row.peso,
                Comentarios: row.comentarios || 'Sem comentários' // Definir valor padrão para null
            });
        });

        // Verificar se temos dados para enviar
        if (Object.keys(treinoData).length > 0) {
            res.status(200).json({
                sucesso: true,
                mensagem: 'Dados dos treinos encontrados com sucesso',
                results: treinoData
            });
        } else {
            res.status(404).json({ sucesso: false, mensagem: 'Nenhum treino encontrado para o ID do aluno fornecido' });
        }
    });
});

server.get('/GetHistorico/APP/:id_aluno', (req, res) => {
    let query = `
        SELECT h.id, h.data_exe, t.nm_treino, h.id_aluno, h.nm_treino as 'exercicios', h.series, h.repeticoes, h.peso, h.comentarios
        FROM historico_treino AS h 
        INNER JOIN treinos_criados AS t ON h.id_treino = t.id_identificador 
        WHERE h.id_aluno = ?
        GROUP BY h.data_exe, t.nm_treino 
        ORDER BY h.data_exe DESC;`;

    const id_aluno = decodeURIComponent(req.params.id_aluno.replace(/\+/g, " "));

    connection.query(query, [id_aluno], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        const formattedResults = result.map(row => ({
            id: row.id,
            nm_treino: row.nm_treino,
            data: row.data_exe,
            series: row.series,
            repeticoes: row.repeticoes,
            peso: row.peso,
            comentarios: row.comentarios
        }));

        console.log(formattedResults);
        
        if (formattedResults.length > 0) {
            res.status(200).json({
                sucesso: true,
                mensagem: 'Dados dos treinos encontrados com sucesso',
                results: formattedResults
            });
            
        } else {
            res.status(404).json({ sucesso: false, mensagem: 'Nenhum treino encontrado para o ID do aluno fornecido' });
        }
    });
});

server.get('/GetHistoricoPorTreino/APP/:id_aluno/:data/:nmTreino', (req, res) => {
    // Extrai e loga os parâmetros recebidos
    const id_aluno = decodeURIComponent(req.params.id_aluno.replace(/\+/g, " "));
    const data = decodeURIComponent(req.params.data.replace(/\+/g, " "));
    const nmTreino = decodeURIComponent(req.params.nmTreino.replace(/\+/g, " "));

    console.log('Parâmetros recebidos:');
    console.log('ID do Aluno:', id_aluno);
    console.log('Data:', data);
    console.log('Nome do Treino:', nmTreino);

    // Define a consulta SQL
    let query = `
                    SELECT DISTINCT h.id, h.data_exe, t.nm_treino, h.id_aluno, h.nm_treino AS 'exercicios', 
                            h.series, h.repeticoes, h.peso, h.comentarios
            FROM historico_treino AS h 
            INNER JOIN treinos_criados AS t 
                ON h.id_treino = t.id_identificador
            WHERE h.id_aluno = ?
                AND t.nm_treino = ? 
                AND h.data_exe = ?`;

    console.log('Consulta SQL:', query);

    // Executa a consulta e loga o resultado ou erro
    connection.query(query, [id_aluno, nmTreino, data], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        // Loga o resultado bruto da consulta
        console.log('Resultado bruto da consulta:', result);

        // Formata os resultados para a resposta
        const formattedResults = result.map(row => ({
            id: row.id,
            nm_treino: row.nm_treino,
            data: row.data_exe,
            series: row.series,
            repeticoes: row.repeticoes,
            peso: row.peso,
            comentarios: row.comentarios?.trim() || 'sem comentários'  // Verifica se o campo comentarios está vazio ou nulo
        }));

        // Loga o resultado formatado
        console.log('Resultado formatado:', formattedResults);

        // Verifica se houve resultados e responde com os dados ou uma mensagem de erro
        if (formattedResults.length > 0) {
            res.status(200).json({
                sucesso: true,
                mensagem: 'Dados dos treinos encontrados com sucesso',
                results: formattedResults
            });
        } else {
            console.log('Nenhum treino encontrado para o ID do aluno e data fornecidos');
            res.status(404).json({
                sucesso: false,
                mensagem: 'Nenhum treino encontrado para o ID do aluno fornecido'
            });
        }
    });
});




server.get('/GetNmTreinos/APP/:id_aluno', (req, res) => {
    let query = `SELECT t.nm_treino, a.id_treino 
                 FROM treinos_atribuidos AS a 
                 INNER JOIN treinos_criados AS t 
                 ON a.id_treino = t.id_identificador 
                 WHERE a.id_aluno = ? 
                 GROUP BY t.nm_treino`;

    const id_aluno = decodeURIComponent(req.params.id_aluno.replace(/\+/g, " "));

    connection.query(query, [id_aluno], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        const formattedResults = result.map(row => ({
            id: row.id_treino,
            nm_treino: row.nm_treino
        }));
       
        if (formattedResults.length > 0) {
            res.status(200).json({
                sucesso: true,
                mensagem: 'Dados dos treinos encontrados com sucesso',
                results: formattedResults
            });
        } else {
            res.status(404).json({ sucesso: false, mensagem: 'Nenhum treino encontrado para o ID do aluno fornecido' });
        }
    });
});


server.delete('/excluir_usuario/:idUsuario', (req, res) => {

    let query = "DELETE FROM usuários WHERE id=?";

    const ID_usuario = decodeURIComponent(req.params.idUsuario.replace(/\+/g, " "));

    connection.query(query, [ID_usuario], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        
        if (result.affectedRows > 0) {
            res.status(201).json({ sucesso: true, mensagem: 'Usuário deletado com sucesso', id: result.insertId });
        } else {
            res.status(500).json({ sucesso: false, mensagem: 'Erro ao deletar usuário no banco de dados' });
        }

        console.log('User excluído');
    });
});

server.delete('/excluir_acesso_aluno/:id', (req, res) => {

    let query = "DELETE FROM treinos_atribuidos WHERE id = ?";

    const id = decodeURIComponent(req.params.id.replace(/\+/g, " "));

    connection.query(query, [id], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        
        if (result.affectedRows > 0) {
            res.status(201).json({ sucesso: true, mensagem: 'Acesso removido com sucesso', id: result.insertId });
        } else {
            res.status(500).json({ sucesso: false, mensagem: 'Erro ao remover acesso no banco de dados' });
        }

        console.log('Acesso removido');
    });
});

server.delete('/excluir_exercicio/:id_exercicio', (req, res) => {

    let query = "DELETE FROM treinos_criados WHERE id=?";
    
    // Decodifica e substitui os espaços no ID do exercício
    const id_exercicio = decodeURIComponent(req.params.id_exercicio.replace(/\+/g, " "));

    connection.query(query, [id_exercicio], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }

        if (result.affectedRows > 0) {
            res.status(200).json({ sucesso: true, mensagem: 'Exercício deletado com sucesso' });
        } else {
            res.status(404).json({ sucesso: false, mensagem: 'Exercício não encontrado para exclusão' });
        }
        console.log('Exercicio excluído!');
    });
});


server.get('/ConsultaTreinoExist/:idGrupo/:ValueCamp/:id_Academia', (req, res) => {
    const idGrupo = req.params.idGrupo;
    const valueCamp = req.params.ValueCamp;
    const id_academia = req.params.id_Academia;

    let query = "SELECT nome FROM tipos_treinos WHERE nome LIKE ? AND id_tipo = ? AND id_academia = ?";


    const searchValue = `%${valueCamp}%`;


    connection.query(query, [searchValue, idGrupo, id_academia], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }


        const formattedResults = result.map(row => ({
            nome: row.nome
        }));


        console.log('Resultados:',formattedResults);
        res.json(formattedResults);
    });
});

server.get('/ConsultaTreinoExist/:id', (req, res) => {
    const idTreino = req.params.id;

    let query = "SELECT * FROM treinos_criados WHERE id = ? ";

    connection.query(query, [idTreino], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }


        const formattedResults = result.map(row => ({
            Titulo: row.nm_treino,
            Exercicio: row.exercicios,
            Serie: row.series,
            Repetição: row.repeticoes,
            peso: row.peso,
            Comentario: row.comentarios
        }));


        console.log('Resultados:',formattedResults);
        res.json(formattedResults);
    });
});

server.put('/AlterarTreinoExist/:id', (req, res) => {
    const idTreino = req.params.id;
    const { nm_treino, exercicios, series, repeticoes, peso, comentarios, id_identificador } = req.body;

   
    let querySelect = "SELECT * FROM treinos_criados WHERE id = ?";


    connection.query(querySelect, [idTreino], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }

        if (result.length === 0) {
            return res.status(404).json({ mensagem: 'Treino não encontrado' });
        }

        
        const treinoAtual = result[0];

      
        const alteracoes = {
            nm_treino: treinoAtual.nm_treino !== nm_treino ? nm_treino : null,
            exercicios: treinoAtual.exercicios !== exercicios ? exercicios : null,
            series: treinoAtual.series !== series ? series : null,
            repeticoes: treinoAtual.repeticoes !== repeticoes ? repeticoes : null,
            peso: treinoAtual.peso !== peso ? peso : null,
            comentarios: treinoAtual.comentarios !== comentarios ? comentarios : null
        };

        let queryUpdate = "UPDATE treinos_criados SET ";
        let values = [];

        if (alteracoes.nm_treino) {
            queryUpdate += "nm_treino = ?, ";
            values.push(alteracoes.nm_treino);
            console.log(queryUpdate);
        }
        if (alteracoes.exercicios) {
            queryUpdate += "exercicios = ?, ";
            values.push(alteracoes.exercicios);
        }
        if (alteracoes.series) {
            queryUpdate += "series = ?, ";
            values.push(alteracoes.series);
        }
        if (alteracoes.repeticoes) {
            queryUpdate += "repeticoes = ?, ";
            values.push(alteracoes.repeticoes);
        }

        if (alteracoes.peso) {
            queryUpdate += "peso = ?, ";
            values.push(alteracoes.peso);
        }
        
        if (alteracoes.comentarios) {
            queryUpdate += "comentarios = ?, ";
            values.push(alteracoes.comentarios);
        }

        
        queryUpdate = queryUpdate.slice(0, -2);
        queryUpdate += " WHERE id = ?";

        
        values.push(idTreino);

      
        connection.query(queryUpdate, values, (err, result) => {
            console.log(queryUpdate);
            if (err) {
                console.error('Erro na atualização:', err);
                return res.status(500).json({ mensagem: 'Erro na atualização do banco de dados' });
            }

            res.status(200).json({
                mensagem: `Treino com ID ${idTreino} atualizado com sucesso`,
                alteracoes: alteracoes
            });
        });
    });
});


server.get('/ConsultarAlunosAtribuidos/:idProfessor/:idTreino', (req, res) => {
    const Id_Professor = req.params.idProfessor;
    const id_treino = req.params.idTreino;
    

    let query = "SELECT t.id, alunos.nome FROM treinos_atribuidos as t JOIN alunos on t.id_aluno = alunos.id_aluno where t.id_prof = ? and t.id_treino = ?";


    const searchValue = `${Id_Professor}`;


    connection.query(query, [searchValue,id_treino], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }


        const formattedResults = result.map(row => ({
            id: row.id,
            nm_aluno: row.nome
        }));


        console.log('Resultados:',formattedResults);
        res.json(formattedResults);
    });
});



server.get('/ConsultaTreinoExist_idProf/:idProfessor', (req, res) => {
    const Id_Professor = req.params.idProfessor;
    

    let query = "SELECT DISTINCT nm_treino, id_identificador FROM treinos_criados WHERE id_prof = ?";


    const searchValue = `${Id_Professor}`;


    connection.query(query, [searchValue], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ mensagem: 'Erro na consulta ao banco de dados' });
        }


        const formattedResults = result.map(row => ({
            nm_treino: row.nm_treino,
            id_treino: row.id_identificador
        }));


        console.log('Resultados:',formattedResults);
        res.json(formattedResults);
    });
});

server.get('/TrazerTreinos/:nm_treino/:id_prof', (req, res) => {
    const Id_Professor = req.params.id_prof;
    const nm_treino = req.params.nm_treino;

    let query = "SELECT id, nm_treino, exercicios, series, repeticoes, peso, comentarios  as count FROM treinos_criados WHERE nm_treino = ? AND id_prof = ?";

    connection.query(query, [nm_treino, Id_Professor], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }

        console.log('Resultados TrazerTreinos:' ,result);

        res.status(201).json(result);
    });
});

server.get('/ConsultarNomeProf/:nm_treino/:id_prof', (req, res) => {
    const Id_Professor = req.params.id_prof;
    const nm_treino = req.params.nm_treino;

    const nm_treino_tratado = decodeURIComponent(nm_treino.replace(/\+/g, " "));

    let query = "SELECT COUNT(nm_treino) as count FROM treinos_criados WHERE nm_treino = ? AND id_prof = ?";

    const formattedQuery = query.replace('?', connection.escape(nm_treino)).replace('?', connection.escape(Id_Professor))


    connection.query(query, [nm_treino_tratado, Id_Professor], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }

        
        console.log('Resultados ConsultarNomeProf:' ,result);
        console.log('Consulta SQL Gerada:', formattedQuery);
        console.log(nm_treino_tratado); // Deve mostrar 'Teste Peito'


        const count = result[0].count;

         // Criar a resposta JSON
         res.json({ nomeValido: count === 0 });
    });
});

server.get('/ConsultarIdTreino/', (req, res) => {


    let query = "SELECT MAX(id_identificador) FROM treinos_criados";

    connection.query(query, (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }


       const id_treino = result[0]['MAX(id_identificador)'];

        console.log('Resultados ConsultarIdTreino:' ,id_treino);

        res.status(201).json(id_treino);
    });
});

server.get('/ConsultarIdAcademia/', (req, res) => {


    let query = "SELECT MAX(id) FROM academias";

    connection.query(query, (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }


       const id_academia = result[0]['MAX(id)'];

        console.log('Resultados ConsultarIdTreino:' ,id_academia);

        const formattedResults = result.map(row => ({
            idAcademia: id_academia,
        }));

        res.status(201).json(formattedResults);
    });
});

server.get('/ConsultarAlunoExistente/:idAluno', (req, res) => {

    const ID_Aluno = req.params.idAluno;

    let query = "SELECT nome,id_aluno FROM alunos WHERE id_aluno = ?";

    connection.query(query, [ID_Aluno], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }


        const formattedResults = result.map(row => ({
            nm_aluno: row.nome,
            id_aluno: row.id_aluno
        }));

        console.log('Resultados Consultar Aluno existente:' ,formattedResults);

        res.status(201).json(formattedResults);
    });
});


server.post('/CadastrarAluno/APP/:Nome/:CPF/:Email/:Senha', (req, res) => {

    let query = "INSERT INTO alunos (cpf, nome, senha, email) VALUES (?,?,?,?)";

    const params = req.params

    const email = decodeURIComponent(params.Email.replace(/\+/g, " "));
    const senha = decodeURIComponent(params.Senha.replace(/\+/g, " "));
    const Nome = decodeURIComponent(params.Nome.replace(/\+/g, " "));
    const CPF = decodeURIComponent(params.CPF.replace(/\+/g, " "));

    connection.query(query, [CPF, Nome, senha, email], (err, result) => {
        if (err) {
            console.error('Erro na consulta:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro na consulta ao banco de dados' });
        }

        console.log(result);

        if (result.affectedRows > 0) {
            res.status(201).json({ sucesso: true, mensagem: 'Usuário cadastrado com sucesso', id: result.insertId });
        } else {
            res.status(500).json({ sucesso: false, mensagem: 'Erro ao cadastrar usuário no banco de dados' });
        }
    });
});

server.post('/ConcluirTreino/APP/:id_aluno/:id_treino', (req, res) => {
    const { id_aluno, id_treino } = req.params;
    const exercicios = req.body.exercicios; // Recebe a lista de exercícios

    console.log('ID do Aluno:', id_aluno);
    console.log('ID do Treino:', id_treino);
    console.log('Exercícios recebidos:', exercicios);

    const today = new Date();
    const Data_exe = today.toISOString().slice(0, 19).replace('T', ' ');
    console.log('Data de execução formatada:', Data_exe);

    // 1. Verifica se há exercícios na lista
    if (!Array.isArray(exercicios) || exercicios.length === 0) {
        console.error('Erro: A lista de exercícios está vazia ou não é um array');
        return res.status(400).json({ sucesso: false, mensagem: 'Lista de exercícios está vazia' });
    }

    // 2. Cria a consulta SQL para inserir todos os exercícios de uma só vez
    let query = "INSERT INTO historico_treino (id_aluno, data_exe, id_treino, nm_treino, series, repeticoes, peso, comentarios) VALUES ";
    console.log('Início da query:', query);

    // 3. Monta os valores para cada exercício
    const valoresExercicios = exercicios.map(exercicio => {
        console.log('Processando exercício:', exercicio);
        return `(${connection.escape(id_aluno)}, ${connection.escape(Data_exe)}, ${connection.escape(id_treino)}, 
                 ${connection.escape(exercicio.nome)}, ${connection.escape(exercicio.series)}, 
                 ${connection.escape(exercicio.repeticoes)}, ${connection.escape(exercicio.peso)}, 
                 ${connection.escape(exercicio.comentarios)})`;
    });

    // 4. Adiciona todos os valores na consulta de uma só vez
    query += valoresExercicios.join(", ");
    console.log('Query final para execução:', query);

    // 5. Executa a consulta
    connection.query(query, (err, result) => {
        if (err) {
            console.error('Erro na execução da consulta SQL:', err);
            return res.status(500).json({ sucesso: false, mensagem: 'Erro ao inserir no banco de dados' });
        }

        console.log('Resultado da consulta SQL:', result);

        if (result.affectedRows > 0) {
            res.status(201).json({ sucesso: true, mensagem: 'Treino e exercícios concluídos com sucesso' });
        } else {
            console.error('Erro: Nenhuma linha afetada, possível falha na inserção');
            res.status(500).json({ sucesso: false, mensagem: 'Erro ao concluír treino no banco de dados' });
        }
    });
});




server.use(cors({
    origin: '*', 
    methods: 'GET,HEAD,PUT,PATCH,POST,DELETE', 
    allowedHeaders: 'Content-Type,Authorization' 
}));

server.listen(3001, '0.0.0.0', () => {
    console.log('Server ligado na porta 3001');
});

