<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - Fazenda Inteligente</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_recuperar.css') ?>">

<style>
    /* ========================================================
       BARRA DE ACESSIBILIDADE
       ======================================================== */

    .recover-container {
        position: relative !important;
        padding-top: 75px !important;
        box-sizing: border-box !important;
        overflow: visible !important;
    }

    .acessibilidade-container {
        position: absolute !important;
        top: 20px !important;
        right: 20px !important;
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        gap: 6px !important;
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
        z-index: 100 !important;
    }

    .acessibilidade-container button {
        background: #57c91b !important;
        border: none !important;
        border-radius: 5px !important;
        width: 34px !important;
        height: 34px !important;
        font-weight: bold !important;
        cursor: pointer !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: 0.2s !important;
        color: #fff !important;
        font-size: 13px !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
        margin: 0 !important;
        padding: 0 !important;
        box-sizing: border-box !important;
    }

    .acessibilidade-container button:hover {
        opacity: 0.85 !important;
    }

    /* ========================================================
       VALIDAÇÃO DO INPUT
       ======================================================== */

    input:invalid {
        border: 2px solid #ff4d4d;
    }

    input:valid {
        border: 2px solid #4caf50;
    }

    .mensagem-erro {
        color: #ff4d4d;
        font-size: 14px;
        margin-top: 5px;
        display: none;
    }

    /* ========================================================
       BOTÃO DE CONTRASTE - MODO NORMAL
       ======================================================== */

    #contraste-btn {
        cursor: pointer !important;
    }

    #contraste-btn i {
        color: #fff !important;
    }

    /* ========================================================
       ALTO CONTRASTE
       ======================================================== */

    html.alto-contraste,
    body.alto-contraste {
        background: #000 !important;
        color: #fff !important;
    }

    /* CONTAINER PRINCIPAL */

    body.alto-contraste .recover-container {
        background: #000 !important;
        color: #fff !important;
        border: 2px solid #fff !important;
    }

    /* CABEÇALHO */

    body.alto-contraste h2,
    body.alto-contraste p,
    body.alto-contraste label,
    body.alto-contraste .logo {
        color: #fff !important;
    }

    body.alto-contraste .logo i {
        color: #fff !important;
    }

    /* ========================================================
       INPUT
       ======================================================== */

    body.alto-contraste input {
        background: #000 !important;
        color: #fff !important;
        border: 2px solid #fff !important;
    }

    body.alto-contraste input::placeholder {
        color: #ccc !important;
        opacity: 1 !important;
    }

    /* ========================================================
       BOTÕES DO FORMULÁRIO
       ======================================================== */

    body.alto-contraste .btn-primary,
    body.alto-contraste .btn-secondary {
        background: #000 !important;
        color: #fff !important;
        border: 2px solid #fff !important;
    }

    body.alto-contraste .btn-primary i,
    body.alto-contraste .btn-secondary i {
        color: #fff !important;
    }

    body.alto-contraste .btn-primary:hover,
    body.alto-contraste .btn-secondary:hover {
        background: #000 !important;
        color: #fff !important;
    }

    /* ========================================================
       BOTÃO DE CONTRASTE
       ======================================================== */

    body.alto-contraste #contraste-btn,
    body.alto-contraste #contraste-btn:hover,
    body.alto-contraste #contraste-btn:focus,
    body.alto-contraste #contraste-btn:active,
    body.alto-contraste #contraste-btn:focus-visible {
        background: #000 !important;
        color: #fff !important;
        border: 2px solid #fff !important;
        outline: none !important;
        box-shadow: none !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    body.alto-contraste #contraste-btn i {
        color: #fff !important;
    }

    /* ========================================================
       BOTÕES DE TAMANHO DA FONTE
       ======================================================== */

    body.alto-contraste #aumentar-fonte,
    body.alto-contraste #diminuir-fonte,
    body.alto-contraste #resetar-fonte {
        background: #000 !important;
        color: #fff !important;
        border: 2px solid #fff !important;
    }

    body.alto-contraste #aumentar-fonte:hover,
    body.alto-contraste #diminuir-fonte:hover,
    body.alto-contraste #resetar-fonte:hover {
        background: #000 !important;
        color: #fff !important;
    }

    /* ========================================================
       PASSOS
       ======================================================== */

    body.alto-contraste .step {
        background: #666 !important;
        color: #fff !important;
    }

    body.alto-contraste .step.active,
    body.alto-contraste .step.completed {
        background: #fff !important;
        color: #000 !important;
    }

    /* ========================================================
       LINK - FAZER LOGIN
       ======================================================== */

    body.alto-contraste .back-link a {
        color: #fff !important;
    }

    body.alto-contraste .back-link a i {
        color: #fff !important;
    }

    body.alto-contraste .back-link a:hover {
        color: #fff !important;
    }

    /* ========================================================
       ALERTAS
       ======================================================== */

    body.alto-contraste .alert {
        background: #000 !important;
        color: #fff !important;
        border: 2px solid #fff !important;
    }

    body.alto-contraste .alert i,
    body.alto-contraste .alert span {
        color: #fff !important;
    }

    /* ========================================================
       RESPONSIVIDADE
       ======================================================== */

    @media (max-width: 768px) {

        .recover-container {
            padding-top: 85px !important;
        }

        .acessibilidade-container {
            top: 15px !important;
            right: 15px !important;
        }

        .acessibilidade-container button {
            width: 30px !important;
            height: 30px !important;
            font-size: 11px !important;
        }
    }
