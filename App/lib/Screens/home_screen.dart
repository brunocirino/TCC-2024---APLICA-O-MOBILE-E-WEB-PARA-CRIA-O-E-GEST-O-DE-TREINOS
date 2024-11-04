import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import '../widgets/validation_dialog.dart';
import '../widgets/treino_card.dart';
import '../widgets/custom_button.dart';
import '../widgets/caixa_selecao.dart';
import 'package:provider/provider.dart';
import '../Providers/List_exercicios.dart';
import 'package:teste/Providers/id_user_provider.dart';
import '../Screens/historico_screen.dart';

class HomeScreen extends StatefulWidget {
  final String userId;

  const HomeScreen({super.key, required this.userId});

  @override
  _HomeScreenState createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  bool isCheckboxChecked = false; // Novo estado para o checkbox
  List<Widget> treinoCards = [];
  String? nm_treino;
  String? id_treino;
  List<Map<String, dynamic>> treinoOptions =
      []; // Atualizado para armazenar IDs e nomes
  String? selectedTreino;

  @override
  void initState() {
    super.initState();
    _fetchTreinoOptions();
  }

  void _showConcluir(BuildContext context, String message) {
    showDialog(
      context: context,
      builder: (context) => ValidationDialog(
        title: 'Concluído',
        content: message,
        onOkPressed: () {
          Navigator.of(context).pop();
        },
      ),
    );
  }

  void _showERRO(BuildContext context, String message) {
    showDialog(
      context: context,
      builder: (context) => ValidationDialog(
        title: 'Erro',
        content: message,
        onOkPressed: () {
          Navigator.of(context).pop();
        },
      ),
    );
  }

  Future<void> _fetchTreinos(String treinoName) async {
    final userProvider = Provider.of<UserProvider>(context, listen: false);
    final idAluno = userProvider.getIdAluno();
    final exerciciosProvider =
        Provider.of<ExerciciosProvider>(context, listen: false);

    if (idAluno == null) {
      //print('ID do aluno não disponível.');
      return;
    }

    exerciciosProvider.clearTreinos();

    final String url = 'http://10.0.2.2:3001/GetTreinos/APP/$idAluno';
    final response = await http.get(Uri.parse(url));

    //print('Status da resposta: ${response.statusCode}');
    // print('Resposta bruta: ${response.body}');

    if (response.statusCode == 200) {
      try {
        final responseData = jsonDecode(response.body);
        //print('Resposta da API: $responseData');

        if (responseData['sucesso'] == true) {
          final results = responseData['results'] as Map<String, dynamic>;

          List<Widget> tempTreinoCards = [];

          results.forEach((treino, exercicios) {
            if (treino == treinoName) {
              List<dynamic> listaExercicios = exercicios;
              nm_treino = treino;
              for (var exercicio in listaExercicios) {
                final nomeExercicio = exercicio['Exercício'] ?? 'Desconhecido';
                final series = exercicio['Series'];
                final repeticoes = exercicio['Repetições'];
                final Peso = exercicio['Peso'];
                final comentarios = exercicio['Comentarios'] ?? '';

                int seriesInt;
                int repeticoesInt;

                try {
                  seriesInt = int.parse(series);
                } catch (e) {
                  seriesInt = 0;
                }

                try {
                  repeticoesInt = int.parse(repeticoes);
                } catch (e) {
                  repeticoesInt = 0;
                }

                tempTreinoCards.add(TreinoCard(
                  key: UniqueKey(), // Adiciona uma chave única
                  nome: nomeExercicio,
                  series: seriesInt,
                  repeticoes: repeticoesInt,
                  peso: Peso,
                  comentarios: comentarios,
                  statuscheckbox: false,
                ));
              }
            }
          });

          setState(() {
            treinoCards = tempTreinoCards;
          });
        } else {
          print('Falha ao obter os treinos: ${responseData['mensagem']}');
        }
      } catch (error) {
        print('Erro ao processar a resposta: $error');
      }
    } else {
      print('Falha na requisição. Status code: ${response.statusCode}');
      _showERRO(context, 'Você não tem nenhum treino atribuído');
    }
  }

  Future<void> ConcluirTreinos() async {
    final userProvider = Provider.of<UserProvider>(context, listen: false);
    final idAluno = userProvider.getIdAluno();

    final exerciciosProvider =
        Provider.of<ExerciciosProvider>(context, listen: false);
    final listaExercicios =
        exerciciosProvider.exercicios; // Obtém a lista de exercícios

    if (idAluno == null) {
      print('ID do aluno não disponível.');
      return;
    }

    final String url =
        'http://10.0.2.2:3001/ConcluirTreino/APP/$idAluno/$id_treino';

    // Converte a lista de exercícios em um JSON para enviar no corpo
    final Map<String, dynamic> data = {
      "exercicios": listaExercicios
          .map((exercicio) => {
                "nome": exercicio.nome,
                "series": exercicio.series,
                "repeticoes": exercicio.repeticoes,
                "peso": exercicio.peso,
                "comentarios": exercicio.comentarios,
              })
          .toList()
    };

    final response = await http.post(
      Uri.parse(url),
      headers: {"Content-Type": "application/json"},
      body: jsonEncode(data),
    );

    if (mounted) {
      setState(() {
        _fetchTreinoOptions(); // Atualize as opções de treino após o sucesso
      });
    }

    //print('Status da resposta: ${response.statusCode}');
    //print('Resposta bruta: ${response.body}');

    _showConcluir(context, 'Treino concluido!');
    exerciciosProvider.clearTreinos();
  }

