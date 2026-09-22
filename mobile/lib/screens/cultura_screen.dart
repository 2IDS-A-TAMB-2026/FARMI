import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/crop.dart';
import '../services/api_service.dart';
import 'cultura_detalhe_screen.dart';

class CulturaScreen extends StatefulWidget {
  const CulturaScreen({super.key});

  @override
  State<CulturaScreen> createState() => _CulturaScreenState();
}

class _CulturaScreenState extends State<CulturaScreen> {
  List<Crop> _crops = [];
  bool _isLoadingCrops = true;
  String? _errorMessage;

  static const Color primaryGreen = Color(0xFF2E7D52);

  @override
  void initState() {
    super.initState();
    _carregarCulturas();
  }

  Future<void> _carregarCulturas() async {
    setState(() {
      _isLoadingCrops = true;
      _errorMessage = null;
    });

    try {
      final cropsData = await ApiService.getCrops();
      if (!mounted) return;

      setState(() {
        _crops = cropsData;
        _isLoadingCrops = false;
      });
    } catch (e) {
      debugPrint('Erro ao carregar culturas: $e');

      if (!mounted) return;
      setState(() {
        _isLoadingCrops = false;
        _errorMessage = 'Não foi possível carregar as culturas.';
      });
    }
  }

  /// Retorna um ícone específico conforme o nome ou tipo da cultura
  IconData _getCropIcon(String name, String type) {
    final text = '${name.toLowerCase()} ${type.toLowerCase()}';

    if (text.contains('milho')) return Icons.grain_rounded;
    if (text.contains('soja')) return Icons.spa_rounded;
    if (text.contains('feijão') || text.contains('feijao')) return Icons.blur_on_rounded;
    if (text.contains('algodão') || text.contains('algodao') || text.contains('fibra')) {
      return Icons.filter_vintage_rounded;
    }
    if (text.contains('melancia') || text.contains('fruta') || text.contains('maçã') || text.contains('maca')) {
      return Icons.yard_rounded;
    }
    if (text.contains('café') || text.contains('cafe')) return Icons.coffee_rounded;
    if (text.contains('trigo') || text.contains('arroz')) return Icons.grass_rounded;

    return Icons.eco_rounded;
  }

  Color _statusColor(String status) {
    switch (status.toLowerCase()) {
      case 'ativa':
      case 'planting':
      case 'plantio':
        return primaryGreen;
      case 'inativa':
      case 'concluída':
      case 'concluida':
        return Colors.grey;
      case 'crescimento':
      case 'growing':
        return Colors.green;
      case 'colheita':
      case 'harvest':
        return Colors.amber[800]!;
      default:
        return primaryGreen;
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
              icon: const Icon(Icons.refresh_rounded),
              onPressed: _carregarCulturas,
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
        child: CircularProgressIndicator(color: primaryGreen),
      );
    }

    if (_errorMessage != null) {
      return Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const Icon(Icons.error_outline_rounded, size: 48, color: Colors.red),
            const SizedBox(height: 12),
            Text(
              _errorMessage!,
              style: GoogleFonts.inter(color: Colors.grey[700]),
            ),
            const SizedBox(height: 16),
            ElevatedButton(
              onPressed: _carregarCulturas,
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryGreen,
                foregroundColor: Colors.white,
                elevation: 0,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10),
                ),
              ),
              child: const Text('Tentar Novamente'),
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
      color: primaryGreen,
      onRefresh: _carregarCulturas,
      child: ListView.separated(
        itemCount: _crops.length,
        separatorBuilder: (_, __) => const SizedBox(height: 10),
        itemBuilder: (context, i) {
          final crop = _crops[i];

          return Card(
            elevation: 0,
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(12),
              side: BorderSide(
                color: Theme.of(context).dividerColor.withOpacity(0.1),
              ),
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
                    // ÍCONE DINÂMICO
                    Container(
                      width: 46,
                      height: 46,
                      decoration: BoxDecoration(
                        color: primaryGreen.withOpacity(0.1),
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Icon(
                        _getCropIcon(crop.name, crop.type),
                        color: primaryGreen,
                        size: 24,
                      ),
                    ),

                    const SizedBox(width: 14),

                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          // Nome da cultura
                          Text(
                            crop.name,
                            style: GoogleFonts.inter(
                              fontWeight: FontWeight.bold,
                              fontSize: 15,
                            ),
                          ),

                          const SizedBox(height: 3),

                          // Tipo + Área
                          Text(
                            '${crop.type} • ${crop.area.toStringAsFixed(1)} ha',
                            style: GoogleFonts.inter(
                              fontSize: 12,
                              color: Colors.grey[600],
                            ),
                          ),

                          const SizedBox(height: 2),

                          // Fazenda
                          Text(
                            'Fazenda: ${crop.farmName}',
                            style: GoogleFonts.inter(
                              fontSize: 12,
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
                                Colors.blue[700]!,
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                    const SizedBox(width: 8),
                    Icon(
                      Icons.chevron_right_rounded,
                      color: Colors.grey[400],
                      size: 24,
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
          fontSize: 11,
          color: color,
          fontWeight: FontWeight.w600,
        ),
      ),
    );
  }
}