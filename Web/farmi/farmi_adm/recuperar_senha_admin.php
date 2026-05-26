<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - Fazenda Inteligente</title>

    <!-- Ícones (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="../style_recuperar.css">

    <style>
        /* VALIDAÇÃO VISUAL */
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

        <!-- FORMULÁRIO -->
        <form id="recoverForm">

            <div class="form-group">

                <button id="contraste-btn" aria-label="Alterar contraste" type="button">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>

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

            <!-- BOTÃO -->
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-paper-plane"></i>
                Enviar Link de Recuperação
            </button>

            <!-- VOLTAR -->
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                <i class="fa-solid fa-arrow-left"></i>
                Voltar
            </button>

        </form>

        <!-- LOGIN -->
        <div class="back-link">
            <a href="login_admin.php">
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