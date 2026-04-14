import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class MainLayout extends StatefulWidget {
  final Widget child;
  const MainLayout({super.key, required this.child});

  @override
  State<MainLayout> createState() => _MainLayoutState();
}

class _MainLayoutState extends State<MainLayout> {
  int _selectedIndex = 0;

  final List<_NavItem> _navItems = const [
    _NavItem(icon: Icons.dashboard_rounded, label: 'Dashboard', route: '/dashboard'),
    _NavItem(icon: Icons.eco_rounded, label: 'Culturas', route: '/crops'),
    _NavItem(icon: Icons.sensors_rounded, label: 'Sensores', route: '/sensors'),
    _NavItem(icon: Icons.bar_chart_rounded, label: 'Relatórios', route: '/reports'),
    _NavItem(icon: Icons.notifications_rounded, label: 'Alertas', route: '/alerts'),
    _NavItem(icon: Icons.admin_panel_settings_rounded, label: 'Admin', route: '/admin'),
  ];

  @override
  Widget build(BuildContext context) {
    final isWide = MediaQuery.of(context).size.width >= 800;

    return Scaffold(
      body: Row(
        children: [
          if (isWide) _buildSidebar(context),
          Expanded(
            child: Column(
              children: [
                if (!isWide) _buildTopBar(context),
                Expanded(
                  child: Padding(
                    padding: const EdgeInsets.all(16),
                    child: widget.child,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
      bottomNavigationBar: isWide
          ? null
          : NavigationBar(
              selectedIndex: _selectedIndex,
              onDestinationSelected: (i) {
                setState(() => _selectedIndex = i);
                Navigator.pushReplacementNamed(context, _navItems[i].route);
              },
              destinations: _navItems.map((item) => NavigationDestination(
                icon: Icon(item.icon),
                label: item.label,
              )).toList(),
            ),
    );
  }

  Widget _buildSidebar(BuildContext context) {
    return Container(
      width: 240,
      color: Colors.white,
      child: Column(
        children: [
          // Logo
          Container(
            padding: const EdgeInsets.all(20),
            decoration: const BoxDecoration(
              border: Border(bottom: BorderSide(color: Color(0xFFE8F0EC))),
            ),
            child: Row(
              children: [
                Container(
                  width: 36,
                  height: 36,
                  decoration: BoxDecoration(
                    color: const Color(0xFF2E7D52),
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: const Icon(Icons.eco_rounded, color: Colors.white, size: 20),
                ),
                const SizedBox(width: 10),
                Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text('FARMI',
                        style: GoogleFonts.inter(
                            fontWeight: FontWeight.w800, fontSize: 16)),
                    Text('Monitoramento Inteligente',
                        style: GoogleFonts.inter(fontSize: 9, color: Colors.grey)),
                  ],
                ),
              ],
            ),
          ),
          // Nav Items
          Expanded(
            child: ListView.builder(
              padding: const EdgeInsets.all(8),
              itemCount: _navItems.length,
              itemBuilder: (context, i) {
                final isActive = _selectedIndex == i;
                return GestureDetector(
                  onTap: () {
                    setState(() => _selectedIndex = i);
                    Navigator.pushReplacementNamed(context, _navItems[i].route);
                  },
                 child: AnimatedContainer(
  duration: const Duration(milliseconds: 200),
  margin: const EdgeInsets.symmetric(vertical: 2),
  padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 10),
  decoration: BoxDecoration(
    color: isActive ? const Color(0xFF2E7D52) : Colors.transparent,
    borderRadius: BorderRadius.circular(10),
  ),
  child: Row(
    children: [
      Icon(_navItems[i].icon,
          size: 18,
          color: isActive ? Colors.white : Colors.grey[600]),
      const SizedBox(width: 10),
      Text(_navItems[i].label,
          style: GoogleFonts.inter(
            fontSize: 13,
            fontWeight: FontWeight.w500,
            color: isActive ? Colors.white : Colors.grey[700],
          )),
    ],
  ),
),
                );
              },
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildTopBar(BuildContext context) {
  return Container(
    color: Colors.white,
    padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
    child: GestureDetector(
      onTap: () {
        Navigator.pushNamedAndRemoveUntil(
          context,
          '/',
          (route) => false,
        );
      },
      child: Row(
        children: [
          const Icon(Icons.eco_rounded, color: Color(0xFF2E7D52)),
          const SizedBox(width: 8),
          Text(
            'FARMI',
            style: GoogleFonts.inter(fontWeight: FontWeight.w800),
          ),
        ],
      ),
    ),
  );
}
}

class _NavItem {
  final IconData icon;
  final String label;
  final String route;
  const _NavItem({required this.icon, required this.label, required this.route});
}