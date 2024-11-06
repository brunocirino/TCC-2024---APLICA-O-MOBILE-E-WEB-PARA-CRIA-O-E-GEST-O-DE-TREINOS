import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class HistoricoCard extends StatelessWidget {
  final String id_aluno;
  final String nmTreino;
  final DateTime data;
  final int series;
  final int repeticoes;
  final int peso;
  final String comentarios;

  const HistoricoCard({
    super.key,
    required this.id_aluno,
    required this.nmTreino,
    required this.data,
    required this.series,
    required this.repeticoes,
    required this.peso,
    required this.comentarios,
  });

  // Função para buscar todos os detalhes de treino na API antes de exibir o diálogo
  Future<void> _fetchDetalhesTreino(BuildContext context) async {
    // Formata a data para o formato YYYY-MM-DD
    String formattedDate = DateFormat('yyyy-MM-dd').format(data);
    final String url =
        'http://10.0.2.2:3001/GetHistoricoPorTreino/APP/$id_aluno/$formattedDate/$nmTreino';

    try {
      final response = await http.get(Uri.parse(url));
      print(response.statusCode);

      if (response.statusCode == 200) {
        final responseData = jsonDecode(response.body);
        print(responseData['sucesso']);
        if (responseData['sucesso'] == true) {
          final detalhes = responseData['results'];

          // Exibe o diálogo com todos os treinos encontrados
          _showDialogDetalhes(
            context,
            detalhes,
          );
        } else {
          _showErroDialog(context, 'Falha ao obter os detalhes do treino.');
        }
      } else {
        _showErroDialog(context, 'Erro na resposta da API.');
      }
    } catch (error) {
      _showErroDialog(context, 'Erro ao processar a solicitação: $error');
      print(error);
    }
  }

  // Função para exibir o diálogo com os detalhes do treino
  void _showDialogDetalhes(BuildContext context, List detalhes) {
    String formattedDate = DateFormat('dd/MM/yyyy').format(data);
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Detalhes do Treino'),
          content: SingleChildScrollView(
            child: ListBody(
              children: detalhes.map<Widget>((detalhe) {
                String comentariosDetalhados =
                    detalhe['comentarios'] ?? 'Sem comentários';
                return Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text('Treino: ${detalhe['nm_treino']}'),
                    Text(
                        'Data: ${DateFormat('dd/MM/yyyy').format(DateTime.parse(detalhe['data']))}'),
                    Text('Séries: ${detalhe['series']}'),
                    Text('Repetições: ${detalhe['repeticoes']}'),
                    Text('Peso: ${detalhe['peso']} kg'),
                    Text('Comentários: $comentariosDetalhados'),
                    Divider(),
                  ],
                );
              }).toList(),
            ),
          ),
          actions: <Widget>[
            TextButton(
              child: const Text('Fechar'),
              onPressed: () {
                Navigator.of(context).pop();
              },
            ),
          ],
        );
      },
    );
  }

  // Função para exibir mensagem de erro
  void _showErroDialog(BuildContext context, String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: const Text('Erro'),
          content: Text(message),
          actions: <Widget>[
            TextButton(
              child: const Text('Fechar'),
              onPressed: () {
                Navigator.of(context).pop();
              },
            ),
          ],
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    // Formata a data para um formato legível
    String formattedDate = DateFormat('dd/MM/yyyy').format(data);

    return GestureDetector(
      onTap: () =>
          _fetchDetalhesTreino(context), // Chama a função ao clicar no card
      child: Container(
        margin: const EdgeInsets.symmetric(vertical: 8.0),
        padding: const EdgeInsets.all(16.0),
        decoration: BoxDecoration(
          color: Colors.grey[800],
          borderRadius: BorderRadius.circular(12),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              'Treino: $nmTreino',
              style: const TextStyle(color: Colors.white, fontSize: 18),
            ),
            const SizedBox(height: 8),
            Text(
              'Data: $formattedDate',
              style: const TextStyle(color: Colors.white),
            ),
          ],
        ),
      ),
    );
  }
}
