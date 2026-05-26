import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/sensor.dart';

class SensorManagementScreen extends StatefulWidget {
  const SensorManagementScreen({super.key});

  @override
  State<SensorManagementScreen> createState() => _SensorManagementScreenState();
}

class _SensorManagementScreenState extends State<SensorManagementScreen> {
  final List<Sensor> _sensors = [
    Sensor(id: '1', name: 'Sensor Temp. Parcela Norte', type: 'temperature', status: 'active', currentValue: 28.5, unit: '°C', location: 'Parcela Norte'),
    Sensor(id: '2', name: 'Sensor Umid. Solo A1', type: 'soil_humidity', status: 'active', currentValue: 62, unit: '%', location: 'Área A1'),
    Sensor(id: '3', name: 'Sensor Umid. Ar Central', type: 'air_humidity', status: 'active', currentValue: 71, unit: '%', location: 'Centro'),
    Sensor(id: '4', name: 'Sensor Luz Parcela Sul', type: 'light', status: 'active', currentValue: 450, unit: 'lux', location: 'Parcela Sul'),
    Sensor(id: '5', name: 'Sensor Temp. Estufa', type: 'temperature', status: 'maintenance', currentValue: 34, unit: '°C', location: 'Estufa 1'),
    Sensor(id: '6', name: 'Sensor Umid. Solo B2', type: 'soil_humidity', status: 'inactive', currentValue: 22, unit: '%', location: 'Área B2'),
  ];

  IconData _typeIcon(String type) {
    switch (type) {
      case 'temperature': return Icons.thermostat_rounded;
      case 'soil_humidity': return Icons.water_drop_rounded;
      case 'air_humidity': return Icons.cloud_rounded;
      case 'light': return Icons.light_mode_rounded;
      default: return Icons.sensors_rounded;
    }
  }

  Color _typeColor(String type) {
    switch (type) {
      case 'temperature': return Colors.red;
      case 'soil_humidity': return Colors.brown;
      case 'air_humidity': return Colors.blue;
      case 'light': return Colors.amber;
      default: return Colors.grey;
    }
  }

  Color _statusColor(String s) {
    switch (s) {
      case 'active': return Colors.green;
      case 'maintenance': return Colors.amber;
      default: return Colors.red;
    }
  }

  String _statusLabel(String s) {
    switch (s) {
      case 'active': return 'Ativo';
      case 'maintenance': return 'Manutenção';
      default: return 'Inativo';
    }
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text('Sensores', style: GoogleFonts.inter(fontSize: 22, fontWeight: FontWeight.w800)),
                Text('Gerencie seus sensores IoT', style: GoogleFonts.inter(fontSize: 13, color: Colors.grey[600])),
              ],
            ),
            ElevatedButton.icon(
              onPressed: () {},
              icon: const Icon(Icons.add_rounded, size: 16),
              label: const Text('Novo Sensor'),
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFF2E7D52),
                foregroundColor: Colors.white,
                shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 10),
                textStyle: GoogleFonts.inter(fontWeight: FontWeight.w600, fontSize: 13),
              ),
            ),
          ],
        ),
        const SizedBox(height: 16),
        Expanded(
          child: ListView.separated(
            itemCount: _sensors.length,
            separatorBuilder: (_, __) => const SizedBox(height: 8),
            itemBuilder: (context, i) {
              final s = _sensors[i];
              return Card(
                child: Padding(
                  padding: const EdgeInsets.all(14),
                  child: Row(
                    children: [
                      Container(
                        width: 42,
                        height: 42,
                        decoration: BoxDecoration(
                          color: _typeColor(s.type).withOpacity(0.1),
                          borderRadius: BorderRadius.circular(10),
                        ),
                        child: Icon(_typeIcon(s.type), color: _typeColor(s.type), size: 20),
                      ),
                      const SizedBox(width: 12),
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(s.name, style: GoogleFonts.inter(fontWeight: FontWeight.w600, fontSize: 13)),
                            const SizedBox(height: 3),
                            Text(s.location ?? '', style: GoogleFonts.inter(fontSize: 11, color: Colors.grey[600])),
                          ],
                        ),
                      ),
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.end,
                        children: [
                          Text(s.currentValue != null ? '${s.currentValue} ${s.unit ?? ""}' : '--',
                              style: GoogleFonts.inter(fontWeight: FontWeight.w700, fontSize: 15)),
                          const SizedBox(height: 4),
                          Container(
                            padding: const EdgeInsets.symmetric(horizontal: 7, vertical: 2),
                            decoration: BoxDecoration(
                              color: _statusColor(s.status).withOpacity(0.1),
                              borderRadius: BorderRadius.circular(6),
                            ),
                            child: Text(_statusLabel(s.status),
                                style: GoogleFonts.inter(
                                    fontSize: 10,
                                    color: _statusColor(s.status),
                                    fontWeight: FontWeight.w600)),
                          ),
                        ],
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
}