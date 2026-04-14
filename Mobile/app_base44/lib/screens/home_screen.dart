import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../services/auth_service.dart';

class HomeScreen extends StatelessWidget {
  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF0D2B1A),
      body: CustomScrollView(
        slivers: [
          SliverAppBar(
            floating: true,
            backgroundColor: Colors.transparent,
            elevation: 0,
            title: Row(
              children: [
                Container(
                  width: 32,
                  height: 32,
                  decoration: BoxDecoration(
                    color: const Color(0xFF2E7D52),
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: const Icon(Icons.eco_rounded, color: Colors.white, size: 18),
                ),
                const SizedBox(width: 8),
                Text('FARMI',
                    style: GoogleFonts.inter(
                        color: Colors.white, fontWeight: FontWeight.w800)),
              ],
            ),
            actions: [
              TextButton(
                onPressed: () => Navigator.pushReplacementNamed(context, '/dashboard'),
                child: Text('Dashboard',
                    style: GoogleFonts.inter(color: Colors.white70, fontSize: 13)),
              ),
              Padding(
                padding: const EdgeInsets.only(right: 12),
                child: AuthService.isLoggedIn
                    ? PopupMenuButton<String>(
                        icon: const Icon(Icons.account_circle, color: Colors.white),
                        onSelected: (value) {
                          if (value == 'sair') {
                            AuthService.isLoggedIn = false;

                            Navigator.pushNamedAndRemoveUntil(
                              context,
                              '/login',
                              (route) => false,
                            );
                          }
                        },
                        itemBuilder: (context) => [
                          const PopupMenuItem(
                            value: 'sair',
                            child: Text('Sair'),
                          ),
                        ],
                      )
                    : ElevatedButton(
                        onPressed: () => Navigator.pushReplacementNamed(context, '/login'),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color(0xFF2E7D52),
                          foregroundColor: Colors.white,
                          shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(8)),
                          padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                        ),
                        child: Text('Entrar', style: GoogleFonts.inter(fontSize: 13)),
                      ),
              ),
            ],
          ),
          SliverToBoxAdapter(
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 80),
              child: Column(
                children: [
                  Container(
                    padding:
                        const EdgeInsets.symmetric(horizontal: 14, vertical: 6),
                    decoration: BoxDecoration(
                      border: Border.all(color: Colors.green.shade800),
                      borderRadius: BorderRadius.circular(20),
                      color: Colors.green.shade900.withOpacity(0.4),
                    ),
                    child: Text('🌱 Agricultura Inteligente com IoT',
                        style: GoogleFonts.inter(
                            color: Colors.green.shade300, fontSize: 12)),
                  ),
                  const SizedBox(height: 32),
                  Text(
                    'Monitore sua fazenda\nem tempo real',
                    textAlign: TextAlign.center,
                    style: GoogleFonts.inter(
                      fontSize: 40,
                      fontWeight: FontWeight.w800,
                      color: Colors.white,
                      height: 1.1,
                    ),
                  ),
                  const SizedBox(height: 16),
                  Text(
                    'Sensores IoT inteligentes para controle de temperatura, umidade, irrigação e saúde das suas culturas.',
                    textAlign: TextAlign.center,
                    style: GoogleFonts.inter(
                        color: Colors.white60, fontSize: 15, height: 1.6),
                  ),
                  const SizedBox(height: 40),
                  ElevatedButton.icon(
                    onPressed: () =>
                        Navigator.pushReplacementNamed(context, '/dashboard'),
                    icon: const Icon(Icons.arrow_forward_rounded),
                    label: const Text('Acessar Dashboard'),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFF2E7D52),
                      foregroundColor: Colors.white,
                      padding: const EdgeInsets.symmetric(
                          horizontal: 28, vertical: 16),
                      shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(12)),
                      textStyle: GoogleFonts.inter(
                          fontWeight: FontWeight.w600, fontSize: 15),
                    ),
                  ),
                  const SizedBox(height: 80),
                  _buildFeatureGrid(),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildFeatureGrid() {
    final features = [
      {'icon': Icons.sensors_rounded, 'title': 'Sensores IoT', 'desc': 'Leituras em tempo real de temperatura, umidade e luz'},
      {'icon': Icons.bar_chart_rounded, 'title': 'Análise de Dados', 'desc': 'Gráficos e relatórios detalhados das suas culturas'},
      {'icon': Icons.notifications_active_rounded, 'title': 'Alertas Inteligentes', 'desc': 'Notificações automáticas sobre condições críticas'},
      {'icon': Icons.eco_rounded, 'title': 'Gestão de Culturas', 'desc': 'Controle completo do ciclo produtivo'},
    ];

    return GridView.count(
      shrinkWrap: true,
      physics: const NeverScrollableScrollPhysics(),
      crossAxisCount: 2,
      mainAxisSpacing: 12,
      crossAxisSpacing: 12,
      childAspectRatio: 1.4,
      children: features.map((f) => Container(
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: Colors.white.withOpacity(0.05),
          borderRadius: BorderRadius.circular(16),
          border: Border.all(color: Colors.white12),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Icon(f['icon'] as IconData,
                color: const Color(0xFF4CAF85), size: 24),
            const SizedBox(height: 8),
            Text(f['title'] as String,
                style: GoogleFonts.inter(
                    color: Colors.white,
                    fontWeight: FontWeight.w600,
                    fontSize: 13)),
            const SizedBox(height: 4),
            Text(f['desc'] as String,
                style: GoogleFonts.inter(color: Colors.white38, fontSize: 11),
                maxLines: 2),
          ],
        ),
      )).toList(),
    );
  }
}