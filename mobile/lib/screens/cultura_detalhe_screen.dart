import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/crop.dart';

class DetalhesCulturaScreen extends StatefulWidget {
  final Crop crop;

  const DetalhesCulturaScreen({
    super.key,
    required this.crop,
  });

  @override
  State<DetalhesCulturaScreen> createState() => _DetalhesCulturaScreenState();
}

class _DetalhesCulturaScreenState extends State<DetalhesCulturaScreen> {
  bool? _isHighContrast;

  static const Color primaryGreen = Color(0xFF2E7D52);

  IconData _getCropIcon(String name, String type) {
    final text = '${name.toLowerCase()} ${type.toLowerCase()}';
    if (text.contains('milho')) return Icons.grain_rounded;
    if (text.contains('soja')) return Icons.spa_rounded;
    if (text.contains('feijão') || text.contains('feijao')) return Icons.blur_on_rounded;
    if (text.contains('algodão') || text.contains('algodao')) return Icons.filter_vintage_rounded;
    if (text.contains('melancia') || text.contains('fruta')) return Icons.yard_rounded;
    if (text.contains('café') || text.contains('cafe')) return Icons.coffee_rounded;
    if (text.contains('trigo') || text.contains('arroz')) return Icons.grass_rounded;
    return Icons.eco_rounded;
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final highContrastActive = _isHighContrast ?? (theme.brightness == Brightness.dark);

    final iconGreenColor = highContrastActive ? const Color(0xFF4CAF50) : primaryGreen;
    final backgroundColor = highContrastActive ? Colors.black : theme.scaffoldBackgroundColor;
    final cardColor = highContrastActive ? const Color(0xFF1E1E1E) : theme.cardColor;
    final textColor = highContrastActive ? Colors.white : theme.textTheme.bodyLarge?.color;
    final subtitleColor = highContrastActive ? Colors.white70 : Colors.grey[600];

    return Scaffold(
      backgroundColor: backgroundColor,
      appBar: AppBar(
        title: Text(
          'Detalhes da Cultura',
          style: GoogleFonts.inter(fontWeight: FontWeight.w700, fontSize: 18),
        ),
        backgroundColor: highContrastActive ? cardColor : Colors.white,
        foregroundColor: highContrastActive ? Colors.white : Colors.black,
        elevation: 0.5,
        actions: [
          IconButton(
            icon: const Icon(Icons.contrast),
            tooltip: 'Alternar Alto Contraste',
            onPressed: () {
              setState(() {
                _isHighContrast = !highContrastActive;
              });
            },
          ),
        ],
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // CABEÇALHO PRINCIPAL
            Container(
              width: double.infinity,
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: cardColor,
                borderRadius: BorderRadius.circular(16),
                border: Border.all(color: theme.dividerColor.withOpacity(0.1)),
              ),
              child: Row(
                children: [
                  Container(
                    width: 56,
                    height: 56,
                    decoration: BoxDecoration(
                      color: iconGreenColor.withOpacity(0.12),
                      borderRadius: BorderRadius.circular(14),
                    ),
                    child: Icon(
                      _getCropIcon(widget.crop.name, widget.crop.type),
                      color: iconGreenColor,
                      size: 30,
                    ),
                  ),
                  const SizedBox(width: 16),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Text(
                              widget.crop.name,
                              style: GoogleFonts.inter(
                                color: textColor,
                                fontSize: 20,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                            Container(
                              padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                              decoration: BoxDecoration(
                                color: iconGreenColor.withOpacity(0.1),
                                borderRadius: BorderRadius.circular(20),
                                border: Border.all(color: iconGreenColor.withOpacity(0.3)),
                              ),
                              child: Text(
                                widget.crop.status,
                                style: GoogleFonts.inter(
                                  color: iconGreenColor,
                                  fontSize: 11,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                            ),
                          ],
                        ),
                        const SizedBox(height: 4),
                        Text(
                          'Fazenda: ${widget.crop.farmName}',
                          style: GoogleFonts.inter(color: subtitleColor, fontSize: 13),
                        ),
                        Text(
                          'ID: #${widget.crop.id}',
                          style: GoogleFonts.inter(color: subtitleColor?.withOpacity(0.7), fontSize: 11),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),

            const SizedBox(height: 20),

            // INFORMAÇÕES GERAIS (GRID)
            Text(
              'Informações Gerais',
              style: GoogleFonts.inter(fontSize: 16, fontWeight: FontWeight.bold, color: textColor),
            ),
            const SizedBox(height: 12),

            GridView.count(
              crossAxisCount: 2,
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(),
              crossAxisSpacing: 10,
              mainAxisSpacing: 10,
              childAspectRatio: 2.2,
              children: [
                _buildCompactCard(
                  icon: Icons.category_outlined,
                  title: 'Tipo',
                  value: widget.crop.type,
                  cardColor: cardColor,
                  textColor: textColor,
                  subtitleColor: subtitleColor,
                  iconColor: iconGreenColor,
                  theme: theme,
                ),
                _buildCompactCard(
                  icon: Icons.straighten_rounded,
                  title: 'Área Cultivada',
                  value: '${widget.crop.area.toStringAsFixed(1)} ha',
                  cardColor: cardColor,
                  textColor: textColor,
                  subtitleColor: subtitleColor,
                  iconColor: iconGreenColor,
                  theme: theme,
                ),
                _buildCompactCard(
                  icon: Icons.calendar_today_rounded,
                  title: 'Data de Plantio',
                  value: widget.crop.plantingDate,
                  cardColor: cardColor,
                  textColor: textColor,
                  subtitleColor: subtitleColor,
                  iconColor: iconGreenColor,
                  theme: theme,
                ),
                _buildCompactCard(
                  icon: Icons.timer_outlined,
                  title: 'Ciclo Produtivo',
                  value: '${widget.crop.productiveCycle} dias',
                  cardColor: cardColor,
                  textColor: textColor,
                  subtitleColor: subtitleColor,
                  iconColor: iconGreenColor,
                  theme: theme,
                ),
              ],
            ),

            const SizedBox(height: 24),

            // SENSORES E MONITORAMENTO
            Text(
              'Sensores e Monitoramento',
              style: GoogleFonts.inter(fontSize: 16, fontWeight: FontWeight.bold, color: textColor),
            ),
            const SizedBox(height: 12),

            GridView.count(
              crossAxisCount: 2,
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(),
              crossAxisSpacing: 10,
              mainAxisSpacing: 10,
              childAspectRatio: 1.8,
              children: [
                _buildSensorTile(
                  icon: Icons.thermostat_rounded,
                  title: 'Temperatura',
                  value: widget.crop.sensorClimateTemperature.isNotEmpty
                      ? '${widget.crop.sensorClimateTemperature}°C'
                      : 'N/A',
                  color: Colors.orange[800]!,
                  cardColor: cardColor,
                  textColor: textColor,
                  theme: theme,
                ),
                _buildSensorTile(
                  icon: Icons.water_drop_rounded,
                  title: 'Umid. do Clima',
                  value: widget.crop.sensorClimateHumidity.isNotEmpty
                      ? '${widget.crop.sensorClimateHumidity}%'
                      : 'N/A',
                  color: Colors.blue[600]!,
                  cardColor: cardColor,
                  textColor: textColor,
                  theme: theme,
                ),
                _buildSensorTile(
                  icon: Icons.landscape_rounded,
                  title: 'Umid. do Solo',
                  value: widget.crop.sensorSoil.isNotEmpty
                      ? '${widget.crop.sensorSoil}%'
                      : 'N/A',
                  color: Colors.teal,
                  cardColor: cardColor,
                  textColor: textColor,
                  theme: theme,
                ),
                _buildSensorTile(
                  icon: Icons.wb_sunny_rounded,
                  title: 'Luminosidade',
                  value: widget.crop.sensorLight.isNotEmpty
                      ? '${widget.crop.sensorLight} lux'
                      : 'N/A',
                  color: Colors.amber[800]!,
                  cardColor: cardColor,
                  textColor: textColor,
                  theme: theme,
                ),
              ],
            ),

            const SizedBox(height: 28),

            // BOTÃO VOLTAR
            SizedBox(
              width: double.infinity,
              height: 48,
              child: ElevatedButton.icon(
                style: ElevatedButton.styleFrom(
                  backgroundColor: primaryGreen,
                  foregroundColor: Colors.white,
                  elevation: 0,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                ),
                onPressed: () => Navigator.pop(context),
                icon: const Icon(Icons.arrow_back_rounded, size: 20),
                label: Text(
                  'Voltar ao Painel',
                  style: GoogleFonts.inter(fontSize: 14, fontWeight: FontWeight.bold),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildCompactCard({
    required IconData icon,
    required String title,
    required String value,
    required Color cardColor,
    required Color? textColor,
    required Color? subtitleColor,
    required Color iconColor,
    required ThemeData theme,
  }) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 10),
      decoration: BoxDecoration(
        color: cardColor,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: theme.dividerColor.withOpacity(0.1)),
      ),
      child: Row(
        children: [
          Icon(icon, color: iconColor, size: 20),
          const SizedBox(width: 10),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Text(
                  title,
                  style: GoogleFonts.inter(fontSize: 11, color: subtitleColor),
                  maxLines: 1,
                  overflow: TextOverflow.ellipsis,
                ),
                const SizedBox(height: 2),
                Text(
                  value.isEmpty ? 'Não informado' : value,
                  style: GoogleFonts.inter(fontSize: 13, fontWeight: FontWeight.w600, color: textColor),
                  maxLines: 1,
                  overflow: TextOverflow.ellipsis,
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildSensorTile({
    required IconData icon,
    required String title,
    required String value,
    required Color color,
    required Color cardColor,
    required Color? textColor,
    required ThemeData theme,
  }) {
    return Container(
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: cardColor,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: color.withOpacity(0.2)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Row(
            children: [
              Container(
                padding: const EdgeInsets.all(6),
                decoration: BoxDecoration(
                  color: color.withOpacity(0.1),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: Icon(icon, color: color, size: 18),
              ),
              const SizedBox(width: 8),
              Expanded(
                child: Text(
                  title,
                  style: GoogleFonts.inter(fontSize: 11, color: Colors.grey[600]),
                  maxLines: 1,
                  overflow: TextOverflow.ellipsis,
                ),
              ),
            ],
          ),
          const SizedBox(height: 8),
          Text(
            value,
            style: GoogleFonts.inter(
              fontSize: 16,
              fontWeight: FontWeight.bold,
              color: textColor,
            ),
          ),
        ],
      ),
    );
  }
}