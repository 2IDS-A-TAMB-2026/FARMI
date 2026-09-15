import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class ResetPasswordScreen extends StatefulWidget {
  const ResetPasswordScreen({super.key});

  @override
  State<ResetPasswordScreen> createState() => _ResetPasswordScreenState();
}

class _ResetPasswordScreenState extends State<ResetPasswordScreen> {
  final _formKey = GlobalKey<FormState>();
  final _newPasswordController = TextEditingController();
  final _confirmPasswordController = TextEditingController();
  bool _obscureNew = true;
  bool _obscureConfirm = true;
  bool _isLoading = false;
  bool _success = false;

  @override
  void dispose() {
    _newPasswordController.dispose();
    _confirmPasswordController.dispose();
    super.dispose();
  }

  Future<void> _handleReset() async {
    if (!_formKey.currentState!.validate()) return;
    setState(() => _isLoading = true);
    await Future.delayed(const Duration(seconds: 2));
    setState(() {
      _isLoading = false;
      _success = true;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF0D2B1A),
      body: SafeArea(
        child: Center(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(24),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                _buildLogo(),
                const SizedBox(height: 48),
                Container(
                  constraints: const BoxConstraints(maxWidth: 400),
                  padding: const EdgeInsets.all(28),
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.06),
                    borderRadius: BorderRadius.circular(20),
                    border: Border.all(color: Colors.white12),
                  ),
                  child: _success ? _buildSuccessState(context) : _buildFormState(),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildFormState() {
    return Form(
      key: _formKey,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // Ícone
          Container(
            width: 48,
            height: 48,
            decoration: BoxDecoration(
              color: const Color(0xFF2E7D52).withOpacity(0.2),
              borderRadius: BorderRadius.circular(12),
            ),
            child: const Icon(Icons.lock_rounded, color: Color(0xFF4CAF85), size: 24),
          ),
          const SizedBox(height: 16),
          Text(
            'Criar nova senha',
            style: GoogleFonts.inter(fontSize: 22, fontWeight: FontWeight.w700, color: Colors.white),
          ),
          const SizedBox(height: 6),
          Text(
            'Sua nova senha deve ter no mínimo 6 caracteres.',
            style: GoogleFonts.inter(fontSize: 13, color: Colors.white54, height: 1.5),
          ),
          const SizedBox(height: 28),

          // Nova Senha
          _buildLabel('Nova senha'),
          const SizedBox(height: 6),
          TextFormField(
            controller: _newPasswordController,
            obscureText: _obscureNew,
            style: GoogleFonts.inter(color: Colors.white, fontSize: 14),
            decoration: _inputDecoration(
              hint: 'Digite a nova senha',
              icon: Icons.lock_outline_rounded,
              obscure: _obscureNew,
              onToggle: () => setState(() => _obscureNew = !_obscureNew),
            ),
            validator: (v) {
              if (v == null || v.isEmpty) return 'Informe a nova senha';
              if (v.length < 6) return 'Mínimo 6 caracteres';
              return null;
            },
          ),
          const SizedBox(height: 18),

          // Confirmar Senha
          _buildLabel('Confirmar senha'),
          const SizedBox(height: 6),
          TextFormField(
            controller: _confirmPasswordController,
            obscureText: _obscureConfirm,
            style: GoogleFonts.inter(color: Colors.white, fontSize: 14),
            decoration: _inputDecoration(
              hint: 'Confirme a nova senha',
              icon: Icons.lock_outline_rounded,
              obscure: _obscureConfirm,
              onToggle: () => setState(() => _obscureConfirm = !_obscureConfirm),
            ),
            validator: (v) {
              if (v == null || v.isEmpty) return 'Confirme a senha';
              if (v != _newPasswordController.text) return 'As senhas não coincidem';
              return null;
            },
          ),
          const SizedBox(height: 28),

          // Botão
          SizedBox(
            width: double.infinity,
            height: 48,
            child: ElevatedButton(
              onPressed: _isLoading ? null : _handleReset,
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFF2E7D52),
                foregroundColor: Colors.white,
                disabledBackgroundColor: const Color(0xFF2E7D52).withOpacity(0.5),
                shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
                elevation: 0,
              ),
              child: _isLoading
                  ? const SizedBox(
                      width: 20,
                      height: 20,
                      child: CircularProgressIndicator(
                        strokeWidth: 2,
                        valueColor: AlwaysStoppedAnimation(Colors.white),
                      ),
                    )
                  : Text(
                      'Redefinir senha',
                      style: GoogleFonts.inter(fontSize: 15, fontWeight: FontWeight.w600),
                    ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildSuccessState(BuildContext context) {
    return Column(
      children: [
        Container(
          width: 64,
          height: 64,
          decoration: BoxDecoration(
            color: const Color(0xFF2E7D52).withOpacity(0.2),
            shape: BoxShape.circle,
          ),
          child: const Icon(Icons.check_circle_rounded, color: Color(0xFF4CAF85), size: 36),
        ),
        const SizedBox(height: 20),
        Text(
          'Senha redefinida!',
          style: GoogleFonts.inter(fontSize: 20, fontWeight: FontWeight.w700, color: Colors.white),
        ),
        const SizedBox(height: 8),
        Text(
          'Sua senha foi alterada com sucesso.\nFaça login com sua nova senha.',
          textAlign: TextAlign.center,
          style: GoogleFonts.inter(fontSize: 13, color: Colors.white54, height: 1.5),
        ),
        const SizedBox(height: 28),
        SizedBox(
          width: double.infinity,
          height: 48,
          child: ElevatedButton(
            onPressed: () => Navigator.pushReplacementNamed(context, '/login'),
            style: ElevatedButton.styleFrom(
              backgroundColor: const Color(0xFF2E7D52),
              foregroundColor: Colors.white,
              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
              elevation: 0,
            ),
            child: Text(
              'Ir para o login',
              style: GoogleFonts.inter(fontSize: 15, fontWeight: FontWeight.w600),
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildLogo() {
    return Column(
      children: [
        Container(
          width: 56,
          height: 56,
          decoration: BoxDecoration(color: const Color(0xFF2E7D52), borderRadius: BorderRadius.circular(16)),
          child: const Icon(Icons.eco_rounded, color: Colors.white, size: 30),
        ),
        const SizedBox(height: 12),
        Text('FARMI', style: GoogleFonts.inter(fontSize: 28, fontWeight: FontWeight.w800, color: Colors.white, letterSpacing: 2)),
        const SizedBox(height: 4),
        Text('Monitoramento Inteligente', style: GoogleFonts.inter(fontSize: 12, color: Colors.white38)),
      ],
    );
  }

  Widget _buildLabel(String text) {
    return Text(text, style: GoogleFonts.inter(fontSize: 13, fontWeight: FontWeight.w500, color: Colors.white70));
  }

  InputDecoration _inputDecoration({
    required String hint,
    required IconData icon,
    required bool obscure,
    required VoidCallback onToggle,
  }) {
    return InputDecoration(
      hintText: hint,
      hintStyle: GoogleFonts.inter(color: Colors.white24, fontSize: 13),
      prefixIcon: Icon(icon, color: Colors.white38, size: 18),
      suffixIcon: IconButton(
        icon: Icon(
          obscure ? Icons.visibility_off_outlined : Icons.visibility_outlined,
          color: Colors.white38,
          size: 18,
        ),
        onPressed: onToggle,
      ),
      filled: true,
      fillColor: Colors.white.withOpacity(0.07),
      contentPadding: const EdgeInsets.symmetric(horizontal: 14, vertical: 14),
      border: OutlineInputBorder(borderRadius: BorderRadius.circular(12), borderSide: const BorderSide(color: Colors.white12)),
      enabledBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(12), borderSide: const BorderSide(color: Colors.white12)),
      focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(12), borderSide: const BorderSide(color: Color(0xFF2E7D52), width: 1.5)),
      errorBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(12), borderSide: const BorderSide(color: Colors.redAccent)),
      focusedErrorBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(12), borderSide: const BorderSide(color: Colors.redAccent, width: 1.5)),
      errorStyle: GoogleFonts.inter(color: Colors.redAccent, fontSize: 11),
    );
  }
}