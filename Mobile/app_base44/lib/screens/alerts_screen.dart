import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/alert_model.dart';

class AlertsScreen extends StatefulWidget {
  const AlertsScreen({super.key});

  @override
  State<AlertsScreen> createState() => _AlertsScreenState();
}

class _AlertsScreenState extends State<AlertsScreen> {
  List<AlertModel> _alerts = [
    AlertModel(id: '1', title: 'Temperatura acima do limite', message: 'Sensor Temp. Estufa registrou 34°C', type: 'extreme_temperature', severity: 'high', sensorName: 'Sensor Temp. Estufa', isRead: false),
    AlertModel(id: '2', title: 'Umidade do solo muito baixa', message: 'Sensor Umid. Solo B2 registrou 22%', type: 'low_humidity', severity: 'critical', sensorName: 'Sensor Umid. Solo B2', isRead: false),
    AlertModel(id: '3', title: 'Sensor em manutenção', message: 'Sensor Temp. Estufa em modo de manutenção', type: 'sensor_failure', severity: 'medium', sensorName: 'Sensor Temp. Estufa', isRead: false),
    AlertModel(id: '4', title: 'Baixa luminosidade detectada', message: 'Luminosidade abaixo do esperado', type: 'low_light', severity: 'low', sensorName: 'Sensor Luz', isRead: true),
    AlertModel(id: '5', title: 'Sensor desativado', message: 'Sensor Umid. Solo B2 foi desativado', type: 'sensor_failure', severity: 'high', sensorName: 'Sensor Umid. Solo B2', isRead: true),
  ];

  IconData _typeIcon(String type) {
    switch (type) {
      case 'extreme_temperature': return Icons.thermostat_rounded;
      case 'low_humidity': case 'high_humidity': return Icons.water_drop_rounded;
      case 'sensor_failure': return Icons.sensors_off_rounded;
      case 'low_light': return Icons.wb_cloudy_rounded;
      default: return Icons.notifications_rounded;
    }
  }

  Color _severityColor(String s) {
    switch (s) {
      case 'low': return Colors.blue;
      case 'medium': return Colors.amber;
      case 'high': return Colors.orange;
      case 'critical': return Colors.red;
      default: return Colors.grey;
    }
  }

  String _severityLabel(String s) {
    switch (s) {
      case 'low': return 'Baixo';
      case 'medium': return 'Médio';
      case 'high': return 'Alto';
      case 'critical': return 'Crítico';
      default: return s;
    }
  }

  void _markAsRead(String id) {
    setState(() {
      _alerts = _alerts.map((a) => a.id == id
          ? AlertModel(id: a.id, title: a.title, message: a.message, type: a.type, severity: a.severity, sensorName: a.sensorName, isRead: true, createdDate: a.createdDate)
          : a).toList();
    });
  }

  void _delete(String id) {
    setState(() => _alerts.removeWhere((a) => a.id == id));
  }

  @override
  Widget build(BuildContext context) {
    final unread = _alerts.where((a) => !a.isRead).length;

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(children: [
                  Text('Alertas', style: GoogleFonts.inter(fontSize: 22, fontWeight: FontWeight.w800)),
                  if (unread > 0) ...[
                    const SizedBox(width: 8),
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 2),
                      decoration: BoxDecoration(color: Colors.red, borderRadius: BorderRadius.circular(10)),
                      child: Text('$unread novos', style: GoogleFonts.inter(color: Colors.white, fontSize: 11, fontWeight: FontWeight.w600)),
                    ),
                  ],
                ]),
                Text('Notificações do sistema', style: GoogleFonts.inter(fontSize: 13, color: Colors.grey[600])),
              ],
            ),
            if (unread > 0)
              TextButton.icon(
                onPressed: () => setState(() {
                  _alerts = _alerts.map((a) => AlertModel(id: a.id, title: a.title, message: a.message, type: a.type, severity: a.severity, sensorName: a.sensorName, isRead: true, createdDate: a.createdDate)).toList();
                }),
                icon: const Icon(Icons.done_all_rounded, size: 16),
                label: const Text('Todos lidos'),
                style: TextButton.styleFrom(foregroundColor: const Color(0xFF2E7D52)),
              ),
          ],
        ),
        const SizedBox(height: 16),
        Expanded(
          child: ListView.separated(
            itemCount: _alerts.length,
            separatorBuilder: (_, __) => const SizedBox(height: 8),
            itemBuilder: (context, i) {
              final a = _alerts[i];
              final severityColor = _severityColor(a.severity);
              return Card(
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(16),
                  side: a.isRead ? BorderSide.none : BorderSide(color: const Color(0xFF2E7D52).withOpacity(0.5), width: 1.5),
                ),
                child: Padding(
                  padding: const EdgeInsets.all(14),
                  child: Row(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Container(
                        width: 40,
                        height: 40,
                        decoration: BoxDecoration(
                          color: severityColor.withOpacity(0.1),
                          borderRadius: BorderRadius.circular(10),
                        ),
                        child: Icon(_typeIcon(a.type), color: severityColor, size: 20),
                      ),
                      const SizedBox(width: 12),
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
                              children: [
                                Expanded(
                                  child: Text(a.title,
                                      style: GoogleFonts.inter(fontWeight: FontWeight.w600, fontSize: 13)),
                                ),
                                Container(
                                  padding: const EdgeInsets.symmetric(horizontal: 7, vertical: 2),
                                  decoration: BoxDecoration(
                                    color: severityColor.withOpacity(0.1),
                                    borderRadius: BorderRadius.circular(6),
                                    border: Border.all(color: severityColor.withOpacity(0.3)),
                                  ),
                                  child: Text(_severityLabel(a.severity),
                                      style: GoogleFonts.inter(fontSize: 10, color: severityColor, fontWeight: FontWeight.w600)),
                                ),
                              ],
                            ),
                            if (a.message != null) ...[
                              const SizedBox(height: 4),
                              Text(a.message!, style: GoogleFonts.inter(fontSize: 12, color: Colors.grey[600])),
                            ],
                            if (a.sensorName != null) ...[
                              const SizedBox(height: 4),
                              Text('Sensor: ${a.sensorName}',
                                  style: GoogleFonts.inter(fontSize: 11, color: Colors.grey[500])),
                            ],
                            const SizedBox(height: 8),
                            Row(
                              children: [
                                if (!a.isRead)
                                  _actionButton(Icons.check_circle_outline_rounded, 'Lido', const Color(0xFF2E7D52), () => _markAsRead(a.id)),
                                _actionButton(Icons.delete_outline_rounded, 'Remover', Colors.red, () => _delete(a.id)),
                              ],
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
              );
            },
          ),
        ),
      ],
    );
  }

  Widget _actionButton(IconData icon, String label, Color color, VoidCallback onTap) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        margin: const EdgeInsets.only(right: 8),
        padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
        decoration: BoxDecoration(
          color: color.withOpacity(0.08),
          borderRadius: BorderRadius.circular(6),
        ),
        child: Row(children: [
          Icon(icon, size: 12, color: color),
          const SizedBox(width: 4),
          Text(label, style: GoogleFonts.inter(fontSize: 11, color: color, fontWeight: FontWeight.w500)),
        ]),
      ),
    );
  }
}