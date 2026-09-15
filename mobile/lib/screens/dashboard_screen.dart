import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/crop.dart';
import '../models/farm.dart';
import '../models/sensor.dart';
import '../models/alert_model.dart';
import '../services/api_service.dart';
import 'home_screen.dart';

class DashboardScreen extends StatefulWidget {
  const DashboardScreen({super.key});

  @override
  State<DashboardScreen> createState() => _DashboardScreenState();
}

class _DashboardScreenState extends State<DashboardScreen> {
  List<Crop> _crops = [];
  List<AlertModel> _alerts = [];
  bool _isLoading = true;

  Map<String, dynamic> data = {
    'sensores_totais': '0',
    'fazendas': '0',
    'usuarios': '1',
  };

  final _statusLabels = {
    'planting': 'Plantio',
    'growing': 'Crescimento',
    'harvest': 'Colheita',
    'completed': 'Concluída'
  };

  static const Color verdeEscuro = Color(0xFF052501);
  static const Color corVermelho = Color(0xFFF44336);
  static const Color bgCinza = Colors.transparent;

  @override
  void initState() {
    super.initState();
    _carregarDadosDashboard();
  }

  Future<void> _carregarDadosDashboard() async {
  List<Crop> crops = [];
  List<Farm> farms = [];
  List<Sensor> sensors = [];
  List<AlertModel> alerts = [];

  // Busca cada requisição individualmente protegendo contra retornos nulos
  try {
    crops = await ApiService.getCrops();
  } catch (e) {
    print('Erro ao buscar culturas: $e');
  }

  try {
    farms = await ApiService.getFarms();
  } catch (e) {
    print('Erro ao buscar fazendas: $e');
  }

  try {
    sensors = await ApiService.getSensors();
  } catch (e) {
    print('Erro ao buscar sensores: $e');
  }

  try {
    alerts = await ApiService.getAlerts();
  } catch (e) {
    print('Erro ao buscar alertas: $e');
  }

  if (!mounted) return;

  setState(() {
    _crops = crops;
    _alerts = alerts;
    data = {
      'sensores_totais': sensors.length.toString(),
      'fazendas': farms.length.toString(),
      'usuarios': '1',
    };
    _isLoading = false;
  });
}

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
    final theme = Theme.of(context);
    final isHighContrast = theme.brightness == Brightness.dark;

    if (_isLoading) {
      return const Center(
        child: CircularProgressIndicator(color: Color(0xFF2E7D52)),
      );
    }

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
                        color: isHighContrast ? Colors.white : Colors.black,
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
                    backgroundColor: isHighContrast
                        ? Colors.white
                        : const Color(0xFF2E7D52),
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

