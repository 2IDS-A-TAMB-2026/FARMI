<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Ícone do site-->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
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
body.contraste #contraste-btn {
    background: #000 !important;
    border: none !important;
    box-shadow: none !important;
}

body.contraste #contraste-btn i {
    color: #fff !important;
}

body.contraste #contraste-btn,
body.contraste #contraste-btn * {
    border-color: transparent !important;
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
            width: 37px;
            height: 37px;
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
    background: #fff;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    border: 1px solid #eee;
    transition: 0.3s;
}

.card:hover {
    box-shadow: 0 12px 35px rgba(0,0,0,0.12);
}

       h3 {
    font-size: 18px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #2e2e2e;
    margin-bottom: 20px;
}

h3 i {
    color: #58CC02;
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
    color: var(--verde-escuro);
}

.btn-secondary:hover {
    background-color: var(--verde-claro-hover);
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
        /* ==========================================================================
   PADRONIZAÇÃO ACESSIBILIDADE E LOGOUT (MODELO DASHBOARD)
   ========================================================================== */
#aumentar-fonte,
#diminuir-fonte,
#resetar-fonte {
    background: #57c91b;
    border: none;
    border-radius: 8px;
    width: 42px;
    height: 42px;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s;
    color: #fff;
    font-size: 16px;
}

#aumentar-fonte:hover,
#diminuir-fonte:hover,
#resetar-fonte:hover {
    opacity: .85;
}

.btn-logout {
    background: #57c91b;
    color: #fff;
    text-decoration: none;
    width: 116px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 16px;
    font-weight: 600;
}

/* AUTO CONTRASTE */
body.contraste .btn-logout {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}

body.contraste .btn-logout i {
    color: #fff !important;
}

body.contraste #aumentar-fonte,
body.contraste #diminuir-fonte,
body.contraste #resetar-fonte {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}
        /* =========================
   TODOS OS ELEMENTOS
========================= */

