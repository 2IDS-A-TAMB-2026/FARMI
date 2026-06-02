import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:provider/provider.dart'; // Adicionado para o High Contrast / Theme
import '../models/crop.dart'; 
import 'theme_provider.dart'; // Importado igual à página de cultura
import 'home_screen.dart';

class DashboardScreen extends StatefulWidget {
  const DashboardScreen({super.key});

  @override
  State<DashboardScreen> createState() => _DashboardScreenState();
}

class _DashboardScreenState extends State<DashboardScreen> {
  // Lista de culturas simulando os dados reais (Mantida a original do Dashboard)
  final List<Crop> _crops = [
    Crop(
        id: '1',
        name: 'Soja Parcela Norte',
        type: 'Soja',
        status: 'growing',
        health: 'excellent',
        area: 120,
        season: '2025/2026'),
    Crop(
        id: '2',
        name: 'Milho Área A1',
        type: 'Milho',
        status: 'harvest',
        health: 'good',
        area: 85,
        season: '2025/2026'),
    Crop(
        id: '3',
        name: 'Café Parcela Sul',
        type: 'Café',
        status: 'growing',
        health: 'regular',
        area: 45,
        season: '2024/2025'),
    Crop(
        id: '4',
        name: 'Feijão Área B2',
        type: 'Feijão',
        status: 'planting',
        health: 'good',
        area: 30,
        season: '2025/2026'),
    Crop(
        id: '5',
        name: 'Trigo Parcela Leste',
        type: 'Trigo',
        status: 'completed',
        health: 'excellent',
        area: 60,
        season: '2025/2025'),
  ];

  final Map<String, dynamic> data = {
    'sensores_totais': '4',
    'fazendas': '3',
    'usuarios': '4',
  };

  final _statusLabels = {
    'planting': 'Plantio',
    'growing': 'Crescimento',
    'harvest': 'Colheita',
    'completed': 'Concluída'
  };

  static const Color verdeEscuro = Color(0xFF052501);
  static const Color verdeClaro = Color(0xFF4BC714);
  static const Color corAzul = Color(0xFF2196F3);
  static const Color corLaranja = Color(0xFFFF9800);
  static const Color corVermelho = Color(0xFFF44336);
  static const Color bgCinza = Colors.transparent;

  Color _statusColor(String? s) {
    switch (s) {
      case 'planting':
        return Colors.blue;
      case 'growing':
        return Colors.green;
      case 'harvest':
        return Colors.amber;
      case 'completed':
        return Colors.grey;
      default:
        return Colors.grey;
    }
  }

