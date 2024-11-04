import 'package:flutter/material.dart';
import 'treino_checkbox.dart';

class TreinoCard extends StatelessWidget {
  final String nome;
  final int series;
  final int repeticoes;
  final int peso;
  final String comentarios;
  final bool statuscheckbox;

  const TreinoCard({
    super.key,
    required this.nome,
    required this.series,
    required this.repeticoes,
    required this.peso,
    required this.comentarios,
    required this.statuscheckbox,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.symmetric(vertical: 8.0),
      padding: const EdgeInsets.all(16.0),
      decoration: BoxDecoration(
        color: Colors.grey[800],
        borderRadius: BorderRadius.circular(12),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(nome,
                  style: const TextStyle(color: Colors.white, fontSize: 18)),
              Text('Séries: $series',
                  style: const TextStyle(color: Colors.white)),
              Text('Repetições: $repeticoes',
                  style: const TextStyle(color: Colors.white)),
              Text('Peso: $peso', style: const TextStyle(color: Colors.white)),
              Text('Comentários: $comentarios',
                  style: const TextStyle(color: Colors.white)),
            ],
          ),
          TreinoCheckbox(
            isCheckedExternally: statuscheckbox,
            nome: nome,
            series: series,
            repeticoes: repeticoes,
            peso: peso,
            comentario: ' ',
          ),
        ],
      ),
    );
  }
}