/* 
Seleciona TODOS os elementos dentro do body
quando o alto contraste estiver ativo

O * significa "todos os elementos"
*/
body.contraste * {

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
body.contraste div,
body.contraste section,
body.contraste main,
body.contraste aside,
body.contraste nav,
body.contraste header,
body.contraste footer,
body.contraste form {

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
body.contraste input,
body.contraste select,
body.contraste textarea {

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
body.contraste input::placeholder {

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
body.contraste button,
body.contraste .btn,
body.contraste .logout-btn,
body.contraste .fonte-btn {
    background: #fff !important;
    color: #000 !important;
    border: 2px solid #fff !important;
}

body.contraste button *,
body.contraste .btn *,
body.contraste .logout-btn *,
body.contraste .fonte-btn * {
    color: #000 !important;
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
body.contraste table,
body.contraste thead,
body.contraste tbody,
body.contraste tr,
body.contraste td,
body.contraste th {

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
body.contraste i {

    /* deixa os ícones brancos */
    color: #fff !important;
}
body.contraste .chart-container {
    background: #222426 !important;
    border: 2px solid white;
    border-radius: 10px;
}



#contraste-btn:hover {
    color: #000000;
}

#contraste-btn:focus,
#contraste-btn:active,
#contraste-btn:focus-visible {
    outline: none !important;
    box-shadow: none !important;
    background: transparent !important;
}

/* BOTÕES DE ACESSIBILIDADE */
.accessibility-controls{
    display:flex;
    gap:10px;
    align-items:center;
}

.accessibility-btn {
    width: 42px; /* Padronizado */
    height: 42px; /* Padronizado */
    background-color: #58CC02;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center; /* Centraliza perfeitamente o "A+" */
    transition: 0.3s;
}

.accessibility-btn:hover {
    background-color: #46A302;
}

.accessibility-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.accessibility-btn {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    background: var(--verde-escuro);
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: .3s;

    display: flex;
    align-items: center;
    justify-content: center;
}

.accessibility-btn:hover {
    background: var(--verde-claro);
    color: var(--verde-escuro);
}

/* BOTÕES DE ACESSIBILIDADE */
.accessibility-controls{
    display:flex;
    align-items:center;
    gap:10px;
}

.accessibility-btn{
    width:40px;
    height:40px;
    border:none;
    border-radius:50%;
    background:#052501;
    color:#fff;
    cursor:pointer;
    font-weight:bold;
    font-size:16px;
    transition:0.3s;

    display:flex;
    align-items:center;
    justify-content:center;
}

.accessibility-btn:hover{
    background:#4bc714;
    color:#052501;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 15px; /* Ajustado de 10px para 15px igual ao dADMIN */
}

/* LOGOUT */
.logout-btn {
    background: #58CC02;
    color: white;
    text-decoration: none;
    height: 42px; /* Padronizado */
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 0 18px; /* Padding vertical zerado porque a altura já está fixa */
    border-radius: 10px;
    font-weight: bold;
    transition: 0.3s;
}

.logout-btn:hover {
    background: #46A302;
    color: white;
}
.campo-visualizacao {
    width: 100%;
    padding: 14px 16px;
    border-radius: 12px;
    background: linear-gradient(145deg, #f9f9f9, #f1f1f1);
    border: 1px solid #e3e3e3;
    font-size: 15px;
    color: #333;
    min-height: 45px;
    display: flex;
    align-items: center;
    transition: 0.3s;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.campo-visualizacao:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.1);
    border-color: #58CC02;
}

/* CONTRASTE */
#contraste-btn {
    background: transparent !important;
    border: none !important;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px; /* Padronizado */
    height: 42px; /* Padronizado */
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

/* A+, A-, A */
.fonte-btn{
    width:40px;
    height:40px;

    border:none;
    border-radius:10px;

    background:#4bc714;
    color:#fff;

    font-weight:bold;
    font-size:20px;

    cursor:pointer;
}

.fonte-btn:hover{
    background:#3da510;
}

/* AVATAR */
.avatar {
    width: 42px; /* Padronizado */
    height: 42px; /* Padronizado */
    background-color: var(--verde-claro);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: var(--verde-escuro);
    font-weight: bold;
}

/* ==========================================================
CONFIGURAÇÕES - RESPONSIVIDADE ESPECÍFICA
========================================================== */

* {
  box-sizing: border-box;
  }
  html,
  body {
  max-width: 100%;
  overflow-x: hidden;
  }
  .main-content {
  min-width: 0;
  width: calc(100% - 260px);
  max-width: 100%;
  }
  .config-grid {
  display: grid;
  grid-template-columns: minmax(0, 1fr);
  width: 100%;
  max-width: 100%;
  gap: 20px;
  }
  .config-grid .card {
  width: 100%;
  min-width: 0;
  }
  .form-group {
  width: 100%;
  min-width: 0;
  }
  .campo-visualizacao {
  width: 100%;
  max-width: 100%;
  min-width: 0;
  overflow-wrap: break-word;
  word-break: break-word;
  }
  .security-section {
  width: 100%;
  max-width: 100%;
  margin-top: 20px;
  min-width: 0;
  }
  .security-item {
  width: 100%;
  min-width: 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  }
  .security-item .info {
  min-width: 0;
  display: flex;
  align-items: center;
  gap: 10px;
  }
  .security-item .info span {
  overflow-wrap: break-word;
  }
  .security-item a {
  flex-shrink: 0;
  }
  .btn {
  max-width: 100%;
  }
  .header {
  width: 100%;
  max-width: 100%;
  min-width: 0;
  }
  .header > div:first-child {
  min-width: 0;
  }
  .header > div:first-child h2 {
  overflow-wrap: break-word;
  }
  .header > div:last-child {
  max-width: 100%;
  flex-wrap: wrap;
  }
  .btn-logout {
  white-space: nowrap;
  }
  .avatar {
  flex-shrink: 0;
  }
  #aumentar-fonte,
  #diminuir-fonte,
  #resetar-fonte,
  #contraste-btn {
  flex-shrink: 0;
  }
  /* ==========================================================
  TABLET E NOTEBOOK
  ========================================================== */
  @media (max-width: 1100px) {
  .main-content {
  width: calc(100% - 260px);
  padding: 25px;
  }
  .header {
  gap: 20px;
  }
  .config-grid {
  grid-template-columns: 1fr;
  }
  }
  /* ==========================================================
  TABLET
  ========================================================== */
  @media (max-width: 768px) {
  .main-content {
  margin-left: 0 !important;
  width: 100% !important;
  max-width: 100%;
  padding: 75px 15px 25px;
  }
  .header {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 15px;
  margin-bottom: 20px;
  }
  .header > div:first-child {
  width: 100%;
  }
  .header h2 {
  font-size: 22px;
  line-height: 1.3;
  }
  .header p {
  font-size: 14px;
  line-height: 1.5;
  }
  .header > div:last-child {
  width: 100%;
  display: flex !important;
  align-items: center;
  justify-content: flex-start;
  flex-wrap: wrap;
  gap: 8px !important;
  }
  .btn-logout {
  margin-right: 0;
  }
  .config-grid {
  width: 100%;
  grid-template-columns: 1fr;
  gap: 15px;
  }
  .config-grid .card {
  width: 100%;
  padding: 20px;
  }
  .card h3 {
  font-size: 18px;
  line-height: 1.4;
  flex-wrap: wrap;
  }
  .campo-visualizacao {
  padding: 13px 14px;
  min-height: 44px;
  font-size: 15px;
  }
  .security-section {
  width: 100%;
  padding: 20px;
  margin-top: 15px;
  }
  .security-section h3 {
  font-size: 18px;
  }
  .security-item {
  flex-wrap: wrap;
  gap: 15px;
  padding: 15px 0;
  }
  .security-item .info {
  flex: 1 1 200px;
  }
  .security-item a {
  width: auto;
  max-width: 100%;
  }
  .security-item .btn {
  max-width: 100%;
  }
  }
  /* ==========================================================
  CELULAR
  ========================================================== */
  @media (max-width: 600px) {
  .main-content {
  padding: 70px 12px 20px;
  }
  .header {
  gap: 12px;
  }
  .header h2 {
  font-size: 20px;
  }
  .header p {
  font-size: 13px;
  }
  .header > div:last-child {
  width: 100%;
  gap: 7px !important;
  }
  .btn-logout {
  width: 100%;
  flex-basis: 100%;
  height: 42px;
  margin-right: 0;
  }
  #contraste-btn,
  #aumentar-fonte,
  #diminuir-fonte,
  #resetar-fonte,
  .avatar {
  width: 40px;
  height: 40px;
  }
  .config-grid {
  gap: 12px;
  }
  .config-grid .card {
  padding: 16px;
  border-radius: 14px;
  }
  .card h3 {
  font-size: 17px;
  margin-bottom: 18px;
  }
  .form-group {
  margin-bottom: 15px;
  }
  .form-group label {
  font-size: 13px;
  }
  .campo-visualizacao {
  padding: 12px;
  font-size: 14px;
  min-height: 42px;
  }
  .security-section {
  padding: 16px;
  margin-top: 12px;
  border-radius: 14px;
  }
  .security-section h3 {
  font-size: 17px;
  margin-bottom: 15px;
  }
  .security-item {
  display: flex;
  flex-direction: column;
  align-items: stretch;
  gap: 12px;
  }
  .security-item .info {
  width: 100%;
  }
  .security-item a {
  width: 100%;
  }
  .security-item .btn {
  width: 100%;
  min-height: 42px;
  justify-content: center;
  }
  }
  /* ==========================================================
  CELULAR PEQUENO
  ========================================================== */
  @media (max-width: 480px) {
  .main-content {
  padding: 70px 10px 20px;
  }
  .header h2 {
  font-size: 19px;
  }
  .header p {
  font-size: 13px;
  }
  .header > div:last-child {
  gap: 6px !important;
  }
  .btn-logout {
  width: 100%;
  flex-basis: 100%;
  }
  #contraste-btn,
  #aumentar-fonte,
  #diminuir-fonte,
  #resetar-fonte,
  .avatar {
  width: 38px;
  height: 38px;
  }
  .config-grid .card {
  padding: 14px;
  }
  .card h3 {
  font-size: 16px;
  }
  .campo-visualizacao {
  font-size: 14px;
  padding: 11px;
  }
  .security-section {
  padding: 14px;
  }
  .security-item .info {
  font-size: 14px;
  }
  }
  /* ==========================================================
  MENU SANDUÍCHE
  ========================================================== */
  .menu-toggle {
    display: none;
}

  @media (max-width: 768px) {
  .menu-toggle {
  display: flex;
  position: fixed;
  top: 15px;
  left: 15px;
  width: 45px;
  height: 45px;
  border: none;
  border-radius: 10px;
  background: #58CC02;
  color: #fff;
  font-size: 22px;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  z-index: 1100;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.25);
  }
  .menu-toggle:hover {
  background: #46A302;
  }
  .sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: 260px;
  height: 100vh;
  z-index: 1000;
  transform: translateX(-100%);
  transition: transform 0.3s ease;
  overflow-y: auto;
  }
  .sidebar.active {
  transform: translateX(0);
  }
  .menu-overlay {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.5);
  z-index: 999;
  }
  .menu-overlay.active {
  display: block;
  }
  }
  @media (max-width: 480px) {
  .menu-toggle {
  top: 12px;
  left: 12px;
  width: 42px;
  height: 42px;
  }
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
            <a href="<?= base_url('/dashboard-usuario') ?>" class="menu-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="<?= base_url('/luz') ?>" class="menu-item "><i class="fa-solid fa-lightbulb"></i> Luz</a>
            <a href="<?= base_url('/temperatura') ?>" class="menu-item"><i class="fa-solid fa-temperature-high"></i> Temperatura</a>
            <a href="<?= base_url('/umidade') ?>" class="menu-item"><i class="fa-solid fa-droplet"></i> Umidade</a>
            <a href="<?= base_url('/solo') ?>" class="menu-item"><i class="fa-solid fa-chart-pie"></i> Solo</a>
            <a href="<?= base_url('/alertas-usuario') ?>" class="menu-item"><i class="fa-solid fa-triangle-exclamation"></i>Alertas</a>
            <a href="<?= base_url('/configuracoes-usuario') ?>" class="menu-item active"><i class="fa-solid fa-gear"></i> Configurações</a>
        </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">

    <!-- Menu sanduíche -->
    <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu">
        <i class="fa-solid fa-bars"></i>
    </button>
        
        <!-- CABEÇALHO -->
        <!-- CABEÇALHO -->
        <header class="header">
    <div>
        <h2>Configurações</h2>
        <p style="color: #666;">
            Edite seu perfil.
        </p>
    </div>

   <div style="display:flex; align-items:center; gap:15px;">

    <!-- BOTÃO VOLTAR PARA LOGIN -->
    <a href="<?= base_url('/logout') ?>" class="btn-logout">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>

    <!-- CONTRASTE -->
    <button id="contraste-btn">
        <i class="fa-solid fa-circle-half-stroke"></i>
    </button>

    <!-- ACESSIBILIDADE DE FONTE -->
    <button id="aumentar-fonte" aria-label="Aumentar fonte">A+</button>
    <button id="diminuir-fonte" aria-label="Diminuir fonte">A-</button>
    <button id="resetar-fonte" aria-label="Resetar fonte">A</button>

    <!-- AVATAR -->
    <div class="avatar">F</div>

</div>

</div>
</header>

        <!-- ALERTA DE SUCESSO -->

        <!-- CONFIGURAÇÕES DE PERFIL -->
        <div class="config-grid">
            
            

            <!-- INFORMAÇÕES DE CONTATO -->
            <div class="card">
    <h3><i class="fa-solid fa-user"></i> Meu Perfil</h3>

    <div class="form-group">
        <label>Nome Completo:</label>
        <div class="campo-visualizacao">
            <?= esc($usuario['NOME']) ?>
        </div>
    </div>

    <div class="form-group">
        <label>CPF:</label>
        <div class="campo-visualizacao">
            <?= esc($usuario['CPF']) ?>
        </div>
    </div>

    <div class="form-group">
        <label>Email:</label>
        <div class="campo-visualizacao">
            <?= esc($usuario['EMAIL']) ?>
        </div>
    </div>

    <div class="form-group">
        <label>Telefone:</label>
        <div class="campo-visualizacao">
            <?= esc($usuario['TELEFONE'] ?? 'Não informado') ?>
        </div>
    </div>

    <div class="form-group">
        <label>Perfil:</label>
        <div class="campo-visualizacao">
            <?= esc($usuario['PERFIL']) ?>
        </div>
    </div>
    <div class="form-group">
    <label>Data de cadastro:</label>
    <div class="campo-visualizacao">
        <?= isset($usuario['DATA_CADASTRO']) 
            ? date('d/m/Y H:i', strtotime($usuario['DATA_CADASTRO'])) 
            : 'Não informado' ?>
    </div>
</div>
    <div class="form-group">
        <label>Status:</label>
        <div class="campo-visualizacao">
            <?= esc($usuario['STATUS']) ?>
        </div>
    </div>
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
                    <a href="<?= base_url('/alterar-senha') ?>" class="alterar"><i class="fa-solid fa-envelope-open-text"></i></i> Alterar senha</a>
                </button>
            </div>

            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-envelope"></i> 
                    <span>Esqueci minha senha</span>
                </div>
                <button class="btn btn-secondary">
                    <a href="<?= base_url('/recuperar-senha') ?>" class="alterar"><i class="fa-solid fa-envelope-open-text"></i> Recuperar</a>
                </button>
            </div>

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

        <script src="./../script.js"></script>

<!-- SCRIPT UNIFICADO E CORRIGIDO -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // ==========================================
    // 1. ACESSIBILIDADE: ALTO CONTRASTE
    // ==========================================
    const contrasteBtn = document.getElementById('contraste-btn');

    if (contrasteBtn) {
        // Verifica se já estava ativo no localStorage ao carregar a página
        if (localStorage.getItem('altoContraste') === 'true') {
            document.body.classList.add('contraste');
        }

        contrasteBtn.addEventListener('click', () => {
            document.body.classList.toggle('contraste'); 
            const ativo = document.body.classList.contains('contraste');
            localStorage.setItem('altoContraste', ativo);
        });
    }

    // ==========================================
    // 2. ACESSIBILIDADE: TAMANHO DA FONTE
    // ==========================================
    let tamanhoFonte = 100;

    function aplicarFonte() {
        // Altera o root (html) para que as fontes em rem/em funcionem proporcionalmente
        document.documentElement.style.fontSize = tamanhoFonte + '%';
        localStorage.setItem('tamanhoFonteDashboard', tamanhoFonte);
    }

    const aumentarFonte = document.getElementById('aumentar-fonte');
    const diminuirFonte = document.getElementById('diminuir-fonte');
    const resetarFonte = document.getElementById('resetar-fonte');

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

    // Carrega a fonte salva no localStorage
    const fonteSalva = localStorage.getItem('tamanhoFonteDashboard');
    if (fonteSalva) {
        tamanhoFonte = parseInt(fonteSalva);
        aplicarFonte();
    }

    // ==========================================
    // 3. VALIDAÇÕES DOS INPUTS (NOME, TEL, EMAIL)
    // ==========================================
    const nameInput = document.getElementById('name');
    if (nameInput) {
        nameInput.addEventListener('keyup', (e) => {
            let value = e.target.value;
            value = value.replace(/[^a-zA-ZÀ-ÿ\s]/g, ''); // Apenas letras
            value = value.replace(/\s+/g, ' '); // Remove espaços duplos
            e.target.value = value;
        });
    }

    const telInput = document.getElementById('tel'); // Corrigido de 'text' para 'telInput'
    if (telInput) {
        telInput.addEventListener('input', function () {
            let v = telInput.value.replace(/\D/g, ''); // Só números
            v = v.slice(0, 11);

            if (v.length <= 2) {
                v = v.replace(/(\d{0,2})/, '($1');
            } else if (v.length <= 6) {
                v = v.replace(/(\d{2})(\d+)/, '($1) $2');
            } else if (v.length <= 10) {
                v = v.replace(/(\d{2})(\d{4})(\d+)/, '($1) $2-$3');
            } else {
                v = v.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            }
            telInput.value = v;
        });
    }

    const emailInput = document.querySelector('#email');
    if (emailInput) {
        emailInput.addEventListener('blur', function () {
            const v = emailInput.value;
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (v && !regex.test(v)) {
                alert('Email inválido!');
                emailInput.style.border = '2px solid red';
            } else {
                emailInput.style.border = '';
            }
        });
    }
});
</script>

