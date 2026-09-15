import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/alert_model.dart';
import '../services/api_service.dart';

class AlertsScreen extends StatefulWidget {
  const AlertsScreen({super.key});

  @override
  State<AlertsScreen> createState() => _AlertsScreenState();
}

class _AlertsScreenState extends State<AlertsScreen> {
  List<AlertModel> _alerts = [];
  bool _isLoading = true;
  String? _errorMessage;

  @override
  void initState() {
    super.initState();
    _loadAlerts();
  }

  // Carrega os alertas da API
  Future<void> _loadAlerts() async {
    setState(() {
      _isLoading = true;
      _errorMessage = null;
    });

    try {
      final alerts = await ApiService.getAlerts();
      if (!mounted) return;

      setState(() {
        _alerts = alerts;
        _isLoading = false;
      });
    } catch (e) {
      if (!mounted) return;

      setState(() {
        _errorMessage = 'Não foi possível carregar os alertas.';
        _isLoading = false;
      });
    }
  }

  // Marca um alerta específico como lido no banco e localmente
  Future<void> _markAsRead(String id) async {
    try {
      await ApiService.markAlertAsRead(id);
      if (!mounted) return;

      setState(() {
        _alerts = _alerts.map((a) {
          if (a.id == id) {
            return AlertModel(
              id: a.id,
              title: a.title,
              message: a.message,
              type: a.type,
              severity: a.severity,
              sensorName: a.sensorName,
              isRead: true,
              createdDate: a.createdDate,
            );
          }
          return a;
        }).toList();
      });
    } catch (e) {
      if (!mounted) return;
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Erro ao marcar alerta como lido.')),
      );
    }
  }

  // Marca todos os alertas como lidos na API e localmente
  Future<void> _markAllAsRead() async {
    try {
      await ApiService.markAllAlertsAsRead();
      if (!mounted) return;

      setState(() {
        _alerts = _alerts.map((a) {
          return AlertModel(
            id: a.id,
            title: a.title,
            message: a.message,
            type: a.type,
            severity: a.severity,
            sensorName: a.sensorName,
            isRead: true,
            createdDate: a.createdDate,
          );
        }).toList();
      });
    } catch (e) {
      if (!mounted) return;
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Erro ao marcar todos como lidos.')),
      );
    }
  }

  void _delete(String id) {
    setState(() => _alerts.removeWhere((a) => a.id == id));
  }

  IconData _typeIcon(String type) {
    switch (type) {
      case 'extreme_temperature':
        return Icons.thermostat_rounded;
      case 'low_humidity':
      case 'high_humidity':
        return Icons.water_drop_rounded;
      case 'sensor_failure':
        return Icons.sensors_off_rounded;
      case 'low_light':
        return Icons.wb_cloudy_rounded;
      default:
        return Icons.notifications_rounded;
    }
  }

  Color _severityColor(String s) {
    switch (s) {
      case 'low':
        return Colors.blue;
      case 'medium':
        return Colors.amber;
      case 'high':
        return Colors.orange;
      case 'critical':
        return Colors.red;
      default:
        return Colors.grey;
    }
  }

  String _severityLabel(String s) {
    switch (s) {
      case 'low':
        return 'Baixo';
      case 'medium':
        return 'Médio';
      case 'high':
        return 'Alto';
      case 'critical':
        return 'Crítico';
      default:
        return s;
    }
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
                Row(
                  children: [
                    Text(
                      'Alertas',
                      style: GoogleFonts.inter(
                        fontSize: 22,
                        fontWeight: FontWeight.w800,
                      ),
                    ),
                    if (unread > 0) ...[
                      const SizedBox(width: 8),
                      Container(
                        padding: const EdgeInsets.symmetric(
                          horizontal: 8,
                          vertical: 2,
                        ),
                        decoration: BoxDecoration(
                          color: Colors.red,
                          borderRadius: BorderRadius.circular(10),
                        ),
                        child: Text(
                          '$unread novos',
                          style: GoogleFonts.inter(
                            color: Colors.white,
                            fontSize: 11,
                            fontWeight: FontWeight.w600,
                          ),
                        ),
                      ),
                    ],
                  ],
                ),
                Text(
                  'Notificações do sistema',
                  style: GoogleFonts.inter(
                    fontSize: 13,
                    color: Colors.grey[600],
                  ),
                ),
              ],
            ),
          ],
        ),

        if (unread > 0)
          TextButton.icon(
            onPressed: _markAllAsRead,
            icon: const Icon(Icons.done_all_rounded, size: 16),
            label: const Text('Todos lidos'),
            style: TextButton.styleFrom(
              foregroundColor: const Color(0xFF2E7D52),
            ),
          ),

        const SizedBox(height: 16),

        Expanded(
          child: _buildBody(),
        ),
      ],
    );
  }

  Widget _buildBody() {
    if (_isLoading) {
      return const Center(
        child: CircularProgressIndicator(color: Color(0xFF2E7D52)),
      );
    }

    if (_errorMessage != null) {
      return Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(
              _errorMessage!,
              style: GoogleFonts.inter(color: Colors.grey[700]),
            ),
            const SizedBox(height: 8),
            ElevatedButton(
              onPressed: _loadAlerts,
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFF2E7D52),
              ),
              child: const Text('Tentar novamente', style: TextStyle(color: Colors.white)),
            ),
          ],
        ),
      );
    }

    if (_alerts.isEmpty) {
      return Center(
        child: Text(
          'Nenhum alerta cadastrado.',
          style: GoogleFonts.inter(color: Colors.grey[600]),
        ),
      );
    }

    return RefreshIndicator(
      onRefresh: _loadAlerts,
      color: const Color(0xFF2E7D52),
      child: ListView.separated(
        itemCount: _alerts.length,
        separatorBuilder: (_, __) => const SizedBox(height: 8),
        itemBuilder: (context, i) {
          final a = _alerts[i];
          final severityColor = _severityColor(a.severity);
          final isResolvido = a.status.toLowerCase() == 'resolvido';

          return Card(
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(16),
              side: a.isRead
                  ? BorderSide.none
                  : BorderSide(
                      color: const Color(0xFF2E7D52).withOpacity(0.5),
                      width: 1.5,
                    ),
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
                    child: Icon(
                      _typeIcon(a.type),
                      color: severityColor,
                      size: 20,
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        // Fazenda e Status igual a Web
                        if (a.farmName != null && a.farmName!.isNotEmpty)
                          Text(
                            a.farmName!,
                            style: GoogleFonts.inter(
                              fontWeight: FontWeight.bold,
                              fontSize: 14,
                            ),
                          ),

                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Expanded(
                              child: Text(
                                a.cropName != null && a.cropName!.isNotEmpty
                                    ? '${a.title} - Cultura ${a.cropName}'
                                    : a.title,
                                style: GoogleFonts.inter(
                                  fontWeight: FontWeight.w600,
                                  fontSize: 13,
                                  color: Colors.grey[800],
                                ),
                              ),
                            ),
                            Container(
                              padding: const EdgeInsets.symmetric(
                                horizontal: 7,
                                vertical: 2,
                              ),
                              decoration: BoxDecoration(
                                color: severityColor.withOpacity(0.1),
                                borderRadius: BorderRadius.circular(6),
                                border: Border.all(
                                  color: severityColor.withOpacity(0.3),
                                ),
                              ),
                              child: Text(
                                _severityLabel(a.severity),
                                style: GoogleFonts.inter(
                                  fontSize: 10,
                                  color: severityColor,
                                  fontWeight: FontWeight.w600,
                                ),
                              ),
                            ),
                          ],
                        ),

                        if (a.message != null && a.message!.isNotEmpty) ...[
                          const SizedBox(height: 4),
                          Text(
                            a.message!,
                            style: GoogleFonts.inter(
                              fontSize: 12,
                              color: Colors.grey[600],
                            ),
                          ),
                        ],

                        const SizedBox(height: 6),

                        // Exibição de Data e Tag Status (Ativo/Resolvido)
                        Row(
                          children: [
                            if (a.createdDate != null)
                              Text(
                                '${a.createdDate!.year}-${a.createdDate!.month.toString().padLeft(2, '0')}-${a.createdDate!.day.toString().padLeft(2, '0')} ${a.createdDate!.hour.toString().padLeft(2, '0')}:${a.createdDate!.minute.toString().padLeft(2, '0')}',
                                style: GoogleFonts.inter(
                                  fontSize: 11,
                                  color: Colors.grey[500],
                                ),
                              ),
                            const SizedBox(width: 8),
                            Container(
                              padding: const EdgeInsets.symmetric(
                                horizontal: 6,
                                vertical: 1,
                              ),
                              decoration: BoxDecoration(
                                color: isResolvido
                                    ? Colors.red.withOpacity(0.1)
                                    : Colors.green.withOpacity(0.1),
                                borderRadius: BorderRadius.circular(4),
                              ),
                              child: Text(
                                isResolvido ? 'Resolvido' : 'Ativo',
                                style: TextStyle(
                                  fontSize: 10,
                                  fontWeight: FontWeight.bold,
                                  color: isResolvido ? Colors.red : Colors.green,
                                ),
                              ),
                            ),
                          ],
                        ),

                        const SizedBox(height: 8),

                        Row(
                          children: [
                            if (!a.isRead)
                              _actionButton(
                                Icons.check_circle_outline_rounded,
                                'Lido',
                                const Color(0xFF2E7D52),
                                () => _markAsRead(a.id),
                              ),
                            _actionButton(
                              Icons.delete_outline_rounded,
                              'Remover',
                              Colors.red,
                              () => _delete(a.id),
                            ),
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
    );
  }

  Widget _actionButton(
    IconData icon,
    String label,
    Color color,
    VoidCallback onTap,
  ) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        margin: const EdgeInsets.only(right: 8),
        padding: const EdgeInsets.symmetric(
          horizontal: 10,
          vertical: 4,
        ),
        decoration: BoxDecoration(
          color: color.withOpacity(0.08),
          borderRadius: BorderRadius.circular(6),
        ),
        child: Row(
          children: [
            Icon(icon, size: 12, color: color),
            const SizedBox(width: 4),
            Text(
              label,
              style: GoogleFonts.inter(
                fontSize: 11,
                color: color,
                fontWeight: FontWeight.w500,
              ),
            ),
          ],
        ),
      ),
    );
  }
}