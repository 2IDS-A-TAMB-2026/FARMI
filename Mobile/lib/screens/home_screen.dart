import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:url_launcher/url_launcher.dart';

class HomeScreen extends StatelessWidget {
  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF052501),
      body: CustomScrollView(
        slivers: [
          // 🔝 TOPO
          SliverAppBar(
            pinned: false,
            backgroundColor: Colors.transparent,
            elevation: 0,
            toolbarHeight: 110,
            title: SafeArea(
              child: Row(
                children: [
                  ClipRRect(
                    borderRadius: BorderRadius.circular(10),
                    child: Image.asset(
                      'assets/images/logo.png',
                      width: 100,
                      height: 90,
                      fit: BoxFit.cover,
                    ),
                  ),
                  const SizedBox(width: 10),
                  Expanded(
                    child: Wrap(
                      spacing: 40,
                      runSpacing: 30,
                      children: [
                        _infoItem(Icons.location_on, 'Local'),
                        _infoItem(Icons.email, 'farmi_tcc2026@gmail.com'),
                        _infoItem(Icons.phone, '(19) 99112-6878'),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),

          SliverToBoxAdapter(
            child: Column(
              children: [
                // 🔲 MENU
                Container(
                  width: double.infinity,
                  padding: const EdgeInsets.symmetric(vertical: 10),
                  color: Colors.black,
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                    children: [
                      TextButton(
                        onPressed: () {},
                        child: const Text(
                          'Sobre',
                          style: TextStyle(color: Colors.white),
                        ),
                      ),
                      TextButton(
                        onPressed: () {},
                        child: const Text(
                          'Nos contrate',
                          style: TextStyle(color: Colors.white),
                        ),
                      ),
                      ElevatedButton(
                        onPressed: () {
                          Navigator.pushReplacementNamed(context, '/login');
                        },
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.black,
                          foregroundColor: Colors.white,
                        ),
                        child: const Text('Entrar'),
                      ),
                    ],
                  ),
                ),

                // 🌄 HERO
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 10),
                  child: Container(
                    width: double.infinity,
                    padding: const EdgeInsets.all(20),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(20),
                      image: const DecorationImage(
                        image: AssetImage('assets/images/lavoura.jpg'),
                        fit: BoxFit.cover,
                      ),
                    ),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          'FARMI',
                          style: GoogleFonts.inter(
                            fontSize: 36,
                            fontWeight: FontWeight.w800,
                            color: Colors.white,
                          ),
                        ),
                        const SizedBox(height: 6),
                        Text(
                          'Fazenda Automatizada Remota de Monitoramento Inteligente',
                          style: GoogleFonts.inter(
                            fontSize: 18,
                            color: const Color(0xFF4BC714),
                            fontWeight: FontWeight.w700,
                          ),
                        ),
                        const SizedBox(height: 12),
                        Text(
                          'Tecnologia que protege e faz sua fazenda crescer.',
                          style: GoogleFonts.inter(
                            color: Colors.white70,
                            fontSize: 14,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),

                const SizedBox(height: 30),

                // 🤍 SOBRE
                Container(
                  width: double.infinity,
                  color: Colors.white,
                  padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 30),
                  child: LayoutBuilder(
                    builder: (context, constraints) {
                      if (constraints.maxWidth < 870) {
                        return Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            _title(),
                            const SizedBox(height: 10),
                            _text(),
                            const SizedBox(height: 20),
                            Center(
                              child: Image.network(
                                'assets/images/folha.png',
                                width: 250,
                              ),
                            ),
                          ],
                        );
                      }

                      return Row(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Expanded(
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                _title(),
                                const SizedBox(height: 10),
                                _text(),
                              ],
                            ),
                          ),
                          const SizedBox(width: 30),
                          Image.asset(
                            'assets/images/logo.png',
                            width: 350,
                          ),
                        ],
                      );
                    },
                  ),
                ),


                // 🌱 SENSORES
                Container(
                  width: double.infinity,
                  color: const Color.fromARGB(255, 255, 255, 255),
                  padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 30),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      RichText(
                        text: TextSpan(
                          style: GoogleFonts.inter(
                            fontSize: 20,
                            fontWeight: FontWeight.w500,
                          ),
                          children: const [
                            TextSpan(
                              text: 'SENSORES ',
                              style: TextStyle(color: Colors.black),
                            ),
                            TextSpan(
                              text: 'UTILIZADOS',
                              style: TextStyle(color: Color(0xFF4BC714)),
                            ),
                          ],
                        ),
                      ),

                      const SizedBox(height: 6),
                      Container(
                        width: double.infinity,
                        height: 0.5,
                        color: Colors.black,
                      ),
                      const SizedBox(height: 40),


                      const SizedBox(height: 30),

                      LayoutBuilder(
                        builder: (context, constraints) {
                          int crossAxisCount;
                          double aspectRatio;

                          if (constraints.maxWidth < 600) {
                            crossAxisCount = 1;
                            aspectRatio = 1.2;
                          } else if (constraints.maxWidth < 1000) {
                            crossAxisCount = 3;
                            aspectRatio = 1.1;
                          } else {
                            crossAxisCount = 3;
                            aspectRatio = 1.0;
                          }

                          final sensores = [
                            {
                              'title': 'Temperatura e\numidade do clima:',
                              'image': 'assets/images/temp.png',
                              'desc':
                                  'Mede a  temperatura (°C) e a umidade do  ar (%) e serve para monitorar o  ambiente, garantindo melhores condições para o cultivo.',
                            },
                            {
                              'title': 'Umidade do solo:',
                              'image': 'assets/images/solo.png',
                              'desc':
                                  'Mede a umidade da terra e serve para indicar o momento ideal de irrigação, evitando excesso ou falta de água.',
                            },
                            {
                              'title': 'Luminosidade:',
                              'image': 'assets/images/luz.png',
                              'desc':
                                  'Mede a  intensidade luminosa em lux (lx)  e serve para controlar a quantidade de luz recebida pelas plantas, favorecendo seu crescimento saudável.',
                            },
                          ];

                          return GridView.builder(
                            shrinkWrap: true,
                            physics: const NeverScrollableScrollPhysics(),
                            itemCount: sensores.length,
                            gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                              crossAxisCount: crossAxisCount,
                              crossAxisSpacing: 20,
                              mainAxisSpacing: 20,
                              childAspectRatio: 0.7,
                            ),
                            itemBuilder: (context, index) {
                              final sensor = sensores[index];

                              return _sensorCard(
                                sensor['title'] as String,
                                sensor['image'] as String,
                                sensor['desc'] as String,
                              );
                            },
                          );
                        },
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 0),
                // 🧩 PRODUCT (igual HTML)
Container(
  width: double.infinity,
  padding: const EdgeInsets.fromLTRB(0, 90, 0, 60),
  color: const Color.fromARGB(255, 255, 255, 255),
  child: Column(
    children: [
      // 🔤 TÍTULO
      Padding(
        padding: const EdgeInsets.symmetric(horizontal: 24),
        child: Row(
          children: [
            Text(
              'CONSIGA ',
              style: GoogleFonts.inter(
                fontSize: 20,
                fontWeight: FontWeight.w500,
                color: Colors.black,
              ),
            ),
            Text(
              'MONITORAR',
              style: GoogleFonts.inter(
                fontSize: 20,
                fontWeight: FontWeight.w500,
                color: Color(0xFF4BC714),
              ),
            ),
          ],
        ),
      ),
       const SizedBox(height: 5),
                      Container(
                        width: double.infinity,
                        height: 0.5,
                        color: Colors.black,
                      ),

      const SizedBox(height: 30),

      // 🔲 GRID IGUAL HTML
      Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // 🔵 ESQUERDA
          Expanded(
            flex: 8,
            child: Column(
              children: [
                Row(
                  children: [
                    Expanded(
                      child: _productBox(
                        'assets/images/product_img1.jpg',
                        'Temperatura',
                      ),
                    ),
                    Expanded(
                      child: _productBox(
                        'assets/images/product_img2.jpg',
                        'Umidade',
                      ),
                    ),
                  ],
                ),
                _productBox(
                  'assets/images/product_img4.jpg',
                  'Cultivo',
                ),
              ],
            ),
          ),

          // 🔵 DIREITA
          Expanded(
            flex: 4,
            child: Column(
              children: [
                _productBox(
                 'assets/images/product_img3.jpg',
                  'Iluminância',
                ),
                _productBox(
                  'assets/images/product_img5.jpg',
                  'Sensores',
                ),
              ],
            ),
          ),
        ],
      ),
    ],
  ),
),

