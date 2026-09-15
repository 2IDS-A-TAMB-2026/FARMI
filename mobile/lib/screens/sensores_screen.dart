import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/sensor.dart';
import '../services/api_service.dart';

class SensoresScreen extends StatefulWidget {
  const SensoresScreen({super.key});

  @override
  State<SensoresScreen> createState() => _SensoresScreenState();
}

class _SensoresScreenState extends State<SensoresScreen> {
  late Future<List<Sensor>> _sensorsFuture;

  @override
  void initState() {
    super.initState();
    _carregarSensores();
  }

  void _carregarSensores() {
    setState(() {
      _sensorsFuture = ApiService.getSensors();
    });
  }

  IconData _typeIcon(String type) {
    final t = type.toLowerCase();
    if (t.contains('temperatura') || t.contains('temperature')) {
      return Icons.thermostat_rounded;
    } else if (t.contains('solo') || t.contains('soil')) {
      return Icons.grass_rounded;
    } else if (t.contains('umidade') || t.contains('humidity')) {
      return Icons.water_drop_rounded;
    } else if (t.contains('luz') || t.contains('luminosidade') || t.contains('light')) {
      return Icons.wb_sunny_rounded;
    }
    return Icons.sensors_rounded;
  }

  Color _typeColor(String type) {
    final t = type.toLowerCase();
    if (t.contains('temperatura') || t.contains('temperature')) {
      return Colors.red;
    } else if (t.contains('solo') || t.contains('soil')) {
      return Colors.brown;
    } else if (t.contains('umidade') || t.contains('humidity')) {
      return Colors.blue;
    } else if (t.contains('luz') || t.contains('luminosidade') || t.contains('light')) {
      return Colors.amber.shade700;
    }
    return const Color(0xFF2E7D52);
  }

  Color _statusColor(String status) {
    final s = status.toLowerCase();
    if (s == 'ativo' || s == 'active') {
      return const Color(0xFF2E7D52);
    } else if (s == 'manutenção' || s == 'manutencao' || s == 'maintenance') {
      return Colors.amber.shade800;
    }
    return Colors.red;
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
                Text(
                  'Sensores',
                  style: GoogleFonts.inter(
                    fontSize: 22,
                    fontWeight: FontWeight.w800,
                  ),
                ),
                Text(
                  'Gerencie seus sensores IoT',
                  style: GoogleFonts.inter(
                    fontSize: 13,
                    color: Colors.grey[600],
                  ),
                ),
              ],
            ),
            IconButton(
              icon: const Icon(Icons.refresh),
              onPressed: _carregarSensores,
              tooltip: 'Recarregar',
            ),
          ],
        ),
        const SizedBox(height: 16),
        Expanded(
          child: FutureBuilder<List<Sensor>>(
            future: _sensorsFuture,
            builder: (context, snapshot) {
              if (snapshot.connectionState == ConnectionState.waiting) {
                return const Center(
                  child: CircularProgressIndicator(color: Color(0xFF2E7D52)),
                );
              }

              if (snapshot.hasError) {
                return Center(
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      const Icon(Icons.error_outline, size: 48, color: Colors.red),
                      const SizedBox(height: 12),
                      Text(
                        'Erro ao carregar sensores',
                        style: GoogleFonts.inter(color: Colors.grey[700]),
                      ),
                      const SizedBox(height: 12),
                      ElevatedButton(
                        onPressed: _carregarSensores,
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color(0xFF2E7D52),
                          foregroundColor: Colors.white,
                        ),
                        child: const Text('Tentar Novamente'),
                      )
                    ],
                  ),
                );
              }

              final sensors = snapshot.data ?? [];

              if (sensors.isEmpty) {
                return Center(
                  child: Text(
                    'Nenhum sensor cadastrado.',
                    style: GoogleFonts.inter(fontSize: 14, color: Colors.grey[600]),
                  ),
                );
              }

              return RefreshIndicator(
                onRefresh: () async => _carregarSensores(),
                child: ListView.separated(
                  itemCount: sensors.length,
                  separatorBuilder: (_, __) => const SizedBox(height: 10),
                  itemBuilder: (context, i) {
                    final s = sensors[i];
                    final color = _typeColor(s.type);

                    return Card(
                      elevation: 1,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Padding(
                        padding: const EdgeInsets.all(16),
                        child: Row(
                          children: [
                            // Ícone do Tipo
                            Container(
                              width: 44,
                              height: 44,
                              decoration: BoxDecoration(
                                color: color.withOpacity(0.1),
                                borderRadius: BorderRadius.circular(10),
                              ),
                              child: Icon(
                                _typeIcon(s.type),
                                color: color,
                                size: 22,
                              ),
                            ),
                            const SizedBox(width: 12),

                            // Nome e Detalhes
                            Expanded(
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Row(
                                    children: [
                                      Text(
                                        '#${s.id}  ',
                                        style: GoogleFonts.inter(
                                          fontWeight: FontWeight.w700,
                                          fontSize: 12,
                                          color: Colors.grey[500],
                                        ),
                                      ),
                                      Expanded(
                                        child: Text(
                                          s.name,
                                          style: GoogleFonts.inter(
                                            fontWeight: FontWeight.w600,
                                            fontSize: 14,
                                          ),
                                          overflow: TextOverflow.ellipsis,
                                        ),
                                      ),
                                    ],
                                  ),
                                  const SizedBox(height: 4),
                                  Text(
                                    'Tipo: ${s.type} ${s.unit.isNotEmpty ? "(${s.unit})" : ""}',
                                    style: GoogleFonts.inter(
                                      fontSize: 12,
                                      color: Colors.grey[700],
                                    ),
                                  ),
                                  const SizedBox(height: 4),
                                  Text(
                                    'Data: ${s.date.isNotEmpty ? s.date : "N/A"} • Cultura ID: ${s.cropId}',
                                    style: GoogleFonts.inter(
                                      fontSize: 11,
                                      color: Colors.grey[500],
                                    ),
                                  ),
                                ],
                              ),
                            ),

                            // Badge de Status
                            Container(
                              padding: const EdgeInsets.symmetric(
                                horizontal: 10,
                                vertical: 4,
                              ),
                              decoration: BoxDecoration(
                                color: _statusColor(s.status).withOpacity(0.1),
                                borderRadius: BorderRadius.circular(6),
                                border: Border.all(
                                  color: _statusColor(s.status).withOpacity(0.3),
                                ),
                              ),
                              child: Text(
                                s.status,
                                style: GoogleFonts.inter(
                                  fontSize: 11,
                                  color: _statusColor(s.status),
                                  fontWeight: FontWeight.w600,
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                    );
                  },
                ),
              );
            },
          ),
        ),
      ],
    );
  }
}