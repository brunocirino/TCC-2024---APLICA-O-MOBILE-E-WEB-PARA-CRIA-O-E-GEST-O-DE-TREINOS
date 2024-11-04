import 'package:flutter/material.dart';

class UserProvider with ChangeNotifier {
  String? _idAluno;

  // Getter para acessar _idAluno
  String? get idAluno => _idAluno;

  // Setter para atualizar _idAluno
  void setIdAluno(String id) {
    _idAluno = id;
    notifyListeners(); // Notifica os widgets que dependem dessa informação
  }

  // Método para limpar _idAluno
  void clearIdAluno() {
    _idAluno = null;
    notifyListeners();
  }

  // Método para obter o ID do aluno, agora retornando String? para permitir null
  String? getIdAluno() {
    return _idAluno;
  }
}
