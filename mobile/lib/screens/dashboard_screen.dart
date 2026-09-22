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

  Map<String, dynamic> _data = {
    'sensores_totais': '0',
    'fazendas': '0',
  };

  final Map<String, String> _statusLabels = {
    'planting': 'Plantio',
    'growing': 'Crescimento',
    'harvest': 'Colheita',
    'completed': 'Concluída',
    'ativa': 'Ativa',
    'inativa': 'Inativa',
  };

  static const Color corVerdePadrao = Color(0xFF2E7D52);

  @override
  void initState() {
    super.initState();
    _carregarDadosDashboard();
  }

  Future<void> _carregarDadosDashboard() async {
    setState(() => _isLoading = true);

    List<Crop> crops = [];
    List<Farm> farms = [];
    List<Sensor> sensors = [];
    List<AlertModel> alerts = [];

    try {
      crops = await ApiService.getCrops();
    } catch (e) {
      debugPrint('Erro ao buscar culturas: $e');
    }

    try {
      farms = await ApiService.getFarms();
    } catch (e) {
      debugPrint('Erro ao buscar fazendas: $e');
    }

    try {
      sensors = await ApiService.getSensors();
    } catch (e) {
      debugPrint('Erro ao buscar sensores: $e');
    }

    try {
      alerts = await ApiService.getAlerts();
    } catch (e) {
      debugPrint('Erro ao buscar alertas: $e');
    }

    if (!mounted) return;

    setState(() {
      _crops = crops;
      _alerts = alerts;
      _data = {
        'sensores_totais': sensors.length.toString(),
        'fazendas': farms.length.toString(),
      };
      _isLoading = false;
    });
  }

  Color _statusColor(String? s) {
    switch (s?.toLowerCase()) {
      case 'planting':
      case 'plantio':
      case 'ativa':
        return corVerdePadrao;
      case 'growing':
      case 'crescimento':
        return Colors.green;
      case 'harvest':
      case 'colheita':
        return Colors.amber;
      case 'completed':
      case 'concluída':
      case 'inativa':
        return Colors.grey;
      default:
        return corVerdePadrao;
    }
  }

  IconData _getCropIcon(String name, String type) {
    final text = '${name.toLowerCase()} ${type.toLowerCase()}';

    if (text.contains('milho')) {
      return Icons.grain_rounded;
    } else if (text.contains('soja')) {
      return Icons.spa_rounded;
    } else if (text.contains('feijão') || text.contains('feijao')) {
      return Icons.blur_on_rounded;
    } else if (text.contains('algodão') ||
        text.contains('algodao') ||
        text.contains('fibra')) {
      return Icons.filter_vintage_rounded;
    } else if (text.contains('melancia') ||
        text.contains('fruta') ||
        text.contains('maçã') ||
        text.contains('maca')) {
      return Icons.yard_rounded;
    } else if (text.contains('café') || text.contains('cafe')) {
      return Icons.coffee_rounded;
    } else if (text.contains('trigo') || text.contains('arroz')) {
      return Icons.grass_rounded;
    } else if (text.contains('cana') ||
        text.contains('açúcar') ||
        text.contains('acucar')) {
      return Icons.segment_rounded;
    }

    return Icons.eco_rounded;
  }

  IconData _getAlertIcon(AlertModel a) {
    final text = '${a.type} ${a.title} ${a.sensorName ?? ''}'.toLowerCase();
    if (text.contains('temperatura') || text.contains('superaquecimento')) {
      return Icons.thermostat_rounded;
    } else if (text.contains('umidade')) {
      return Icons.percent_rounded;
    } else if (text.contains('solo')) {
      return Icons.water_drop_rounded;
    } else if (text.contains('luz') || text.contains('luminosidade')) {
      return Icons.wb_sunny_outlined;
    }
    return Icons.notifications_rounded;
  }

  Color _getAlertColor(AlertModel a) {
    final severity = a.severity.toLowerCase();

    if (severity == 'low' || severity == 'baixo' || severity == 'baixa') {
      return Colors.blue;
    } else if (severity == 'medium' ||
        severity == 'médio' ||
        severity == 'média') {
      return Colors.amber[700]!;
    } else if (severity == 'high' || severity == 'alto' || severity == 'alta') {
      return Colors.orange[800]!;
    } else if (severity == 'critical' ||
        severity == 'crítico' ||
        severity == 'crítica') {
      return Colors.red;
    }

    final text = '${a.type} ${a.title} ${a.sensorName ?? ''}'.toLowerCase();

    if (text.contains('temperatura') || text.contains('superaquecimento')) {
      return Colors.orange[800]!;
    } else if (text.contains('umidade') ||
        text.contains('solo') ||
        text.contains('água')) {
      return Colors.blue[600]!;
    } else if (text.contains('luz') || text.contains('luminosidade')) {
      return Colors.amber[700]!;
    }

    return corVerdePadrao;
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);

    if (_isLoading) {
      return const Center(
        child: CircularProgressIndicator(color: corVerdePadrao),
      );
    }

    return Scaffold(
      backgroundColor: theme.scaffoldBackgroundColor,
      body: RefreshIndicator(
        onRefresh: _carregarDadosDashboard,
        color: corVerdePadrao,
        child: SingleChildScrollView(
          physics: const AlwaysScrollableScrollPhysics(),
          padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // CABEÇALHO
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Dashboard',
                        style: GoogleFonts.inter(
                          fontSize: 22,
                          fontWeight: FontWeight.w800,
                        ),
                      ),
                      Text(
                        'Visão geral do sistema',
                        style: GoogleFonts.inter(
                          fontSize: 13,
                          color: Colors.grey[600],
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
                            Icon(Icons.logout, size: 20),
                            SizedBox(width: 8),
                            Text('Sair'),
                          ],
                        ),
                      ),
                    ],
                    child: Container(
                      width: 40,
                      height: 40,
                      decoration: BoxDecoration(
                        color: corVerdePadrao.withOpacity(0.1),
                        shape: BoxShape.circle,
                      ),
                      child: const Icon(
                        Icons.person_outline_rounded,
                        color: corVerdePadrao,
                        size: 22,
                      ),
                    ),
                  )
                ],
              ),

              const SizedBox(height: 20),

              // GRID DE ESTATÍSTICAS (APENAS SENSORES E FAZENDAS)
              LayoutBuilder(
                builder: (context, constraints) {
                  final isWide = constraints.maxWidth > 600;
                  return GridView.count(
                    shrinkWrap: true,
                    physics: const NeverScrollableScrollPhysics(),
                    crossAxisCount: isWide ? 2 : 1,
                    crossAxisSpacing: 10,
                    mainAxisSpacing: 10,
                    childAspectRatio: isWide ? 3.0 : 3.2,
                    children: [
                      _buildStatCard(
                        title: "Sensores Totais",
                        value: _data['sensores_totais'] ?? '0',
                        icon: Icons.sensors_rounded,
                        color: corVerdePadrao,
                        theme: theme,
                      ),
                      _buildStatCard(
                        title: "Fazendas",
                        value: _data['fazendas'] ?? '0',
                        icon: Icons.agriculture_rounded,
                        color: corVerdePadrao,
                        theme: theme,
                      ),
                    ],
                  );
                },
              ),

              const SizedBox(height: 20),

              // CULTURAS ATIVAS
              _buildSectionCard(
                title: "Culturas Ativas (${_crops.length})",
                icon: Icons.eco_rounded,
                theme: theme,
                child: _crops.isEmpty
                    ? Padding(
                        padding: const EdgeInsets.symmetric(vertical: 12),
                        child: Text(
                          "Nenhuma cultura cadastrada.",
                          style: GoogleFonts.inter(
                            color: Colors.grey[600],
                            fontSize: 13,
                          ),
                        ),
                      )
                    : Column(
                        children: List.generate(_crops.length, (index) {
                          final crop = _crops[index];
                          final String name = crop.name;
                          final String type = crop.type;
                          final String statusKey = crop.status;
                          final String areaText =
                              '${crop.area.toStringAsFixed(1)} ha';

                          return Column(
                            children: [
                              Padding(
                                padding:
                                    const EdgeInsets.symmetric(vertical: 4),
                                child: Row(
                                  children: [
                                    Container(
                                      width: 40,
                                      height: 40,
                                      decoration: BoxDecoration(
                                        color: corVerdePadrao.withOpacity(0.1),
                                        borderRadius: BorderRadius.circular(10),
                                      ),
                                      child: Icon(
                                        _getCropIcon(name, type),
                                        color: corVerdePadrao,
                                        size: 22,
                                      ),
                                    ),
                                    const SizedBox(width: 12),
                                    Expanded(
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          Text(
                                            name,
                                            style: GoogleFonts.inter(
                                              fontWeight: FontWeight.w600,
                                              fontSize: 14,
                                            ),
                                          ),
                                          const SizedBox(height: 2),
                                          Text(
                                            '$type • $areaText',
                                            style: GoogleFonts.inter(
                                              fontSize: 12,
                                              color: Colors.grey[600],
                                            ),
                                          ),
                                        ],
                                      ),
                                    ),
                                    Container(
                                      padding: const EdgeInsets.symmetric(
                                        horizontal: 8,
                                        vertical: 3,
                                      ),
                                      decoration: BoxDecoration(
                                        color: _statusColor(statusKey)
                                            .withOpacity(0.1),
                                        borderRadius: BorderRadius.circular(6),
                                        border: Border.all(
                                          color: _statusColor(statusKey)
                                              .withOpacity(0.3),
                                        ),
                                      ),
                                      child: Text(
                                        _statusLabels[statusKey] ?? statusKey,
                                        style: GoogleFonts.inter(
                                          color: _statusColor(statusKey),
                                          fontWeight: FontWeight.w600,
                                          fontSize: 11,
                                        ),
                                      ),
                                    ),
                                  ],
                                ),
                              ),
                              if (index < _crops.length - 1)
                                const Divider(height: 12, thickness: 0.5),
                            ],
                          );
                        }),
                      ),
              ),

              const SizedBox(height: 20),

              // ALERTAS RECENTES
              _buildSectionCard(
                title: "Alertas (${_alerts.length})",
                icon: Icons.notifications_rounded,
                theme: theme,
                child: Column(
                  children: [
                    if (_alerts.isEmpty)
                      Padding(
                        padding: const EdgeInsets.symmetric(vertical: 12),
                        child: Text(
                          "Nenhum alerta ativo no momento.",
                          style: GoogleFonts.inter(
                            color: Colors.grey[600],
                            fontSize: 13,
                          ),
                        ),
                      )
                    else
                      Column(
                        children: _alerts.take(3).map((alerta) {
                          final color = _getAlertColor(alerta);
                          return Container(
                            margin: const EdgeInsets.only(bottom: 8),
                            padding: const EdgeInsets.all(12),
                            decoration: BoxDecoration(
                              color: theme.cardColor,
                              borderRadius: BorderRadius.circular(12),
                              border: Border.all(
                                color: color.withOpacity(0.25),
                              ),
                            ),
                            child: Row(
                              children: [
                                Container(
                                  width: 40,
                                  height: 40,
                                  decoration: BoxDecoration(
                                    color: color.withOpacity(0.12),
                                    borderRadius: BorderRadius.circular(10),
                                  ),
                                  child: Icon(
                                    _getAlertIcon(alerta),
                                    color: color,
                                    size: 22,
                                  ),
                                ),
                                const SizedBox(width: 12),
                                Expanded(
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      Text(
                                        alerta.title,
                                        style: GoogleFonts.inter(
                                          fontWeight: FontWeight.w600,
                                          fontSize: 13,
                                        ),
                                      ),
                                      if (alerta.cropName != null ||
                                          alerta.farmName != null) ...[
                                        const SizedBox(height: 2),
                                        Text(
                                          '${alerta.cropName ?? ''}${alerta.cropName != null && alerta.farmName != null ? ' • ' : ''}${alerta.farmName ?? ''}',
                                          style: GoogleFonts.inter(
                                            fontSize: 11,
                                            color: Colors.grey[600],
                                          ),
                                        ),
                                      ],
                                    ],
                                  ),
                                ),
                              ],
                            ),
                          );
                        }).toList(),
                      ),
                    const SizedBox(height: 8),
                    SizedBox(
                      width: double.infinity,
                      child: ElevatedButton(
                        style: ElevatedButton.styleFrom(
                          backgroundColor: corVerdePadrao,
                          foregroundColor: Colors.white,
                          padding: const EdgeInsets.symmetric(vertical: 12),
                          elevation: 0,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(10),
                          ),
                        ),
                        onPressed: () =>
                            Navigator.pushNamed(context, '/alerts'),
                        child: Text(
                          "Ver Todos os Alertas",
                          style: GoogleFonts.inter(
                            fontWeight: FontWeight.bold,
                            fontSize: 13,
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 16),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildStatCard({
    required String title,
    required String value,
    required IconData icon,
    required Color color,
    required ThemeData theme,
  }) {
    return Container(
      padding: const EdgeInsets.all(14),
      decoration: BoxDecoration(
        color: theme.cardColor,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(
          color: theme.dividerColor.withOpacity(0.1),
          width: 1,
        ),
      ),
      child: Row(
        children: [
          Container(
            width: 44,
            height: 44,
            decoration: BoxDecoration(
              color: color.withOpacity(0.1),
              borderRadius: BorderRadius.circular(10),
            ),
            child: Icon(icon, color: color, size: 22),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Text(
                  value,
                  style: GoogleFonts.inter(
                    fontSize: 20,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                Text(
                  title,
                  style: GoogleFonts.inter(
                    fontSize: 12,
                    color: Colors.grey[600],
                    fontWeight: FontWeight.w500,
                  ),
                  overflow: TextOverflow.ellipsis,
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildSectionCard({
    required String title,
    required IconData icon,
    required Widget child,
    required ThemeData theme,
  }) {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: theme.cardColor,
        borderRadius: BorderRadius.circular(16),
        border: Border.all(
          color: theme.dividerColor.withOpacity(0.1),
          width: 1,
        ),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Icon(icon, color: corVerdePadrao, size: 20),
              const SizedBox(width: 8),
              Text(
                title,
                style: GoogleFonts.inter(
                  fontSize: 15,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ],
          ),
          const SizedBox(height: 12),
          child,
        ],
      ),
    );
  }
}
