import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/crop.dart';

class CropManagementScreen extends StatefulWidget {
  const CropManagementScreen({super.key});

  @override
  State<CropManagementScreen> createState() => _CropManagementScreenState();
}

class _CropManagementScreenState extends State<CropManagementScreen> {
  final List<Crop> _crops = [
    Crop(id: '1', name: 'Soja Parcela Norte', type: 'Soja', status: 'growing', health: 'excellent', area: 120, season: '2025/2026'),
    Crop(id: '2', name: 'Milho Área A1', type: 'Milho', status: 'harvest', health: 'good', area: 85, season: '2025/2026'),
    Crop(id: '3', name: 'Café Parcela Sul', type: 'Café', status: 'growing', health: 'regular', area: 45, season: '2024/2025'),
    Crop(id: '4', name: 'Feijão Área B2', type: 'Feijão', status: 'planting', health: 'good', area: 30, season: '2025/2026'),
    Crop(id: '5', name: 'Trigo Parcela Leste', type: 'Trigo', status: 'completed', health: 'excellent', area: 60, season: '2025/2025'),
  ];

  final _statusLabels = {'planting': 'Plantio', 'growing': 'Crescimento', 'harvest': 'Colheita', 'completed': 'Concluída'};
  final _healthLabels = {'excellent': 'Excelente', 'good': 'Boa', 'regular': 'Regular', 'poor': 'Ruim', 'critical': 'Crítica'};

  Color _healthColor(String h) {
    switch (h) {
      case 'excellent': return Colors.green;
      case 'good': return const Color(0xFF2E7D52);
      case 'regular': return Colors.amber;
      case 'poor': return Colors.orange;
      case 'critical': return Colors.red;
      default: return Colors.grey;
    }
  }

  Color _statusColor(String s) {
    switch (s) {
      case 'planting': return Colors.blue;
      case 'growing': return Colors.green;
      case 'harvest': return Colors.amber;
      case 'completed': return Colors.grey;
      default: return Colors.grey;
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
                Text('Culturas', style: GoogleFonts.inter(fontSize: 22, fontWeight: FontWeight.w800)),
                Text('Gerencie suas culturas', style: GoogleFonts.inter(fontSize: 13, color: Colors.grey[600])),
              ],
            ),
            ElevatedButton.icon(
              onPressed: () {},
              icon: const Icon(Icons.add_rounded, size: 16),
              label: const Text('Nova Cultura'),
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFF2E7D52),
                foregroundColor: Colors.white,
                shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 10),
                textStyle: GoogleFonts.inter(fontWeight: FontWeight.w600, fontSize: 13),
              ),
            ),
          ],
        ),
        const SizedBox(height: 16),
        Expanded(
          child: ListView.separated(
            itemCount: _crops.length,
            separatorBuilder: (_, __) => const SizedBox(height: 10),
            itemBuilder: (context, i) {
              final crop = _crops[i];
              return Card(
                child: Padding(
                  padding: const EdgeInsets.all(16),
                  child: Row(
                    children: [
                      Container(
                        width: 44,
                        height: 44,
                        decoration: BoxDecoration(
                          color: const Color(0xFF2E7D52).withOpacity(0.1),
                          borderRadius: BorderRadius.circular(10),
                        ),
                        child: const Icon(Icons.eco_rounded, color: Color(0xFF2E7D52), size: 22),
                      ),
                      const SizedBox(width: 12),
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(crop.name, style: GoogleFonts.inter(fontWeight: FontWeight.w600, fontSize: 14)),
                            const SizedBox(height: 4),
                            Text('${crop.type}  •  ${crop.area?.toStringAsFixed(0) ?? "--"} ha  •  ${crop.season ?? "--"}',
                                style: GoogleFonts.inter(fontSize: 11, color: Colors.grey[600])),
                            const SizedBox(height: 8),
                            Row(
                              children: [
                                _buildChip(_statusLabels[crop.status] ?? crop.status, _statusColor(crop.status)),
                                const SizedBox(width: 6),
                                _buildChip(_healthLabels[crop.health] ?? crop.health, _healthColor(crop.health)),
                              ],
                            ),
                          ],
                        ),
                      ),
                      IconButton(
                        onPressed: () {},
                        icon: const Icon(Icons.edit_rounded, size: 18),
                        color: Colors.grey[500],
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

  Widget _buildChip(String label, Color color) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 3),
      decoration: BoxDecoration(
        color: color.withOpacity(0.1),
        borderRadius: BorderRadius.circular(6),
        border: Border.all(color: color.withOpacity(0.3)),
      ),
      child: Text(label, style: GoogleFonts.inter(fontSize: 10, color: color, fontWeight: FontWeight.w600)),
    );
  }
}