<?php

    session_start();

    $erro = $_SESSION['erro'] ?? null;
    unset($_SESSION['erro']);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $usuario = trim($_POST["usuario"] ?? "");
        $senha = $_POST["senha"] ?? "";

        if (empty($usuario) || empty($senha)) {
            $erro = "*Preencha todos os campos!";
        } else {

            $usuario_Admin = "admin@gmail.com";
            $senha_Admin = "12345678";

            $usuario_Usu = "usuario@gmail.com";
            $senha_Usu = "12345678";

            if ($usuario === $usuario_Admin && $senha === $senha_Admin) {
                $_SESSION["usuario"] = $usuario;
                header("Location: ../farmi/farmi_adm/dashboard.php");
                exit;
            }
            if ($usuario === $usuario_Usu && $senha === $senha_Usu) {
                $_SESSION["usuario"] = $usuario;
                header("Location: ../farmi/farmi_usuario/dashboard.php");
                exit;
            }
            else {
                $_SESSION['erro'] = "Usuário ou senha inválidos!";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
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

        <!-- Biblioteca Sweet Alert -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary" id="btnEntrar" disabled>Entrar</button>
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

        <?php if(isset($erro)): ?>
            <script>
                mostrarAlerta("<?php echo $erro; ?>");
            </script>
        <?php endif; ?>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('usuario');
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
        <script>
            function mostrarAlerta(msg){
                Swal.fire({
                    title: 'Erro!',
                    text: msg,
                    icon: 'error'
                });
            }
        </script>
    </body>
</html>