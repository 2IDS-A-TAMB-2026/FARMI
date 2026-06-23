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
        <script>
document.addEventListener('DOMContentLoaded', function() {
    // =========================
    // ACESSIBILIDADE DE FONTE E CONTRASTE
    // =========================

    // 1. Lógica do Alto Contraste
    const contrasteBtn = document.getElementById('contraste-btn');
    
    // Verifica se o contraste já estava ativado em outra página
    if (localStorage.getItem('temaContraste') === 'ativo') {
        document.body.classList.add('contraste');
    }

    contrasteBtn.addEventListener('click', () => {
        document.body.classList.toggle('contraste');
        
        // Salva a preferência para continuar no Dashboard depois do login
        if (document.body.classList.contains('contraste')) {
            localStorage.setItem('temaContraste', 'ativo');
        } else {
            localStorage.removeItem('temaContraste');
        }
    });

    // 2. Lógica do Tamanho da Fonte
    let tamanhoFonte = 100;
    const aumentarFonte = document.getElementById('aumentar-fonte');
    const diminuirFonte = document.getElementById('diminuir-fonte');
    const resetarFonte = document.getElementById('resetar-fonte');

    function aplicarFonte() {
        document.documentElement.style.fontSize = tamanhoFonte + '%';
        // Salva com o mesmo nome usado no dashboard para sincronizar
        localStorage.setItem('tamanhoFonteDashboard', tamanhoFonte); 
    }

    // Puxa a fonte salva anteriormente (se houver)
    const fonteSalva = localStorage.getItem('tamanhoFonteDashboard');
    if (fonteSalva) {
        tamanhoFonte = parseInt(fonteSalva);
        aplicarFonte();
    }

    aumentarFonte.addEventListener('click', () => {
        if (tamanhoFonte < 150) {
            tamanhoFonte += 10;
            aplicarFonte();
        }
    });

    diminuirFonte.addEventListener('click', () => {
        if (tamanhoFonte > 70) {
            tamanhoFonte -= 10;
            aplicarFonte();
        }
    });

    resetarFonte.addEventListener('click', () => {
        tamanhoFonte = 100;
        aplicarFonte();
    });
});
</script>
    </body>
</html>