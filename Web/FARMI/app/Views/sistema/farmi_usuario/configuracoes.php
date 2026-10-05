<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Ícone do site-->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <title>Configurações - Fazenda Inteligente</title>

    <!-- Aplica o tamanho da fonte ANTES de renderizar (evita o layout "pular").
         Usa a mesma chave do dashboard ('fonteSite', em px), então o tamanho
         escolhido vale para todas as telas. -->
    <script>
    (function () {
        var f = parseInt(localStorage.getItem('fonteSite'));
        if (isNaN(f)) f = 16;
        f = Math.min(20, Math.max(14, f));
        document.documentElement.style.fontSize = f + 'px';
    })();
    </script>

    <!-- Ícones (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           Tudo que é texto, botão, ícone e sidebar usa rem, assim
           A+ / A- escalam a tela inteira junto (1rem = fonte do <html>).
        ========================================================== */
        :root {
            --verde-escuro: #052501;
            --verde-claro: #4bc714;
            --verde-claro-hover: #a2d4a5;
            --branco: #ffffff;
            --cinza-fundo: #f4f6f8;
            --texto-escuro: #333333;
            --sombra: 0 4px 6px rgba(0,0,0,0.1);
            --largura-sidebar: 14rem;     /* 224px a 16px */
            --botao-topo: 2.625rem        /* 36px a 16px */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: var(--cinza-fundo);
            display: flex;
            min-height: 100vh;
        }

        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--largura-sidebar);
            background-color: var(--verde-escuro);
            color: var(--branco);
            display: flex;
            flex-direction: column;
            padding: 1.25rem;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 2.5rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.625rem;
            line-height: 1.2;
        }

        .logo i {
            color: var(--verde-claro);
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.9375rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 0.5rem;
            margin-bottom: 0.3125rem;
            transition: 0.3s;
            line-height: 1.3;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255,255,255,0.1);
            color: var(--verde-claro);
        }

        .menu-item i {
            margin-right: 0.9375rem;
            width: 1.25rem;
            flex-shrink: 0;
            text-align: center;
        }

        /* --- CONTEÚDO PRINCIPAL --- */
        .main-content {
            margin-left: var(--largura-sidebar);
            min-width: 0;
            width: calc(100% - var(--largura-sidebar));
            max-width: 100%;
            flex: 1;
            padding: 1.875rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.875rem;
            gap: 0.9375rem;
            flex-wrap: wrap;
        }

        .header h2 {
            color: var(--verde-escuro);
            font-size: 1.5rem;
        }

        .header-right {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        /* ==========================================================
           LAYOUT DE PERFIL
           ========================================================== */

        /* Hero / Card Principal do Usuário */
        .profile-hero {
            background: #ffffff;
            border-radius: 1rem;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            border: 1px solid #eef0f2;
            margin-bottom: 1.5rem;
        }

        .profile-user-info {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            min-width: 0;
        }

        .profile-avatar-large {
            width: 5.625rem;
            height: 5.625rem;
            border-radius: 50%;
            background: #e8f5e9;
            color: #2e7d32;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            border: 3px solid #58CC02;
            flex-shrink: 0;
        }

        .profile-details h2 {
            margin: 0 0 0.375rem 0;
            font-size: 1.375rem;
            color: #1a1a1a;
        }

        .badge-role {
            display: inline-block;
            background: #e8f5e9;
            color: #2e7d32;
            padding: 0.25rem 0.75rem;
            border-radius: 1.25rem;
            font-size: 0.8125rem;
            font-weight: 600;
            margin-bottom: 0.375rem;
        }

        .profile-subtext {
            color: #777;
            font-size: 0.875rem;
            margin: 0;
        }

        .hero-banner-right {
            text-align: right;
            max-width: 15.625rem;
            color: #666;
            font-size: 0.8125rem;
        }

        .hero-banner-right i {
            color: #58CC02;
            font-size: 1.5rem;
            margin-top: 0.5rem;
        }

        /* Layout em Grid (2 Colunas) */
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            min-width: 0;
        }

        .profile-card {
            background: #ffffff;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            border: 1px solid #eef0f2;
            min-width: 0;
        }

        .profile-card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.125rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .profile-card-header i {
            color: #58CC02;
            font-size: 1.25rem;
        }

        /* Lista de Informações Pessoais */
        .info-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 0.875rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #f8f9fa;
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-item i {
            font-size: 1rem;
            color: #777;
            margin-top: 0.1875rem;
            width: 1.25rem;
            flex-shrink: 0;
            text-align: center;
        }

        .info-content {
            min-width: 0;
        }

        .info-content label {
            display: block;
            font-size: 0.75rem;
            color: #888;
            font-weight: 600;
            margin-bottom: 0.125rem;
            text-transform: uppercase;
        }

        .info-content span {
            font-size: 0.9375rem;
            color: #333;
            font-weight: 500;
        }

        /* Cards da Direita (Informações da Conta) */
        .account-box-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .info-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.625rem;
            flex-wrap: wrap;
            min-width: 0;
        }

        .info-box-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .info-box-left i {
            color: #555;
            font-size: 1.125rem;
        }

        .info-box-title {
            font-size: 0.875rem;
            color: #555;
            font-weight: 500;
        }

        .info-box-value {
            font-size: 0.8125rem;
            font-weight: 600;
            color: #555;
        }

        .status-badge {
            background: #e8f5e9;
            color: #2e7d32;
            font-weight: bold;
            font-size: 0.8125rem;
            padding: 0.25rem 0.625rem;
            border-radius: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .status-badge::before {
            content: '';
            width: 0.5rem;
            height: 0.5rem;
            background: #2e7d32;
            border-radius: 50%;
        }

        .notice-card {
            background: #e8f5e9;
            border-left: 4px solid #58CC02;
            border-radius: 0.5rem;
            padding: 0.875rem;
            margin-top: 0.9375rem;
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
            min-width: 0;
        }

        .notice-card i {
            color: #2e7d32;
            font-size: 1.125rem;
            margin-top: 0.125rem;
        }

        .notice-card p {
            margin: 0;
            font-size: 0.8125rem;
            color: #2e7d32;
            line-height: 1.4;
        }

        /* Seção de Segurança */
        .security-section-new {
            margin-top: 1.5rem;
        }

        .sec-btn {
            background: #f8f9fa;
            border: 1px solid #ddd;
            color: #333;
            padding: 0.625rem 1.125rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.9375rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: 0.2s;
        }

        .sec-btn:hover {
            background: #e9ecef;
            color: #000;
        }

        /* Evita estouro de texto nos cards (nomes e e-mails longos) */
        .profile-details,
        .profile-details h2,
        .hero-banner-right,
        .info-box,
        .notice-card {
            min-width: 0;
        }

        .profile-details h2,
        .profile-subtext,
        .hero-banner-right span,
        .info-content span,
        .info-box-title,
        .notice-card p {
            overflow-wrap: anywhere;
        }

        /* ==========================================================
           BOTÕES DE ACESSIBILIDADE / LOGOUT / AVATAR
           ========================================================== */
        #aumentar-fonte,
        #diminuir-fonte,
        #resetar-fonte {
            background: #58CC02;
            border: none;
            border-radius: 0.4375rem;
            width: var(--botao-topo);
            height: var(--botao-topo);
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
            color: #fff;
            font-size: 0.8125rem;
        }

        #aumentar-fonte:hover,
        #diminuir-fonte:hover,
        #resetar-fonte:hover {
            background-color: #46A302;
        }

        .btn-logout {
            background: #58CC02;
            color: #fff;
            text-decoration: none;
            min-height: var(--botao-topo);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0 0.875rem;
            font-size: 0.875rem;
            border-radius: 0.625rem;
            font-weight: bold;
            white-space: nowrap;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #46A302;
            color: #fff;
        }

        #contraste-btn {
            background: transparent !important;
            border: none !important;
            display: flex;
            align-items: center;
            justify-content: center;
            width: var(--botao-topo);
            height: var(--botao-topo);
            font-size: 1.125rem;
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
            color: #46A302;
        }

        #contraste-btn:focus,
        #contraste-btn:active,
        #contraste-btn:focus-visible {
            outline: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }

        .avatar {
            width: var(--botao-topo);
            height: var(--botao-topo);
            min-width: var(--botao-topo);
            min-height: var(--botao-topo);
            background-color: var(--verde-claro);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--verde-escuro);
            font-weight: bold;
            font-size: 0.875rem;
            flex-shrink: 0;
            overflow: hidden;
        }

        /* ==========================================================
           ALTO CONTRASTE
           ========================================================== */
        body.alto-contraste * {
            color: #fff !important;
            border-color: #fff !important;
        }

        body.alto-contraste div,
        body.alto-contraste section,
        body.alto-contraste main,
        body.alto-contraste aside,
        body.alto-contraste nav,
        body.alto-contraste header,
        body.alto-contraste footer,
        body.alto-contraste form {
            background: #000 !important;
        }

        body.alto-contraste .profile-hero,
        body.alto-contraste .profile-card,
        body.alto-contraste .info-box,
        body.alto-contraste .notice-card,
        body.alto-contraste .security-section-new {
            background: #111 !important;
            border-color: #444 !important;
        }

        body.alto-contraste input,
        body.alto-contraste select,
        body.alto-contraste textarea {
            background: #000000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
        }

        body.alto-contraste input::placeholder {
            color: #ccc !important;
        }

        body.alto-contraste button,
        body.alto-contraste .btn,
        body.alto-contraste .btn-logout,
        body.alto-contraste .sec-btn,
        body.alto-contraste #aumentar-fonte,
        body.alto-contraste #diminuir-fonte,
        body.alto-contraste #resetar-fonte {
            background: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
        }

        body.alto-contraste button *,
        body.alto-contraste .btn *,
        body.alto-contraste .btn-logout *,
        body.alto-contraste .sec-btn * {
            color: #fff !important;
        }

        body.alto-contraste #contraste-btn {
            background: #000 !important;
            border: none !important;
            box-shadow: none !important;
        }

        body.alto-contraste #contraste-btn i {
            color: #fff !important;
        }

        body.alto-contraste .avatar,
        body.alto-contraste .profile-avatar-large {
            background: #fff !important;
            color: #000 !important;
        }

        body.alto-contraste .badge-role {
            background: #fff !important;
            color: #000 !important;
        }

        body.alto-contraste .badge-role i {
            color: #000 !important;
        }

        body.alto-contraste i {
            color: #fff !important;
        }

        /* ==========================================================
           MENU SANDUÍCHE
           ========================================================== */
        .menu-toggle {
            display: none;
        }

        /* ==========================================================
           RESPONSIVIDADE
           ========================================================== */
        @media (max-width: 992px) {
            .profile-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .profile-hero {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .hero-banner-right {
                text-align: left;
                max-width: 100%;
            }

            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                max-width: 100%;
                padding: 4.6875rem 0.9375rem 1.5625rem;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.9375rem;
            }

            .header-right {
                width: 100%;
                gap: 0.5rem;
            }

            .menu-toggle {
                display: flex;
                position: fixed;
                top: 0.9375rem;
                left: 0.9375rem;
                width: 2.5rem;
                height: 2.5rem;
                border: none;
                border-radius: 0.625rem;
                background: #58CC02;
                color: #fff;
                font-size: 1.125rem;
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
                width: var(--largura-sidebar);
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

        @media (max-width: 600px) {
            .header h2 {
                font-size: 1.1875rem;
            }

            .header-right {
                justify-content: flex-start;
                gap: 0.375rem;
            }

            .btn-logout {
                width: 100%;
                flex-basis: 100%;
            }

            .profile-avatar-large {
                width: 4.375rem;
                height: 4.375rem;
                font-size: 1.625rem;
            }

            .sec-btn {
                width: 100%;
                justify-content: center;
            }

            .security-section-new > div {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .menu-toggle {
                top: 0.75rem;
                left: 0.75rem;
                width: 2.375rem;
                height: 2.375rem;
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
            <a href="<?= base_url('/luz') ?>" class="menu-item"><i class="fa-solid fa-lightbulb"></i> Luz</a>
            <a href="<?= base_url('/temperatura') ?>" class="menu-item"><i class="fa-solid fa-temperature-high"></i> Temperatura</a>
            <a href="<?= base_url('/umidade') ?>" class="menu-item"><i class="fa-solid fa-droplet"></i> Umidade</a>
            <a href="<?= base_url('/solo') ?>" class="menu-item"><i class="fa-solid fa-chart-pie"></i> Solo</a>
            <a href="<?= base_url('/alertas-usuario') ?>" class="menu-item"><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
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
        <header class="header">
            <div>
                <h2>Configurações</h2>
                <p style="color: #666;">Visualize e edite seus dados pessoais.</p>
            </div>

            <div class="header-right">
                <a href="<?= base_url('/logout') ?>" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>

                <button id="contraste-btn" type="button" aria-label="Alterar contraste">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>

                <button id="aumentar-fonte" type="button" aria-label="Aumentar fonte">A+</button>
                <button id="diminuir-fonte" type="button" aria-label="Diminuir fonte">A-</button>
                <button id="resetar-fonte" type="button" aria-label="Resetar fonte">A</button>

                <div class="avatar">F</div>
            </div>
        </header>

        <!-- Hero do Perfil -->
        <div class="profile-hero">
            <div class="profile-user-info">
                <div class="profile-avatar-large">
                    <?= strtoupper(substr($usuario['NOME'] ?? 'F', 0, 1)) ?>
                </div>
                <div class="profile-details">
                    <h2><?= esc($usuario['NOME']) ?></h2>
                    <span class="badge-role">
                        <i class="fa-solid fa-user-check"></i> <?= esc($usuario['PERFIL']) ?>
                    </span>
                    <p class="profile-subtext">Membro da equipe FARMI</p>
                </div>
            </div>
            <div class="hero-banner-right">
                <span>Juntos por uma agricultura mais inteligente e sustentável.</span>
                <div><i class="fa-solid fa-leaf"></i></div>
            </div>
        </div>

        <!-- Layout em Duas Colunas -->
        <div class="profile-grid">

            <!-- Coluna 1: Informações Pessoais -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <i class="fa-solid fa-user"></i>
                    Informações Pessoais
                </div>

                <div class="info-list">
                    <div class="info-item">
                        <i class="fa-solid fa-user"></i>
                        <div class="info-content">
                            <label>Nome Completo</label>
                            <span><?= esc($usuario['NOME']) ?></span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-id-card"></i>
                        <div class="info-content">
                            <label>CPF</label>
                            <span><?= esc($usuario['CPF']) ?></span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-envelope"></i>
                        <div class="info-content">
                            <label>Email</label>
                            <span><?= esc($usuario['EMAIL']) ?></span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-shield-halved"></i>
                        <div class="info-content">
                            <label>Perfil</label>
                            <span><?= esc($usuario['PERFIL']) ?></span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-calendar-days"></i>
                        <div class="info-content">
                            <label>Data de Cadastro</label>
                            <span>
                                <?= isset($usuario['DATA_CADASTRO'])
                                    ? date('d/m/Y H:i', strtotime($usuario['DATA_CADASTRO']))
                                    : 'Não informado' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna 2: Informações da Conta -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <i class="fa-solid fa-gear"></i>
                    Informações da Conta
                </div>

                <div class="account-box-list">
                    <div class="info-box">
                        <div class="info-box-left">
                            <i class="fa-solid fa-user-check"></i>
                            <span class="info-box-title">Situação</span>
                        </div>
                        <span class="status-badge"><?= esc($usuario['STATUS'] ?? 'Ativo') ?></span>
                    </div>

                    <div class="info-box">
                        <div class="info-box-left">
                            <i class="fa-solid fa-lock"></i>
                            <span class="info-box-title">Último Acesso</span>
                        </div>
                        <span class="info-box-value">
                            <?php
                                date_default_timezone_set('America/Sao_Paulo');
                                echo date('d/m/Y H:i');
                            ?>
                            <i class="fa-regular fa-clock"></i>
                        </span>
                    </div>

                    <div class="info-box">
                        <div class="info-box-left">
                            <i class="fa-solid fa-user-plus"></i>
                            <span class="info-box-title">Cargo</span>
                        </div>
                        <span class="info-box-value" style="color: #444;">
                            <i class="fa-solid fa-user"></i> <?= esc($usuario['PERFIL']) ?>
                        </span>
                    </div>
                </div>

                <div class="notice-card">
                    <i class="fa-solid fa-circle-info"></i>
                    <p>Se precisar atualizar seus dados ou alterar sua senha, utilize as opções de segurança abaixo ou entre em contato com o administrador.</p>
                </div>
            </div>

            <!-- Seção de Segurança -->
            <div class="profile-card security-section-new">
                <div class="profile-card-header">
                    <i class="fa-solid fa-shield-alt"></i>
                    Segurança e Acesso
                </div>

                <div style="display: flex; gap: 0.9375rem; flex-wrap: wrap;">
                    <a href="<?= base_url('/alterar-senha') ?>" class="sec-btn">
                        <i class="fa-solid fa-lock"></i>
                        Alterar senha
                    </a>
                </div>
            </div>

        </div>

    </main>

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
        document.addEventListener('DOMContentLoaded', () => {

            /* ==========================================
               ACESSIBILIDADE: TAMANHO DA FONTE
               Mesma lógica do dashboard: 14px a 20px,
               passo de 1px, padrão 16px, salvo em 'fonteSite'.
               (Antes o botão A+ nunca funcionava, porque o
               limite máximo era 85 e a fonte começava em 100.)
               ========================================== */
            const FONTE_MIN = 14;
            const FONTE_MAX = 20;
            const FONTE_PADRAO = 16;
            const FONTE_PASSO = 1;

            let tamanhoFonte = parseInt(localStorage.getItem('fonteSite'));
            if (isNaN(tamanhoFonte)) tamanhoFonte = FONTE_PADRAO;
            tamanhoFonte = Math.min(FONTE_MAX, Math.max(FONTE_MIN, tamanhoFonte));
            document.documentElement.style.fontSize = tamanhoFonte + 'px';

            function aplicarFonte() {
                document.documentElement.style.fontSize = tamanhoFonte + 'px';
                localStorage.setItem('fonteSite', tamanhoFonte);
            }

            const aumentarFonte = document.getElementById('aumentar-fonte');
            const diminuirFonte = document.getElementById('diminuir-fonte');
            const resetarFonte = document.getElementById('resetar-fonte');

            if (aumentarFonte) {
                aumentarFonte.addEventListener('click', () => {
                    if (tamanhoFonte < FONTE_MAX) {
                        tamanhoFonte += FONTE_PASSO;
                        aplicarFonte();
                    }
                });
            }

            if (diminuirFonte) {
                diminuirFonte.addEventListener('click', () => {
                    if (tamanhoFonte > FONTE_MIN) {
                        tamanhoFonte -= FONTE_PASSO;
                        aplicarFonte();
                    }
                });
            }

            if (resetarFonte) {
                resetarFonte.addEventListener('click', () => {
                    tamanhoFonte = FONTE_PADRAO;
                    aplicarFonte();
                });
            }

            /* ==========================================
               MENU SANDUÍCHE RESPONSIVO
               ========================================== */
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.createElement('div');
            overlay.classList.add('menu-overlay');
            document.body.appendChild(overlay);

            function fecharMenu() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                menuToggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
                menuToggle.setAttribute('aria-label', 'Abrir menu');
            }

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function () {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                    const aberto = sidebar.classList.contains('active');
                    menuToggle.innerHTML = aberto ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
                    menuToggle.setAttribute('aria-label', aberto ? 'Fechar menu' : 'Abrir menu');
                });

                overlay.addEventListener('click', fecharMenu);

                // Fecha o menu ao clicar em um item (mobile)
                document.querySelectorAll('.sidebar .menu-item').forEach(function (item) {
                    item.addEventListener('click', function () {
                        if (window.innerWidth <= 768) fecharMenu();
                    });
                });
            }
        });
    </script>
    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>
</body>
</html>