const SizedBox(height: 0),

// 🌿 IDENTIDADE
Container(
  width: double.infinity,
  color: Colors.white,
  padding: const EdgeInsets.symmetric(vertical: 60, horizontal: 24),
  child: Column(
    children: [
      // 🔤 TÍTULO
      Row(
        children: [
          Text(
            'NOSSA ',
            style: GoogleFonts.inter(
              fontSize: 20,
              fontWeight: FontWeight.w500,
              color: Colors.black,
            ),
          ),
          Text(
            'IDENTIDADE',
            style: GoogleFonts.inter(
              fontSize: 20,
              fontWeight: FontWeight.w500,
              color: const Color(0xFF4BC714),
            ),
          ),
        ],
      ),
      const SizedBox(height: 6),
        Container(
          width: double.infinity,
          height: 0.5,
          color: Colors.black,
        ),

      const SizedBox(height: 40),

      // 🔲 COLUNAS RESPONSIVAS
      LayoutBuilder(
        builder: (context, constraints) {
          if (constraints.maxWidth < 768) {
            // 📱 CELULAR (coluna)
            return Column(
              children: [
                const SizedBox(height: 30),
                _agroItem(
                  'assets/images/mission.png',
                  'Missão',
                  'Usar sensores e monitoramento em tempo real para ajudar produtores a tomar decisões mais eficientes no cultivo.',
                ),
                const SizedBox(height: 30),
                _agroItem(
                  'assets/images/vision.png',
                  'Visão',
                  'Ser referência em tecnologia agrícola, promovendo soluções inteligentes e sustentáveis no campo.',
                ),
                const SizedBox(height: 30),
                _agroItem(
                  'assets/images/values.png',
                  'Valores',
                  'Sustentabilidade, inovação e eficiência, buscando sempre otimizar recursos e melhorar a produção.',
                ),
              ],
            );
          }

          // 💻 TABLET / PC (linha)
          return Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Expanded(
                child: _agroItem(
                  'assets/images/mission.png',
                  'Missão',
                  'Usar sensores e monitoramento em tempo real para ajudar produtores a tomar decisões mais eficientes no cultivo.',
                ),
              ),
              Expanded(
                child: _agroItem(
                  'assets/images/vision.png',
                  'Visão',
                  'Ser referência em tecnologia agrícola, promovendo soluções inteligentes e sustentáveis no campo.',
                ),
              ),
              Expanded(
                child: _agroItem(
                  'assets/images/values.png',
                  'Valores',
                  'Sustentabilidade, inovação e eficiência, buscando sempre otimizar recursos e melhorar a produção.',
                ),
              ),
            ],
          );
        },
      ),
    ],
  ),
),
const SizedBox(height: 0),

