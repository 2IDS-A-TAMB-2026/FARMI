import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/farm.dart';

class DetalhesFazendaScreen extends StatefulWidget {
  final Farm farm;

  const DetalhesFazendaScreen({
    super.key,
    required this.farm,
  });

  @override
  State<DetalhesFazendaScreen> createState() => _DetalhesFazendaScreenState();
}

class _DetalhesFazendaScreenState extends State<DetalhesFazendaScreen> {
  bool? _isHighContrast;

  static const Color primaryGreen = Color(0xFF2E7D52);

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
          'Detalhes da Fazenda',
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
            // CABEÇALHO DA FAZENDA
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
                      Icons.agriculture_rounded,
                      color: iconGreenColor,
                      size: 32,
                    ),
                  ),
                  const SizedBox(width: 16),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          widget.farm.name,
                          style: GoogleFonts.inter(
                            color: textColor,
                            fontSize: 20,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        const SizedBox(height: 4),
                        Text(
                          'ID: #${widget.farm.id}',
                          style: GoogleFonts.inter(color: subtitleColor, fontSize: 12),
                        ),
                      ],
                    ),
                  ),
                  Container(
                    padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 6),
                    decoration: BoxDecoration(
                      color: iconGreenColor.withOpacity(0.1),
                      borderRadius: BorderRadius.circular(10),
                    ),
                    child: Column(
                      children: [
                        Text(
                          '${widget.farm.area.toStringAsFixed(1)}',
                          style: GoogleFonts.inter(
                            color: iconGreenColor,
                            fontWeight: FontWeight.bold,
                            fontSize: 16,
                          ),
                        ),
                        Text(
                          'hectares',
                          style: GoogleFonts.inter(
                            color: iconGreenColor,
                            fontSize: 10,
                          ),
                        ),
                      ],
                    ),
                  )
                ],
              ),
            ),

            const SizedBox(height: 20),

            // SEÇÃO: ENDEREÇO E LOCALIZAÇÃO
            Text(
              'Endereço & Localização',
              style: GoogleFonts.inter(fontSize: 16, fontWeight: FontWeight.bold, color: textColor),
            ),
            const SizedBox(height: 12),

            Container(
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: cardColor,
                borderRadius: BorderRadius.circular(16),
                border: Border.all(color: theme.dividerColor.withOpacity(0.1)),
              ),
              child: Column(
                children: [
                  _buildDetailRow(
                    icon: Icons.location_on_outlined,
                    title: 'Logradouro',
                    value: '${widget.farm.logradouro}${widget.farm.numero.isNotEmpty ? ', Nº ${widget.farm.numero}' : ''}',
                    textColor: textColor,
                    subtitleColor: subtitleColor,
                    iconColor: iconGreenColor,
                  ),
                  const Divider(height: 20, thickness: 0.5),
                  _buildDetailRow(
                    icon: Icons.markunread_mailbox_outlined,
                    title: 'CEP',
                    value: widget.farm.cep,
                    textColor: textColor,
                    subtitleColor: subtitleColor,
                    iconColor: iconGreenColor,
                  ),
                  const Divider(height: 20, thickness: 0.5),
                  _buildDetailRow(
                    icon: Icons.pin_drop_outlined,
                    title: 'Cidade / Região',
                    value: widget.farm.location,
                    textColor: textColor,
                    subtitleColor: subtitleColor,
                    iconColor: iconGreenColor,
                  ),
                ],
              ),
            ),

            const SizedBox(height: 20),

            // SEÇÃO: COORDENADAS GEOGRÁFICAS
            Text(
              'Coordenadas Geográficas',
              style: GoogleFonts.inter(fontSize: 16, fontWeight: FontWeight.bold, color: textColor),
            ),
            const SizedBox(height: 12),

            Row(
              children: [
                Expanded(
                  child: _buildCoordinateCard(
                    title: 'Latitude',
                    value: widget.farm.latitude,
                    cardColor: cardColor,
                    textColor: textColor,
                    subtitleColor: subtitleColor,
                    theme: theme,
                  ),
                ),
                const SizedBox(width: 10),
                Expanded(
                  child: _buildCoordinateCard(
                    title: 'Longitude',
                    value: widget.farm.longitude,
                    cardColor: cardColor,
                    textColor: textColor,
                    subtitleColor: subtitleColor,
                    theme: theme,
                  ),
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

  Widget _buildDetailRow({
    required IconData icon,
    required String title,
    required String value,
    required Color? textColor,
    required Color? subtitleColor,
    required Color iconColor,
  }) {
    return Row(
      children: [
        Icon(icon, color: iconColor, size: 22),
        const SizedBox(width: 12),
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                title,
                style: GoogleFonts.inter(fontSize: 11, color: subtitleColor),
              ),
              const SizedBox(height: 2),
              Text(
                value.trim().isEmpty ? 'Não informado' : value,
                style: GoogleFonts.inter(fontSize: 14, fontWeight: FontWeight.w600, color: textColor),
              ),
            ],
          ),
        ),
      ],
    );
  }

  Widget _buildCoordinateCard({
    required String title,
    required String value,
    required Color cardColor,
    required Color? textColor,
    required Color? subtitleColor,
    required ThemeData theme,
  }) {
    return Container(
      padding: const EdgeInsets.all(14),
      decoration: BoxDecoration(
        color: cardColor,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: theme.dividerColor.withOpacity(0.1)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Icon(Icons.map_outlined, color: Colors.blue[600], size: 18),
              const SizedBox(width: 6),
              Text(
                title,
                style: GoogleFonts.inter(fontSize: 11, color: subtitleColor),
              ),
            ],
          ),
          const SizedBox(height: 6),
          Text(
            value.isEmpty ? 'N/A' : value,
            style: GoogleFonts.inter(fontSize: 14, fontWeight: FontWeight.bold, color: textColor),
          ),
        ],
      ),
    );
  }
}