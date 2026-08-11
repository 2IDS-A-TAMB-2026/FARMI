

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
        <style>
        /* ==========================================================
        CONTAINER E BOTÕES DE ACESSIBILIDADE
        ========================================================== */
        .acessibilidade-login {
            position: absolute;
            top: 20px;
            right: 30px;
            display: flex;
            gap: 8px;
            z-index: 1000;
        }

        #aumentar-fonte, #diminuir-fonte, #resetar-fonte {
            width: 42px; height: 42px;
            background-color: #58CC02; color: white;
            border: none; border-radius: 8px;
            font-size: 16px; font-weight: bold;
            cursor: pointer; display: flex;
            align-items: center; justify-content: center;
            transition: 0.3s;
        }

        #aumentar-fonte:hover, #diminuir-fonte:hover, #resetar-fonte:hover {
            background-color: #46A302;
        }
        /* ==========================================================
        AJUSTE DE FONTE PARA ACESSIBILIDADE
        Força os elementos marcados a usarem 'rem' para crescerem
        junto com o JavaScript
        ========================================================== */

    /* 1. Inputs (E-mail e Senha) */
    .login-box input {
        font-size: 1rem !important;
    }

    /* 1.1. Placeholder (o texto "E-mail" e "Senha" que fica no fundo) */
    .login-box input::placeholder {
        font-size: 1rem !important;
    }

    /* 2. Botão (Entrar) */
    .login-box .btn-primary {
        font-size: 1rem !important;
    }

    /* 3. Links (Esqueceu a senha? e Voltar a Tela Inicial) */
    .login-box .link-senha,
    .login-box .back a {
        font-size: 1rem !important;
    }
    /* Faz o texto do label (E-mail:) aumentar de tamanho */
    .login-box label {
        font-size: 1rem !important;
    }

    /* Garante que o label fique visível no modo de alto contraste */
    body.contraste .login-box label {
        color: #fff !important;
    }

        #contraste-btn {
            background: transparent; border: none;
            width: 42px; height: 42px; font-size: 20px;
            color: #000; cursor: pointer; transition: all 0.3s ease;
        }

        #contraste-btn:hover {
            color: #46A302;
        }

        /* ==========================================================
        ALTO CONTRASTE ESPECÍFICO PARA O LOGIN
        ========================================================== */
        body.contraste .left, 
        body.contraste .right {
            background-color: #121212 !important; /* Fundo escuro */
        }

        body.contraste .login-box {
            background-color: #000 !important;
            border: 2px solid #fff;
            box-shadow: none;
        }

        body.contraste h2, 
        body.contraste .link-senha, 
        body.contraste .back a {
            color: #fff !important;
        }

        body.contraste input {
            background-color: #1e1e1e !important;
            color: #fff !important;
            border: 1px solid #fff !important;
        }

        body.contraste .btn-primary {
            background-color: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
        }

        body.contraste #aumentar-fonte, 
        body.contraste #diminuir-fonte, 
        body.contraste #resetar-fonte {
            background: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
        }

        body.contraste #contraste-btn {
            color: #fff !important;
        }
        </style>
    </head>

    <body>
        <!-- BOTÕES DE ACESSIBILIDADE -->
        <div class="acessibilidade-login">
            <button id="contraste-btn" title="Alto Contraste">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>
            <button id="aumentar-fonte" aria-label="Aumentar fonte">A+</button>
            <button id="diminuir-fonte" aria-label="Diminuir fonte">A-</button>
            <button id="resetar-fonte" aria-label="Resetar fonte">A</button>
        </div>
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
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // =========================
            // ACESSIBILIDADE DE FONTE E CONTRASTE
            // =========================

            // 1. Lógica do Alto Contraste
            const contrasteBtn = document.getElementById('contraste-btn');
            
            if (localStorage.getItem('temaContraste') === 'ativo') {
                document.body.classList.add('contraste');
            }

            if (contrasteBtn) {
                contrasteBtn.addEventListener('click', () => {
                    document.body.classList.toggle('contraste');
                    
                    if (document.body.classList.contains('contraste')) {
                        localStorage.setItem('temaContraste', 'ativo');
                    } else {
                        localStorage.removeItem('temaContraste');
                    }
                });
            }

            // 2. Lógica do Tamanho da Fonte
            let tamanhoFonte = 100;
            const aumentarFonte = document.getElementById('aumentar-fonte');
            const diminuirFonte = document.getElementById('diminuir-fonte');
            const resetarFonte = document.getElementById('resetar-fonte');

            function aplicarFonte() {
                document.documentElement.style.fontSize = tamanhoFonte + '%';
                localStorage.setItem('tamanhoFonteDashboard', tamanhoFonte); 
            }

            const fonteSalva = localStorage.getItem('tamanhoFonteDashboard');
            if (fonteSalva) {
                tamanhoFonte = parseInt(fonteSalva);
                aplicarFonte();
            }

            if (aumentarFonte) {
                aumentarFonte.addEventListener('click', () => {
                    if (tamanhoFonte < 150) {
                        tamanhoFonte += 10;
                        aplicarFonte();
                    }
                });
            }

            if (diminuirFonte) {
                diminuirFonte.addEventListener('click', () => {
                    if (tamanhoFonte > 70) {
                        tamanhoFonte -= 10;
                        aplicarFonte();
                    }
                });
            }

            if (resetarFonte) {
                resetarFonte.addEventListener('click', () => {
                    tamanhoFonte = 100;
                    aplicarFonte();
                });
            }
        });
        </script>
    </body>
</html>