// 👥 NOSSA EQUIPE
Container(
  width: double.infinity,
  color: Colors.white,
  padding: const EdgeInsets.symmetric(vertical: 60, horizontal: 20),
  child: Column(
    children: [
      // 🔤 TÍTULO
      Column(
        children: [
          Text(
            'NOSSA EQUIPE',
            style: GoogleFonts.inter(
              fontSize: 25,
              fontWeight: FontWeight.w500,
              color: const Color(0xFF052501),
            ),
          ),
          const SizedBox(height: 5),
          Container(
            width: 200,
            height: 1,
            color: const Color(0xFF052501),
          ),
        ],
      ),

      const SizedBox(height: 50),

// 🔲 CARDS RESPONSIVO
LayoutBuilder(
  builder: (context, constraints) {
    int crossAxisCount;

    if (constraints.maxWidth < 600) {
      crossAxisCount = 2; // celular
    } else if (constraints.maxWidth < 1000) {
      crossAxisCount = 3; // tablet
    } else {
      crossAxisCount = 6; // pc
    }

    return GridView.count(
      crossAxisCount: crossAxisCount,
      shrinkWrap: true,
      physics: const NeverScrollableScrollPhysics(),
      crossAxisSpacing: 40,
      mainAxisSpacing: 40,
      children: [
        _teamCard(
          'assets/equipe/thaiene.png',
          'Thaiene Tessaro',
          '       Scrum Master e \nProg. Back-End',
          'https://www.instagram.com/thaienetessaro/',
        ),
        _teamCard(
          'assets/equipe/paula.jpg',
          'Paula Zito',
          'P.O e Prog. Back-End',
          'https://www.instagram.com/zito_paula/',
        ),
        _teamCard(
          'assets/equipe/vinicius.jpg',
          'Vinícius Lima',
          'Desen. Full Stack',
          'https://www.instagram.com/vinyssues/',
        ),
        _teamCard(
          'assets/equipe/isabella.png',
          'Isabella Garcia',
          'Desen. Full Stack',
          'https://www.instagram.com/_isabellagarcia__/',
        ),
        _teamCard(
          'assets/equipe/maria.jpg',
          'Maria Clara Braga',
          'Anal.de Banco de Dados',
          'https://www.instagram.com/imnott_mariaaaa/',
        ),
        _teamCard(
          'assets/equipe/vitor.png',
          'Vitor Delduca',
          'Anal. de Banco de Dados',
          'https://www.instagram.com/vitinzxx__/',
        ),
      ],
    );
  },
)
    ],
  ),
),
const SizedBox(height: 10),

