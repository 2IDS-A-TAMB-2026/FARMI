import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

import 'services/auth_service.dart'; // ✅ IMPORTANTE
import 'widgets/main_layout.dart';

import 'screens/home_screen.dart';
import 'screens/dashboard_screen.dart';
import 'screens/crop_management_screen.dart';
import 'screens/sensor_management_screen.dart';
import 'screens/alerts_screen.dart';
import 'screens/reports_screen.dart';
import 'screens/admin_panel_screen.dart';
import 'screens/login_screen.dart';
import 'screens/forgot_password_screen.dart';
import 'screens/reset_password_screen.dart';


void main() {
  runApp(const FarmiApp());
}

class FarmiApp extends StatelessWidget {
  const FarmiApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'FARMI',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        useMaterial3: true,
        colorScheme: ColorScheme.fromSeed(
          seedColor: const Color(0xFF2E7D52),
          brightness: Brightness.light,
        ),
        textTheme: GoogleFonts.interTextTheme(),
        scaffoldBackgroundColor: const Color(0xFFF4F9F6),
        cardTheme: CardThemeData(
          elevation: 0,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(16),
          ),
          color: Colors.white,
        ),
      ),
      initialRoute: '/',
      routes: {
        '/': (context) => const HomeScreen(),

        '/dashboard': (context) =>
            AuthService.isLoggedIn
                ? MainLayout(child: DashboardScreen())
                : const LoginScreen(),

        '/crops': (context) =>
            AuthService.isLoggedIn
                ? MainLayout(child: CropManagementScreen())
                : const LoginScreen(),

        '/sensors': (context) =>
            AuthService.isLoggedIn
                ? MainLayout(child: SensorManagementScreen())
                : const LoginScreen(),

        '/alerts': (context) =>
            AuthService.isLoggedIn
                ? MainLayout(child: AlertsScreen())
                : const LoginScreen(),

        '/reports': (context) =>
            AuthService.isLoggedIn
                ? MainLayout(child: ReportsScreen())
                : const LoginScreen(),

        '/admin': (context) =>
            AuthService.isLoggedIn
                ? MainLayout(child: AdminPanelScreen())
                : const LoginScreen(),

        '/login': (context) => const LoginScreen(),
        '/forgot-password': (context) => const ForgotPasswordScreen(),
        '/reset-password': (context) => const ResetPasswordScreen(),
      },
    );
  }
}