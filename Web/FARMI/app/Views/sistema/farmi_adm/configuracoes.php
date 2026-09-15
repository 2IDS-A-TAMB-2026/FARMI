<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Meu Perfil - Fazenda Inteligente</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_config.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ==========================================================
           ESTILOS MANTIDOS DO SEU TOPO/SIDEBAR
           ========================================================== */
        #aumentar-fonte,
        #diminuir-fonte,
        #resetar-fonte {
            width: 42px;
            height: 42px;
            background-color: #58CC02;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        #aumentar-fonte:hover,
        #diminuir-fonte:hover,
        #resetar-fonte:hover {
            background-color: #46A302;
        }

        #contraste-btn {
            background: transparent !important;
            border: none !important;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            font-size: 20px;
            color: #000;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #contraste-btn:hover {
            color: #46A302;
        }

        .btn-logout {
            background: #58CC02;
            color: white;
            text-decoration: none;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0 18px;
            border-radius: 10px;
            font-weight: bold;
            transition: 0.3s;
            margin-right: 15px;
        }

        .btn-logout:hover {
            background: #46A302;
            color: white;
        }

        .avatar {
            background: #57c91b;
            color: #000;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
            flex-shrink: 0;
        }

        /* AUTO CONTRASTE */
        body.contraste .btn-logout,
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

        body.contraste .avatar {
            background: #fff !important;
            color: #000 !important;
        }

        body.contraste .profile-card,
        body.contraste .info-box {
            background: #111 !important;
            color: #fff !important;
            border-color: #444 !important;
        }

        /* ==========================================================
           ESTILOS NOVOS DO PERFIL (LAYOUT INSPIRADO)
           ========================================================== */
        * { box-sizing: border-box; }
        html, body { max-width: 100%; overflow-x: hidden; }

        .main-content {
            min-width: 0;
            width: calc(100% - 260px);
            max-width: 100%;
        }

        /* Hero / Card Principal do Usuário */
        .profile-hero {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            border: 1px solid #eef0f2;
            margin-bottom: 24px;
        }

        .profile-user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-avatar-large {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #e8f5e9;
            color: #2e7d32;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            border: 3px solid #58CC02;
        }

        .profile-details h2 {
            margin: 0 0 6px 0;
            font-size: 22px;
            color: #1a1a1a;
        }

        .badge-role {
            display: inline-block;
            background: #e8f5e9;
            color: #2e7d32;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .profile-subtext {
            color: #777;
            font-size: 14px;
            margin: 0;
        }

        .hero-banner-right {
            text-align: right;
            max-width: 250px;
            color: #666;
            font-size: 13px;
        }

        .hero-banner-right i {
            color: #58CC02;
            font-size: 24px;
            margin-top: 8px;
        }

        /* Layout em Grid (2 Colunas) */
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .profile-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            border: 1px solid #eef0f2;
        }

        .profile-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        .profile-card-header i {
            color: #58CC02;
            font-size: 20px;
        }

        /* Lista de Informações Pessoais */
        .info-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f8f9fa;
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-item i {
            font-size: 16px;
            color: #777;
            margin-top: 3px;
            width: 20px;
            text-align: center;
        }

        .info-content label {
            display: block;
            font-size: 12px;
            color: #888;
            font-weight: 600;
            margin-bottom: 2px;
            text-transform: uppercase;
        }

        .info-content span {
            font-size: 15px;
            color: #333;
            font-weight: 500;
        }

        /* Cards da Direita (Informações da Conta) */
        .account-box-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-box-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .info-box-left i {
            color: #555;
            font-size: 18px;
        }

        .info-box-title {
            font-size: 14px;
            color: #555;
            font-weight: 500;
        }

        .status-badge {
            background: #e8f5e9;
            color: #2e7d32;
            font-weight: bold;
            font-size: 13px;
            padding: 4px 10px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-badge::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #2e7d32;
            border-radius: 50%;
        }

        .notice-card {
            background: #e8f5e9;
            border-left: 4px solid #58CC02;
            border-radius: 8px;
            padding: 14px;
            margin-top: 15px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .notice-card i {
            color: #2e7d32;
            font-size: 18px;
            margin-top: 2px;
        }

        .notice-card p {
            margin: 0;
            font-size: 13px;
            color: #2e7d32;
            line-height: 1.4;
        }

        /* Seção de Segurança */
        .security-section-new {
            margin-top: 24px;
            grid-column: span 2;
        }

        .sec-btn {
            background: #f8f9fa;
            border: 1px solid #ddd;
            color: #333;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }

        .sec-btn:hover {
            background: #e9ecef;
            color: #000;
        }

        /* Escondido por padrão em telas grandes (Desktops / Notebooks) */
        .menu-toggle {
            display: none;
        }

        /* Visível apenas em dispositivos móveis e tablets (≤ 768px) */
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

        /* Responsividade */
        @media (max-width: 992px) {
            .profile-grid { grid-template-columns: 1fr; }
            .security-section-new { grid-column: span 1; }
        }

        @media (max-width: 768px) {
            .profile-hero {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            .hero-banner-right {
                text-align: left;
                max-width: 100%;
            }
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                padding: 75px 15px 25px;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Gestor
        </div>

        <nav>
            <a href="<?= base_url('/dashboard-admin') ?>" class="menu-item">
                <i class="fa-solid fa-chart-line"></i>
                Dashboard
            </a>
            <a href="<?= base_url('/fazendas-admin') ?>" class="menu-item">
                <i class="fa-solid fa-cow"></i>
                Fazendas
            </a>
            <a href="<?= base_url('/cultura-admin') ?>" class="menu-item">
                <i class="fa-solid fa-seedling"></i>
                Culturas
            </a>
            <a href="<?= base_url('/usuarios-admin') ?>" class="menu-item">
                <i class="fa-solid fa-users"></i>
                Funcionários
            </a>
            <a href="<?= base_url('/sensor') ?>" class="menu-item">
                <i class="fa-solid fa-satellite-dish"></i>
                Sensores
            </a>
            <a href="<?= base_url('/alertas-admin') ?>" class="menu-item">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Alertas
            </a>
            <a href="<?= base_url('/configuracoes-admin') ?>" class="menu-item active">
                <i class="fa-solid fa-user"></i>
                Meu Perfil
            </a>
        </nav>
    </aside>

    <main class="main-content">

        <!-- Menu sanduíche -->
        <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Topo idêntico ao original -->
        <header class="header">
            <div>
                <h2>Meu Perfil</h2>
                <p style="color: #666;">Visualize e edite seus dados pessoais.</p>
            </div>

            <div style="display:flex; align-items:center; gap:8px;">
                <a href="<?= base_url('/logout') ?>" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>

                <button id="contraste-btn" style="margin-right: 5px;" aria-label="Alterar contraste">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>

                <button id="aumentar-fonte" aria-label="Aumentar fonte">A+</button>
                <button id="diminuir-fonte" aria-label="Diminuir fonte">A-</button>
                <button id="resetar-fonte" aria-label="Resetar fonte">A</button>

                <div class="avatar"><?= strtoupper(substr($usuario['NOME'] ?? 'U', 0, 1)) ?></div>
            </div>
        </header>

        <!-- NOVO CONTEÚDO PRINCIPAL (INSPIRADO NA IMAGEM DE REFERÊNCIA) -->
        
        <!-- Top Hero Card -->
        <div class="profile-hero">
            <div class="profile-user-info">
                <div class="profile-avatar-large">
                    <?= strtoupper(substr($usuario['NOME'] ?? 'U', 0, 1)) ?>
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

            <!-- Coluna 2: Informações da Conta & Avisos -->
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
                        <span style="font-size: 13px; font-weight: 600; color: #555;">
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
                        <span style="font-size: 14px; font-weight: 600; color: #444;">
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

                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <a href="<?= base_url('/alterar-senha-admin') ?>" class="sec-btn">
                        <i class="fa-solid fa-lock"></i>
                        Alterar senha
                    </a>

                    <a href="<?= base_url('/recuperar-senha-admin') ?>" class="sec-btn">
                        <i class="fa-solid fa-envelope-open-text"></i>
                        Recuperar senha
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

    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>

    <script>
        /* Acessibilidade de fonte e contraste */
        document.addEventListener('DOMContentLoaded', () => {
            const contrasteBtn = document.getElementById('contraste-btn');
            if (contrasteBtn) {
                contrasteBtn.addEventListener('click', () => {
                    document.body.classList.toggle('contraste');
                });
            }

            let tamanhoFonte = parseInt(localStorage.getItem('fonteSite')) || 16;
            document.documentElement.style.fontSize = tamanhoFonte + 'px';

            document.getElementById('aumentar-fonte').addEventListener('click', () => {
                if (tamanhoFonte < 24) {
                    tamanhoFonte += 2;
                    document.documentElement.style.fontSize = tamanhoFonte + 'px';
                    localStorage.setItem('fonteSite', tamanhoFonte);
                }
            });

            document.getElementById('diminuir-fonte').addEventListener('click', () => {
                if (tamanhoFonte > 12) {
                    tamanhoFonte -= 2;
                    document.documentElement.style.fontSize = tamanhoFonte + 'px';
                    localStorage.setItem('fonteSite', tamanhoFonte);
                }
            });

            document.getElementById('resetar-fonte').addEventListener('click', () => {
                tamanhoFonte = 16;
                document.documentElement.style.fontSize = tamanhoFonte + 'px';
                localStorage.setItem('fonteSite', tamanhoFonte);
            });
        });

        /* Menu Sanduíche Responsivo */
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.createElement('div');
            overlay.classList.add('menu-overlay');
            document.body.appendChild(overlay);

            menuToggle.addEventListener('click', function () {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                const aberto = sidebar.classList.contains('active');
                menuToggle.innerHTML = aberto ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
            });

            overlay.addEventListener('click', function () {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                menuToggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
            });
        });
    </script>
</body>

</html>