// 🔻 RODAPÉ
Container(
  width: double.infinity,
  color: const Color(0xFF052501),
  padding: const EdgeInsets.symmetric(vertical: 15),
  child: Center(
    child: Text(
      '© 2026 Todos os direitos reservados. TCC Farmi.',
      textAlign: TextAlign.center,
      style: GoogleFonts.inter(
        color: Colors.white,
        fontSize: 13,
      ),
    ),
  ),
),
              ],
            ),
          ),
        ],
      ),
    );
  }

  // 🔧 COMPONENTES

  Widget _infoItem(IconData icon, String text) {
    return Row(
      mainAxisSize: MainAxisSize.min,
      children: [
        Icon(icon, size: 14, color: const Color(0xFF4BC714)),
        const SizedBox(width: 4),
        Text(
          text,
          style: const TextStyle(color: Colors.white, fontSize: 12),
        ),
      ],
    );
  }

  Widget _title() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        RichText(
          text: TextSpan(
            style: GoogleFonts.inter(
              fontSize: 20,
              fontWeight: FontWeight.w500,
            ),
            children: const [
              TextSpan(
                text: 'SOBRE A\n',
                style: TextStyle(color: Colors.black),
              ),
              TextSpan(
                text: '            FARMI',
                style: TextStyle(color: Color(0xFF4BC714)),
              ),
            ],
          ),
        ),
        const SizedBox(height: 6),
        Container(
          width: double.infinity,
          height: 0.5,
          color: Colors.black,
        ),
      ],
    );
  }

  Widget _text() {
    return Text(
      'A FARMI (Fazenda Automatizada e Remota com '
      'Monitoramento Inteligente) é uma solução de AgTech '
      'focada em transformar a gestão rural por meio da '
      'tecnologia. Nosso objetivo é centralizar dados dispersos '
      'em uma plataforma única, facilitando a tomada de decisão '
      'e aumentando a produtividade no campo. Através de '
      'sensores IoT, monitoramos em tempo real indicadores '
      'como temperatura, umidade e luminosidade do tempo. O '
      'sistema oferece um painel intuitivo com alertas '
      'automáticos sobre condições críticas, garantindo o uso '
      'sustentável de recursos e redução de custos. Projetada '
      'para pequenos e grandes produtores, a FARMI une a '
      'tradição do cultivo à inovação digital.',
      style: GoogleFonts.inter(
        fontSize: 14,
        color: Colors.black87,
        height: 1.5,
      ),
    );
  }

