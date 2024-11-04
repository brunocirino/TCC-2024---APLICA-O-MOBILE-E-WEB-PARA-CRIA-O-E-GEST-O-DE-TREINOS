import 'package:flutter/material.dart';

class DropdownWidget extends StatefulWidget {
  final List<Map<String, dynamic>> items; // Modificado para incluir IDs e nomes
  final String? selectedValue;
  final ValueChanged<String?> onChanged;

  const DropdownWidget({
    Key? key,
    required this.items,
    this.selectedValue,
    required this.onChanged,
  }) : super(key: key);

  @override
  _DropdownWidgetState createState() => _DropdownWidgetState();
}

class _DropdownWidgetState extends State<DropdownWidget> {
  @override
  Widget build(BuildContext context) {
    return DropdownButton<String>(
      value: widget.selectedValue,
      onChanged: widget.onChanged,
      items: widget.items.map((item) {
        return DropdownMenuItem<String>(
          value: item['nm_treino'], // Usar o nome do treino como valor
          child: Text(item['nm_treino']),
        );
      }).toList(),
    );
  }
}
