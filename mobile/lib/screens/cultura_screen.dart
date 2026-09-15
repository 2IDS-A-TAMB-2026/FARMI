import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/crop.dart';
import '../services/api_service.dart';
import 'cultura_detalhe_screen.dart';
import 'alerts_screen.dart';

class CulturaScreen extends StatefulWidget {
  const CulturaScreen({super.key});

  @override
  State<CulturaScreen> createState() => _CulturaScreenState();
}

class _CulturaScreenState extends State<CulturaScreen> {
  List<Crop> _crops = [];
  bool _isLoadingCrops = true;

  Future<void> _fetchCrops() => _carregarCulturas();

  get _errorMessage => null;

  @override
  void initState() {
    super.initState();
    _carregarCulturas();
  }

  Future<void> _carregarCulturas() async {
    try {
      final cropsData = await ApiService.getCrops();
      if (!mounted) return;

      setState(() {
        _crops = cropsData;
        _isLoadingCrops = false;
      });
    } catch (e) {
      print('Erro ao carregar culturas: $e');

      setState(() {
        _isLoadingCrops = false;
      });
    }
  }

  Color _healthColor(String h) {
    switch (h) {
      case 'excellent':
        return Colors.green;
      case 'good':
        return const Color(0xFF2E7D52);
      case 'regular':
        return Colors.amber;
      case 'poor':
        return Colors.orange;
      case 'critical':
        return Colors.red;
      default:
        return Colors.grey;
    }
  }

  Color _statusColor(String status) {
    switch (status.toLowerCase()) {
      case 'ativa':
        return const Color(0xFF2E7D52);

      case 'inativa':
        return Colors.grey;

      case 'plantio':
        return Colors.blue;

      case 'colheita':
        return Colors.amber;

      case 'concluída':
      case 'concluida':
        return Colors.grey;

      default:
        return Colors.grey;
    }
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
                  'Culturas',
                  style: GoogleFonts.inter(
                    fontSize: 22,
                    fontWeight: FontWeight.w800,
                  ),
                ),
                Text(
                  'Gerencie suas culturas',
                  style: GoogleFonts.inter(
                    fontSize: 13,
                    color: Colors.grey[600],
                  ),
                ),
              ],
            ),
            IconButton(
              icon: const Icon(Icons.refresh),
              onPressed: () => _fetchCrops(),
              tooltip: 'Recarregar',
            ),
          ],
        ),
        const SizedBox(height: 16),
        Expanded(
          child: _buildBody(),
        ),
      ],
    );
  }

  Widget _buildBody() {
    if (_isLoadingCrops) {
      return const Center(
        child: CircularProgressIndicator(color: Color(0xFF2E7D52)),
      );
    }

    if (_errorMessage != null) {
      return Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const Icon(Icons.error_outline, size: 48, color: Colors.red),
            const SizedBox(height: 12),
            Text(_errorMessage!,
                style: GoogleFonts.inter(color: Colors.grey[700])),
            const SizedBox(height: 16),
            ElevatedButton(
              onPressed: () => _fetchCrops(),
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFF2E7D52),
              ),
              child: const Text('Tentar Novamente',
                  style: TextStyle(color: Colors.white)),
            ),
          ],
        ),
      );
    }

    if (_crops.isEmpty) {
      return Center(
        child: Text(
          'Nenhuma cultura cadastrada no banco.',
          style: GoogleFonts.inter(fontSize: 14, color: Colors.grey[600]),
        ),
      );
    }

    return RefreshIndicator(
      onRefresh: _fetchCrops,
      child: ListView.separated(
        itemCount: _crops.length,
        separatorBuilder: (_, __) => const SizedBox(height: 10),
        itemBuilder: (context, i) {
          final crop = _crops[i];

          return Card(
  elevation: 1,
  shape: RoundedRectangleBorder(
    borderRadius: BorderRadius.circular(12),
  ),
  child: InkWell(
    borderRadius: BorderRadius.circular(12),
    onTap: () {
      Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => DetalhesCulturaScreen(crop: crop),
        ),
      );
    },
    child: Padding(
      padding: const EdgeInsets.all(16),
      child: Row(
                  children: [
                    // ... (Restante do seu código original do Row, Container, Icon, etc. continua igual)
                    Container(
                      width: 44,
                      height: 44,
                      decoration: BoxDecoration(
                        color: const Color(0xFF2E7D52).withOpacity(0.1),
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: const Icon(
                        Icons.eco_rounded,
                        color: Color(0xFF2E7D52),
                        size: 22,
                      ),
                    ),

                    const SizedBox(width: 12),

                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          // Nome da cultura
                          Text(
                            crop.name,
                            style: GoogleFonts.inter(
                              fontWeight: FontWeight.w600,
                              fontSize: 14,
                            ),
                          ),

                          const SizedBox(height: 4),

                          // Tipo + Área
                          Text(
                            '${crop.type} • '
                            '${crop.area.toStringAsFixed(2)} ha',
                            style: GoogleFonts.inter(
                              fontSize: 11,
                              color: Colors.grey[600],
                            ),
                          ),

                          const SizedBox(height: 4),

                          // Fazenda
                          Text(
                            'Fazenda: ${crop.farmName}',
                            style: GoogleFonts.inter(
                              fontSize: 11,
                              color: Colors.grey[600],
                            ),
                          ),

                          const SizedBox(height: 8),

                          Row(
                            children: [
                              _buildChip(
                                crop.status,
                                _statusColor(crop.status),
                              ),
                              const SizedBox(width: 6),
                              _buildChip(
                                '${crop.productiveCycle} dias',
                                Colors.blue,
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
            ),
          );
        },
      ),
    );
  }

  Widget _buildChip(String label, Color color) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 3),
      decoration: BoxDecoration(
        color: color.withOpacity(0.1),
        borderRadius: BorderRadius.circular(6),
        border: Border.all(color: color.withOpacity(0.3)),
      ),
      child: Text(
        label,
        style: GoogleFonts.inter(
          fontSize: 10,
          color: color,
          fontWeight: FontWeight.w600,
        ),
      ),
    );
  }
}