</style>
</head>

<body>

    <div class="recover-container">

        <div class="acessibilidade-container">
            <button id="auto-contraste" type="button" aria-label="Alterar contraste">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>
            <button id="aumentar-fonte" type="button" aria-label="Aumentar fonte">A+</button>
            <button id="diminuir-fonte" type="button" aria-label="Diminuir fonte">A-</button>
            <button id="resetar-fonte" type="button" aria-label="Resetar fonte">A</button>
        </div>

        <div class="recover-header">
            <div class="logo">
                <i class="fa-solid fa-leaf"></i>
                FARMI
            </div>

            <h2>Recuperar Senha</h2>
            <p>Insira seu email para receber instruções de recuperação</p>
        </div>

        <form id="recoverForm">

            <div class="form-group">
                <label for="email">
                    <i class="fa-solid fa-envelope"></i>
                    Email
                </label>

                <input 
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Digite seu email cadastrado"
                    required
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                    title="Digite um email válido. Ex: exemplo@gmail.com"
                >

                <div class="mensagem-erro" id="erroEmail">
                    Digite um email válido!
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-paper-plane"></i>
                Enviar Link de Recuperação
            </button>

            <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                <i class="fa-solid fa-arrow-left"></i>
                Voltar
            </button>

        </form>

        <div class="back-link">
            <a href="<?= base_url('/login') ?>">
                <i class="fa-solid fa-sign-in-alt"></i>
                Fazer Login
            </a>
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
    const form = document.getElementById('recoverForm');
    const emailInput = document.getElementById('email');
    const btnEnviar = form.querySelector('.btn-primary');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const email = emailInput.value.trim();

        // ========================================================
        // VALIDAÇÃO EMAIL
        // ========================================================
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email) {
            mostrarAlerta('warning', 'Informe seu email para continuar.');
            emailInput.focus();
            return;
        }

        if (!regexEmail.test(email)) {
            mostrarAlerta('warning', 'Digite um email válido.');
            emailInput.focus();
            return;
        }

        // ========================================================
        // LOADING BOTÃO
        // ========================================================
        const textoOriginal = btnEnviar.innerHTML;
        btnEnviar.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Enviando...';
        btnEnviar.disabled = true;

        // ========================================================
        // SIMULA ENVIO
        // ========================================================
        setTimeout(() => {
            btnEnviar.innerHTML = '<i class="fa-solid fa-check"></i> Link enviado!';
            btnEnviar.style.backgroundColor = '#4caf50';

            atualizarPassos();
            mostrarAlerta('success', `Link de recuperação enviado para ${email}`);

            setTimeout(() => {
                window.location.href = 'login.php';
            }, 2500);
        }, 2000);
    });

    // ========================================================
    // ALERTAS
    // ========================================================
    function mostrarAlerta(tipo, mensagem) {
        const alertaExistente = document.querySelector('.alert');
        if (alertaExistente) {
            alertaExistente.remove();
        }

        const alerta = document.createElement('div');
        alerta.className = `alert alert-${tipo}`;
        alerta.innerHTML = `
            <i class="fa-solid ${tipo === 'success' ? 'fa-check-circle' : 'fa-triangle-exclamation'}"></i>
            <span>${mensagem}</span>
        `;

        form.parentNode.insertBefore(alerta, form);

        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }

    // ========================================================
    // PASSOS
    // ========================================================
    function atualizarPassos() {
        const passos = document.querySelectorAll('.step');
        passos[0].classList.remove('active');
        passos[0].classList.add('completed');
        passos[1].classList.add('active');
    }

    // ========================================================
    // ENTER NO INPUT
    // ========================================================
    emailInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            form.dispatchEvent(new Event('submit'));
        }
    });
    // ========================================================
    // REMOVE ESPAÇOS EMAIL
    // ========================================================
    emailInput.addEventListener('input', function () {
        this.value = this.value.replace(/\s/g, '');
    });

    // ========================================================
    // SISTEMA DE ACESSIBILIDADE DE FONTE 
    // ========================================================
    let tamanhoFonte = 100;
    const aumentarFonte = document.getElementById('aumentar-fonte');
    const diminuirFonte = document.getElementById('diminuir-fonte');
    const resetarFonte = document.getElementById('resetar-fonte');

    function aplicarFonte() {
        document.documentElement.style.fontSize = tamanhoFonte + '%';
        localStorage.setItem('tamanhoFonteRecuperar', tamanhoFonte);
    }

    const fonteSalva = localStorage.getItem('tamanhoFonteRecuperar');
    if (fonteSalva) {
        tamanhoFonte = parseInt(fonteSalva);
        aplicarFonte();
    }

    if (aumentarFonte) {
        aumentarFonte.addEventListener('click', () => {
            if (tamanhoFonte < 150) { tamanhoFonte += 10; aplicarFonte(); }
        });
    }
    if (diminuirFonte) {
        diminuirFonte.addEventListener('click', () => {
            if (tamanhoFonte > 70) { tamanhoFonte -= 10; aplicarFonte(); }
        });
    }
    if (resetarFonte) {
        resetarFonte.addEventListener('click', () => {
            tamanhoFonte = 100; aplicarFonte();
        });
    }
    </script>
    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>
</body>
</html>