<script>
    // =========================
    // MENU SANDUÍCHE
    // =========================
    document.addEventListener('DOMContentLoaded', function () {

        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');

        // Cria o fundo escuro
        const overlay = document.createElement('div');
        overlay.classList.add('menu-overlay');

        document.body.appendChild(overlay);


        // Abrir e fechar menu
        menuToggle.addEventListener('click', function () {

            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');

            const aberto = sidebar.classList.contains('active');

            // Troca o ícone
            if (aberto) {
                menuToggle.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                menuToggle.setAttribute('aria-label', 'Fechar menu');
            } else {
                menuToggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
                menuToggle.setAttribute('aria-label', 'Abrir menu');
            }

        });


        // Fecha ao clicar no fundo escuro
        overlay.addEventListener('click', function () {

            sidebar.classList.remove('active');
            overlay.classList.remove('active');

            menuToggle.innerHTML =
                '<i class="fa-solid fa-bars"></i>';

            menuToggle.setAttribute(
                'aria-label',
                'Abrir menu'
            );

        });


        // Fecha o menu ao clicar em um item
        const menuItems =
            document.querySelectorAll('.sidebar .menu-item');

        menuItems.forEach(function (item) {

            item.addEventListener('click', function () {

                if (window.innerWidth <= 768) {

                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');

                    menuToggle.innerHTML =
                        '<i class="fa-solid fa-bars"></i>';

                    menuToggle.setAttribute(
                        'aria-label',
                        'Abrir menu'
                    );

                }

            });

        });

    });
    </script>

</body>
</html>