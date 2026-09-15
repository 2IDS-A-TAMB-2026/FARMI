import 'package:app_base44/screens/detalhes_fazenda_screen.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'detalhes_fazenda_screen.dart';
import '../models/farm.dart';
import '../services/api_service.dart';

class FazendasScreen extends StatefulWidget {
  const FazendasScreen({super.key});

  @override
  State<FazendasScreen> createState() => _FazendasScreenState();
}

class _FazendasScreenState extends State<FazendasScreen> {
  List<Farm> _farms = [];
  bool _isLoading = true;
  String? _errorMessage;

  @override
  void initState() {
    super.initState();
    _fetchFarms();
  }

  Future<void> _fetchFarms() async {
    setState(() {
      _isLoading = true;
      _errorMessage = null;
    });

    try {
      final farmsData = await ApiService.getFarms();
      setState(() {
        _farms = farmsData;
        _isLoading = false;
      });
    } catch (e, stack) {
      print('ERRO AO CARREGAR FAZENDAS: $e');
      print(stack);

      setState(() {
        _errorMessage = 'Erro: $e';
        _isLoading = false;
      });
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
                  'Fazendas',
                  style: GoogleFonts.inter(
                    fontSize: 22,
                    fontWeight: FontWeight.w800,
                  ),
                ),
                const SizedBox(height: 4),
                Text(
                  'Gerencie suas propriedades rurais',
                  style: GoogleFonts.inter(
                    fontSize: 13,
                    color: Colors.grey[600],
                  ),
                ),
              ],
            ),
            IconButton(
              icon: const Icon(Icons.refresh),
              onPressed: _fetchFarms,
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
    if (_isLoading) {
      return const Center(
        child: CircularProgressIndicator(
          color: Color(0xFF2E7D52),
        ),
      );
    }

    if (_errorMessage != null) {
      return Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const Icon(
              Icons.error_outline,
              size: 48,
              color: Colors.red,
            ),
            const SizedBox(height: 12),
            Text(
              _errorMessage!,
              textAlign: TextAlign.center,
              style: GoogleFonts.inter(color: Colors.grey[700]),
            ),
            const SizedBox(height: 16),
            ElevatedButton(
              onPressed: _fetchFarms,
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFF2E7D52),
              ),
              child: const Text(
                'Tentar Novamente',
                style: TextStyle(color: Colors.white),
              ),
            ),
          ],
        ),
      );
    }

    if (_farms.isEmpty) {
      return Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(
              Icons.agriculture_outlined,
              size: 60,
              color: Colors.grey[400],
            ),
            const SizedBox(height: 12),
            Text(
              'Nenhuma fazenda cadastrada.',
              style: GoogleFonts.inter(
                fontSize: 14,
                color: Colors.grey[600],
              ),
            ),
          ],
        ),
      );
    }

    return RefreshIndicator(
      onRefresh: _fetchFarms,
      color: const Color(0xFF2E7D52),
      child: ListView.separated(
        itemCount: _farms.length,
        separatorBuilder: (context, index) => const SizedBox(height: 10),
        itemBuilder: (context, index) {
          final farm = _farms[index];

          return InkWell(
  borderRadius: BorderRadius.circular(12),
  onTap: () {
    Navigator.push(
      context,
      MaterialPageRoute(
        builder: (context) => DetalhesFazendaScreen(
          farm: farm,
        ),
      ),
    );
  },
  child: Card(
    elevation: 1,
    shape: RoundedRectangleBorder(
      borderRadius: BorderRadius.circular(12),
    ),
    child: Padding(
      padding: const EdgeInsets.all(16),
      child: Row(
        children: [
          Container(
            width: 50,
            height: 50,
            decoration: BoxDecoration(
              color: const Color(0xFF2E7D52).withOpacity(0.1),
              borderRadius: BorderRadius.circular(12),
            ),
            child: const Icon(
              Icons.agriculture_rounded,
              color: Color(0xFF2E7D52),
              size: 26,
            ),
          ),

          const SizedBox(width: 14),

          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // NOME
                Text(
                  farm.name,
                  style: GoogleFonts.inter(
                    fontSize: 15,
                    fontWeight: FontWeight.w700,
                  ),
                ),

                const SizedBox(height: 6),

                // LOCALIZAÇÃO
                Row(
                  children: [
                    Icon(
                      Icons.location_on_outlined,
                      size: 15,
                      color: Colors.grey[600],
                    ),
                    const SizedBox(width: 4),

                    Expanded(
                      child: Text(
                        farm.location,
                        style: GoogleFonts.inter(
                          fontSize: 11,
                          color: Colors.grey[600],
                        ),
                      ),
                    ),
                  ],
                ),

                const SizedBox(height: 5),

                // ÁREA + CEP
                Row(
                  children: [
                    Icon(
                      Icons.square_foot,
                      size: 15,
                      color: Colors.grey[600],
                    ),

                    const SizedBox(width: 4),

                    Text(
                      '${farm.area.toStringAsFixed(2)} ha',
                      style: GoogleFonts.inter(
                        fontSize: 11,
                        color: Colors.grey[600],
                      ),
                    ),

                    if (farm.cep.isNotEmpty) ...[
                      const SizedBox(width: 12),

                      Icon(
                        Icons.markunread_mailbox_outlined,
                        size: 15,
                        color: Colors.grey[600],
                      ),

                      const SizedBox(width: 4),

                      Text(
                        farm.cep,
                        style: GoogleFonts.inter(
                          fontSize: 11,
                          color: Colors.grey[600],
                        ),
                      ),
                    ],
                  ],
                ),
              ],
            ),
          ),

          const Icon(
            Icons.chevron_right,
            color: Colors.grey,
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
}
