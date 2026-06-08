<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>FARMI - Login</title>

        <!--Ícone do site-->
        <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">

        <!-- Fonte Roboto -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

        <!-- Importando o documento do css -->
        <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

        <!-- Biblioteca para aparecer a setinha -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <!-- Biblioteca Sweet Alert -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    </head>

    <body>

        <!-- ESQUERDA -->
        <div class="left">
            <div class="logo-left">
                <img src="<?= base_url('assets/images/logo_FARMI.png') ?>">
            </div>
        </div>

        <!-- DIREITA -->
        <div class="right">
            <div class="login-box">
                <h2>Login</h2>

                <form method="POST" action="<?= base_url('login/autenticar') ?>">

                    <input type="text" name="email" id="email" placeholder="E-mail">

                    <div class="input-icone">
                        <input type="password" name="senha" id="senha" placeholder="Senha">
                        <i class="fa-solid fa-eye" id="toggleSenha"></i>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary" id="btnEntrar" disabled>Entrar</button>
                    </div>

                    <a href="<?= base_url('/esqueceu-senha') ?>" class="link-senha">*Esqueceu a senha?</a><br>

                    <div class="back">
                        <a href="<?= base_url('/') ?>">
                            <i class="fas fa-arrow-left"></i> Voltar a Tela Inicial
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <?php if(session()->getFlashdata('erro')): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: 'Erro!',
                        text: '<?= session()->getFlashdata('erro') ?>',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        <?php endif; ?>

        <!-- VLibras -->
        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
        </div>

        <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
        <script>
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        </script>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            const senhaInput = document.getElementById('senha');
            const botao = document.getElementById('btnEntrar');
            const toggleSenha = document.getElementById('toggleSenha');

            // OLHO SENHA (com verificação pra não quebrar)
            if (toggleSenha) {
                toggleSenha.addEventListener('click', function () {
                    const tipo = senhaInput.type === 'password' ? 'text' : 'password';
                    senhaInput.type = tipo;

                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }

            function validarFormulario() {
                const email = emailInput.value.trim();
                const senha = senhaInput.value;

                const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                const senhaValida = senha.length >= 8;

                // ativa/desativa botão
                botao.disabled = !(emailValido && senhaValida);
            }

            // valida enquanto digita
            emailInput.addEventListener('input', validarFormulario);
            senhaInput.addEventListener('input', validarFormulario);
        });

        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>