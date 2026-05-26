import 'package:flutter/material.dart';
import 'package:fl_chart/fl_chart.dart';
import 'package:google_fonts/google_fonts.dart';

class ReportsScreen extends StatelessWidget {
  const ReportsScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text('Relatórios', style: GoogleFonts.inter(fontSize: 22, fontWeight: FontWeight.w800)),
          Text('Análise de desempenho das culturas', style: GoogleFonts.inter(fontSize: 13, color: Colors.grey[600])),
          const SizedBox(height: 20),
          _buildStats(),
          const SizedBox(height: 20),
          _buildAreaChart(),
          const SizedBox(height: 20),
          _buildHealthPie(),
          const SizedBox(height: 20),
          _buildTable(),
        ],
      ),
    );
  }

  Widget _buildStats() {
    final stats = [
      {'label': 'Total Culturas', 'value': '5'},
      {'label': 'Área Total', 'value': '340 ha'},
      {'label': 'Sensores', 'value': '7'},
      {'label': 'Safras', 'value': '2'},
    ];

    return GridView.count(
      shrinkWrap: true,
      physics: const NeverScrollableScrollPhysics(),
      crossAxisCount: 2,
      mainAxisSpacing: 10,
      crossAxisSpacing: 10,
      childAspectRatio: 2.4,
      children: stats.map((s) => Card(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 10),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Text(s['value']!, style: GoogleFonts.inter(fontSize: 20, fontWeight: FontWeight.w700)),
              Text(s['label']!, style: GoogleFonts.inter(fontSize: 11, color: Colors.grey[600])),
            ],
          ),
        ),
      )).toList(),
    );
  }

  Widget _buildAreaChart() {
    final data = [
      BarChartGroupData(x: 0, barRods: [BarChartRodData(toY: 120, color: const Color(0xFF2E7D52), width: 20, borderRadius: BorderRadius.circular(4))]),
      BarChartGroupData(x: 1, barRods: [BarChartRodData(toY: 85, color: const Color(0xFF2E7D52), width: 20, borderRadius: BorderRadius.circular(4))]),
      BarChartGroupData(x: 2, barRods: [BarChartRodData(toY: 45, color: const Color(0xFF2E7D52), width: 20, borderRadius: BorderRadius.circular(4))]),
      BarChartGroupData(x: 3, barRods: [BarChartRodData(toY: 30, color: const Color(0xFF2E7D52), width: 20, borderRadius: BorderRadius.circular(4))]),
      BarChartGroupData(x: 4, barRods: [BarChartRodData(toY: 60, color: const Color(0xFF2E7D52), width: 20, borderRadius: BorderRadius.circular(4))]),
    ];

    final labels = ['Soja', 'Milho', 'Café', 'Feijão', 'Trigo'];

    return Card(
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Área por Cultura (ha)', style: GoogleFonts.inter(fontWeight: FontWeight.w600, fontSize: 14)),
            const SizedBox(height: 16),
            SizedBox(
              height: 180,
              child: BarChart(
                BarChartData(
                  barGroups: data,
                  gridData: FlGridData(show: false),
                  borderData: FlBorderData(show: false),
                  titlesData: FlTitlesData(
                    leftTitles: AxisTitles(sideTitles: SideTitles(showTitles: false)),
                    rightTitles: AxisTitles(sideTitles: SideTitles(showTitles: false)),
                    topTitles: AxisTitles(sideTitles: SideTitles(showTitles: false)),
                    bottomTitles: AxisTitles(
                      sideTitles: SideTitles(
                        showTitles: true,
                        getTitlesWidget: (v, _) => Text(
                          labels[v.toInt()],
                          style: GoogleFonts.inter(fontSize: 10, color: Colors.grey[600]),
                        ),
                      ),
                    ),
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildHealthPie() {
    final data = [
      PieChartSectionData(value: 2, color: Colors.green, title: 'Excelente\n2', titleStyle: GoogleFonts.inter(fontSize: 10, color: Colors.white, fontWeight: FontWeight.w600), radius: 70),
      PieChartSectionData(value: 2, color: const Color(0xFF2E7D52), title: 'Boa\n2', titleStyle: GoogleFonts.inter(fontSize: 10, color: Colors.white, fontWeight: FontWeight.w600), radius: 70),
      PieChartSectionData(value: 1, color: Colors.amber, title: 'Regular\n1', titleStyle: GoogleFonts.inter(fontSize: 10, color: Colors.white, fontWeight: FontWeight.w600), radius: 70),
    ];

    return Card(
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Distribuição de Saúde', style: GoogleFonts.inter(fontWeight: FontWeight.w600, fontSize: 14)),
            const SizedBox(height: 16),
            SizedBox(
              height: 160,
              child: PieChart(PieChartData(sections: data, sectionsSpace: 2, centerSpaceRadius: 30)),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildTable() {
    final rows = [
      ['Soja Parcela Norte', 'Soja', '120 ha', 'Crescimento', 'Excelente'],
      ['Milho Área A1', 'Milho', '85 ha', 'Colheita', 'Boa'],
      ['Café Parcela Sul', 'Café', '45 ha', 'Crescimento', 'Regular'],
      ['Feijão Área B2', 'Feijão', '30 ha', 'Plantio', 'Boa'],
      ['Trigo Parcela Leste', 'Trigo', '60 ha', 'Concluída', 'Excelente'],
    ];

    return Card(
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Detalhamento das Culturas', style: GoogleFonts.inter(fontWeight: FontWeight.w600, fontSize: 14)),
            const SizedBox(height: 12),
            Table(
              border: TableBorder(horizontalInside: BorderSide(color: Colors.grey[200]!)),
              columnWidths: const {0: FlexColumnWidth(2), 1: FlexColumnWidth(1), 2: FlexColumnWidth(1), 3: FlexColumnWidth(1.2), 4: FlexColumnWidth(1.2)},
              children: [
                TableRow(
                  decoration: BoxDecoration(color: Colors.grey[100]),
                  children: ['Cultura', 'Tipo', 'Área', 'Status', 'Saúde'].map((h) => Padding(
                    padding: const EdgeInsets.symmetric(vertical: 8, horizontal: 4),
                    child: Text(h, style: GoogleFonts.inter(fontSize: 10, fontWeight: FontWeight.w700, color: Colors.grey[700])),
                  )).toList(),
                ),
                ...rows.map((row) => TableRow(
                  children: row.map((cell) => Padding(
                    padding: const EdgeInsets.symmetric(vertical: 8, horizontal: 4),
                    child: Text(cell, style: GoogleFonts.inter(fontSize: 11)),
                  )).toList(),
                )),
              ],
            ),
          ],
        ),
      ),
    );
  }
}