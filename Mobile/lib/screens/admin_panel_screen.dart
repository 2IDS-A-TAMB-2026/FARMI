import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class AdminPanelScreen extends StatelessWidget {
  const AdminPanelScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final users = [
      {'name': 'João Silva', 'email': 'joao@fazenda.com', 'role': 'ADM / Produtor'},
      {'name': 'Maria Santos', 'email': 'maria@fazenda.com', 'role': 'Usuário'},
      {'name': 'Pedro Costa', 'email': 'pedro@fazenda.com', 'role': 'Usuário'},
    ];

    final sensors = [
      {'name': 'Sensor Temp. Norte', 'type': 'Temperatura', 'status': 'Ativo'},
      {'name': 'Sensor Umid. Solo A1', 'type': 'Umid. Solo', 'status': 'Ativo'},
      {'name': 'Sensor Temp. Estufa', 'type': 'Temperatura', 'status': 'Manutenção'},
    ];

    return SingleChildScrollView(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text('Painel Administrativo',
                      style: GoogleFonts.inter(fontSize: 20, fontWeight: FontWeight.w800)),
                  Text('Gerencie usuários e sensores',
                      style: GoogleFonts.inter(fontSize: 13, color: Colors.grey[600])),
                ],
              ),
              ElevatedButton.icon(
                onPressed: () => _showInviteDialog(context),
                icon: const Icon(Icons.person_add_alt_1_rounded, size: 16),
                label: const Text('Convidar'),
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

          // Stats
          GridView.count(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            crossAxisCount: 2,
            mainAxisSpacing: 10,
            crossAxisSpacing: 10,
            childAspectRatio: 2.2,
            children: [
              _statCard('Total Usuários', '3', Icons.people_rounded, Colors.blue),
              _statCard('Admins', '1', Icons.shield_rounded, Colors.amber),
              _statCard('Sensores Ativos', '5', Icons.sensors_rounded, Colors.green),
              _statCard('Inativos', '2', Icons.sensors_off_rounded, Colors.red),
            ],
          ),
          const SizedBox(height: 20),

          // Users section
          Card(
            child: Padding(
              padding: const EdgeInsets.all(16),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text('Usuários', style: GoogleFonts.inter(fontWeight: FontWeight.w600, fontSize: 14)),
                  const SizedBox(height: 12),
                  ...users.map((u) => Padding(
                    padding: const EdgeInsets.symmetric(vertical: 8),
                    child: Row(
                      children: [
                        Container(
                          width: 36,
                          height: 36,
                          decoration: BoxDecoration(
                            color: const Color(0xFF2E7D52).withOpacity(0.1),
                            shape: BoxShape.circle,
                          ),
                          child: const Icon(Icons.person_rounded, color: Color(0xFF2E7D52), size: 18),
                        ),
                        const SizedBox(width: 10),
                        Expanded(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(u['name']!, style: GoogleFonts.inter(fontWeight: FontWeight.w500, fontSize: 13)),
                              Text(u['email']!, style: GoogleFonts.inter(fontSize: 11, color: Colors.grey[600])),
                            ],
                          ),
                        ),
                        Container(
                          padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 3),
                          decoration: BoxDecoration(
                            color: u['role'] == 'ADM / Produtor'
                                ? Colors.amber.withOpacity(0.15)
                                : Colors.grey[100],
                            borderRadius: BorderRadius.circular(6),
                          ),
                          child: Text(u['role']!,
                              style: GoogleFonts.inter(
                                  fontSize: 10,
                                  fontWeight: FontWeight.w600,
                                  color: u['role'] == 'ADM / Produtor' ? Colors.amber[800] : Colors.grey[700])),
                        ),
                      ],
                    ),
                  )),
                ],
              ),
            ),
          ),
          const SizedBox(height: 16),

          // Sensors admin section
          Card(
            child: Padding(
              padding: const EdgeInsets.all(16),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text('Sensores', style: GoogleFonts.inter(fontWeight: FontWeight.w600, fontSize: 14)),
                  const SizedBox(height: 12),
                  ...sensors.map((s) => Padding(
                    padding: const EdgeInsets.symmetric(vertical: 8),
                    child: Row(
                      children: [
                        const Icon(Icons.sensors_rounded, color: Color(0xFF2E7D52), size: 20),
                        const SizedBox(width: 10),
                        Expanded(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(s['name']!, style: GoogleFonts.inter(fontWeight: FontWeight.w500, fontSize: 13)),
                              Text(s['type']!, style: GoogleFonts.inter(fontSize: 11, color: Colors.grey[600])),
                            ],
                          ),
                        ),
                        Container(
                          padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 3),
                          decoration: BoxDecoration(
                            color: s['status'] == 'Ativo'
                                ? Colors.green.withOpacity(0.1)
                                : Colors.amber.withOpacity(0.1),
                            borderRadius: BorderRadius.circular(6),
                          ),
                          child: Text(s['status']!,
                              style: GoogleFonts.inter(
                                  fontSize: 10,
                                  fontWeight: FontWeight.w600,
                                  color: s['status'] == 'Ativo' ? Colors.green[700] : Colors.amber[800])),
                        ),
                        const SizedBox(width: 8),
                        OutlinedButton(
                          onPressed: () {},
                          style: OutlinedButton.styleFrom(
                            padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                            minimumSize: Size.zero,
                            shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                          ),
                          child: Text(s['status'] == 'Ativo' ? 'Desativar' : 'Ativar',
                              style: GoogleFonts.inter(fontSize: 11)),
                        ),
                      ],
                    ),
                  )),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _statCard(String label, String value, IconData icon, Color color) {
    return Card(
      child: Padding(
        padding: const EdgeInsets.all(14),
        child: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                color: color.withOpacity(0.1),
                borderRadius: BorderRadius.circular(8),
              ),
              child: Icon(icon, color: color, size: 18),
            ),
            const SizedBox(width: 10),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(value, style: GoogleFonts.inter(fontSize: 20, fontWeight: FontWeight.w700)),
                Text(label, style: GoogleFonts.inter(fontSize: 10, color: Colors.grey[600])),
              ],
            ),
          ],
        ),
      ),
    );
  }

  void _showInviteDialog(BuildContext context) {
    final emailController = TextEditingController();
    showDialog(
      context: context,
      builder: (ctx) => AlertDialog(
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        title: Text('Convidar Usuário', style: GoogleFonts.inter(fontWeight: FontWeight.w700)),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            TextField(
              controller: emailController,
              decoration: InputDecoration(
                labelText: 'E-mail',
                border: OutlineInputBorder(borderRadius: BorderRadius.circular(10)),
                contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 10),
              ),
            ),
          ],
        ),
        actions: [
          TextButton(onPressed: () => Navigator.pop(ctx), child: const Text('Cancelar')),
          ElevatedButton(
            onPressed: () => Navigator.pop(ctx),
            style: ElevatedButton.styleFrom(
              backgroundColor: const Color(0xFF2E7D52),
              foregroundColor: Colors.white,
              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
            ),
            child: const Text('Enviar'),
          ),
        ],
      ),
    );
  }
}