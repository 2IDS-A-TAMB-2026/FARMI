import 'package:flutter/material.dart';

class DashboardScreen extends StatefulWidget {
  const DashboardScreen({super.key});

  @override
  State<DashboardScreen> createState() => _DashboardScreenState();
}

class _DashboardScreenState extends State<DashboardScreen> {
  // Simulação de dados (vindo do seu PHP)
  final Map<String, dynamic> data = {
    'total_cultivos': '12 Ha',
    'nivel_agua': '85%',
    'sensors_ativos': '24',
    'luz': '1.250 lux',
  };

  @override
  Widget build(BuildContext context) {
    // Cores baseadas no seu style_dashboard.css
    final Color verdeEscuro = const Color(0xFF052501);
    final Color verdeClaro = const Color(0xFF4BC714);

    return SingleChildScrollView(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            "Painel Visual",
            style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: Color(0xFF052501)),
          ),
          const Text("Bem-vindo de volta, Usuário.", style: TextStyle(color: Colors.grey)),
          
          const SizedBox(height: 24),

          // CARDS DE ESTATÍSTICAS (Grid adaptado para celular)
          GridView.count(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            crossAxisCount: 2,
            crossAxisSpacing: 12,
            mainAxisSpacing: 12,
            childAspectRatio: 1.3,
            children: [
              _buildStatCard("Solo", data['total_cultivos'], Icons.landscape, verdeEscuro, verdeClaro),
              _buildStatCard("Umidade", data['nivel_agua'], Icons.opacity, verdeEscuro, verdeClaro),
              _buildStatCard("Sensores", data['sensors_ativos'], Icons.sensors, verdeEscuro, verdeClaro),
              _buildStatCard("Luz", data['luz'], Icons.wb_sunny, verdeEscuro, verdeClaro),
            ],
          ),

          const SizedBox(height: 32),

          const Text(
            "Status dos Sistemas",
            style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold, color: Color(0xFF052501)),
          ),
          
          const SizedBox(height: 16),

          // LISTA DE STATUS (Substituindo a tabela HTML)
          _buildStatusItem("Sistema Temperatura", "Soja 1", "Operacional", Colors.green, verdeClaro),
          _buildStatusItem("Controle de Umidade", "Estufa Principal", "Normal", Colors.green, verdeClaro),
          _buildStatusItem("Energia Solar", "Margaridas", "Alerta", Colors.red, verdeClaro),
        ],
      ),
    );
  }

  Widget _buildStatCard(String title, String value, IconData icon, Color primary, Color accent) {
    return Container(
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        border: Border(left: BorderSide(color: primary, width: 5)),
        boxShadow: [
          BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 4, offset: const Offset(0, 2)),
        ],
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(icon, color: accent, size: 28),
          const SizedBox(height: 8),
          Text(title, style: const TextStyle(fontSize: 12, color: Colors.grey)),
          Text(value, style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: primary)),
        ],
      ),
    );
  }

  Widget _buildStatusItem(String nome, String local, String status, Color statusColor, Color iconColor) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        boxShadow: [
          BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 2, offset: const Offset(0, 1)),
        ],
      ),
      child: ListTile(
        leading: Icon(Icons.settings_input_component, color: iconColor),
        title: Text(nome, style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 14)),
        subtitle: Text(local, style: const TextStyle(fontSize: 12)),
        trailing: Container(
          padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
          decoration: BoxDecoration(
            color: statusColor.withOpacity(0.1),
            borderRadius: BorderRadius.circular(12),
            border: Border.all(color: statusColor),
          ),
          child: Text(
            status,
            style: TextStyle(color: statusColor, fontSize: 10, fontWeight: FontWeight.bold),
          ),
        ),
      ),
    );
  }
}