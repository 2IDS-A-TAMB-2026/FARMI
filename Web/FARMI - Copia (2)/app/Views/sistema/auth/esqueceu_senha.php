

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FARMI - Recuperar Senha</title>

        <!--Ícone do site-->
        <link rel="icon" href="<?= base_url('assets/images/about.png') ?>" type="image/png" />

        <!-- Fonte Roboto -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

        <!-- Pode usar o mesmo login.css -->
        <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

        <!-- Biblioteca para aparecer a setinha -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
                <h2>Recuperar Senha</h2>

                <form method="POST" action="<?= base_url('enviar-recuperacao') ?>">

                    <label class="campo">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="nome@email.com"><br>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary" id="btnEnviar" disabled>Enviar link</button>
                    </div>

                    <br>
                    <div class="back">
                        <a href="<?= base_url('login') ?>">
                            <i class="fas fa-arrow-left"></i> Voltar para o Login
                        </a>
                    </div>

                </form>
            </div>
        </div>

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
            const botao = document.getElementById('btnEnviar');
            const erroSpan = document.getElementById('erroEmail');

            function validarFormulario() {
                const email = emailInput.value.trim();
                const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

                // ativa/desativa botão
                botao.disabled = !emailValido;

            }

            // valida enquanto digita
            emailInput.addEventListener('input', validarFormulario);
        });
        </script>

    </body>
</html>