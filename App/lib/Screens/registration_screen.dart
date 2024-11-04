import 'package:flutter/material.dart';
import '../widgets/custom_text_field.dart';
import '../widgets/custom_button.dart';
import '../widgets/validation_dialog.dart'; // Importando o widget de pop-up
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'login_screen.dart';

class RegistrationScreen extends StatelessWidget {
  final TextEditingController nomeController = TextEditingController();
  final TextEditingController cpfController = TextEditingController();
  final TextEditingController emailController = TextEditingController();
  final TextEditingController senhaController = TextEditingController();

  RegistrationScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color.fromARGB(255, 0, 0, 0), // Mantendo o fundo branco
      appBar: AppBar(
        title: const Text("Registrar", style: TextStyle(color: Colors.orange)),
        leading: IconButton(
            icon: const Icon(Icons.arrow_back), onPressed: () => LoginScreen()),
      ),
      body: GestureDetector(
        onTap: () => FocusScope.of(context).unfocus(),
        child: Center(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(16.0),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Image.asset(
                  'assets/Logo.png', // Substitua pelo caminho da sua logo
                  height: 100, // Ajuste a altura conforme necessário
                ),
                const SizedBox(
                    height: 24), // Espaçamento entre a logo e os campos
                Text(
                  'Crie sua conta',
                  style: TextStyle(
                    fontSize: 24,
                    fontWeight: FontWeight.bold,
                    color: Colors.orange, // Cor do texto ajustada
                  ),
                ),
                const SizedBox(height: 24),
                CustomTextField(controller: nomeController, hint: 'Nome'),
                const SizedBox(height: 16),
                CustomTextField(
                    controller: cpfController, hint: 'CPF', isNumber: true),
                const SizedBox(height: 16),
                CustomTextField(controller: emailController, hint: 'E-mail'),
                const SizedBox(height: 16),
                CustomTextField(
                    controller: senhaController,
                    hint: 'Senha',
                    isPassword: true),
                const SizedBox(height: 24),
                CustomButton(
                    text: 'Registrar',
                    onPressed: () {
                      _handleRegistration(context);
                    }),
                const SizedBox(height: 16),
                GestureDetector(
                  onTap: () =>
                      Navigator.pop(context), // Volta para a tela anterior
                  child: const Text(
                    "Já tem uma conta? Faça login",
                    style: TextStyle(
                        color: Colors.orange,
                        decoration: TextDecoration.underline),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  void _handleRegistration(BuildContext context) {
    if (nomeController.text.isEmpty ||
        cpfController.text.isEmpty ||
        emailController.text.isEmpty ||
        senhaController.text.isEmpty) {
      _showPopup(context, 'Campos Obrigatórios',
          'Por favor, preencha todos os campos.');
    } else {
      Cadastro(
        cpfController.text,
        nomeController.text,
        senhaController.text,
        emailController.text,
        context,
      );
    }
  }

  void _showPopup(BuildContext context, String title, String content,
      [VoidCallback? onOkPressed]) {
    showDialog(
      context: context,
      builder: (context) => ValidationDialog(
        title: title,
        content: content,
        onOkPressed: () {
          Navigator.of(context).pop(); // Fecha o diálogo
          onOkPressed?.call(); // Chama a ação adicional se fornecida
        },
      ),
    );
  }
}

void _showERRO(BuildContext context, String message) {
  showDialog(
    context: context,
    builder: (context) => ValidationDialog(
      title: 'Erro',
      content: message,
      onOkPressed: () {
        Navigator.of(context).pop(); // Fecha o diálogo
      },
    ),
  );
}

Future<void> Cadastro(String cpf, String nome, String senha, String email,
    BuildContext context) async {
  final String baseUrl = 'http://10.0.2.2:3001/CadastrarAluno/APP';
  final url = Uri.parse('$baseUrl/$cpf/$nome/$senha/$email');
  print('Chamando API: $url');

  try {
    final response = await http.post(url);
    print('Status da resposta: ${response.statusCode}');
    print('Resposta: ${response.body}');

    if (response.statusCode == 201) {
      final responseData = jsonDecode(response.body);
      print('Resposta da API: $responseData');
      _showERRO(context, 'Cadastro realizado com sucesso!');
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(
          builder: (_) => LoginScreen(),
        ),
      );
    } else {
      _showERRO(context, 'Falha ao autenticar');
    }
  } catch (error) {
    print('Erro ao fazer a requisição: $error');
    _showERRO(context, 'Falha ao autenticar');
  }
}