// ✅ CARD MELHORADO
Widget _sensorCard(String title, String imagePath, String description) {
  return Container(
    height: 350,
    padding: const EdgeInsets.all(12),
    decoration: BoxDecoration(
      color: const Color.fromARGB(255, 255, 255, 255),
      borderRadius: BorderRadius.circular(12),
      boxShadow: [
        BoxShadow(
          color: const Color.fromARGB(122, 0, 0, 0),
          blurRadius: 6,
          offset: Offset(0, 3),
        ),
      ],
    ),
    child: Column(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        Container(
          width: 120,
          height: 120,
          decoration: BoxDecoration(
            shape: BoxShape.circle,
            border: Border.all(
              color: Color(0xFF4BC714),
              width: 2,
            ),
          ),
          child: Padding(
            padding: const EdgeInsets.all(14),
            child: Image.asset(imagePath),
          ),
        ),
        const SizedBox(height: 0),
        Text(
  title,
  textAlign: TextAlign.center,
  maxLines: 4,
  overflow: TextOverflow.ellipsis,
  style: GoogleFonts.inter(
    fontSize: 14,
    fontWeight: FontWeight.w400,
    color: const Color.fromARGB(255, 8, 8, 8),
  ),
),
        const SizedBox(height: 6),
        Text(
          description,
          textAlign: TextAlign.center,
          style: GoogleFonts.inter(
            fontSize: 11,
            color: Colors.black54,
          ),
        ),
      ],
    ),
  );
}

Widget _productBox(String image, String title) {
  return Container(
    margin: const EdgeInsets.all(8),
    height: 248,
    child: Stack(
      children: [
        Positioned.fill(
          child: Image.asset(
            image,
            fit: BoxFit.cover,
          ),
        ),
        Positioned(
          bottom: 0,
          left: 0,
          right: 0,
          child: Container(
            color: const Color(0xD4052501),
            padding: const EdgeInsets.fromLTRB(13, 10, 13, 13),
            child: Text(
              title,
              textAlign: TextAlign.center,
              style: GoogleFonts.inter(
                fontSize: 20,
                fontWeight: FontWeight.w500,
                color: Colors.white,
              ),
            ),
          ),
        ),
      ],
    ),
  );
}
}
Widget _agroItem(String image, String title, String text) {
  return Padding(
    padding: const EdgeInsets.symmetric(horizontal: 10),
    child: Column(
      children: [
        Image.asset(
          image,
          width: 120,
        ),
        const SizedBox(height: 15),
        Text(
          title.toUpperCase(),
          style: GoogleFonts.inter(
            fontSize: 16,
            fontWeight: FontWeight.w600,
            color: const Color(0xFF052501),
          ),
        ),
        const SizedBox(height: 10),
        Text(
          text,
          textAlign: TextAlign.center,
          style: GoogleFonts.inter(
            fontSize: 14,
            color: const Color(0xFF4C4A49),
            height: 1.6,
          ),
        ),
      ],
    ),
  );
}
Widget _teamCard(String image, String name, String role, String url) {
  return GestureDetector(
    onTap: () async {
      final Uri uri = Uri.parse(url);

      if (!await launchUrl(uri)) {
        throw 'Não foi possível abrir $url';
      }
    },
    child: Column(
      children: [
        Container(
          width: 130,
          height: 130,
          decoration: BoxDecoration(
            shape: BoxShape.circle,
            border: Border.all(
              color: const Color(0xFF4BC714),
              width: 4,
            ),
          ),
          child: ClipOval(
            child: Image.asset(
              image,
              fit: BoxFit.cover,
            ),
          ),
        ),
        const SizedBox(height: 15),
        Text(
  name,
  style: GoogleFonts.inter(
    fontSize: 14,
    fontWeight: FontWeight.w500, 
    color: Colors.black,         
  ),
),
        Text(role),

],

    ),
  );
}
