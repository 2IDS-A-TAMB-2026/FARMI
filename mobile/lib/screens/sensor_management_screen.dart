import 'package:app_base44/main.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/sensor.dart';
import 'package:provider/provider.dart';
import 'theme_provider.dart';

class SensorManagementScreen extends StatefulWidget {
  const SensorManagementScreen({super.key});

  @override
  State<SensorManagementScreen> createState() =>
      _SensorManagementScreenState();
}

class _SensorManagementScreenState
    extends State<SensorManagementScreen> {
  final List<Sensor> _sensors = [
    Sensor(
      id: '1',
      name: 'Sensor Temp. Parcela Norte',
      type: 'temperature',
      status: 'active',
      currentValue: 28.5,
      unit: '°C',
      location: 'Parcela Norte',
    ),
    Sensor(
      id: '2',
      name: 'Sensor Umid. Solo A1',
      type: 'soil_humidity',
      status: 'active',
      currentValue: 62,
      unit: '%',
      location: 'Área A1',
    ),
    Sensor(
      id: '3',
      name: 'Sensor Umid. Ar Central',
      type: 'air_humidity',
      status: 'active',
      currentValue: 71,
      unit: '%',
      location: 'Centro',
    ),
    Sensor(
      id: '4',
      name: 'Sensor Luz Parcela Sul',
      type: 'light',
      status: 'active',
      currentValue: 450,
      unit: 'lux',
      location: 'Parcela Sul',
    ),
    Sensor(
      id: '5',
      name: 'Sensor Temp. Estufa',
      type: 'temperature',
      status: 'maintenance',
      currentValue: 34,
      unit: '°C',
      location: 'Estufa 1',
    ),
    Sensor(
      id: '6',
      name: 'Sensor Umid. Solo B2',
      type: 'soil_humidity',
      status: 'inactive',
      currentValue: 22,
      unit: '%',
      location: 'Área B2',
    ),
  ];

  IconData _typeIcon(String type) {
    switch (type) {
      case 'temperature':
        return Icons.thermostat_rounded;
      case 'soil_humidity':
        return Icons.water_drop_rounded;
      case 'air_humidity':
        return Icons.cloud_rounded;
      case 'light':
        return Icons.light_mode_rounded;
      default:
        return Icons.sensors_rounded;
    }
  }

  Color _typeColor(String type) {
    switch (type) {
      case 'temperature':
        return Colors.red;
      case 'soil_humidity':
        return Colors.brown;
      case 'air_humidity':
        return Colors.blue;
      case 'light':
        return Colors.amber;
      default:
        return Colors.grey;
    }
  }

  Color _statusColor(String s) {
    switch (s) {
      case 'active':
        return Colors.green;
      case 'maintenance':
        return Colors.amber;
      default:
        return Colors.red;
    }
  }

  String _statusLabel(String s) {
    switch (s) {
      case 'active':
        return 'Ativo';
      case 'maintenance':
        return 'Manutenção';
      default:
        return 'Inativo';
    }
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          mainAxisAlignment:
              MainAxisAlignment.spaceBetween,
          children: [
            Column(
              crossAxisAlignment:
                  CrossAxisAlignment.start,
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

            Row(
  children: [
    Padding(
      padding:
          const EdgeInsets.only(right: 8),
    ),
  ],
),
          ],
        ),

        const SizedBox(height: 16),

        Expanded(
          child: ListView.separated(
            itemCount: _sensors.length,
            separatorBuilder: (_, __) =>
                const SizedBox(height: 8),
            itemBuilder: (context, i) {
              final s = _sensors[i];

              return Card(
                child: Padding(
                  padding:
                      const EdgeInsets.all(14),
                  child: Row(
                    children: [
                      Container(
                        width: 42,
                        height: 42,
                        decoration: BoxDecoration(
                          color: _typeColor(s.type)
                              .withOpacity(0.1),
                          borderRadius:
                              BorderRadius.circular(
                                  10),
                        ),
                        child: Icon(
                          _typeIcon(s.type),
                          color:
                              _typeColor(s.type),
                          size: 20,
                        ),
                      ),

                      const SizedBox(width: 12),

                      Expanded(
                        child: Column(
                          crossAxisAlignment:
                              CrossAxisAlignment
                                  .start,
                          children: [
                            Text(
                              s.name,
                              style:
                                  GoogleFonts.inter(
                                fontWeight:
                                    FontWeight
                                        .w600,
                                fontSize: 13,
                              ),
                            ),

                            const SizedBox(
                                height: 3),

                            Text(
                              s.location ?? '',
                              style:
                                  GoogleFonts.inter(
                                fontSize: 11,
                                color: Colors
                                    .grey[600],
                              ),
                            ),
                          ],
                        ),
                      ),

                      Column(
                        crossAxisAlignment:
                            CrossAxisAlignment.end,
                        children: [
                          Text(
                            s.currentValue != null
                                ? '${s.currentValue} ${s.unit ?? ""}'
                                : '--',
                            style:
                                GoogleFonts.inter(
                              fontWeight:
                                  FontWeight.w700,
                              fontSize: 15,
                            ),
                          ),

                          const SizedBox(
                              height: 4),

                          Container(
                            padding:
                                const EdgeInsets
                                    .symmetric(
                              horizontal: 7,
                              vertical: 2,
                            ),
                            decoration:
                                BoxDecoration(
                              color: _statusColor(
                                      s.status)
                                  .withOpacity(
                                      0.1),
                              borderRadius:
                                  BorderRadius
                                      .circular(
                                          6),
                            ),
                            child: Text(
                              _statusLabel(
                                  s.status),
                              style:
                                  GoogleFonts.inter(
                                fontSize: 10,
                                color:
                                    _statusColor(
                                        s.status),
                                fontWeight:
                                    FontWeight
                                        .w600,
                              ),
                            ),
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

void _showAddSensorDialog(
    BuildContext context) {
  final nameController =
      TextEditingController();

  final locationController =
      TextEditingController();

  final valueController =
      TextEditingController();

  String selectedType = 'temperature';
  String selectedStatus = 'active';

  final Map<String, String> sensorTypes = {
    'temperature': 'Temperatura',
    'soil_humidity':
        'Umidade do Solo',
    'air_humidity':
        'Umidade do Ar',
    'light':
        'Luminosidade (Luz)',
  };

  final Map<String, String>
      sensorStatuses = {
    'active': 'Ativo',
    'maintenance': 'Manutenção',
    'inactive': 'Inativo',
  };

  showDialog(
    context: context,
    builder: (ctx) => StatefulBuilder(
      builder: (context, setDialogState) {
        return AlertDialog(
          shape: RoundedRectangleBorder(
            borderRadius:
                BorderRadius.circular(16),
          ),

          title: Row(
            children: [
              const Icon(
                Icons.sensors_rounded,
                color: Color(0xFF2E7D52),
              ),

              const SizedBox(width: 8),

              Text(
                'Novo Sensor IoT',
                style: GoogleFonts.inter(
                  fontWeight:
                      FontWeight.w700,
                  fontSize: 18,
                ),
              ),
            ],
          ),

          content: Container(
            width:
                MediaQuery.of(context)
                        .size
                        .width *
                    0.9,

            constraints: BoxConstraints(
              maxHeight:
                  MediaQuery.of(context)
                          .size
                          .height *
                      0.6,
            ),

            child: SingleChildScrollView(
              physics:
                  const BouncingScrollPhysics(),

              child: Column(
                mainAxisSize:
                    MainAxisSize.min,
                children: [
                  const SizedBox(height: 4),

                  TextField(
                    controller:
                        nameController,

                    style:
                        GoogleFonts.inter(
                            fontSize: 14),

                    decoration:
                        InputDecoration(
                      labelText:
                          'Nome do Sensor *',

                      prefixIcon:
                          const Icon(
                        Icons
                            .badge_rounded,
                        size: 18,
                      ),

                      border:
                          OutlineInputBorder(
                        borderRadius:
                            BorderRadius
                                .circular(
                                    10),
                      ),
                    ),
                  ),

                  const SizedBox(height: 12),

                  TextField(
                    controller:
                        locationController,

                    style:
                        GoogleFonts.inter(
                            fontSize: 14),

                    decoration:
                        InputDecoration(
                      labelText:
                          'Localização / Área *',

                      prefixIcon:
                          const Icon(
                        Icons.place_rounded,
                        size: 18,
                      ),

                      border:
                          OutlineInputBorder(
                        borderRadius:
                            BorderRadius
                                .circular(
                                    10),
                      ),
                    ),
                  ),

                  const SizedBox(height: 12),

                  DropdownButtonFormField<
                      String>(
                    value: selectedType,

                    style:
                        GoogleFonts.inter(
                      color: Colors.black,
                      fontSize: 14,
                    ),

                    decoration:
                        InputDecoration(
                      labelText:
                          'Tipo de Sensor *',

                      prefixIcon:
                          const Icon(
                        Icons
                            .category_rounded,
                        size: 18,
                      ),

                      border:
                          OutlineInputBorder(
                        borderRadius:
                            BorderRadius
                                .circular(
                                    10),
                      ),
                    ),

                    items: sensorTypes
                        .entries
                        .map((entry) {
                      return DropdownMenuItem(
                        value: entry.key,
                        child:
                            Text(entry.value),
                      );
                    }).toList(),

                    onChanged: (val) {
                      if (val != null) {
                        setDialogState(() =>
                            selectedType =
                                val);
                      }
                    },
                  ),

                  const SizedBox(height: 12),

                  DropdownButtonFormField<
                      String>(
                    value: selectedStatus,

                    style:
                        GoogleFonts.inter(
                      color: Colors.black,
                      fontSize: 14,
                    ),

                    decoration:
                        InputDecoration(
                      labelText:
                          'Status Inicial *',

                      prefixIcon:
                          const Icon(
                        Icons
                            .info_outline_rounded,
                        size: 18,
                      ),

                      border:
                          OutlineInputBorder(
                        borderRadius:
                            BorderRadius
                                .circular(
                                    10),
                      ),
                    ),

                    items: sensorStatuses
                        .entries
                        .map((entry) {
                      return DropdownMenuItem(
                        value: entry.key,
                        child:
                            Text(entry.value),
                      );
                    }).toList(),

                    onChanged: (val) {
                      if (val != null) {
                        setDialogState(() =>
                            selectedStatus =
                                val);
                      }
                    },
                  ),

                  const SizedBox(height: 12),

                  TextField(
                    controller:
                        valueController,

                    keyboardType:
                        const TextInputType
                            .numberWithOptions(
                      decimal: true,
                    ),

                    style:
                        GoogleFonts.inter(
                            fontSize: 14),

                    decoration:
                        InputDecoration(
                      labelText:
                          'Valor de Leitura Inicial (Opcional)',

                      prefixIcon:
                          const Icon(
                        Icons.speed_rounded,
                        size: 18,
                      ),

                      border:
                          OutlineInputBorder(
                        borderRadius:
                            BorderRadius
                                .circular(
                                    10),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),

          actions: [
            TextButton(
              onPressed: () =>
                  Navigator.pop(ctx),

              child: Text(
                'Cancelar',
                style: GoogleFonts.inter(
                  color:
                      Colors.grey[700],
                ),
              ),
            ),

            ElevatedButton(
              onPressed: () {
                Navigator.pop(ctx);
              },

              style:
                  ElevatedButton.styleFrom(
                backgroundColor:
                    const Color(0xFF2E7D52),

                foregroundColor:
                    Colors.white,

                shape:
                    RoundedRectangleBorder(
                  borderRadius:
                      BorderRadius.circular(
                          8),
                ),
              ),

              child: const Text(
                  'Cadastrar Sensor'),
            ),
          ],
        );
      },
    ),
  );
}