import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../Providers/List_exercicios.dart';
import '../Providers/exercicios.dart';

class TreinoCheckbox extends StatefulWidget {
  final bool isCheckedExternally;
  final String nome;
  final int series;
  final int repeticoes;
  final int peso;
  final String comentario;

  const TreinoCheckbox({
    super.key,
    required this.isCheckedExternally,
    required this.nome,
    required this.series,
    required this.repeticoes,
    required this.peso,
    required this.comentario,
  });

  @override
  _TreinoCheckboxState createState() => _TreinoCheckboxState();
}

class _TreinoCheckboxState extends State<TreinoCheckbox> {
  late bool isChecked;
  late int series;
  late int repeticoes;
  late int peso;
  late TextEditingController comentarioController;

  @override
  void initState() {
    super.initState();
    isChecked = widget.isCheckedExternally;
    series = widget.series;
    repeticoes = widget.repeticoes;
    peso = widget.peso;
    comentarioController = TextEditingController(text: widget.comentario);
  }

  void _showConfirmationDialog() {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Confirmação'),
          content: Text('Você cumpriu o exercício conforme o planejado?'),
          actions: [
            TextButton(
              onPressed: () {
                Navigator.of(context).pop();
                _showFeedbackForm();
              },
              child: Text('Não'),
            ),
            TextButton(
              onPressed: () {
                Navigator.of(context).pop();

                // Adiciona o exercício com as informações padrão do widget
                _adicionarExercicio(
                  series: widget.series,
                  repeticoes: widget.repeticoes,
                  peso: widget.peso,
                  comentario: widget.comentario,
                );

                print("Exercício concluído conforme planejado.");
              },
              child: Text('Sim'),
            ),
          ],
        );
      },
    );
  }

  void _showFeedbackForm() {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return StatefulBuilder(
          builder: (BuildContext context, StateSetter setState) {
            return AlertDialog(
              title: Text('Informe as alterações'),
              content: SingleChildScrollView(
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    _buildIncrementField("Séries", () => series, (newValue) {
                      setState(() {
                        series = newValue;
                      });
                    }),
                    _buildIncrementField("Repetições", () => repeticoes,
                        (newValue) {
                      setState(() {
                        repeticoes = newValue;
                      });
                    }),
                    _buildIncrementField("Peso (kg)", () => peso, (newValue) {
                      setState(() {
                        peso = newValue;
                      });
                    }),
                    TextField(
                      controller: comentarioController,
                      decoration: InputDecoration(
                        labelText: 'Comentário',
                        hintText: 'Ex.: Alterei a quantidade de repetições',
                      ),
                      keyboardType: TextInputType.text,
                    ),
                  ],
                ),
              ),
              actions: [
                TextButton(
                  onPressed: () {
                    Navigator.of(context).pop();
                  },
                  child: Text('Cancelar'),
                ),
                TextButton(
                  onPressed: () {
                    final String comentario = comentarioController.text;

                    // Adiciona o exercício com as informações alteradas
                    _adicionarExercicio(
                      series: series,
                      repeticoes: repeticoes,
                      peso: peso,
                      comentario: comentario,
                    );

                    Navigator.of(context).pop();
                  },
                  child: Text('Enviar'),
                ),
              ],
            );
          },
        );
      },
    );
  }

  void _adicionarExercicio({
    required int series,
    required int repeticoes,
    required int peso,
    required String comentario,
  }) {
    Exercicios exercicioConcluido = Exercicios(
      nome: widget.nome,
      series: series,
      repeticoes: repeticoes,
      peso: peso,
      comentarios: comentario,
    );

    // Adiciona o exercício à lista global
    Provider.of<ExerciciosProvider>(context, listen: false)
        .addExercicio(exercicioConcluido);
  }

  Widget _buildIncrementField(
      String label, int Function() getValue, ValueChanged<int> onChanged) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      children: [
        Text(label),
        Row(
          children: [
            IconButton(
              icon: Icon(Icons.remove),
              onPressed: () {
                if (getValue() > 0) {
                  onChanged(getValue() - 1);
                }
              },
            ),
            Text(getValue().toString()),
            IconButton(
              icon: Icon(Icons.add),
              onPressed: () {
                onChanged(getValue() + 1);
              },
            ),
          ],
        ),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Checkbox(
          value: isChecked,
          activeColor: Colors.orange,
          onChanged: (value) {
            setState(() {
              isChecked = value ?? false;
              print("Checkbox alterado: $isChecked");
            });
            if (isChecked) {
              _showConfirmationDialog();
            }
          },
        ),
      ],
    );
  }
}
