import 'package:app_base44/screens/theme_provider.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:provider/provider.dart';

import 'services/auth_service.dart';
import 'widgets/main_layout.dart';

import 'screens/home_screen.dart';
import 'screens/dashboard_screen.dart';
import 'screens/crop_management_screen.dart';
import 'screens/sensor_management_screen.dart';
import 'screens/alerts_screen.dart';
import 'screens/reports_screen.dart';
import 'screens/login_screen.dart';
import 'screens/forgot_password_screen.dart';
import 'screens/reset_password_screen.dart';
import 'screens/theme_provider.dart';

void main() {
  runApp(const FarmiApp());
}

class FarmiApp extends StatefulWidget {
  const FarmiApp({super.key});

  // ACESSAR DE QUALQUER TELA
  static _FarmiAppState of(BuildContext context) {
    return context.findAncestorStateOfType<_FarmiAppState>()!;
  }

  @override
  State<FarmiApp> createState() => _FarmiAppState();
}

class _FarmiAppState extends State<FarmiApp> {

  bool altoContraste = false;

  // ALTERA O CONTRASTE
  void trocarContraste() {
    setState(() {
      altoContraste = !altoContraste;
    });
  }

  @override
  Widget build(BuildContext context) {

    return MaterialApp(
      title: 'FARMI',
      debugShowCheckedModeBanner: false,

      // ---------------- TEMA NORMAL ----------------
      theme: ThemeData(
        useMaterial3: true,

        colorScheme: ColorScheme.fromSeed(
          seedColor: const Color(0xFF2E7D52),
          brightness: Brightness.light,
        ),

        textTheme: GoogleFonts.interTextTheme(),

        scaffoldBackgroundColor: const Color(0xFFF4F9F6),

        appBarTheme: const AppBarTheme(
          backgroundColor: Colors.white,
          foregroundColor: Colors.black,
        ),

        bottomNavigationBarTheme:
            const BottomNavigationBarThemeData(
          backgroundColor: Colors.white,
          selectedItemColor: Colors.black,
          unselectedItemColor: Colors.grey,
        ),

        drawerTheme: const DrawerThemeData(
          backgroundColor: Colors.white,
        ),

        cardTheme: CardThemeData(
          elevation: 0,

          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(16),
          ),

          color: Colors.white,
        ),
      ),

      // ---------------- ALTO CONTRASTE ----------------
      darkTheme: ThemeData(
        useMaterial3: true,
        brightness: Brightness.dark,

        scaffoldBackgroundColor: Colors.black,

        colorScheme: const ColorScheme.dark(
          primary: Colors.white,
          secondary: Colors.white,
          surface: Colors.black,
        ),

        textTheme: GoogleFonts.interTextTheme(
          ThemeData.dark().textTheme,
        ).apply(
          bodyColor: Colors.white,
          displayColor: Colors.white,
        ),

        appBarTheme: const AppBarTheme(
          backgroundColor: Colors.black,
          foregroundColor: Colors.white,
        ),

        bottomNavigationBarTheme:
            const BottomNavigationBarThemeData(
          backgroundColor: Colors.black,
          selectedItemColor: Colors.white,
          unselectedItemColor: Colors.white70,
        ),

        drawerTheme: const DrawerThemeData(
          backgroundColor: Colors.black,
        ),

        cardTheme: CardThemeData(
          elevation: 0,

          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(16),
          ),

          color: Colors.black,
        ),

        iconTheme: const IconThemeData(
          color: Colors.white,
        ),

        dividerColor: Colors.white54,
      ),

      // MUDA O TEMA DA APP INTEIRA
      themeMode:
          altoContraste
              ? ThemeMode.dark
              : ThemeMode.light,

      initialRoute: '/',

      routes: {

        '/': (context) => const HomeScreen(),

        '/dashboard': (context) =>
            AuthService.isLoggedIn
                ? MainLayout(
                    child: DashboardScreen(),
                  )
                : const LoginScreen(),

        '/crops': (context) =>
            AuthService.isLoggedIn
                ? MainLayout(
                    child: CropManagementScreen(),
                  )
                : const LoginScreen(),

        '/sensors': (context) =>
            AuthService.isLoggedIn
                ? MainLayout(
                    child: SensorManagementScreen(),
                  )
                : const LoginScreen(),

        '/alerts': (context) =>
            AuthService.isLoggedIn
                ? MainLayout(
                    child: AlertsScreen(),
                  )
                : const LoginScreen(),

        '/reports': (context) =>
            AuthService.isLoggedIn
                ? MainLayout(
                    child: ReportsScreen(),
                  )
                : const LoginScreen(),

        '/login': (context) =>
            const LoginScreen(),

        '/forgot-password': (context) =>
            const ForgotPasswordScreen(),

        '/reset-password': (context) =>
            const ResetPasswordScreen(),
      },
      
    );
  }
}