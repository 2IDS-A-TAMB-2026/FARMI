<?php

    session_start();

    $erro = $_SESSION['erro'] ?? null;
    unset($_SESSION['erro']);

    // Verifica se o formulário foi enviado
    if (isset($_POST["email"])) {

        $email = $_POST["email"];

        // Simulação: verifica se o email é o admin
        if ($email === "admin@email.com") {

            // Simula envio de link
            $sucesso = "Um link de redefinição foi enviado para seu e-mail.";

            // Redirecionar
            header("Location: ../home.html");
            exit;

        } else {
            $_SESSION['erro'] = "*E-mail não encontrado!";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FARMI - Recuperar Senha</title>

        <!--Ícone do site-->
        <link rel="icon" href="../images/about.png" type="image/png" />

        <!-- Fonte Roboto -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

        <!-- Pode usar o mesmo login.css -->
        <link rel="stylesheet" href="../login/login.css">

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
                <h2>Recuperar Senha</h2>

                <form method="POST">

                    <label class="campo">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="nome@email.com"><br>

                    <?php if(isset($erro)) echo "<p class='erro'>$erro</p>"; ?>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary" id="btnEnviar" disabled>Enviar link</button>
                    </div>

                    <br>
                    <div class="back">
                        <a href="login.php">
                            <i class="fas fa-arrow-left"></i> Voltar para o Login
                        </a>
                    </div>

                </form>
            </div>
        </div>

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