            // STATS GRID (Valores dinâmicos da API)
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
                      isHighContrast
                          ? theme.colorScheme.primary
                          : const Color(0xFF2E7D52),
                      theme,
                    ),
                    _buildStatCard(
                      "Fazendas",
                      data['fazendas']?.toString() ?? '0',
                      Icons.pets,
                      isHighContrast
                          ? theme.colorScheme.primary
                          : const Color(0xFF2E7D52),
                      theme,
                    ),
                    _buildStatCard(
                      "Funcionários",
                      data['usuarios']?.toString() ?? '0',
                      Icons.people,
                      isHighContrast
                          ? theme.colorScheme.primary
                          : const Color(0xFF2E7D52),
                      theme,
                    ),
                  ],
                );
              },
            ),

            const SizedBox(height: 20),

            // CULTURAS ATIVAS (Lista dinâmica da API)
            _buildSectionCard(
              title: "Culturas Ativas (${_crops.length})",
              icon: Icons.eco_rounded,
              theme: theme,
              child: _crops.isEmpty
                  ? Text(
                      "Nenhuma cultura encontrada.",
                      style: TextStyle(color: theme.textTheme.bodyMedium?.color),
                    )
                  : Column(
                      children: List.generate(_crops.length, (index) {
                        final crop = _crops[index];

                        final String name = crop.name ?? 'Sem nome';
                        final String type = crop.type ?? 'Não informado';
                        final String statusKey = crop.status ?? 'planting';
                        final String areaText = crop.area != null
                            ? '${crop.area!.toStringAsFixed(0)} ha'
                            : '-- ha';

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
                              Divider(
                                height: 16,
                                thickness: 0.5,
                                color: theme.dividerColor,
                              ),
                          ],
                        );
                      }),
                    ),
            ),

            const SizedBox(height: 20),

            // ALERTAS ATIVOS (Dinâmicos da API)
            _buildSectionCard(
              title: "Alertas (${_alerts.length})",
              icon: Icons.notifications,
              theme: theme,
              child: Column(
                children: [
                  Container(
                    width: double.infinity,
                    padding: const EdgeInsets.all(15),
                    decoration: BoxDecoration(
                      color: isHighContrast ? theme.cardColor : Colors.white,
                      borderRadius: BorderRadius.circular(8),
                      border: Border.all(color: theme.dividerColor),
                    ),
                    child: _alerts.isEmpty
                        ? Text(
                            "Nenhum alerta ativo no momento.",
                            style: TextStyle(
                              color: theme.textTheme.bodyMedium?.color,
                            ),
                          )
                        : Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: _alerts.take(4).map((alerta) {
                              return Padding(
                                padding: const EdgeInsets.only(bottom: 8.0),
                                child: Text(
                                  "⚠️ ${alerta.cropName ?? 'Alerta'}: ${alerta.farmName ?? 'Atenção nas medições'}",
                                  style: TextStyle(
                                    color: isHighContrast
                                        ? Colors.white
                                        : corVermelho,
                                    fontWeight: FontWeight.w500,
                                  ),
                                ),
                              );
                            }).toList(),
                          ),
                  ),
                  const SizedBox(height: 12),
                  ElevatedButton(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: isHighContrast
                          ? theme.colorScheme.primary
                          : verdeEscuro,
                      foregroundColor: isHighContrast
                          ? theme.colorScheme.onPrimary
                          : Colors.white,
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

  Widget _buildStatCard(String title, String value, IconData icon,
      Color iconColor, ThemeData theme) {
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
                style: TextStyle(
                  fontSize: 14,
                  color: theme.textTheme.bodyMedium?.color?.withOpacity(0.6),
                  fontWeight: FontWeight.w500,
                ),
              ),
              const SizedBox(height: 4),
              Text(
                value,
                style: TextStyle(
                  fontSize: 22,
                  fontWeight: FontWeight.bold,
                  color: theme.textTheme.bodyLarge?.color,
                ),
              ),
            ],
          ),
          Icon(icon, color: iconColor, size: 32),
        ],
      ),
    );
  }

  Widget _buildSectionCard(
      {required String title,
      required IconData icon,
      required Widget child,
      required ThemeData theme}) {
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
              Icon(
                icon,
                color: theme.iconTheme.color ?? Colors.black,
                size: 20,
              ),
              const SizedBox(width: 8),
              Text(
                title,
                style: TextStyle(
                  fontSize: 16,
                  fontWeight: FontWeight.bold,
                  color: theme.textTheme.titleMedium?.color,
                ),
              ),
            ],
          ),
          const SizedBox(height: 16),
          child,
        ],
      ),
    );
  }

  Widget _buildStatusRow(IconData icon, String title, String status,
      Color statusColor, ThemeData theme,
      {required String subtitle}) {
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
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 14,
                  color: theme.textTheme.bodyLarge?.color,
                ),
                maxLines: 1,
                overflow: TextOverflow.ellipsis,
              ),
              Text(
                subtitle,
                style: TextStyle(
                  fontSize: 12,
                  color: theme.textTheme.bodyMedium?.color?.withOpacity(0.6),
                ),
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
            style: TextStyle(
              color: statusColor,
              fontWeight: FontWeight.bold,
              fontSize: 12,
            ),
          ),
        ),
      ],
    );
  }
}