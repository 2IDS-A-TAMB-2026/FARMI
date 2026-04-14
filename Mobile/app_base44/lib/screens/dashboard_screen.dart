import 'package:flutter/material.dart';
import 'package:fl_chart/fl_chart.dart';
import 'package:google_fonts/google_fonts.dart';

class DashboardScreen extends StatelessWidget {
  const DashboardScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          _buildHeader(),
          const SizedBox(height: 20),
          _buildStatsRow(),
          const SizedBox(height: 20),
          _buildSensorsGrid(),
          const SizedBox(height: 20),
          _buildChartCard(),
          const SizedBox(height: 20),
          _buildRecentAlerts(),
        ],
      ),
    );
  }

  Widget _buildHeader() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text('Dashboard',
            style: GoogleFonts.inter(
                fontSize: 24, fontWeight: FontWeight.w800)),
        Text('Monitoramento em tempo real da sua fazenda',
            style: GoogleFonts.inter(fontSize: 13, color: Colors.grey[600])),
      ],
    );
  }

  Widget _buildStatsRow() {
    final stats = [
      {'label': 'Sensores Ativos', 'value': '5', 'icon': Icons.sensors_rounded, 'color': const Color(0xFF2E7D52)},
      {'label': 'Culturas', 'value': '5', 'icon': Icons.eco_rounded, 'color': const Color(0xFF1976D2)},
      {'label': 'Alertas Novos', 'value': '3', 'icon': Icons.notifications_rounded, 'color': const Color(0xFFE53935)},
      {'label': 'Área Total', 'value': '340 ha', 'icon': Icons.landscape_rounded, 'color': const Color(0xFFFF9800)},
    ];

    return GridView.count(
      shrinkWrap: true,
      physics: const NeverScrollableScrollPhysics(),
      crossAxisCount: 2,
      mainAxisSpacing: 12,
      crossAxisSpacing: 12,
      childAspectRatio: 1.6,
      children: stats.map((s) => Card(
        child: Padding(
          padding: const EdgeInsets.all(16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Container(
                padding: const EdgeInsets.all(8),
                decoration: BoxDecoration(
                  color: (s['color'] as Color).withOpacity(0.1),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: Icon(s['icon'] as IconData,
                    color: s['color'] as Color, size: 18),
              ),
              const Spacer(),
              Text(s['value'] as String,
                  style: GoogleFonts.inter(
                      fontSize: 22, fontWeight: FontWeight.w700)),
              Text(s['label'] as String,
                  style: GoogleFonts.inter(
                      fontSize: 11, color: Colors.grey[600])),
            ],
          ),
        ),
      )).toList(),
    );
  }

  Widget _buildSensorsGrid() {
    final sensors = [
      {'name': 'Temperatura', 'value': '28.5°C', 'icon': Icons.thermostat_rounded, 'color': Colors.red, 'status': 'normal'},
      {'name': 'Umid. Solo', 'value': '62%', 'icon': Icons.water_drop_rounded, 'color': Colors.brown, 'status': 'normal'},
      {'name': 'Umid. Ar', 'value': '71%', 'icon': Icons.cloud_rounded, 'color': Colors.blue, 'status': 'normal'},
      {'name': 'Luminosidade', 'value': '450 lux', 'icon': Icons.light_mode_rounded, 'color': Colors.amber, 'status': 'alert'},
    ];

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text('Sensores',
            style: GoogleFonts.inter(fontSize: 16, fontWeight: FontWeight.w600)),
        const SizedBox(height: 8),
        GridView.count(
          shrinkWrap: true,
          physics: const NeverScrollableScrollPhysics(),
          crossAxisCount: 2,
          mainAxisSpacing: 8,
          crossAxisSpacing: 8,
          childAspectRatio: 2.0,
          children: sensors.map((s) => Card(
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 10),
              child: Row(
                children: [
                  Container(
                    padding: const EdgeInsets.all(8),
                    decoration: BoxDecoration(
                      color: (s['color'] as Color).withOpacity(0.1),
                      borderRadius: BorderRadius.circular(8),
                    ),
                    child: Icon(s['icon'] as IconData,
                        color: s['color'] as Color, size: 16),
                  ),
                  const SizedBox(width: 8),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Text(s['value'] as String,
                            style: GoogleFonts.inter(
                                fontWeight: FontWeight.w700, fontSize: 14)),
                        Text(s['name'] as String,
                            style: GoogleFonts.inter(
                                fontSize: 10, color: Colors.grey[600])),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          )).toList(),
        ),
      ],
    );
  }

  Widget _buildChartCard() {
    final spots = [
      const FlSpot(0, 24), const FlSpot(1, 26), const FlSpot(2, 28),
      const FlSpot(3, 27), const FlSpot(4, 29), const FlSpot(5, 28.5),
    ];

    return Card(
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Temperatura (últimas 6 horas)',
                style: GoogleFonts.inter(
                    fontWeight: FontWeight.w600, fontSize: 14)),
            const SizedBox(height: 16),
            SizedBox(
              height: 160,
              child: LineChart(
                LineChartData(
                  gridData: FlGridData(
                    show: true,
                    getDrawingHorizontalLine: (_) =>
                        FlLine(color: Colors.grey[200]!, strokeWidth: 1),
                  ),
                  titlesData: FlTitlesData(
                    leftTitles: AxisTitles(
                      sideTitles: SideTitles(
                        showTitles: true,
                        reservedSize: 32,
                        getTitlesWidget: (v, _) => Text('${v.toInt()}°',
                            style: GoogleFonts.inter(
                                fontSize: 10, color: Colors.grey)),
                      ),
                    ),
                    bottomTitles: AxisTitles(
                      sideTitles: SideTitles(showTitles: false),
                    ),
                    rightTitles: AxisTitles(
                        sideTitles: SideTitles(showTitles: false)),
                    topTitles: AxisTitles(
                        sideTitles: SideTitles(showTitles: false)),
                  ),
                  borderData: FlBorderData(show: false),
                  lineBarsData: [
                    LineChartBarData(
                      spots: spots,
                      isCurved: true,
                      color: const Color(0xFF2E7D52),
                      barWidth: 2.5,
                      belowBarData: BarAreaData(
                        show: true,
                        color: const Color(0xFF2E7D52).withOpacity(0.1),
                      ),
                      dotData: FlDotData(show: false),
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildRecentAlerts() {
    final alerts = [
      {'title': 'Temperatura acima do limite', 'severity': 'Alto', 'color': Colors.orange},
      {'title': 'Umidade do solo muito baixa', 'severity': 'Crítico', 'color': Colors.red},
      {'title': 'Sensor em manutenção', 'severity': 'Médio', 'color': Colors.amber},
    ];

    return Card(
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Alertas Recentes',
                style: GoogleFonts.inter(
                    fontWeight: FontWeight.w600, fontSize: 14)),
            const SizedBox(height: 12),
            ...alerts.map((a) => Padding(
              padding: const EdgeInsets.symmetric(vertical: 6),
              child: Row(
                children: [
                  Container(
                    width: 8,
                    height: 8,
                    decoration: BoxDecoration(
                      color: a['color'] as Color,
                      shape: BoxShape.circle,
                    ),
                  ),
                  const SizedBox(width: 10),
                  Expanded(
                    child: Text(a['title'] as String,
                        style: GoogleFonts.inter(fontSize: 13)),
                  ),
                  Container(
                    padding: const EdgeInsets.symmetric(
                        horizontal: 8, vertical: 2),
                    decoration: BoxDecoration(
                      color: (a['color'] as Color).withOpacity(0.1),
                      borderRadius: BorderRadius.circular(8),
                    ),
                    child: Text(a['severity'] as String,
                        style: GoogleFonts.inter(
                            fontSize: 10,
                            color: a['color'] as Color,
                            fontWeight: FontWeight.w600)),
                  ),
                ],
              ),
            )),
          ],
        ),
      ),
    );
  }
}