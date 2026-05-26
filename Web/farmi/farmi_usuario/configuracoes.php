<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - Fazenda Inteligente</title>
    <!-- Ícones (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --verde-escuro: #052501;
            --verde-claro: #4bc714;
            --verde-claro-hover: #a2d4a5;
            --branco: #ffffff;
            --cinza-fundo: #f4f6f8;
            --texto-escuro: #333333;
            --sombra: 0 4px 6px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial';
        }

        body {
            background-color: var(--cinza-fundo);
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 250px;
            background-color: var(--verde-escuro);
            color: var(--branco);
            display: flex;
            flex-direction: column;
            padding: 20px;
            position: fixed;
            height: 100%;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            color: var(--verde-claro);
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: 0.3s;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255,255,255,0.1);
            color: var(--verde-claro);
        }

        .menu-item i {
            margin-right: 15px;
            width: 20px;
        }

        /* --- CONTEÚDO PRINCIPAL --- */
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 30px;
        }

        .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    gap: 20px;
    flex-wrap: wrap;
}

/* agrupa avatar + botão */
.header-right {
    display: flex;
    align-items: center;
    gap: 15px;
}

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background-color: var(--verde-claro);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--verde-escuro);
            font-weight: bold;
        }

        /* --- CARDS DE CONFIGURAÇÕES --- */
        .config-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: var(--branco);
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--sombra);
            border-left: 5px solid var(--verde-escuro);
        }

        .card h3 {
            color: var(--verde-escuro);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* --- PERFIL --- */
        .profile-section {
            text-align: center;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px;
            border: 4px solid var(--verde-claro);
            overflow: hidden;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.3s;
        }

        .profile-photo:hover {
            border-color: var(--verde-escuro);
        }

        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-photo i {
            font-size: 3rem;
            color: var(--verde-claro);
        }

        .profile-photo .upload-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: var(--verde-escuro);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info h4 {
            color: var(--verde-escuro);
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .profile-info p {
            color: #666;
        }

        /* --- FORMULÁRIOS --- */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: var(--texto-escuro);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--verde-claro);
        }

        .form-group input[readonly] {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }

        /* --- BOTÕES --- */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: var(--verde-escuro);
            color: var(--branco);
        }

        .btn-primary:hover {
            background-color: #4bc714;
        }

        .btn-secondary {
            background-color: var(--verde-claro);
            color: var(--branco);
        }

        .btn-secondary:hover {
            background-color: #3da80e;
        }

        .btn-danger {
            background-color: #d32f2f;
            color: var(--branco);
        }

        .btn-danger:hover {
            background-color: #b71c1c;
        }

        .btn-outline {
            background-color: #000;
            border: 2px solid var(--verde-escuro);
            color: var(--branco);
        }

        .btn-outline:hover {
            background-color: #3da80e;
            color: var(--branco);
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-group .btn {
            flex: 1;
        }

        /* --- ALERTAS --- */
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
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

        .alert-error {
            background-color: rgba(244, 67, 54, 0.2);
            color: #d32f2f;
            border-left: 4px solid #d32f2f;
        }

        /* --- SEÇÃO DE SEGURANÇA --- */
        .security-section {
            background: var(--branco);
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--sombra);
            margin-bottom: 30px;
        }

        .security-section h3 {
            color: var(--verde-escuro);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .security-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .security-item:last-child {
            border-bottom: none;
        }

        .security-item .info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .security-item .info i {
            color: var(--verde-claro);
            font-size: 1.2rem;
        }

        .security-item .info span {
            color: var(--texto-escuro);
        }

        /* --- FOOTER --- */
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 0.9rem;
        }

        /* --- UPLOAD INPUT --- */
        .file-input {
            display: none;
        }
       

        /* --- RESPONSIVO --- */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .config-grid {
                grid-template-columns: 1fr;
            }
        }
        .alterar {
            text-decoration: none;
            color: #fff;
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

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Funcionário
        </div>
        <nav>
            <a href="dashboard.php" class="menu-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="luz.php" class="menu-item "><i class="fa-solid fa-lightbulb"></i> Luz</a>
            <a href="temperatura.php" class="menu-item"><i class="fa-solid fa-temperature-high"></i> Temperatura</a>
            <a href="umidade.php" class="menu-item"><i class="fa-solid fa-droplet"></i> Umidade</a>
            <a href="solo.php" class="menu-item"><i class="fa-solid fa-chart-pie"></i> Solo</a>
            <a href="configuracoes.php" class="menu-item active"><i class="fa-solid fa-gear"></i> Configurações</a>
            

        </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
        
        <!-- CABEÇALHO -->
        <!-- CABEÇALHO -->
        <header class="header">
    <div>
        <h2>Configurações</h2>
        <p style="color: #666;">
            Edite seu perfil.
        </p>
    </div>

    <div class="header-right">
        <button id="contraste-btn" aria-label="Alterar contraste">
            <i class="fa-solid fa-circle-half-stroke"></i>
        </button>

        <div class="user-profile">
            <div class="avatar">FUN</div>
        </div>
    </div>
</header>

        <!-- ALERTA DE SUCESSO -->
        <div class="alert alert-success">
            <i class="fa-solid fa-check-circle"></i>
            <span>Configurações salvas com sucesso!</span>
        </div>

        <!-- CONFIGURAÇÕES DE PERFIL -->
        <div class="config-grid">
            
            

            <!-- INFORMAÇÕES DE CONTATO -->
            <div class="card">
                <h3><i class="fa-solid fa-address-book"></i> Informações de Contato</h3>
                <div class="form-group">
                    <label>Nome Completo:</label>
                    <input type="text"  name="nome" id="name" placeholder="Nome...." >
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" placeholder="nome@email.com" >
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="tel" name="number" id="tel"  placeholder="(00)00000-0000">
                </div>
                <div class="btn-group">
                    <button class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Salvar
                    </button>
                    <button class="btn btn-secondary">
                        <i class="fa-solid fa-undo"></i> Cancelar
                    </button>
                </div>
            </div>

        </div>

        <!-- SEGURANÇA -->
        <div class="security-section">
            <h3><i class="fa-solid fa-shield-alt"></i> Segurança</h3>
            
            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-lock"></i>
                    <span>Senha</span>
                </div>
                <button class="btn btn-outline">
                    <a href="alterar_senha.php " class="alterar"><i class="fa-solid fa-envelope-open-text"></i></i> Alterar senha</a>
                </button>
            </div>

            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-envelope"></i> 
                    <span>Esqueci minha senha</span>
                </div>
                <button class="btn btn-secondary">
                    <a href="recuperar_senha.php" class="alterar"><i class="fa-solid fa-envelope-open-text"></i> Recuperar</a>
                </button>
            </div>

            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
            <script src="./../script.js"></script>
</body>
</html>

<script>
const name = document.getElementById('name');

if(name){

    name.addEventListener('keyup', (e) => {
        let value = e.target.value;

        // REMOVE TUDO QUE NÃO FOR LETRA OU ESPAÇO
        value = value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');

        // REMOVE ESPAÇOS DUPLOS
        value = value.replace(/\s+/g, ' ');

        e.target.value = value;
    });

}
const text = document.getElementById('tel');
document.addEventListener('DOMContentLoaded', function () {
    

    if (!tel) return;

    tel.addEventListener('input', function () {
        // console.log('teste');
        let v = tel.value.replace(/\D/g, ''); // só números

        // limita 11 dígitos
        v = v.slice(0, 11);

        // (DD) + número
        if (v.length <= 2) {
            v = v.replace(/(\d{0,2})/, '($1');
        } 
        else if (v.length <= 6) {
            v = v.replace(/(\d{2})(\d+)/, '($1) $2');
        } 
        else if (v.length <= 10) {
            v = v.replace(/(\d{2})(\d{4})(\d+)/, '($1) $2-$3');
        } 
        else {
            v = v.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        }

        tel.value = v;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const email = document.querySelector('#email');

    if (!email) return;

    email.addEventListener('blur', function () {
        const v = email.value;

        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (v && !regex.test(v)) {
            alert('Email inválido!');
            email.style.border = '2px solid red';
        } else {
            email.style.border = '';
        }
    });
});
</script>


                    
