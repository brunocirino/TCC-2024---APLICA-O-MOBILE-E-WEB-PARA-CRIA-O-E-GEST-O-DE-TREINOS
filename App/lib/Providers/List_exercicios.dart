import 'package:flutter/material.dart';
import '../Providers/exercicios.dart'; // Importe a classe Exercicios

class ExerciciosProvider with ChangeNotifier {
  List<Exercicios> _exercicios = [];

  List<Exercicios> get exercicios => _exercicios;

  void addExercicio(Exercicios exercicio) {
    _exercicios.add(exercicio);
    notifyListeners(); // Notifica os ouvintes sobre a mudança
  }

  void clearTreinos() {
    _exercicios.clear();
    notifyListeners(); // Notifica os ouvintes que a lista foi atualizada
  }
}
