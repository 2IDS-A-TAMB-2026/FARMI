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
          'Detalhes da Fazenda',
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
                    Icons.agriculture_rounded,
                    color: iconGreenColor,
                    size: 42,
                  ),
                  const SizedBox(height: 12),
                  Text(
                    widget.farm.name,
                    style: GoogleFonts.inter(
                      color: textColor,
                      fontSize: 22,
                      fontWeight: FontWeight.w800,
                    ),
                  ),
                  const SizedBox(height: 6),
                  Text(
                    'ID da fazenda: ${widget.farm.id}',
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
              'Informações da propriedade',
              style: GoogleFonts.inter(
                fontSize: 18,
                fontWeight: FontWeight.w800,
                color: textColor,
              ),
            ),

            const SizedBox(height: 12),

            _buildInfoCard(
              icon: Icons.straighten,
              title: 'Área total',
              value: '${widget.farm.area.toStringAsFixed(2)} ha',
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.location_on_outlined,
              title: 'Logradouro',
              value: widget.farm.logradouro,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.tag,
              title: 'Número',
              value: widget.farm.numero,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.markunread_mailbox_outlined,
              title: 'CEP',
              value: widget.farm.cep,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.map_outlined,
              title: 'Latitude',
              value: widget.farm.latitude,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.map_outlined,
              title: 'Longitude',
              value: widget.farm.longitude,
              cardColor: cardColor,
              textColor: textColor,
              subtitleColor: subtitleColor,
              iconColor: iconGreenColor,
              dividerColor: theme.dividerColor,
            ),

            _buildInfoCard(
              icon: Icons.pin_drop_outlined,
              title: 'Localização',
              value: widget.farm.location,
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