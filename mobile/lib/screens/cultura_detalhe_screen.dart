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

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);

    final highContrastActive = _isHighContrast ?? (theme.brightness == Brightness.dark);

    final primaryColor = const Color(0xFF2E7D52);
    final iconGreenColor = highContrastActive ? const Color(0xFF4CAF50) : const Color(0xFF2E7D52);

    final backgroundColor = highContrastActive
        ? Colors.black
        : theme.scaffoldBackgroundColor;

    final cardColor = highContrastActive
        ? const Color(0xFF1E1E1E)
        : theme.cardColor;

    final textColor = highContrastActive
        ? Colors.white
        : theme.textTheme.bodyLarge?.color;

    final subtitleColor = highContrastActive
        ? Colors.white70
        : theme.textTheme.bodyMedium?.color?.withOpacity(0.7);

    return Scaffold(
      backgroundColor: backgroundColor,
      appBar: AppBar(
        title: Text(
          'Detalhes da Cultura',
          style: GoogleFonts.inter(
            fontWeight: FontWeight.w700,
          ),
        ),
        backgroundColor: highContrastActive ? cardColor : Colors.white,
        foregroundColor: highContrastActive ? Colors.white : Colors.black,
        elevation: 0,
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
        padding: const EdgeInsets.all(24),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Cabeçalho com fundo cinza e ícone verde
            Container(
              width: double.infinity,
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: cardColor,
                borderRadius: BorderRadius.circular(16),
                border: Border.all(
                  color: theme.dividerColor,
                ),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Icon(
                    Icons.eco_rounded,
                    color: iconGreenColor,
                    size: 42,
                  ),
                  const SizedBox(height: 12),
                  Text(
                    widget.crop.name,
                    style: GoogleFonts.inter(
                      color: textColor,
                      fontSize: 22,
                      fontWeight: FontWeight.w800,
                    ),
                  ),
                  const SizedBox(height: 6),
                  Text(
                    'ID da cultura: ${widget.crop.id} • Fazenda: ${widget.crop.farmName}',
                    style: GoogleFonts.inter(
                      color: subtitleColor,
                      fontSize: 13,
                    ),
                  ),
                ],
              ),
            ),

            const SizedBox(height: 24),

            Text(
              'Informações da cultura',
              style: GoogleFonts.inter(
                fontSize: 18,
                fontWeight: FontWeight.w800,
                color: textColor,
              ),
            ),

            const SizedBox(height: 12),

            _buildInfoCard(
              icon: Icons.category_outlined,
              title: 'Tipo de cultura',
              value: widget.crop.type,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.straighten,
              title: 'Área cultivada',
              value: '${widget.crop.area.toStringAsFixed(2)} ha',
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.info_outline,
              title: 'Status',
              value: widget.crop.status,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.calendar_today_outlined,
              title: 'Data de plantio',
              value: widget.crop.plantingDate,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.timer_outlined,
              title: 'Ciclo produtivo',
              value: '${widget.crop.productiveCycle} dias',
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.agriculture_outlined,
              title: 'Fazenda',
              value: widget.crop.farmName,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.grass_outlined,
              title: 'Safra',
              value: widget.crop.season,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            const SizedBox(height: 20),

            Text(
              'Sensores e Monitoramento',
              style: GoogleFonts.inter(
                fontSize: 18,
                fontWeight: FontWeight.w800,
                color: textColor,
              ),
            ),

            const SizedBox(height: 12),

            _buildInfoCard(
              icon: Icons.wb_sunny_outlined,
              title: 'Sensor de luminosidade',
              value: widget.crop.sensorLight,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.thermostat_outlined,
              title: 'Sensor de temperatura',
              value: widget.crop.sensorClimateTemperature,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.water_drop_outlined,
              title: 'Umidade do clima',
              value: widget.crop.sensorClimateHumidity,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.landscape_outlined,
              title: 'Sensor de solo',
              value: widget.crop.sensorSoil,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            const SizedBox(height: 24),

            // BOTÃO VOLTAR
            SizedBox(
              width: double.infinity,
              height: 48,
              child: ElevatedButton.icon(
                style: ElevatedButton.styleFrom(
                  backgroundColor: primaryColor,
                  foregroundColor: Colors.white,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(10),
                  ),
                ),
                onPressed: () => Navigator.pop(context),
                icon: const Icon(Icons.arrow_back),
                label: const Text(
                  'Voltar',
                  style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildInfoCard({
    required IconData icon,
    required String title,
    required String value,
    required Color cardColor,
    required Color? textColor,
    required Color? subtitleColor,
    required Color iconColor,
    required Color dividerColor,
  }) {
    return Container(
      width: double.infinity,
      margin: const EdgeInsets.only(bottom: 10),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: cardColor,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(
          color: dividerColor,
        ),
      ),
      child: Row(
        children: [
          Container(
            width: 42,
            height: 42,
            decoration: BoxDecoration(
              color: iconColor.withOpacity(0.2),
              borderRadius: BorderRadius.circular(10),
            ),
            child: Icon(
              icon,
              color: iconColor,
            ),
          ),
          const SizedBox(width: 14),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  title,
                  style: GoogleFonts.inter(
                    fontSize: 11,
                    color: subtitleColor,
                  ),
                ),
                const SizedBox(height: 3),
                Text(
                  value.isEmpty ? 'Não informado' : value,
                  style: GoogleFonts.inter(
                    fontSize: 14,
                    fontWeight: FontWeight.w600,
                    color: textColor,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}