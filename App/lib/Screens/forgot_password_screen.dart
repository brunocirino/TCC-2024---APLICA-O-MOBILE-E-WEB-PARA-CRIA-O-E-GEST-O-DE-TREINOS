import 'package:flutter/material.dart';
import '../widgets/custom_text_field.dart';
import '../widgets/custom_button.dart';
import '../widgets/validation_dialog.dart'; // Importando o widget de pop-up

class ForgotPasswordScreen extends StatelessWidget {
  final TextEditingController cpfController = TextEditingController();

  ForgotPasswordScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white, // Mantendo o fundo branco
      appBar: AppBar(
        title: const Text("Recuperar Senha", style: TextStyle(color: Colors.orange)),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () => Navigator.pop(context),
        ),
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
                  height: 120, // Ajuste a altura conforme necessário
                ),
                const SizedBox(height: 24),
                Text(
                  'Recuperar Senha',
                  style: TextStyle(
                    fontSize: 24,
                    fontWeight: FontWeight.bold,
                    color: Colors.orange, // Cor do texto ajustada
                  ),
                ),
                const SizedBox(height: 24),
                CustomTextField(controller: cpfController, hint: 'CPF', isNumber: true),
                const SizedBox(height: 24),
                CustomButton(text: 'Enviar', onPressed: () {
                  _handleSubmit(context);
                }),
                const SizedBox(height: 16),
                GestureDetector(
                  onTap: () => Navigator.pop(context), // Volta para a tela anterior
                  child: const Text(
                    "Voltar ao Login",
                    style: TextStyle(color: Colors.orange, decoration: TextDecoration.underline),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  void _handleSubmit(BuildContext context) {
    // Verifica se o CPF está vazio
    if (cpfController.text.isEmpty) {
      _showPopup(context, 'Campo Obrigatório', 'Por favor, preencha o campo CPF.');
    } else {
      _showPopup(context, 'Senha Enviada', 'A senha foi enviada para o seu email.', () {
        Navigator.of(context).pushReplacementNamed('/'); // Retorna para a tela inicial
      });
    }
  }

  void _showPopup(BuildContext context, String title, String content, [VoidCallback? onOkPressed]) {
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