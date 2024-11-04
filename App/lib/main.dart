import 'package:flutter/material.dart';
import 'package:provider/provider.dart'; // Adicione isso para utilizar o provider
import 'package:teste/Screens/login_screen.dart';
import 'package:teste/Providers/id_user_provider.dart'; // Importa o UserProvider
import 'package:teste/Providers/List_exercicios.dart'; // Importa o UserProvider

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (_) => UserProvider()),
        ChangeNotifierProvider(
            create: (_) =>
                ExerciciosProvider()), // Adiciona o UserProvider aqui
      ],
      child: MaterialApp(
        theme: ThemeData(
          scaffoldBackgroundColor: Colors.black,
          colorScheme: const ColorScheme.dark(primary: Colors.orange),
        ),
        home: LoginScreen(),
      ),
    );
  }
}
