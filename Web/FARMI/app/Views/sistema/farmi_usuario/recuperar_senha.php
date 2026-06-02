<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Ícone do site-->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <title>Recuperar Senha - Fazenda Inteligente</title>
    <!-- Ícones (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --verde-escuro: #052501;
            --verde-claro: #4bc714;
            --verde-claro-hover: #66bb6a;
            --branco: #ffffff;
            --cinza-fundo: #f4f6f8;
            --texto-escuro: #333333;
            --sombra: 0 4px 6px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:  'Arial';
        }

        body {
            background-color: #052501;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .recover-container {
            background: var(--branco);
            padding: 40px;
            border-radius: 12px;
            box-shadow: var(--sombra);
            border-left: 5px solid var(--verde-escuro);
            max-width: 450px;
            width: 100%;
        }

        .recover-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .recover-header .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--verde-escuro);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .recover-header .logo i {
            color: var(--verde-claro);
            font-size: 2rem;
        }

        .recover-header h2 {
            color: var(--verde-escuro);
            margin-bottom: 10px;
        }

        .recover-header p {
            color: #666;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: var(--texto-escuro);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: 0.3s;
            background-color: var(--branco);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--verde-claro);
            box-shadow: 0 0 0 3px rgba(129, 199, 132, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: var(--verde-escuro);
            color: var(--branco);
        }

        .btn-primary:hover {
            background-color: #4bc714;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--verde-escuro);
            border: 2px solid var(--verde-escuro);
        }

        .btn-secondary:hover {
            background-color: #4bc714;
            color: var(--branco);
        }

        .steps-indicator {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .step {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ddd;
            transition: 0.3s;
        }

        .step.active {
            background-color: var(--verde-claro);
            transform: scale(1.2);
        }

        .step.completed {
            background-color: var(--verde-escuro);
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
        }

        .alert-success {
            background-color: rgba(129, 199, 132, 0.2);
            color: var(--verde-escuro);
            border-left: 4px solid var(--verde-escuro);
        }

        .alert-warning {
            background-color: rgba(255, 193, 7, 0.2);
            color: #f57f17;
            border-left: 4px solid #f57f17;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: var(--verde-escuro);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: 0.3s;
        }

        .back-link a:hover {
            color: var(--verde-claro-hover);
        }

        /* RESPONSIVO */
        @media (max-width: 480px) {
            .recover-container {
                padding: 30px 20px;
                margin: 10px;
            }
            
            .recover-header .logo {
                font-size: 1.5rem;
            }
        }
        /* =========================
   TODOS OS ELEMENTOS
========================= */

/* 
Seleciona TODOS os elementos dentro do body
quando o alto contraste estiver ativo

O * significa "todos os elementos"
*/
body.alto-contraste * {

    /* deixa todos os textos brancos */
    color: #fff !important;

    /* muda a cor das bordas para branco */
    border-color: #fff !important;
}

/* =========================
   CONTAINERS
========================= */

/* 
Seleciona vários tipos de containers:
div, section, main, aside, nav, etc.
*/
body.alto-contraste div,
body.alto-contraste section,
body.alto-contraste main,
body.alto-contraste aside,
body.alto-contraste nav,
body.alto-contraste header,
body.alto-contraste footer,
body.alto-contraste form {

    /* fundo preto para todos esses containers */
    background: #000 !important;
}

/* =========================
   INPUTS
========================= */

/* 
Seleciona:
- input
- select
- textarea
*/
body.alto-contraste input,
body.alto-contraste select,
body.alto-contraste textarea {

    /* fundo escuro */
    background: #000000 !important;

    /* texto branco */
    color: #fff !important;

    /* borda branca */
    border: 2px solid #fff !important;
}

/* =========================
   PLACEHOLDER
========================= */

/* 
Seleciona o placeholder do input

Ex:
<input placeholder="Digite seu nome">
*/
body.alto-contraste input::placeholder {

    /* cor cinza clara */
    color: #ccc !important;
}

/* =========================
   BOTÕES
========================= */

/* 
Seleciona:
- todos os <button>
- elementos com classe .btn
*/
body.alto-contraste button,
body.alto-contraste .btn {

    /* fundo branco */
    background: #fff !important;

    /* texto preto */
    color: #000 !important;

    /* borda branca */
    border: 2px solid #fff !important;
}

/* =========================
   TABELAS
========================= */

/* 
Seleciona:
- table
- thead
- tbody
- tr
- td
- th
*/
body.alto-contraste table,
body.alto-contraste thead,
body.alto-contraste tbody,
body.alto-contraste tr,
body.alto-contraste td,
body.alto-contraste th {

    /* fundo preto */
    background: #191717 !important;

    /* texto branco */
    color: #fff !important;

    /* bordas brancas */
    border: 1px solid #fff !important;
}

/* =========================
   ÍCONES
========================= */

/* 
Seleciona todos os ícones <i>

Ex:
<i class="fa-solid fa-user"></i>
*/
body.alto-contraste i {

    /* deixa os ícones brancos */
    color: #fff !important;
}
body.alto-contraste .chart-container {
    background: #222426 !important;
    border: 2px solid white;
    border-radius: 10px;
}

#contraste-btn {
    margin-left: 78%;
    background: transparent !important;
    border: none !important;

    /* display: inline-flex;
    align-items: center;
    justify-content: center; */

    padding: 10px;
    font-size: 20px;

    color: #000;

    cursor: pointer;
    transition: all 0.3s ease;

    outline: none !important;
    box-shadow: none !important;

    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}

