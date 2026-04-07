<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST["usuario"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if (empty($usuario) || empty($senha)) {
        $erro = "*Preencha todos os campos!";
    } else {

        $usuarioCorreto = "admin@gmail.com";
        $senhaCorreta = "12345678";

        if ($usuario === $usuarioCorreto && $senha === $senhaCorreta) {
            $_SESSION["usuario"] = $usuario;
            header("Location: ../farmi/dashboard.php");
            exit;
        } else {
            $erro = "*Usuário ou senha inválidos!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>FARMI - Login</title>

        <!--Ícone do site-->
        <link rel="icon" href="../images/about.png">

        <!-- Fonte Roboto -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

        <!-- Importando o documento do css -->
        <link rel="stylesheet" href="login.css">

        <!-- Biblioteca para aparecer a setinha -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>

    <body>

        <!-- ESQUERDA -->
        <div class="left">
            <div class="logo-left">
                <img src="../images/logo_FARMI.png">
            </div>
        </div>

        <!-- DIREITA -->
        <div class="right">
            <div class="login-box">
                <h2>Login</h2>

                <form method="POST">

                    <input type="text" name="usuario" id="usuario" placeholder="E-mail">

                    <div class="input-icone">
                        <input type="password" name="senha" id="senha" placeholder="Senha">
                        <i class="fa-solid fa-eye" id="toggleSenha"></i>
                    </div>

                    <?php if(isset($erro)) echo "<p class='erro'>$erro</p>"; ?>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>

                    <a href="esqueceu_senha.php" class="link-senha">*Esqueceu a senha?</a><br>

                    <div class="back">
                        <a href="../home.html">
                            <i class="fas fa-arrow-left"></i> Voltar a Tela Inicial
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const emailInput = document.getElementById('usuario');
            const senhaInput = document.getElementById('senha');

            // ===== OLHO SENHA =====
            toggleSenha.addEventListener('click', function () {
                const tipo = senhaInput.type === 'password' ? 'text' : 'password';
                senhaInput.type = tipo;

                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let isValid = true;

                // Limpa bordas
                document.querySelectorAll('input').forEach(el => {
                    el.style.border = '';
                });

                // ===== EMAIL =====
                const email = emailInput.value.trim();
                if (email === '' || !validarEmail(email)) {
                    emailInput.style.border = '2px solid red';
                    isValid = false;
                } else {
                    emailInput.style.border = '2px solid green';
                }

                // ===== SENHA =====
                const senha = senhaInput.value;
                if (senha === '' || senha.length < 8) {
                    senhaInput.style.border = '2px solid red';
                    isValid = false;
                } else {
                    senhaInput.style.border = '2px solid green';
                }

                // ===== ENVIO =====
                if (isValid) {
                    form.submit();
                }
            });
        });

        // VALIDAR EMAIL
        function validarEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }
        </script>

        <!-- ALERTA DO PHP -->
        <script>
        <?php if(isset($erro)) { ?>
            alert('Esse usuário não está cadastrado.');
        <?php } ?>
        </script>

    </body>
</html>