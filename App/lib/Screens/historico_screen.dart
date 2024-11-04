import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import '../widgets/validation_dialog.dart';
import '../widgets/historico_card.dart';
import 'package:provider/provider.dart';
import 'package:teste/Providers/id_user_provider.dart';
import '../Screens/home_screen.dart';

class HistoricoScreen extends StatefulWidget {
  const HistoricoScreen({super.key});

  @override
  _HistoricoScreenState createState() => _HistoricoScreenState();
}

class _HistoricoScreenState extends State<HistoricoScreen> {
  List<Widget> treinoCards = [];
  String? nm_treino;
  String? selectedTreino;
  List<Map<String, dynamic>> treinoOptions =
      []; // Preencher com dados se necessário

  @override
  void initState() {
    super.initState();
    _trazerHistorico(); // Carrega os cartões ao inicializar
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

  Future<void> _trazerHistorico() async {
    final userProvider = Provider.of<UserProvider>(context, listen: false);
    final idAluno = userProvider.getIdAluno();

    if (idAluno == null) return;

    final String url = 'http://10.0.2.2:3001/GetHistorico/APP/$idAluno';
    final response = await http.get(Uri.parse(url));

    if (response.statusCode == 200) {
      try {
        final responseData = jsonDecode(response.body);
        if (responseData['sucesso'] == true) {
          final results = responseData['results'] as List<dynamic>;

          List<Widget> tempHistoricoCards = [];

          // Criar os cartões com os dados do histórico
          for (var treino in results) {
            final String nomeTreino = treino['nm_treino'];
            final String dataTreino = treino['data'];
            final int idTreino = treino['id'];

            tempHistoricoCards.add(
              HistoricoCard(
                id: idTreino,
                nmTreino: nomeTreino,
                data: DateTime.parse(dataTreino),
              ),
            );
          }

          setState(() {
            treinoCards = tempHistoricoCards; // Atualiza a lista de cards
          });
        } else {
          _showERRO(context,
              'Falha ao obter os treinos: ${responseData['mensagem']}');
        }
      } catch (error) {
        print('Erro ao processar a resposta: $error');
      }
    } else {
      _showERRO(context, 'Você não tem nenhum treino atribuído');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Histórico de Treinos',
            style: TextStyle(color: Colors.orange)),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const SizedBox(height: 16),
            Expanded(
              child: ListView(
                children: treinoCards, // Exibindo os cards gerados
              ),
            ),
            const SizedBox(height: 16),
            const SizedBox(height: 24),
          ],
        ),
      ),
    );
  }
}
