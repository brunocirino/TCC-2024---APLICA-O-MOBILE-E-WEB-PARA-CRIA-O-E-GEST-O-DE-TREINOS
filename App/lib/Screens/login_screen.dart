import 'package:flutter/material.dart';
import '../widgets/custom_text_field.dart';
import '../widgets/custom_button.dart';
import '../widgets/validation_dialog.dart'; // Importando o novo widget
import 'registration_screen.dart';
import 'forgot_password_screen.dart';
import 'home_screen.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:provider/provider.dart'; // Corrigido para importar o provider
import 'package:teste/Providers/id_user_provider.dart'; // Importe o UserProvider

class LoginScreen extends StatelessWidget {
  final TextEditingController cpfController = TextEditingController();
  final TextEditingController senhaController = TextEditingController();

  LoginScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color.fromARGB(255, 0, 0, 0),
      body: GestureDetector(
        onTap: () => FocusScope.of(context).unfocus(),
        child: Center(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(16.0),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Image.asset('assets/Logo.png', height: 120),
                const SizedBox(height: 24),
                Text(
                  'Bem-vindo de volta!',
                  style: TextStyle(
                    fontSize: 24,
                    fontWeight: FontWeight.bold,
                    color: Colors.orange,
                  ),
                ),
                const SizedBox(height: 16),
                CustomTextField(
                    controller: cpfController, hint: 'CPF', isNumber: true),
                const SizedBox(height: 16),
                CustomTextField(
                    controller: senhaController,
                    hint: 'Senha',
                    isPassword: true),
                const SizedBox(height: 24),
                CustomButton(
                    text: 'Entrar',
                    onPressed: () {
                      if (cpfController.text.isEmpty ||
                          senhaController.text.isEmpty) {
                        _showValidationDialog(context);
                      } else {
                        login2(
                            cpfController.text, senhaController.text, context);
                      }
                    }),
                const SizedBox(height: 16),
                GestureDetector(
                  onTap: () => Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (_) => ForgotPasswordScreen())),
                  child: const Text(
                    "Esqueceu a senha?",
                    style: TextStyle(
                        color: Colors.orange,
                        decoration: TextDecoration.underline),
                  ),
                ),
                const SizedBox(height: 16),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    const Text("Não tem uma conta? ",
                        style: TextStyle(color: Colors.grey)),
                    GestureDetector(
                      onTap: () {
                        Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (_) => RegistrationScreen()));
                      },
                      child: const Text(
                        "Registrar",
                        style: TextStyle(
                            color: Colors.orange,
                            fontWeight: FontWeight.bold,
                            decoration: TextDecoration.underline),
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 24),
              ],
            ),
          ),
        ),
      ),
    );
  }

  void _showValidationDialog(BuildContext context) {
    showDialog(
      context: context,
      builder: (context) => ValidationDialog(
        title: 'Campos Obrigatórios',
        content: 'Por favor, preencha todos os campos.',
        onOkPressed: () {
          Navigator.of(context).pop();
        },
      ),
    );
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

  Future<void> login2(String cpf, String senha, BuildContext context) async {
    final String baseUrl = 'http://10.0.2.2:3001/login/APP';
    final url = Uri.parse('$baseUrl/$cpf/$senha');
    print('Chamando API: $url');

    try {
      final response = await http.get(url);
      print('Status da resposta: ${response.statusCode}');
      print('Resposta: ${response.body}');

      if (response.statusCode == 200) {
        final responseData = jsonDecode(response.body);
        print('Resposta da API: $responseData');

        if (responseData['sucesso'] == true) {
          final List<dynamic> results = responseData['results'] ?? [];

          if (results.isNotEmpty) {
            final userId = results[0]['id'].toString();
            print('ID do usuário: $userId');

            // Armazene o ID no UserProvider
            Provider.of<UserProvider>(context, listen: false)
                .setIdAluno(userId);

            Navigator.pushReplacement(
              context,
              MaterialPageRoute(
                builder: (_) => HomeScreen(userId: userId),
              ),
            );
          } else {
            _showERRO(context, 'Nenhum resultado encontrado.');
          }
        } else {
          _showERRO(context, 'Falha ao autenticar');
        }
      } else {
        _showERRO(context, 'Falha ao autenticar');
      }
    } catch (error) {
      print('Erro ao fazer a requisição: $error');
      _showERRO(context, 'Falha ao autenticar');
    }
  }
}
