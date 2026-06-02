import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class MainLayout extends StatefulWidget {
  final Widget child;
  const MainLayout({super.key, required this.child});

  @override
  State<MainLayout> createState() => _MainLayoutState();
}

// 🌓 Provedor de Contraste Nativo (InheritedWidget)
class AppContrast extends InheritedWidget {
  final bool isHighContrast;
  final VoidCallback toggleContrast;

  const AppContrast({
    super.key,
    required this.isHighContrast,
    required this.toggleContrast,
    required super.child,
  });

  static AppContrast? of(BuildContext context) {
    return context.dependOnInheritedWidgetOfExactType<AppContrast>();
  }

  @override
  bool updateShouldNotify(AppContrast oldWidget) {
    return oldWidget.isHighContrast != isHighContrast;
  }
}

class _MainLayoutState extends State<MainLayout> {
  final List<_NavItem> _navItems = const [
    _NavItem(icon: Icons.dashboard_rounded, label: 'Dashboard', route: '/dashboard'),
    _NavItem(icon: Icons.eco_rounded, label: 'Culturas', route: '/crops'),
    _NavItem(icon: Icons.sensors_rounded, label: 'Sensores', route: '/sensors'),
    _NavItem(icon: Icons.bar_chart_rounded, label: 'Relatórios', route: '/reports'),
    _NavItem(icon: Icons.notifications_rounded, label: 'Alertas', route: '/alerts'),
  ];

  bool _isHighContrast = false;

  void _toggleContrast() {
    setState(() {
      _isHighContrast = !_isHighContrast;
    });
  }

