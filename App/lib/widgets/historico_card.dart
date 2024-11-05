import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

class HistoricoCard extends StatelessWidget {
  final int id;
  final String nmTreino;
  final DateTime data;
  final int series;
  final int repeticoes;
  final int peso;
  final String cometarios;

  const HistoricoCard({
    super.key,
    required this.id,
    required this.nmTreino,
    required this.data,
    required this.series,
    required this.repeticoes,
    required this.peso,
    required this.cometarios,
  });

  @override
  Widget build(BuildContext context) {
    // Formata a data para um formato legível
    String formattedDate = DateFormat('dd/MM/yyyy').format(data);

    return GestureDetector(
      onTap: () {
        // Quando o card é clicado, mostra um dialog com as informações
        showDialog(
          context: context,
          builder: (BuildContext context) {
            return AlertDialog(
              title: Text('Detalhes do Treino'),
              content: SingleChildScrollView(
                child: ListBody(
                  children: [
                    Text('Treino: $nmTreino'),
                    Text('Data: $formattedDate'),
                    Text('Séries: $series'),
                    Text('Repetições: $repeticoes'),
                    Text('Peso: $peso kg'),
                    Text('Comentários: $cometarios'),
                  ],
                ),
              ),
              actions: <Widget>[
                TextButton(
                  child: const Text('Fechar'),
                  onPressed: () {
                    Navigator.of(context).pop(); // Fecha o dialog
                  },
                ),
              ],
            );
          },
        );
      },
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
