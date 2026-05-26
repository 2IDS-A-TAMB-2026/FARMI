import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class ForgotPasswordScreen extends StatefulWidget {
  const ForgotPasswordScreen({super.key});

  @override
  State<ForgotPasswordScreen> createState() => _ForgotPasswordScreenState();
}

class _ForgotPasswordScreenState extends State<ForgotPasswordScreen> {
  final _formKey = GlobalKey<FormState>();
  final _emailController = TextEditingController();

  bool _isLoading = false;
  bool _isButtonEnabled = false;
  String? _errorMessage;

  @override
  void initState() {
    super.initState();
    _emailController.addListener(_validateEmail);
  }

  void _validateEmail() {
    final email = _emailController.text.trim();

    final bool emailValido =
        RegExp(r'^[^\s@]+@[^\s@]+\.[^\s@]+$')
            .hasMatch(email);

    setState(() {
      _isButtonEnabled = emailValido;

      if (emailValido) _errorMessage = null;
    });
  }

  @override
  void dispose() {
    _emailController.dispose();
    super.dispose();
  }

  Future<void> _handleSendLink() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() {
      _isLoading = true;
      _errorMessage = null;
    });

    await Future.delayed(
      const Duration(seconds: 2),
    );

    setState(() => _isLoading = false);

    if (_emailController.text.trim() ==
        "admin@email.com") {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text(
              "Um link de redefinição foi enviado para o seu e-mail.",
            ),
            backgroundColor: Colors.green,
          ),
        );

        Navigator.pop(context);
      }
    } else {
      setState(() {
        _errorMessage =
            "*E-mail não encontrado!";
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor:
          const Color(0xFF0D2B1A),

      appBar: AppBar(
        backgroundColor:
            Colors.transparent,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(
            Icons.arrow_back,
            color: Colors.white,
          ),
          onPressed: () =>
              Navigator.pop(context),
        ),
      ),

      body: LayoutBuilder(
        builder: (context, constraints) {
          bool mobile =
              constraints.maxWidth < 700;

          return Center(
            child: mobile
                ? _buildMobileLayout()
                : _buildDesktopLayout(),
          );
        },
      ),
    );
  }

  // MOBILE
  Widget _buildMobileLayout() {
    return Container(
      color: const Color(0xFFF4F6F8),
      child: Center(
        child: SingleChildScrollView(
          padding:
              const EdgeInsets.all(20),
          child: Container(
            width: double.infinity,
            constraints:
                const BoxConstraints(
              maxWidth: 420,
            ),
            padding:
                const EdgeInsets.all(24),
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius:
                  BorderRadius.circular(16),
              boxShadow: const [
                BoxShadow(
                  blurRadius: 10,
                  color: Colors.black12,
                  offset: Offset(0, 4),
                )
              ],
            ),

            child: Column(
              mainAxisSize:
                  MainAxisSize.min,
              children: [

                // LOGO
                Image.asset(
                  'assets/images/logo.png',
                  width: 300,
                ),

                const SizedBox(
                    height: 20),

                _buildFormContent(
                  isMobile: true,
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  // DESKTOP
  Widget _buildDesktopLayout() {
    return Row(
      children: [

        // ESQUERDA
        Expanded(
          child: Container(
            color:
                const Color(0x99052501),
            child: Center(
              child: Image.asset(
                'assets/images/logo.png',
                width: 450,
              ),
            ),
          ),
        ),

        // DIREITA
        Expanded(
          child: Container(
            color:
                const Color(0xFFF4F6F8),
            child: Center(
              child:
                  SingleChildScrollView(
                padding:
                    const EdgeInsets.all(
                        24),
                child: Container(
                  width: 500,
                  padding:
                      const EdgeInsets.all(
                          35),
                  decoration:
                      BoxDecoration(
                    color: Colors.white,
                    borderRadius:
                        BorderRadius
                            .circular(12),
                    boxShadow: const [
                      BoxShadow(
                        blurRadius: 10,
                        color:
                            Colors.black12,
                        offset:
                            Offset(0, 4),
                      )
                    ],
                  ),

                  child:
                      _buildFormContent(
                    isMobile: false,
                  ),
                ),
              ),
            ),
          ),
        ),
      ],
    );
  }

  // FORMULÁRIO
  Widget _buildFormContent({
    required bool isMobile,
  }) {
    return Form(
      key: _formKey,
      child: Column(
        mainAxisSize:
            MainAxisSize.min,
        crossAxisAlignment:
            CrossAxisAlignment.start,
        children: [
          Center(
            child: Text(
              'Recuperar Senha',
              style:
                  GoogleFonts.roboto(
                fontSize: 26,
                fontWeight:
                    FontWeight.bold,
                color: const Color(
                    0xFF052501),
              ),
            ),
          ),

          const SizedBox(height: 35),

          Text(
            "E-mail:",
            style:
                GoogleFonts.roboto(
              fontSize: 14,
              fontWeight:
                  FontWeight.w600,
              color: Colors.black87,
            ),
          ),

          const SizedBox(height: 8),

          TextFormField(
            controller:
                _emailController,
            keyboardType:
                TextInputType
                    .emailAddress,

            decoration: InputDecoration(
              hintText:
                  'nome@email.com',

              contentPadding:
                  const EdgeInsets
                      .symmetric(
                horizontal: 12,
                vertical: 15,
              ),

              border:
                  OutlineInputBorder(
                borderRadius:
                    BorderRadius
                        .circular(8),
              ),

              focusedBorder:
                  OutlineInputBorder(
                borderRadius:
                    BorderRadius
                        .circular(8),

                borderSide:
                    const BorderSide(
                  color:
                      Color(0xFF052501),
                  width: 2,
                ),
              ),
            ),

            validator: (value) {
              if (value == null ||
                  value.isEmpty) {
                return 'Digite seu e-mail';
              }

              return null;
            },
          ),

          if (_errorMessage != null)
            Padding(
              padding:
                  const EdgeInsets.only(
                      top: 10),
              child: Text(
                _errorMessage!,
                style: const TextStyle(
                  color: Colors.red,
                  fontSize: 13,
                  fontWeight:
                      FontWeight.bold,
                ),
              ),
            ),

          const SizedBox(height: 30),

          SizedBox(
            width: double.infinity,
            height: 50,
            child: ElevatedButton(
              onPressed:
                  (_isButtonEnabled &&
                          !_isLoading)
                      ? _handleSendLink
                      : null,

              style:
                  ElevatedButton.styleFrom(
                backgroundColor:
                    const Color(
                        0xFF052501),

                foregroundColor:
                    Colors.white,

                disabledBackgroundColor:
                    Colors.grey[300],

                shape:
                    RoundedRectangleBorder(
                  borderRadius:
                      BorderRadius
                          .circular(8),
                ),
              ),

              child: _isLoading
                  ? const SizedBox(
                      width: 20,
                      height: 20,
                      child:
                          CircularProgressIndicator(
                        color:
                            Colors.white,
                        strokeWidth: 2,
                      ),
                    )
                  : const Text(
                      'Enviar link',
                      style: TextStyle(
                        fontSize: 16,
                        fontWeight:
                            FontWeight
                                .bold,
                      ),
                    ),
            ),
          ),

          const SizedBox(height: 25),

          Center(
            child: TextButton.icon(
              onPressed: () =>
                  Navigator.pop(
                      context),

              icon: const Icon(
                Icons.arrow_back,
                size: 18,
                color:
                    Color(0xFF052501),
              ),

              label: Text(
                'Voltar para o Login',
                style:
                    GoogleFonts.roboto(
                  color: const Color(
                      0xFF052501),
                  fontWeight:
                      FontWeight.w500,
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}