  @override
  Widget build(BuildContext context) {
    final isWide = MediaQuery.of(context).size.width >= 800;
    final String? currentRoute = ModalRoute.of(context)?.settings.name;

    int selectedIndex =
        _navItems.indexWhere((item) => item.route == currentRoute);
    if (selectedIndex == -1) selectedIndex = 0;

    return AppContrast(
      isHighContrast: _isHighContrast,
      toggleContrast: _toggleContrast,
      child: Theme(
        data: _isHighContrast
            ? ThemeData.dark().copyWith(
                scaffoldBackgroundColor: Colors.black,
                cardColor: Colors.white10,
                textTheme: Theme.of(context).textTheme.apply(
                      bodyColor: Colors.white,
                      displayColor: Colors.white,
                    ),
                bottomNavigationBarTheme:
                    const BottomNavigationBarThemeData(
                  backgroundColor: Colors.black,
                  selectedItemColor: Colors.white,
                  unselectedItemColor: Colors.white70,
                ),
              )
            : Theme.of(context),
        child: Scaffold(
          backgroundColor: _isHighContrast
              ? Colors.black
              : Theme.of(context).scaffoldBackgroundColor,
          body: Row(
            children: [
              if (isWide) _buildSidebar(context, selectedIndex),
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
              : BottomNavigationBar(
                  currentIndex: selectedIndex,
                  type: BottomNavigationBarType.fixed,
                  backgroundColor:
                      _isHighContrast ? Colors.black : Colors.white,
                  selectedItemColor:
                      _isHighContrast ? Colors.white : Colors.black,
                  unselectedItemColor:
                      _isHighContrast ? Colors.white70 : Colors.black54,
                  selectedLabelStyle: GoogleFonts.inter(
                      fontSize: 11, fontWeight: FontWeight.bold),
                  unselectedLabelStyle:
                      GoogleFonts.inter(fontSize: 11),
                  onTap: (i) {
                    if (_navItems[i].route != currentRoute) {
                      Navigator.pushReplacementNamed(
                          context, _navItems[i].route);
                    }
                  },
                  items: _navItems
                      .map((item) => BottomNavigationBarItem(
                            icon: Icon(item.icon),
                            label: item.label,
                          ))
                      .toList(),
                ),
        ),
      ),
    );
  }

  // ✅ SIDEBAR
  Widget _buildSidebar(BuildContext context, int selectedIndex) {
    final String? currentRoute = ModalRoute.of(context)?.settings.name;

    return Container(
      width: 240,
      color: _isHighContrast ? Colors.black : Colors.white,
      child: Column(
        children: [
          Container(
            padding: const EdgeInsets.all(20),
            decoration: BoxDecoration(
              border: Border(
                bottom: BorderSide(
                  color: _isHighContrast
                      ? Colors.black
                      : Colors.white,
                ),
              ),
            ),
            child: Row(
              children: [
                ClipRRect(
                  borderRadius: BorderRadius.circular(10),
                  child: Image.asset(
                    'assets/images/logo.png',
                    width: 36,
                    height: 36,
                    fit: BoxFit.cover,
                  ),
                ),
                const SizedBox(width: 10),
                Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      'FARMI',
                      style: GoogleFonts.inter(
                        fontWeight: FontWeight.w800,
                        fontSize: 16,
                        color: _isHighContrast
                            ? Colors.white
                            : Colors.black,
                      ),
                    ),
                    Text(
                      'Monitoramento Inteligente',
                      style: GoogleFonts.inter(
                        fontSize: 9,
                        color: _isHighContrast
                            ? Colors.white
                            : Colors.black,
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
          Expanded(
            child: ListView.builder(
              padding: const EdgeInsets.all(8),
              itemCount: _navItems.length,
              itemBuilder: (context, i) {
                final isActive = selectedIndex == i;

                Color itemBgColor = Colors.transparent;
                Color contentColor =
                    _isHighContrast ? Colors.white : Colors.black;

                if (isActive) {
                  itemBgColor = _isHighContrast
                      ? Colors.white
                      : Colors.black;
                  contentColor = _isHighContrast
                      ? Colors.black
                      : Colors.white;
                }

                return GestureDetector(
                  onTap: () {
                    if (_navItems[i].route != currentRoute) {
                      Navigator.pushReplacementNamed(
                          context, _navItems[i].route);
                    }
                  },
                  child: AnimatedContainer(
                    duration: const Duration(milliseconds: 200),
                    margin: const EdgeInsets.symmetric(vertical: 2),
                    padding: const EdgeInsets.symmetric(
                        horizontal: 12, vertical: 10),
                    decoration: BoxDecoration(
                      color: itemBgColor,
                      borderRadius: BorderRadius.circular(10),
                    ),
                    child: Row(
                      children: [
                        Icon(_navItems[i].icon,
                            size: 18, color: contentColor),
                        const SizedBox(width: 10),
                        Text(
                          _navItems[i].label,
                          style: GoogleFonts.inter(
                            fontSize: 13,
                            fontWeight: FontWeight.w500,
                            color: contentColor,
                          ),
                        ),
                      ],
                    ),
                  ),
                );
              },
            ),
          ),
          Padding(
            padding: const EdgeInsets.all(16.0),
            child: ElevatedButton.icon(
              style: ElevatedButton.styleFrom(
                backgroundColor:
                    _isHighContrast ? Colors.white : Colors.black,
                foregroundColor:
                    _isHighContrast ? Colors.black : Colors.white,
                minimumSize: const Size.fromHeight(40),
              ),
              onPressed: _toggleContrast,
              icon: Icon(
                  _isHighContrast ? Icons.light_mode : Icons.contrast),
              label: Text(_isHighContrast
                  ? 'Modo Normal'
                  : 'Alto Contraste'),
            ),
          )
        ],
      ),
    );
  }

  // ✅ TOPBAR
  Widget _buildTopBar(BuildContext context) {
    return Container(
      color: _isHighContrast ? Colors.black : Colors.white,
      padding: const EdgeInsets.symmetric(
          horizontal: 16, vertical: 12),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          GestureDetector(
            onTap: () {
              Navigator.pushNamedAndRemoveUntil(
                  context, '/', (route) => false);
            },
            child: Row(
              children: [
                ClipRRect(
                  borderRadius: BorderRadius.circular(6),
                  child: Image.asset(
                    'assets/images/folha.png',
                    width: 28,
                    height: 28,
                    fit: BoxFit.cover,
                  ),
                ),
                const SizedBox(width: 10),
                Text(
                  'FARMI',
                  style: GoogleFonts.inter(
                    fontWeight: FontWeight.w800,
                    fontSize: 16,
                    color: _isHighContrast
                        ? Colors.white
                        : Colors.black,
                  ),
                ),
              ],
            ),
          ),
          IconButton(
            icon: Icon(_isHighContrast
                ? Icons.light_mode
                : Icons.contrast),
            color: _isHighContrast
                ? Colors.white
                : Colors.black,
            onPressed: _toggleContrast,
          ),
        ],
      ),
    );
  }
}

class _NavItem {
  final IconData icon;
  final String label;
  final String route;

  const _NavItem({
    required this.icon,
    required this.label,
    required this.route,
  });
}