  @override
  Widget build(BuildContext context) {
    // REFERÊNCIA AO THEME (Igual feito implicitamente ou explicitamente na Cultura)
    // Se o seu alto contraste muda as cores do Theme padrão do Flutter:
    final theme = Theme.of(context);
    final isHighContrast = theme.brightness == Brightness.dark; // Ou a lógica do seu ThemeProvider

    return Scaffold(
      backgroundColor: bgCinza,
      body: SingleChildScrollView(
        padding: const EdgeInsets.fromLTRB(4, 2, 12, 16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // HEADER
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      'Dashboard',
                      style: GoogleFonts.inter(
                        fontSize: 20,
                        fontWeight: FontWeight.w800,
                      ),
                    ),
                    Text(
                      'Visão geral do sistema',
                      style: GoogleFonts.inter(
                        fontSize: 13,
                        color: isHighContrast ? const Color.fromARGB(255, 255, 255, 255) : const Color.fromARGB(255, 0, 0, 0), // Adaptável
                      ),
                    ),
                  ],
                ),
                PopupMenuButton<String>(
                  onSelected: (value) {
                    if (value == 'sair') {
                      Navigator.pushReplacement(
                        context,
                        MaterialPageRoute(
                          builder: (context) => const HomeScreen(),
                        ),
                      );
                    }
                  },
                  itemBuilder: (context) => [
                    const PopupMenuItem(
                      value: 'sair',
                      child: Row(
                        children: [
                          Icon(Icons.logout),
                          SizedBox(width: 8),
                          Text('Sair'),
                        ],
                      ),
                    ),
                  ],
                  child: CircleAvatar(
                    radius: 18,
                    backgroundColor: isHighContrast ? Colors.white : const Color.fromARGB(255, 46, 125, 82),
                    child: Text(
                      '➜',
                      style: TextStyle(
                        color: isHighContrast ? Colors.black : Colors.white,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                )
              ],
            ),

            const SizedBox(height: 30),

            // STATS GRID
            LayoutBuilder(
              builder: (context, constraints) {
                return GridView.count(
                  shrinkWrap: true,
                  physics: const NeverScrollableScrollPhysics(),
                  crossAxisCount: constraints.maxWidth > 600 ? 3 : 1,
                  crossAxisSpacing: 12,
                  mainAxisSpacing: 12,
                  childAspectRatio: constraints.maxWidth > 600 ? 2.5 : 2,
                  children: [
                    _buildStatCard(
                      "Sensores Totais",
                      data['sensores_totais']?.toString() ?? '0',
                      Icons.sensors,
                      isHighContrast ? theme.colorScheme.primary : const Color.fromARGB(255, 46, 125, 82),
                      theme,
                    ),
                    _buildStatCard(
                      "Fazendas",
                      data['fazendas']?.toString() ?? '0',
                      Icons.pets,
                      isHighContrast ? theme.colorScheme.primary : const Color.fromARGB(255, 46, 125, 82),
                      theme,
                    ),
                    _buildStatCard(
                      "Funcionários",
                      data['usuarios']?.toString() ?? '0',
                      Icons.people,
                      isHighContrast ? theme.colorScheme.primary : const Color.fromARGB(255, 46, 125, 82),
                      theme,
                    ),
                  ],
                );
              },
            ),

            const SizedBox(height: 20),

            // MONITORAMENTO (GRÁFICO)
            _buildSectionCard(
              title: "Monitoramento",
              icon: Icons.trending_up,
              theme: theme,
              child: Container(
                height: 180,
                decoration: BoxDecoration(
                  color: theme.cardColor, // Usa a cor do card do tema atual
                  borderRadius: BorderRadius.circular(8),
                  border: Border.all(color: theme.dividerColor),
                ),
                child: Center(
                  child: Text(
                    "📊 [Gráfico]",
                    style: TextStyle(
                      fontSize: 24,
                      color: theme.textTheme.bodyLarge?.color,
                    ),
                  ),
                ),
              ),
            ),

            const SizedBox(height: 20),

            // CULTURAS ATIVAS
            _buildSectionCard(
              title: "Culturas Ativas",
              icon: Icons.eco_rounded,
              theme: theme,
              child: Column(
                children: List.generate(_crops.length, (index) {
                  final crop = _crops[index];
                  
                  final String name = crop.name ?? 'Sem nome';
                  final String type = crop.type ?? 'Não informado';
                  final String statusKey = crop.status ?? 'planting';
                  final String areaText = crop.area != null ? '${crop.area!.toStringAsFixed(0)} ha' : '-- ha';

                  return Column(
                    children: [
                      _buildStatusRow(
                        Icons.eco_rounded,
                        name,
                        _statusLabels[statusKey] ?? 'Plantio',
                        _statusColor(statusKey),
                        theme,
                        subtitle: '$type • $areaText',
                      ),
                      if (index < _crops.length - 1)
                        Divider(height: 16, thickness: 0.5, color: theme.dividerColor),
                    ],
                  );
                }),
              ),
            ),

            const SizedBox(height: 20),

            // ALERTAS
            _buildSectionCard(
              title: "Alertas (3)",
              icon: Icons.notifications,
              theme: theme,
              child: Column(
                children: [
                  Container(
                    width: double.infinity,
                    padding: const EdgeInsets.all(15),
                    decoration: BoxDecoration(
                      color: isHighContrast ? theme.cardColor : const Color.fromARGB(255, 255, 255, 255),
                      borderRadius: BorderRadius.circular(8),
                      border: Border.all(color: theme.dividerColor),
                    ),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          "⚠️ Temp alta Estufa A",
                          style: TextStyle(color: isHighContrast ? Colors.white : corVermelho, fontWeight: FontWeight.w500),
                        ),
                        const SizedBox(height: 8),
                        Text(
                          "🌡️ Umidade baixa Campo B",
                          style: TextStyle(color: isHighContrast ? Colors.white : corLaranja, fontWeight: FontWeight.w500),
                        ),
                        const SizedBox(height: 8),
                        Text(
                          "💡 Luz fraca Estufa C",
                          style: TextStyle(color: isHighContrast ? Colors.white : corAzul, fontWeight: FontWeight.w500),
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 12),
                  ElevatedButton(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: isHighContrast ? theme.colorScheme.primary : verdeEscuro,
                      foregroundColor: isHighContrast ? theme.colorScheme.onPrimary : Colors.white,
                      minimumSize: const Size(double.infinity, 45),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(8),
                      ),
                    ),
                    onPressed: () => Navigator.pushNamed(context, '/alerts'),
                    child: const Text(
                      "Ver Todos os Alertas",
                      style: TextStyle(fontWeight: FontWeight.bold),
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  // Métodos auxiliares de UI recebendo o "theme" dinâmico para respeitar o Alto Contraste

  Widget _buildStatCard(String title, String value, IconData icon, Color iconColor, ThemeData theme) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: theme.cardColor,
        borderRadius: BorderRadius.circular(8),
        border: Border.all(color: theme.dividerColor, width: 0.5),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Text(
                title,
                style: TextStyle(fontSize: 14, color: theme.textTheme.bodyMedium?.color?.withOpacity(0.6), fontWeight: FontWeight.w500),
              ),
              const SizedBox(height: 4),
              Text(
                value,
                style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold, color: theme.textTheme.bodyLarge?.color),
              ),
            ],
          ),
          Icon(icon, color: iconColor, size: 32),
        ],
      ),
    );
  }

  Widget _buildSectionCard({required String title, required IconData icon, required Widget child, required ThemeData theme}) {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: theme.cardColor,
        borderRadius: BorderRadius.circular(8),
        border: Border.all(color: theme.dividerColor, width: 0.5),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Icon(icon, color: theme.iconTheme.color ?? const Color.fromARGB(255, 0, 0, 0), size: 20),
              const SizedBox(width: 8),
              Text(
                title,
                style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: theme.textTheme.titleMedium?.color),
              ),
            ],
          ),
          const SizedBox(height: 16),
          child,
        ],
      ),
    );
  }

  Widget _buildStatusRow(IconData icon, String title, String status, Color statusColor, ThemeData theme, {required String subtitle}) {
    return Row(
      children: [
        CircleAvatar(
          backgroundColor: statusColor.withOpacity(0.1),
          child: Icon(icon, color: statusColor, size: 20),
        ),
        const SizedBox(width: 12),
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                title,
                style: TextStyle(fontWeight: FontWeight.bold, fontSize: 14, color: theme.textTheme.bodyLarge?.color),
                maxLines: 1,
                overflow: TextOverflow.ellipsis,
              ),
              Text(
                subtitle,
                style: TextStyle(fontSize: 12, color: theme.textTheme.bodyMedium?.color?.withOpacity(0.6)),
                maxLines: 1,
                overflow: TextOverflow.ellipsis,
              ),
            ],
          ),
        ),
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
          decoration: BoxDecoration(
            color: statusColor.withOpacity(0.1),
            borderRadius: BorderRadius.circular(6),
            border: Border.all(color: statusColor.withOpacity(0.3)),
          ),
          child: Text(
            status,
            style: TextStyle(color: statusColor, fontWeight: FontWeight.bold, fontSize: 12),
          ),
        ),
      ],
    );
  }

  Widget _buildActivityItem({
    required IconData icon,
    required Color iconColor,
    required Color bgColor,
    required String title,
    required String subtitle,
    required ThemeData theme,
    VoidCallback? onTap,
  }) {
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(8),
      child: Padding(
        padding: const EdgeInsets.symmetric(vertical: 6.0, horizontal: 4.0),
        child: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(color: bgColor, shape: BoxShape.circle),
              child: Icon(icon, color: iconColor, size: 20),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(title, style: TextStyle(fontWeight: FontWeight.bold, fontSize: 14, color: theme.textTheme.bodyLarge?.color)),
                  Text(subtitle, style: TextStyle(color: theme.textTheme.bodyMedium?.color?.withOpacity(0.6), fontSize: 12)),
                ],
              ),
            ),
            if (onTap != null) Icon(Icons.chevron_right, color: theme.iconTheme.color?.withOpacity(0.5) ?? const Color.fromARGB(255, 255, 255, 255), size: 18),
          ],
        ),
      ),
    );
  }
}