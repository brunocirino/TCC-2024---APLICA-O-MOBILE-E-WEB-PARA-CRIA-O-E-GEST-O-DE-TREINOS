import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

class HistoricoCard extends StatelessWidget {
  final int id;
  final String nmTreino;
  final DateTime data;

  const HistoricoCard({
    super.key,
    required this.id,
    required this.nmTreino,
    required this.data,
  });

  @override
  Widget build(BuildContext context) {
    // Formata a data para um formato legível
    String formattedDate = DateFormat('dd/MM/yyyy').format(data);

    return Container(
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
    );
  }
}
