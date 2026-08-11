<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Ícone do site-->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        a{
            text-decoration: none;
            color:#fff;
        }
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Arial'}

        body{
            background: #052501;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px}

        .container{background:white;
            padding:30px;
            border-radius:16px;
            box-shadow:0 20px 40px rgba(0,0,0,0.1);
            width:100%;
            max-width:350px;
            text-align:center}

        .header{margin-bottom:25px}

        .header i{font-size:2.5rem;
            color: #4bc714;
            margin-bottom:10px}

        h1{color: #4bc714;
            font-size:1.3rem;
            margin-bottom:5px}

        .info{margin-bottom:25px}

        .avatar{width:80px;
            height:80px;
            border-radius:50%;
            margin:0 auto 15px;
            border:4px solid #4bc714;
            background: #4bc714;
            color: #052501;
            font-weight:bold;
            font-size:1.5rem;
            display:flex;
            align-items:center;
            justify-content:center}

        .nome{color: #052501;
            font-size:1.1rem;
            font-weight:500;
            margin-bottom:5px}

        .email{color: #052501;
            font-size:0.9rem}

        .btn{width:100%;
            padding:14px;
            border:none;
            border-radius:8px;
            font-weight:bold;
            cursor:pointer;
            transition:all 0.3s;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            font-size:1rem;
            margin-bottom:10px}

        .logout{background:#d32f2f;
            color:white}

        .logout:hover{background:#b71c1c;
            transform:translateY(-1px)}

        .foto{background:transparent;
            color:#2E7D32;
            border:2px solid #2E7D32}

        .foto:hover{background:#2E7D32;
            color:white}

        .back{margin-top:15px}

        .back a{color: #052501;
            text-decoration:none;
            font-weight:500;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:5px}

        .back a:hover{text-decoration:underline}

        @media(max-width:480px){.container{padding:25px 20px}}
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
    <div class="container">
        <div class="header">
            <i class="fas fa-user"></i>
            <h1>Meu Perfil</h1>
        </div>

        <div class="info">
            <div class="avatar" id="avatar">JD</div>
            <div class="nome" id="nomeUsuario">João da Silva</div>
            <div class="email" id="emailUsuario">joao@farmsi.com</div>
        </div>

        <button id="logoutBtn" class="btn logout">
            <a href="dashboard.php">
                <i class="fas fa-sign-out-alt"></i> Sair da Conta
            </a>
        </button>

        <div class="back">
            <a href="dashboard.php">
                <i class="fas fa-arrow-left"></i> Voltar ao Dashboard
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
        // Dados do usuário 
        const usuario = {
            nome: 'João da Silva',
            email: 'joao@farmsi.com',
            initials: 'FUN'
        };

        // Preenche perfil
        document.getElementById('avatar').textContent = usuario.initials;
        document.getElementById('nomeUsuario').textContent = usuario.nome;
        document.getElementById('emailUsuario').textContent = usuario.email;

        // Logout
        document.getElementById('logoutBtn').onclick = function() {
            if(confirm('Deseja realmente sair da conta?')){
                // Limpa dados locais
                localStorage.clear();
                sessionStorage.clear();
                
                // Redireciona para login
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 500);
            }
        };
    </script>
    <script src="./../script.js"></script>
</body>
</html>