#contraste-btn:hover {
    color: #ffffff;
}

#contraste-btn:focus,
#contraste-btn:active,
#contraste-btn:focus-visible {
    outline: none !important;
    box-shadow: none !important;
    background: transparent !important;
}

    </style>
</head>
<body>
    <div class="recover-container">
        <!-- HEADER -->
        <div class="recover-header">
            <div class="logo">
                <i class="fa-solid fa-leaf"></i>
                FARMI
            </div>
            <h2>Recuperar Senha</h2>
            <p>Insira seu email para receber instruções de recuperação</p>
        </div>

        <!-- INDICADOR DE PASSOS -->
        <div class="steps-indicator">
            <div class="step active"></div>
            <div class="step"></div>
            <div class="step"></div>
        </div>

        <!-- ALERTA OPCIONAL -->
        <!-- <div class="alert alert-success">
            <i class="fa-solid fa-check-circle"></i>
            <span>Código de verificação enviado para seu email!</span>
        </div> -->

        <!-- FORMULÁRIO -->
        <form id="recoverForm">
            <div class="form-group">
                <button id="contraste-btn" aria-label="Alterar contraste"><i class="fa-solid fa-circle-half-stroke"></i></button>

                <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Digite seu email cadastrado"
                    required
                >
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

        <!-- LINK PARA VOLTAR -->
        <div class="back-link">
            <a href="#">
                <i class="fa-solid fa-sign-in-alt"></i>
                Fazer Login
            </a>
        </div>
    </div>

        <script>


    const form = document.getElementById('recoverForm');
    const emailInput = document.getElementById('email');
    const btnEnviar = form.querySelector('.btn-primary');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const email = emailInput.value.trim();

        // =========================
        // VALIDAÇÃO EMAIL
        // =========================

        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email) {
            mostrarAlerta(
                'warning',
                'Informe seu email para continuar.'
            );

            emailInput.focus();
            return;
        }

        if (!regexEmail.test(email)) {
            mostrarAlerta(
                'warning',
                'Digite um email válido.'
            );

            emailInput.focus();
            return;
        }

        // =========================
        // LOADING BOTÃO
        // =========================

        const textoOriginal = btnEnviar.innerHTML;

        btnEnviar.innerHTML =
            '<i class="fa-solid fa-spinner fa-spin"></i> Enviando...';

        btnEnviar.disabled = true;

        // =========================
        // SIMULA ENVIO
        // =========================

        setTimeout(() => {

            btnEnviar.innerHTML =
                '<i class="fa-solid fa-check"></i> Link enviado!';

            btnEnviar.style.backgroundColor = '#4caf50';

            atualizarPassos();

            mostrarAlerta(
                'success',
                `Link de recuperação enviado para ${email}`
            );

            // redireciona depois
            setTimeout(() => {
                window.location.href = 'login.php';
            }, 2500);

        }, 2000);
    });

    // =========================
    // ALERTAS
    // =========================

    function mostrarAlerta(tipo, mensagem) {

        // remove alerta antigo
        const alertaExistente =
            document.querySelector('.alert');

        if (alertaExistente) {
            alertaExistente.remove();
        }

        // cria alerta
        const alerta = document.createElement('div');

        alerta.className = `alert alert-${tipo}`;

        alerta.innerHTML = `
            <i class="fa-solid ${
                tipo === 'success'
                    ? 'fa-check-circle'
                    : 'fa-triangle-exclamation'
            }"></i>

            <span>${mensagem}</span>
        `;

        // adiciona antes do formulário
        form.parentNode.insertBefore(alerta, form);

        // remove automaticamente
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }

    // =========================
    // PASSOS
    // =========================

    function atualizarPassos() {

        const passos =
            document.querySelectorAll('.step');

        passos[0].classList.remove('active');
        passos[0].classList.add('completed');

        passos[1].classList.add('active');
    }

    // =========================
    // ENTER NO INPUT
    // =========================

    emailInput.addEventListener('keydown', function (e) {

        if (e.key === 'Enter') {
            form.dispatchEvent(
                new Event('submit')
            );
        }
    });

    // =========================
    // CONTRASTE
    // =========================

    const contrasteBtn =
        document.getElementById('contraste-btn');

    // verifica se já estava ativado
    if (localStorage.getItem('altoContraste') === 'ativo') {
        document.body.classList.add('alto-contraste');
    }

    contrasteBtn.addEventListener('click', function () {

        document.body.classList.toggle('alto-contraste');

        // salva preferência
        if (
            document.body.classList.contains('alto-contraste')
        ) {
            localStorage.setItem(
                'altoContraste',
                'ativo'
            );
        } else {
            localStorage.removeItem(
                'altoContraste'
            );
        }
    });

    // =========================
    // REMOVE ESPAÇOS EMAIL
    // =========================

    emailInput.addEventListener('input', function () {

        this.value = this.value.replace(/\s/g, '');
    });
</script>
    

    <script src="./../script.js"></script>
</body>
</html>