  Future<void> _fetchTreinoOptions() async {
    final userProvider = Provider.of<UserProvider>(context, listen: false);
    final idAluno = userProvider.getIdAluno();

    if (idAluno == null) {
      //print('ID do aluno não disponível.');
      return;
    }

    final String url = 'http://10.0.2.2:3001/GetNmTreinos/APP/$idAluno';
    final response = await http.get(Uri.parse(url));

    //print('Status da resposta: ${response.statusCode}');
    //print('Resposta bruta: ${response.body}');

    if (response.statusCode == 200) {
      try {
        final responseData = jsonDecode(response.body);
        print('Resposta da API: $responseData');

        if (responseData['sucesso'] == true) {
          final results = responseData['results'] as List<dynamic>;

          setState(() {
            treinoOptions = results
                .cast<Map<String, dynamic>>(); // Atualizado para lista de mapas
            if (treinoOptions.isNotEmpty) {
              // Define o primeiro treino como selecionado
              selectedTreino = treinoOptions[0]['nm_treino'];
              id_treino = treinoOptions[0]['id'].toString();

              // Carrega o treino selecionado inicialmente
              _fetchTreinos(selectedTreino!);
            }
          });
        } else {
          print(
              'Falha ao obter os nomes dos treinos: ${responseData['mensagem']}');
        }
      } catch (error) {
        print('Erro ao processar a resposta: $error');
      }
    } else {
      print('Falha na requisição. Status code: ${response.statusCode}');
      _showERRO(context, 'Erro ao obter os nomes dos treinos');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Meu treino', style: TextStyle(color: Colors.orange)),
      ),
      drawer: Drawer(
        child: ListView(
          padding: EdgeInsets.zero,
          children: [
            Container(
              color: Colors.black, // Cor de fundo do cabeçalho
              padding: const EdgeInsets.all(16.0), // Espaçamento interno
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Image.asset(
                    'assets/Logo.png',
                    height: 120,
                  ),
                  const SizedBox(height: 10), // Espaço entre a imagem e o texto
                  Text(
                    'ID do Usuário: ${widget.userId}', // Substitua pelo texto desejado
                    style: TextStyle(
                      color: Colors.white, // Ajuste a cor conforme necessário
                      fontSize:
                          18, // Ajuste o tamanho da fonte conforme necessário
                    ),
                  ),
                ],
              ),
            ),
            ListTile(
              title: const Text('Histórico de Treinos',
                  style: TextStyle(fontSize: 18)),
              onTap: () {
                // Navegar para a tela de histórico de treinos
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) =>
                        HistoricoScreen(), // Aqui você usa o HistoricoScreen
                  ),
                );
              },
            ),
            ListTile(
              title: const Text('Sair', style: TextStyle(fontSize: 18)),
              onTap: () {
                _showLogoutConfirmation(context);
              },
            ),
          ],
        ),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            DropdownWidget(
              items: treinoOptions,
              selectedValue: selectedTreino,
              onChanged: (newValue) {
                setState(() {
                  selectedTreino = newValue;
                  nm_treino = newValue; // Atualiza o nome do treino selecionado
                  id_treino = treinoOptions
                      .firstWhere(
                          (treino) => treino['nm_treino'] == newValue)['id']
                      .toString();
                  _fetchTreinos(
                      newValue!); // Atualiza os treinos com o novo valor selecionado
                });
              },
            ),
            const SizedBox(height: 16),
            Text('$nm_treino',
                style: TextStyle(color: Colors.orange, fontSize: 24)),
            const SizedBox(height: 16),
            Expanded(
              child: ListView(
                children: treinoCards,
              ),
            ),
            const SizedBox(height: 16),
            CustomButton(
              text: 'Concluir',
              onPressed: () {
                ConcluirTreinos();
              },
            ),
            const SizedBox(height: 24),
          ],
        ),
      ),
    );
  }

  void _showLogoutConfirmation(BuildContext context) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text('Confirmar Logout'),
        content: const Text('Você tem certeza que deseja sair?'),
        actions: [
          TextButton(
            onPressed: () {
              Navigator.of(context).pop();
            },
            child: const Text('Cancelar'),
          ),
          TextButton(
            onPressed: () {
              Navigator.of(context).pop();
              Navigator.of(context)
                  .pushReplacementNamed('/'); // Retorna para a tela inicial
            },
            child: const Text('Sair'),
          ),
        ],
      ),
    );
  }
}
