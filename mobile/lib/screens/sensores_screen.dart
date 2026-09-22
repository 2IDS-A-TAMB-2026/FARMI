import 'dart:async';
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
    } else if (t.contains('luz') ||
        t.contains('luminosidade') ||
        t.contains('light')) {
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
    } else if (t.contains('luz') ||
        t.contains('luminosidade') ||
        t.contains('light')) {
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

  void _mostrarHistorico(BuildContext context, Sensor sensor) {
    final color = _typeColor(sensor.type);
    final historyFuture = ApiService.getSensorHistory(sensor.id);

    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(top: Radius.circular(20)),
      ),
      builder: (context) {
        final screenHeight = MediaQuery.sizeOf(context).height;

        return Container(
          height: screenHeight * 0.65,
          padding: const EdgeInsets.all(20),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Indicador Superior de Arraste
              Center(
                child: Container(
                  width: 40,
                  height: 4,
                  margin: const EdgeInsets.only(bottom: 16),
                  decoration: BoxDecoration(
                    color: Colors.grey[300],
                    borderRadius: BorderRadius.circular(2),
                  ),
                ),
              ),

              // Cabeçalho do Sensor
              Row(
                children: [
                  Container(
                    width: 48,
                    height: 48,
                    decoration: BoxDecoration(
                      color: color.withOpacity(0.1),
                      borderRadius: BorderRadius.circular(12),
                    ),
                    child: Icon(
                      _typeIcon(sensor.type),
                      color: color,
                      size: 26,
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          '#${sensor.id} ${sensor.name}',
                          style: GoogleFonts.inter(
                            fontSize: 16,
                            fontWeight: FontWeight.bold,
                          ),
                          maxLines: 1,
                          overflow: TextOverflow.ellipsis,
                        ),
                        Text(
                          '${sensor.cropName.isNotEmpty ? sensor.cropName : "Sem Cultura"} • ${sensor.location ?? "Sem Fazenda"}',
                          style: GoogleFonts.inter(
                            fontSize: 12,
                            color: Colors.grey[600],
                          ),
                        ),
                      ],
                    ),
                  ),
                  IconButton(
                    icon: const Icon(Icons.close_rounded),
                    onPressed: () => Navigator.pop(context),
                  ),
                ],
              ),
              const SizedBox(height: 20),

              // Card da Última Leitura
              Container(
                width: double.infinity,
                padding: const EdgeInsets.all(16),
                decoration: BoxDecoration(
                  color: color.withOpacity(0.08),
                  borderRadius: BorderRadius.circular(12),
                  border: Border.all(color: color.withOpacity(0.3)),
                ),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          'Última Leitura Registrada',
                          style: GoogleFonts.inter(
                            fontSize: 12,
                            color: Colors.grey[700],
                          ),
                        ),
                        const SizedBox(height: 4),
                        Text(
                          sensor.displayReading,
                          style: GoogleFonts.inter(
                            fontSize: 22,
                            fontWeight: FontWeight.bold,
                            color: color,
                          ),
                        ),
                      ],
                    ),
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.end,
                      children: [
                        Text(
                          'Atualização',
                          style: GoogleFonts.inter(
                            fontSize: 11,
                            color: Colors.grey[600],
                          ),
                        ),
                        const SizedBox(height: 4),
                        Text(
                          sensor.updatedAt,
                          style: GoogleFonts.inter(
                            fontSize: 12,
                            fontWeight: FontWeight.w600,
                            color: Colors.grey[800],
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 20),

              Text(
                'Histórico de Leituras',
                style: GoogleFonts.inter(
                  fontSize: 15,
                  fontWeight: FontWeight.w700,
                ),
              ),
              const SizedBox(height: 10),

              // FutureBuilder que consome a API em tempo real
              Expanded(
                child: FutureBuilder<List<Map<String, dynamic>>>(
                  future: historyFuture,
                  builder: (context, snapshot) {
                    if (snapshot.connectionState == ConnectionState.waiting) {
                      return const Center(
                        child:
                            CircularProgressIndicator(color: Color(0xFF2E7D52)),
                      );
                    }

                    if (snapshot.hasError) {
                      return Center(
                        child: Text(
                          'Não foi possível carregar o histórico do banco.',
                          style: GoogleFonts.inter(
                              fontSize: 13, color: Colors.red[400]),
                        ),
                      );
                    }

                    final historico = snapshot.data ?? [];

                    if (historico.isEmpty) {
                      return Center(
                        child: Text(
                          'Nenhuma leitura anterior encontrada no banco.',
                          style: GoogleFonts.inter(
                              fontSize: 13, color: Colors.grey[600]),
                        ),
                      );
                    }

                    return ListView.separated(
                      itemCount: historico.length,
                      separatorBuilder: (_, __) => const Divider(height: 1),
                      itemBuilder: (context, index) {
                        final item = historico[index];

                        final valor = item['valor'] ??
                            item['reading'] ??
                            item['valor_leitura'] ??
                            sensor.displayReading;

                        final dataHora = item['created_at'] ??
                            item['data'] ??
                            item['data_leitura'] ??
                            sensor.updatedAt;

                        return ListTile(
                          contentPadding: EdgeInsets.zero,
                          leading: CircleAvatar(
                            radius: 16,
                            backgroundColor: color.withOpacity(0.1),
                            child: Icon(_typeIcon(sensor.type),
                                size: 16, color: color),
                          ),
                          title: Text(
                            '$valor',
                            style: GoogleFonts.inter(
                              fontWeight: FontWeight.bold,
                              fontSize: 15,
                              color: color,
                            ),
                          ),
                          subtitle: Text(
                            'Registro #${historico.length - index}',
                            style: GoogleFonts.inter(
                                fontSize: 11, color: Colors.grey[500]),
                          ),
                          trailing: Text(
                            '$dataHora',
                            style: GoogleFonts.inter(
                              fontSize: 12,
                              color: Colors.grey[700],
                              fontWeight: FontWeight.w500,
                            ),
                          ),
                        );
                      },
                    );
                  },
                ),
              ),
            ],
          ),
        );
      },
    );
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
                      const Icon(Icons.error_outline,
                          size: 48, color: Colors.red),
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
                    style: GoogleFonts.inter(
                        fontSize: 14, color: Colors.grey[600]),
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
                      child: InkWell(
                        borderRadius: BorderRadius.circular(12),
                        onTap: () => _mostrarHistorico(context, s),
                        child: Padding(
                          padding: const EdgeInsets.all(16),
                          child: Row(
                            children: [
                              // Ícone
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

                              // Informações Principais
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
                                      'Leitura: ${s.displayReading}',
                                      style: GoogleFonts.inter(
                                        fontSize: 13,
                                        fontWeight: FontWeight.bold,
                                        color: color,
                                      ),
                                    ),
                                    const SizedBox(height: 2),
                                    Text(
                                      '${s.cropName.isNotEmpty ? s.cropName : "Sem Cultura"} • ${s.location ?? "Sem Fazenda"}',
                                      style: GoogleFonts.inter(
                                        fontSize: 11,
                                        color: Colors.grey[700],
                                      ),
                                    ),
                                    const SizedBox(height: 2),
                                    Text(
                                      'Atualizado: ${s.updatedAt}',
                                      style: GoogleFonts.inter(
                                        fontSize: 10,
                                        color: Colors.grey[500],
                                      ),
                                    ),
                                  ],
                                ),
                              ),

                              // Tag Status
                              Container(
                                padding: const EdgeInsets.symmetric(
                                  horizontal: 10,
                                  vertical: 4,
                                ),
                                decoration: BoxDecoration(
                                  color:
                                      _statusColor(s.status).withOpacity(0.1),
                                  borderRadius: BorderRadius.circular(6),
                                  border: Border.all(
                                    color:
                                        _statusColor(s.status).withOpacity(0.3),
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
                              const SizedBox(width: 4),
                              Icon(
                                Icons.chevron_right_rounded,
                                color: Colors.grey[400],
                                size: 20,
                              ),
                            ],
                          ),
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
