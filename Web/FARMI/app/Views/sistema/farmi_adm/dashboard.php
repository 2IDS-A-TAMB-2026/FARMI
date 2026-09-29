<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FARMI Gestor</title>
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">

    <!-- Font Awesome & CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_responsivo.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_alto_contraste.css') ?>">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* ==========================================================
           BOTÕES DE FONTE & CONTRASTE
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
            outline: none !important;
            box-shadow: none !important;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        #contraste-btn:hover {
            color: var(--verde-claro);
        }

        #contraste-btn:focus,
        #contraste-btn:active,
        #contraste-btn:focus-visible {
            outline: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }

        /* ==========================================================
           TABELA DE SISTEMAS
        ========================================================== */
        .section-title {
            color: #052501;
            margin-bottom: 15px;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .table-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-top: 20px;
            margin-bottom: 30px;
            overflow-x: auto;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .table-container th {
            color: #052501;
            font-weight: 600;
        }

        .table-container .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            display: inline-block;
        }

        .status-ok {
            background-color: rgba(129, 199, 132, 0.2);
            color: #052501;
        }

        .status-alert {
            background-color: rgba(244, 67, 54, 0.2);
            color: #d32f2f;
        }

        /* ==========================================================
           STATUS DOS SENSORES
        ========================================================== */
        .sensor-status-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .sensor-status-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 15px;
            border-radius: 10px;
            background: #f8f9fa;
            border: 1px solid #e5e7eb;
            transition: 0.3s;
            width: 100%;
            box-sizing: border-box;
        }

        .sensor-status-item:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }

        .sensor-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            flex: 1;
        }

        .status-circle {
            position: relative;
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .status-circle.online  { background: #e8f8df; color: #58CC02; }
        .status-circle.warning { background: #fff3cd; color: #f0ad00; }
        .status-circle.offline { background: #ffe5e5; color: #dc3545; }

        .sensor-info {
            min-width: 0;
        }

        .sensor-info h4 {
            margin: 0;
            font-size: 14px;
            color: #052501;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .sensor-info p {
            margin: 3px 0 0;
            font-size: 11px;
            color: #666;
        }

        .sensor-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .signal-bars {
            display: flex;
            align-items: flex-end;
            gap: 2px;
            height: 16px;
        }

        .signal-bars i {
            display: block;
            width: 4px;
            background: #58CC02;
            border-radius: 2px;
        }

        .signal-bars i:nth-child(1) { height: 5px; }
        .signal-bars i:nth-child(2) { height: 10px; }
        .signal-bars i:nth-child(3) { height: 15px; }

        .sensor-status-list .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .sensor-status-list .status-badge.online  { background: #e8f8df; color: #328000; }
        .sensor-status-list .status-badge.warning { background: #fff3cd; color: #946c00; }
        .sensor-status-list .status-badge.offline { background: #ffe5e5; color: #c62828; }

        .pulse-dot {
            position: absolute;
            width: 8px;
            height: 8px;
            background: #58CC02;
            border-radius: 50%;
            top: 2px;
            right: 2px;
            animation: pulsarSensor 1.5s infinite;
        }

        @keyframes pulsarSensor {
            0%, 100% { transform: scale(0.8); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.5; }
        }

        /* ==========================================================
           COMPONENTES GERAIS & CLIMA
        ========================================================== */
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
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }

        /* Ações no fim do card de sensores */
        .card-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .card-actions .btn-logout {
            margin-right: 0;
        }

        /* ==========================================================
           POSIÇÕES DO GRID: SOLO + ALERTAS (esquerda) | STATUS (direita)
           Posições explícitas evitam o buraco vazio ao lado do card
        ========================================================== */
        .card-solo {
            grid-column: 1;
            grid-row: 3;
        }

        .alertas-externo {
            grid-column: 1;
            grid-row: 4;
            display: flex;
            justify-content: center;
            align-self: start;
            margin: 0 0 20px;
        }

        .card-status {
            grid-column: 2;
            grid-row: 3 / span 2;
            align-self: start;
        }

        .alertas-externo .btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 25px;
            border-radius: 10px;
            background: #58CC02;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            box-sizing: border-box;
        }

        .alertas-externo .btn:hover {
            background: #46A302;
        }

        .weather-card {
            background: linear-gradient(135deg, #1b5bb5 0%, #3275d2 50%, #4b8be3 100%);
            border-radius: 20px;
            padding: 6px 20px;
            color: #ffffff;
            font-family: 'Segoe UI', system-ui, sans-serif;
            width: 100%;
            max-width: 100%;
            min-width: 0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            align-self: start;
            height: fit-content;
            box-sizing: border-box;
        }

        .weather-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            font-weight: 600;
        }

        .location-selector {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .weather-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
        }

        .temp-main {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .temp-main #weather-icon {
            font-size: 42px;
            color: #ffc107;
        }

        .temp-main #temperatura {
            font-size: 52px;
            font-weight: 300;
            line-height: 1;
        }

        .temp-main .unit {
            font-size: 20px;
            vertical-align: top;
            margin-top: -15px;
        }

        .air-quality {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            background: rgba(255, 255, 255, 0.1);
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
        }

        .air-quality i {
            color: #ffb300;
        }

        .air-text {
            display: flex;
            flex-direction: column;
        }

        .weather-footer {
            text-align: center;
            margin-top: 10px;
        }

        .btn-previsao {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: white;
            padding: 6px 20px;
            border-radius: 20px;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-previsao:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .weather-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .detail-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            font-size: 12px;
        }

        .detail-item i {
            font-size: 18px;
            margin-bottom: 2px;
        }

        .detail-item strong {
            font-size: 14px;
        }

        /* ==========================================================
           GRID & RESPONSIVIDADE
        ========================================================== */
        .dashboard-container { width: 100%; max-width: 100%; min-width: 0; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            width: 100%;
        }

        .stats-grid .card { width: 100%; min-width: 0; overflow: hidden; }
        .card-info { min-width: 0; }
        .card-info h3 { overflow-wrap: break-word; }
        .card-info p { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            width: 100%;
            min-width: 0;
            align-items: start;
        }

        .chart-card, .activities-card { width: 100%; min-width: 0; overflow: hidden; }

        .chart-container {
            position: relative;
            width: 100%;
            max-width: 100%;
            min-width: 0;
            height: 350px;
        }

        .chart-container canvas {
            display: block;
            width: 100% !important;
            height: 100% !important;
            max-width: 100%;
        }

        .mostrar-mais {
            color: #fff;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: 0.3s;
            cursor: pointer;
            padding: 10px;
            background-color: #57c91b;
        }

        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .charts-grid { grid-template-columns: 1fr; }

            /* Grid de 1 coluna: volta ao fluxo normal */
            .card-solo,
            .alertas-externo,
            .card-status {
                grid-column: 1;
                grid-row: auto;
            }
        }

        @media (max-width: 768px) {
            .main-content { margin-left: 0 !important; width: 100% !important; padding: 75px 15px 25px; }
            .header h2 { font-size: 22px; }
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 15px; }
            .chart-container { height: 280px; }
            .signal-bars { display: none; }
        }

        @media (max-width: 600px) {
            .stats-grid { grid-template-columns: 1fr; }
            .chart-container { height: 250px; }
        }

        /* ==========================================================
           PAGINAÇÃO - SENSORES E SISTEMAS
        ========================================================== */
        .sensor-pagination,
        .system-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
        }

        .sensor-pagination button,
        .system-pagination button {
            background: #58CC02;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .sensor-pagination button:hover:not(:disabled),
        .system-pagination button:hover:not(:disabled) {
            background: #46A302;
        }

        .sensor-pagination button:disabled,
        .system-pagination button:disabled {
            background: #ccc;
            color: #666;
            cursor: not-allowed;
        }

        .sensor-pagination .pagina-atual,
        .system-pagination .pagina-atual {
            font-weight: bold;
            color: #052501;
            min-width: 70px;
            text-align: center;
        }

        /* ==========================================================
           ALTO CONTRASTE
           (classe única: alto-contraste, igual às demais telas)
        ========================================================== */
        body.alto-contraste {
            background: #000 !important;
            color: #fff !important;
        }

        body.alto-contraste * {
            color: #fff !important;
            border-color: #fff !important;
        }

        body.alto-contraste .sidebar {
            background: #000 !important;
            border-right: 2px solid #fff;
        }

        body.alto-contraste .main-content {
            background: #000 !important;
        }

        body.alto-contraste .card,
        body.alto-contraste .table-container,
        body.alto-contraste .chart-card,
        body.alto-contraste .activities-card,
        body.alto-contraste .weather-card,
        body.alto-contraste .status-item {
            background: #111 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
            box-shadow: none !important;
        }

        body.alto-contraste .activities-card > div {
            background: #000 !important;
            border: 1px solid #fff !important;
        }

        body.alto-contraste .activities-card .btn {
            background-color: #ffffff !important;
            color: #000000 !important;
            border: 2px solid #ffffff !important;
        }

        body.alto-contraste .activities-card .btn:hover {
            background-color: #e6e6e6 !important;
            color: #000000 !important;
        }

        body.alto-contraste table,
        body.alto-contraste tr,
        body.alto-contraste td,
        body.alto-contraste th {
            background: #111 !important;
            color: #fff !important;
            border: 1px solid #fff !important;
        }

        body.alto-contraste .status-badge {
            background: #fff !important;
            color: #000 !important;
        }

        body.alto-contraste .btn-logout,
        body.alto-contraste .logout-btn,
        body.alto-contraste .accessibility-btn,
        body.alto-contraste #aumentar-fonte,
        body.alto-contraste #diminuir-fonte,
        body.alto-contraste #resetar-fonte,
        body.alto-contraste .btn,
        body.alto-contraste .mostrar-mais {
            background: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
        }

        body.alto-contraste #contraste-btn,
        body.alto-contraste #contraste-btn:hover {
            color: #fff !important;
        }

        body.alto-contraste .avatar {
            background: #fff !important;
            color: #000 !important;
        }

        body.alto-contraste input,
        body.alto-contraste select,
        body.alto-contraste textarea {
            background: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
        }

        /* --- Status dos sensores --- */
        body.alto-contraste .activities-card {
            background: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
            box-shadow: none !important;
        }

        body.alto-contraste .activities-card .chart-title {
            background: #000 !important;
            color: #fff !important;
        }

        body.alto-contraste .activities-card .chart-title i {
            color: #fff !important;
        }

        body.alto-contraste .sensor-status-list,
        body.alto-contraste .sensor-left,
        body.alto-contraste .sensor-right {
            background: #000 !important;
            color: #fff !important;
        }

        body.alto-contraste .sensor-status-item {
            background: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
            box-shadow: none !important;
        }

        body.alto-contraste .sensor-info h4,
        body.alto-contraste .sensor-info p {
            color: #fff !important;
        }

        body.alto-contraste .status-circle {
            background: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
        }

        body.alto-contraste .status-circle i {
            color: #fff !important;
        }

        body.alto-contraste .signal-bars {
            color: #fff !important;
        }

        body.alto-contraste .signal-bars i {
            background: #fff !important;
        }

        body.alto-contraste .sensor-status-item .status-badge {
            background: #fff !important;
            color: #000 !important;
            border: 2px solid #fff !important;
        }

        body.alto-contraste .pulse-dot {
            background: #fff !important;
            border: 1px solid #fff !important;
        }

        body.alto-contraste .sensor-status-item:hover {
            background: #222 !important;
        }

        body.alto-contraste .sensor-status-item:hover * {
            color: #fff !important;
        }

        /* --- Gráficos --- */
        body.alto-contraste .chart-card,
        body.alto-contraste .grafico-box {
            background: #111 !important;
            color: #fff !important;
            border-color: #fff !important;
        }

        /* Neutraliza qualquer "filter: invert" vindo de CSS externo */
        body.alto-contraste .grafico-box canvas {
            background: transparent !important;
            filter: none !important;
        }

        body.alto-contraste .chart-card .chart-title,
        body.alto-contraste .chart-card .chart-title i {
            color: #fff !important;
        }

        /* --- Paginação --- */
        body.alto-contraste .sensor-pagination button,
        body.alto-contraste .system-pagination button {
            background: #000 !important;
            color: #fff !important;
            border: 1px solid #fff !important;
        }

        body.alto-contraste .sensor-pagination button:disabled,
        body.alto-contraste .system-pagination button:disabled {
            background: #000 !important;
            color: #777 !important;
            border-color: #777 !important;
        }

        body.alto-contraste .sensor-pagination .pagina-atual,
        body.alto-contraste .system-pagination .pagina-atual {
            color: #fff !important;
        }

        /* ==========================================================
           MODO NORMAL (ao sair do alto contraste)
        ========================================================== */
        body:not(.alto-contraste) {
            color: #052501;
            background: #f4f6f8;
        }

        body:not(.alto-contraste) #aumentar-fonte,
        body:not(.alto-contraste) #diminuir-fonte,
        body:not(.alto-contraste) #resetar-fonte,
        body:not(.alto-contraste) .btn-logout,
        body:not(.alto-contraste) .sensor-pagination button,
        body:not(.alto-contraste) .system-pagination button {
            color: #fff;
        }

        body:not(.alto-contraste) #contraste-btn {
            color: #000;
        }
    </style>
</head>
<body>

    <!-- Aplica o alto contraste salvo o mais cedo possível (evita "piscar") -->
    <script>
        if (localStorage.getItem('altoContraste') === 'true') {
            document.body.classList.add('alto-contraste');
        }
    </script>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i> FARMI Gestor
        </div>
        <nav>
            <a href="<?= base_url('/dashboard-admin') ?>" class="menu-item active">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
            <a href="<?= base_url('/fazendas-admin') ?>" class="menu-item">
                <i class="fa-solid fa-cow"></i> Fazendas
            </a>
            <a href="<?= base_url('/cultura-admin') ?>" class="menu-item">
                <i class="fa-solid fa-seedling"></i> Culturas
            </a>
            <a href="<?= base_url('/usuarios-admin') ?>" class="menu-item">
                <i class="fa-solid fa-users"></i> Funcionários
            </a>
            <a href="<?= base_url('/sensor') ?>" class="menu-item">
                <i class="fa-solid fa-satellite-dish"></i> Sensores
            </a>
            <a href="<?= base_url('/alertas-admin') ?>" class="menu-item">
                <i class="fa-solid fa-triangle-exclamation"></i> Alertas
            </a>
            <a href="<?= base_url('/configuracoes-admin') ?>" class="menu-item">
                <i class="fa-solid fa-gear"></i> Configurações
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu">
            <i class="fas fa-bars"></i>
        </button>
        <div class="menu-overlay" id="menuOverlay"></div>

        <!-- HEADER -->
        <header class="header">
            <div>
                <h2>Dashboard</h2>
                <p style="color:#666;">Visão geral do sistema</p>
            </div>
            <div style="display:flex; align-items:center; gap:8px;">
                <a href="<?= base_url('/logout') ?>" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
                <button id="contraste-btn" aria-label="Alterar contraste" style="margin-right: 5px;">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>
                <button id="aumentar-fonte" aria-label="Aumentar fonte">A+</button>
                <button id="diminuir-fonte" aria-label="Diminuir fonte">A-</button>
                <button id="resetar-fonte" aria-label="Resetar fonte">A</button>
                <div class="avatar">G</div>
            </div>
        </header>

        <!-- CARDS -->
        <div class="stats-grid">
            <div class="card">
                <div>
                    <h3>Sensores Totais</h3>
                    <p><?= $total_sensores ?></p>
                </div>
                <i class="fa-solid fa-satellite-dish" style="color: var(--verde-claro)"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Fazendas</h3>
                    <p><?= $total_fazendas ?></p>
                </div>
                <i class="fa-solid fa-cow" style="color: var(--verde-claro)"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Funcionários</h3>
                    <p><?= $total_usuarios ?></p>
                </div>
                <i class="fa-solid fa-users" style="color: var(--verde-claro)"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Culturas</h3>
                    <p><?= $total_culturas ?></p>
                </div>
                <i class="fa-solid fa-seedling" style="color: var(--verde-claro)"></i>
            </div>
        </div>

        <!-- GRÁFICOS & CLIMA -->
        <div class="charts-grid">

            <!-- TEMPERATURA -->
            <div class="chart-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-chart-line"></i> Temperatura do Ar (°C)
                </h3>
                <div class="grafico-box">
                    <canvas id="graficoMonitoramento"></canvas>
                </div>
            </div>

            <!-- CLIMA -->
            <div class="weather-card" id="weather-widget">
                <div class="weather-header">
                    <div class="location-selector">
                        <i class="fa-solid fa-location-arrow"></i>
                        <span id="cidade-nome">Tambaú</span>
                    </div>
                </div>
                <div class="weather-body">
                    <div class="temp-main">
                        <i class="fa-solid fa-sun" id="weather-icon"></i>
                        <span id="temperatura">--</span>
                        <span class="unit">°C</span>
                    </div>
                    <div class="air-quality" id="btn-qualidade-ar">
                        <i class="fa-solid fa-bars-staggered"></i>
                        <div class="air-text">
                            <span class="air-title">Qualidade do ar</span>
                            <span id="qualidade-ar">Carregando...</span>
                        </div>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
                <div class="weather-footer">
                    <button class="btn-previsao" id="btn-previsao-completa">Ver a previsão completa</button>
                </div>
                <div class="weather-details-grid">
                    <div class="detail-item">
                        <i class="fa-solid fa-wind"></i>
                        <span>Vento</span>
                        <strong id="dado-vento">-- km/h</strong>
                    </div>
                    <div class="detail-item">
                        <i class="fa-solid fa-droplet"></i>
                        <span>Umidade</span>
                        <strong id="dado-umidade">--%</strong>
                    </div>
                    <div class="detail-item">
                        <i class="fa-solid fa-cloud-rain"></i>
                        <span>Chuva</span>
                        <strong id="dado-chuva">-- mm</strong>
                    </div>
                    <div class="detail-item">
                        <i class="fa-solid fa-sun"></i>
                        <span>Índice UV</span>
                        <strong id="dado-uv">--</strong>
                    </div>
                    <div class="detail-item">
                        <i class="fa-solid fa-temperature-half"></i>
                        <span>Sensação</span>
                        <strong id="dado-sensacao">-- °C</strong>
                    </div>
                    <div class="detail-item">
                        <i class="fa-solid fa-temperature-arrow-down"></i>
                        <span>Orvalho</span>
                        <strong id="dado-orvalho">-- °C</strong>
                    </div>
                </div>
            </div>

            <!-- UMIDADE DO AR -->
            <div class="chart-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-droplet"></i> Umidade do Ar (%)
                </h3>
                <div class="grafico-box">
                    <canvas id="graficoUmidade"></canvas>
                </div>
            </div>

            <!-- LUMINOSIDADE -->
            <div class="chart-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-sun"></i> Luminosidade (Lux)
                </h3>
                <div class="grafico-box">
                    <canvas id="graficoLux" width="200"></canvas>
                </div>
            </div>

            <!-- UMIDADE DO SOLO -->
            <div class="chart-card card-solo">
                <h3 class="chart-title">
                    <i class="fa-solid fa-seedling"></i> Umidade do Solo (%)
                </h3>
                <div class="grafico-box">
                    <canvas id="graficoUmidadeSolo"></canvas>
                </div>
            </div>

            <!-- BOTÃO DE ALERTAS (único, abaixo do gráfico de solo) -->
            <div class="alertas-externo">
                <a href="<?= base_url('/alertas-admin') ?>" class="btn">
                    Ver Alertas
                </a>
            </div>

            <!-- STATUS DOS SENSORES -->
            <div class="activities-card card-status">

                <h3 class="chart-title">
                    <i class="fa-solid fa-microchip"></i> Status dos Sensores
                </h3>

                <div class="sensor-status-list" id="sensor-status-list">
                    <div style="text-align:center; padding:30px; color:#666;">
                        Carregando sensores...
                    </div>
                </div>

                <!-- PAGINAÇÃO DOS SENSORES -->
                <div class="sensor-pagination" id="sensor-pagination" style="display:none;">
                    <button id="sensor-anterior" type="button" aria-label="Página anterior">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <span class="pagina-atual" id="sensor-pagina-atual">Página 1</span>

                    <button id="sensor-proxima" type="button" aria-label="Próxima página">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>

                <!-- AÇÃO DO RELATÓRIO -->
                <div class="card-actions">
                    <a href="<?= base_url('/relatorio') ?>" class="btn-logout">
                        <i class="fa-solid fa-print"></i> Imprimir Relatório
                    </a>
                </div>
            </div>

        </div>

        <!-- TABELA PRINCIPAL -->
        <h3 class="section-title">Status dos Sistemas Automatizados</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sensores</th>
                        <th>Cultura</th>
                        <th>Localização</th>
                        <th>Última Atualização</th>
                        <th>Última Leitura</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sensores as $sensor): ?>
                        <?php
                            $icone = 'fa-microchip';
                            switch ($sensor['TIPO_SENSOR']) {
                                case 'Temperatura': $icone = 'fa-temperature-high'; break;
                                case 'Umidade':     $icone = 'fa-droplet'; break;
                                case 'Luz':         $icone = 'fa-lightbulb'; break;
                                case 'Solo':        $icone = 'fa-seedling'; break;
                            }
                        ?>
                        <tr class="linha-sensor">
                            <td><?= esc($sensor['ID_SENSOR']) ?></td>
                            <td>
                                <i class="fa-solid <?= $icone ?>" style="color: var(--verde-claro); margin-right: 8px;"></i>
                                <?= esc($sensor['NOME_SENSOR']) ?>
                            </td>
                            <td>
                                <?= esc($sensor['NOME_CULTURA']) ?>
                                <small>ID: <?= esc($sensor['ID_CULTURA']) ?></small>
                            </td>
                            <td><?= esc($sensor['NOME_FAZENDA']) ?></td>
                            <td>
                                <?= !empty($sensor['DATA_HORA'])
                                    ? date('d/m/Y H:i', strtotime($sensor['DATA_HORA']))
                                    : '--' ?>
                            </td>
                            <td>
                                <?php
                                    switch ($sensor['TIPO_SENSOR']) {
                                        case 'Temperatura':
                                            echo number_format((float)$sensor['VALOR'], 1, ',', '.') . ' °C';
                                            break;
                                        case 'Umidade':
                                        case 'Solo':
                                            echo number_format((float)$sensor['VALOR'], 1, ',', '.') . ' %';
                                            break;
                                        case 'Luz':
                                            echo number_format((float)$sensor['VALOR'], 0, ',', '.') . ' Lux';
                                            break;
                                        default:
                                            echo esc($sensor['VALOR']);
                                    }
                                ?>
                            </td>
                            <td>
                                <span class="status-badge status-ok"><?= esc($sensor['STATUS']) ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- PAGINAÇÃO DOS SISTEMAS AUTOMATIZADOS -->
            <div class="system-pagination" id="system-pagination" style="display:none;">
                <button id="system-anterior" type="button">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <span class="pagina-atual" id="system-pagina-atual">
                    Página 1
                </span>

                <button id="system-proxima" type="button">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </main>

    <!-- VLIBRAS -->
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

    <!-- ==========================================================
         GRÁFICOS
    ========================================================== -->
    <script>
        // Estado do alto contraste (a classe já foi aplicada no início do body)
        const contrasteInicial = document.body.classList.contains('alto-contraste');
        const corEixos = contrasteInicial ? '#ffffff' : '#052501';
        const corGrade = contrasteInicial ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9';

        // Dados vindos do controller
        const labelsEixoX = <?= json_encode($grafico_horarios ?? []) ?>;
        const datasetsTemperatura = <?= json_encode($datasets_temperatura ?? []) ?>;
        const datasetsUmidade = <?= json_encode($datasets_umidade ?? []) ?>;
        const datasetsSolo = <?= json_encode($datasets_solo ?? []) ?>;
        const datasetsLux = <?= json_encode($datasets_lux ?? []) ?>;
        let valorLuxAtual = <?= floatval($lux ?? 0) ?>;

        const ultimas10Labels = labelsEixoX.slice(-10);

        const datasetsTemperatura10 = datasetsTemperatura.map(dataset => ({
            ...dataset,
            data: dataset.data.slice(-10)
        }));

        const datasetsUmidade10 = datasetsUmidade.map(dataset => ({
            ...dataset,
            data: dataset.data.slice(-10)
        }));

        const datasetsSolo10 = datasetsSolo.map(dataset => ({
            ...dataset,
            data: dataset.data.slice(-10)
        }));

        let chartTemperatura = null;
        let chartUmidade = null;
        let chartSolo = null;
        let chartLux = null;

        // Gráfico Temperatura
        const ctxTemperatura = document.getElementById('graficoMonitoramento');
        if (ctxTemperatura) {
            chartTemperatura = new Chart(ctxTemperatura, {
                type: 'line',
                data: { labels: ultimas10Labels, datasets: datasetsTemperatura10 },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true, labels: { color: corEixos, font: { size: 13, weight: 'bold' } } }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { color: corEixos, callback: v => v + 'ºC' }, grid: { color: corGrade } },
                        x: { ticks: { color: corEixos }, grid: { color: corGrade } }
                    }
                }
            });
        }

        // Gráfico Umidade
        const ctxUmidade = document.getElementById('graficoUmidade');
        if (ctxUmidade) {
            chartUmidade = new Chart(ctxUmidade, {
                type: 'line',
               data: { labels: ultimas10Labels, datasets: datasetsUmidade10 },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true, labels: { color: corEixos, font: { size: 13, weight: 'bold' } } }
                    },
                    scales: {
                        y: { beginAtZero: true, max: 100, ticks: { color: corEixos, callback: v => v + '%' }, grid: { color: corGrade } },
                        x: { ticks: { color: corEixos }, grid: { color: corGrade } }
                    }
                }
            });
        }

        // Gráfico Umidade do Solo
        const ctxUmidadeSolo = document.getElementById('graficoUmidadeSolo');
        if (ctxUmidadeSolo) {
            chartSolo = new Chart(ctxUmidadeSolo, {
                type: 'line',
                data: { labels: ultimas10Labels, datasets: datasetsSolo10 },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { display: true, labels: { color: corEixos, font: { size: 13, weight: 'bold' } } },
                        tooltip: { callbacks: { label: ctx => `${ctx.dataset.label}: ${ctx.parsed.y}%` } }
                    },
                    scales: {
                        y: { beginAtZero: true, min: 0, max: 100, ticks: { color: corEixos, callback: v => v + '%' }, grid: { color: corGrade } },
                        x: { ticks: { color: corEixos }, grid: { color: corGrade } }
                    }
                }
            });
        }

        // Gráfico Luminosidade
        const graficoLuxCanvas = document.getElementById('graficoLux');
        if (graficoLuxCanvas) {
            chartLux = new Chart(graficoLuxCanvas, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [
                            Math.min(Number(valorLuxAtual), 25000),
                            Math.max(25000 - Number(valorLuxAtual), 0)
                        ],
                        backgroundColor: ['#4bc714', '#e5e7eb'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '82%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    }
                },
                plugins: [{
                    id: 'radialLux',
                    afterDraw(chart) {
                        const { ctx, chartArea } = chart;
                        const centroX = (chartArea.left + chartArea.right) / 2;
                        const centroY = (chartArea.top + chartArea.bottom) / 2;
                        const contraste = document.body.classList.contains('alto-contraste');

                        ctx.save();

                        // Ícone de sol
                        ctx.font = '32px Arial';
                        ctx.fillStyle = contraste ? '#ffffff' : '#052501';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText('☼', centroX, centroY - 28);

                        // Valor
                        ctx.font = 'bold 28px Arial';
                        ctx.fillStyle = contraste ? '#ffffff' : '#052501';
                        ctx.fillText(
                            Number(valorLuxAtual).toLocaleString('pt-BR'),
                            centroX,
                            centroY + 18
                        );

                        // Unidade
                        ctx.font = '16px Arial';
                        ctx.fillStyle = contraste ? '#ffffff' : '#666666';
                        ctx.fillText('Lux', centroX, centroY + 43);

                        ctx.restore();
                    }
                }]
            });
        }

        // Atualiza o gráfico de luminosidade
        function atualizarLux(novoValor) {
            valorLuxAtual = Number(novoValor);

            if (chartLux) {
                chartLux.data.datasets[0].data = [
                    Math.min(valorLuxAtual, 25000),
                    Math.max(25000 - valorLuxAtual, 0)
                ];

                chartLux.update();
            }
        }

        /* =========================
           CORES DOS GRÁFICOS NO ALTO CONTRASTE
        ========================= */
        function aplicarFundoGraficosJS(contraste) {
            // Reforço via JS, caso algum CSS externo tente inverter o canvas
            document.querySelectorAll('.grafico-box').forEach(box => {
                if (contraste) {
                    box.style.setProperty('background', '#111111', 'important');
                } else {
                    box.style.removeProperty('background');
                }
            });

            document.querySelectorAll('.grafico-box canvas').forEach(canvas => {
                if (contraste) {
                    canvas.style.setProperty('filter', 'none', 'important');
                    canvas.style.setProperty('background', 'transparent', 'important');
                } else {
                    canvas.style.removeProperty('filter');
                    canvas.style.removeProperty('background');
                }
            });
        }

        function atualizarCoresGraficos() {
            const ativo = document.body.classList.contains('alto-contraste');
            const cor   = ativo ? '#ffffff' : '#052501';
            const grade = ativo ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9';

            aplicarFundoGraficosJS(ativo);

            [chartTemperatura, chartUmidade, chartSolo].forEach(function (chart) {
                if (!chart) return;

                try {
                    chart.options.plugins.legend.labels.color = cor;
                    chart.options.scales.x.ticks.color = cor;
                    chart.options.scales.x.grid.color  = grade;
                    chart.options.scales.y.ticks.color = cor;
                    chart.options.scales.y.grid.color  = grade;
                    chart.update();
                } catch (erro) {
                    console.error('Erro ao recolorir gráfico:', erro);
                }
            });

            // O texto do gauge é recalculado sozinho no afterDraw
            if (chartLux) chartLux.update();
        }

        /* =========================
           ATUALIZA OS GRÁFICOS
        ========================= */
        async function atualizarGraficos() {
            try {
                const resposta = await fetch('<?= base_url('dados-graficos') ?>');
                if (!resposta.ok) throw new Error('Erro ao buscar dados');
                const dados = await resposta.json();

                if (chartTemperatura && dados.temperatura) {
                    chartTemperatura.data.labels = dados.horarios;
                    chartTemperatura.data.datasets = dados.temperatura;
                    chartTemperatura.update();
                }
                if (chartUmidade && dados.umidade) {
                    chartUmidade.data.labels = dados.horarios;
                    chartUmidade.data.datasets = dados.umidade;
                    chartUmidade.update();
                }
                if (chartSolo && dados.solo) {
                    chartSolo.data.labels = dados.horarios;
                    chartSolo.data.datasets = dados.solo;
                    chartSolo.update();
                }
                if (dados.lux !== undefined && chartLux) {
                    atualizarLux(dados.lux);
                }

                // Mantém as cores corretas depois de atualizar os dados
                atualizarCoresGraficos();

            } catch (erro) {
                console.error('Erro ao atualizar gráficos:', erro);
            }
        }
    </script>

    <!-- ==========================================================
         STATUS DOS SENSORES + PAGINAÇÃO
    ========================================================== -->
    <script>
        let sensoresTodos = [];
        let paginaSensor = 1;
        const sensoresPorPagina = 4;

        // Evita injeção de HTML vindo da API
        function escaparHtml(valor) {
            return String(valor ?? '').replace(/[&<>"']/g, c => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
            }[c]));
        }

        // Só aceita classes de ícone seguras (fa-xxx)
        function iconeSeguro(icone) {
            return /^fa-[a-z0-9-]+$/i.test(icone || '') ? icone : 'fa-microchip';
        }

        function totalPaginasSensores() {
            return Math.max(1, Math.ceil(sensoresTodos.length / sensoresPorPagina));
        }

        async function atualizarStatusSensores() {
            const lista = document.getElementById('sensor-status-list');
            const paginacao = document.getElementById('sensor-pagination');

            if (!lista) return;

            try {
                const resposta = await fetch('<?= base_url('status-sensores') ?>', { cache: 'no-store' });

                if (!resposta.ok) {
                    throw new Error('Erro ao buscar status');
                }

                const sensores = await resposta.json();

                if (!Array.isArray(sensores) || sensores.length === 0) {
                    sensoresTodos = [];
                    paginaSensor = 1;

                    lista.innerHTML = `
                        <div style="text-align:center; padding:30px; color:#666;">
                            Nenhum sensor encontrado.
                        </div>`;

                    if (paginacao) paginacao.style.display = 'none';
                    return;
                }

                sensoresTodos = sensores;

                // Se a página atual deixou de existir, volta para a última disponível
                if (paginaSensor > totalPaginasSensores()) {
                    paginaSensor = totalPaginasSensores();
                }

                mostrarPaginaSensores();

            } catch (erro) {
                console.error('Erro nos sensores:', erro);

                lista.innerHTML = `
                    <div style="text-align:center; padding:30px; color:#888;">
                        Erro ao carregar sensores.
                    </div>`;

                if (paginacao) paginacao.style.display = 'none';
            }
        }

        function mostrarPaginaSensores() {
            const lista = document.getElementById('sensor-status-list');
            const paginacao = document.getElementById('sensor-pagination');
            const botaoAnterior = document.getElementById('sensor-anterior');
            const botaoProxima = document.getElementById('sensor-proxima');
            const textoPagina = document.getElementById('sensor-pagina-atual');

            if (!lista) return;

            const inicio = (paginaSensor - 1) * sensoresPorPagina;

            // Somente os sensores da página atual
            const sensoresPagina = sensoresTodos.slice(inicio, inicio + sensoresPorPagina);

            lista.innerHTML = sensoresPagina.map(sensor => {
                let estado = 'offline';
                let texto = 'Offline';
                let pulso = '';

                const minutos = (sensor.minutos_atras === null || sensor.minutos_atras === undefined)
                    ? null
                    : Number(sensor.minutos_atras);

                if (minutos !== null && minutos <= 5) {
                    estado = 'online';
                    texto = 'Online';
                    pulso = '<span class="pulse-dot"></span>';
                } else if (minutos !== null && minutos <= 20) {
                    estado = 'warning';
                    texto = 'Oscilando';
                }

                return `
                    <div class="sensor-status-item">
                        <div class="sensor-left">
                            <span class="status-circle ${estado}">
                                <i class="fa-solid ${iconeSeguro(sensor.icone)}"></i>
                                ${pulso}
                            </span>
                            <div class="sensor-info">
                                <h4>${escaparHtml(sensor.nome || 'Sensor')}</h4>
                                <p>${escaparHtml(sensor.tipo || 'Sensor')} · ${escaparHtml(sensor.tempo_texto || 'Sem leitura')}</p>
                            </div>
                        </div>
                        <div class="sensor-right">
                            <span class="signal-bars"><i></i><i></i><i></i></span>
                            <span class="status-badge ${estado}">${texto}</span>
                        </div>
                    </div>`;
            }).join('');

            const totalPaginas = totalPaginasSensores();

            // Só mostra a paginação se houver mais de uma página
            if (paginacao && totalPaginas > 1) {
                paginacao.style.display = 'flex';
                textoPagina.textContent = `Página ${paginaSensor} de ${totalPaginas}`;
                botaoAnterior.style.display = paginaSensor <= 1 ? 'none' : 'flex';
                botaoProxima.style.display = paginaSensor >= totalPaginas ? 'none' : 'flex';
            } else if (paginacao) {
                paginacao.style.display = 'none';
            }
        }

        document.getElementById('sensor-anterior')?.addEventListener('click', function () {
            if (paginaSensor > 1) {
                paginaSensor--;
                mostrarPaginaSensores();
            }
        });

        document.getElementById('sensor-proxima')?.addEventListener('click', function () {
            if (paginaSensor < totalPaginasSensores()) {
                paginaSensor++;
                mostrarPaginaSensores();
            }
        });

        // Primeira atualização e depois a cada 30 segundos
        atualizarStatusSensores();
        setInterval(atualizarStatusSensores, 30 * 1000);
    </script>

    <!-- ==========================================================
         PAGINAÇÃO DOS SISTEMAS AUTOMATIZADOS
    ========================================================== -->
    <script>
        let paginaSistema = 1;
        const sistemasPorPagina = 4;

        const linhasSistema = document.querySelectorAll('.linha-sensor');
        const paginacaoSistema = document.getElementById('system-pagination');
        const botaoSistemaAnterior = document.getElementById('system-anterior');
        const botaoSistemaProxima = document.getElementById('system-proxima');
        const textoPaginaSistema = document.getElementById('system-pagina-atual');

        function mostrarPaginaSistemas() {

            const totalPaginas = Math.ceil(linhasSistema.length / sistemasPorPagina);

            // Se couber tudo em uma página, esconde a paginação
            if (totalPaginas <= 1) {

                if (paginacaoSistema) {
                    paginacaoSistema.style.display = 'none';
                }

                linhasSistema.forEach(linha => {
                    linha.style.display = '';
                });

                return;
            }

            const inicio = (paginaSistema - 1) * sistemasPorPagina;
            const fim = inicio + sistemasPorPagina;

            linhasSistema.forEach((linha, indice) => {
                linha.style.display = (indice >= inicio && indice < fim) ? '' : 'none';
            });

            paginacaoSistema.style.display = 'flex';

            textoPaginaSistema.textContent = `Página ${paginaSistema} de ${totalPaginas}`;

            botaoSistemaAnterior.style.display = paginaSistema <= 1 ? 'none' : 'flex';
            botaoSistemaProxima.style.display = paginaSistema >= totalPaginas ? 'none' : 'flex';
        }

        botaoSistemaAnterior?.addEventListener('click', function () {
            if (paginaSistema > 1) {
                paginaSistema--;
                mostrarPaginaSistemas();
            }
        });

        botaoSistemaProxima?.addEventListener('click', function () {
            const totalPaginas = Math.ceil(linhasSistema.length / sistemasPorPagina);

            if (paginaSistema < totalPaginas) {
                paginaSistema++;
                mostrarPaginaSistemas();
            }
        });

        mostrarPaginaSistemas();
    </script>

    <!-- ==========================================================
         CLIMA
    ========================================================== -->
    <script>
        async function buscarClima() {
            const lat = -21.7056, lon = -47.2728;
            try {
                const resClima = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,relative_humidity_2m,precipitation,wind_speed_10m,uv_index,apparent_temperature,dewpoint_2m`);
                const dataClima = await resClima.json();
                const atual = dataClima.current;

                document.getElementById('temperatura').textContent = Math.round(atual.temperature_2m);
                document.getElementById('dado-vento').textContent = `${Math.round(atual.wind_speed_10m)} km/h`;
                document.getElementById('dado-umidade').textContent = `${atual.relative_humidity_2m}%`;
                document.getElementById('dado-chuva').textContent = `${atual.precipitation} mm`;
                document.getElementById('dado-uv').textContent = Math.round(atual.uv_index);
                document.getElementById('dado-sensacao').textContent = `${Math.round(atual.apparent_temperature)} °C`;
                document.getElementById('dado-orvalho').textContent = `${Math.round(atual.dewpoint_2m)} °C`;

                const resAr = await fetch(`https://air-quality-api.open-meteo.com/v1/air-quality?latitude=${lat}&longitude=${lon}&current=european_aqi`);
                const dataAr = await resAr.json();
                const aqi = dataAr.current.european_aqi;

                let textoAr = 'Boa';
                if (aqi > 20 && aqi <= 40) textoAr = 'Moderada';
                if (aqi > 40) textoAr = 'Ruim';

                document.getElementById('qualidade-ar').textContent = textoAr;
            } catch (erro) {
                console.error('Erro ao carregar clima:', erro);
            }
        }

        // Redirecionamentos do clima
        document.getElementById('btn-previsao-completa')?.addEventListener('click', () => {
            window.open('https://www.msn.com/pt-br/clima/forecast/in-Tamba%C3%BA,S%C3%A3o-Paulo,Brasil', '_blank');
        });
        document.getElementById('btn-qualidade-ar')?.addEventListener('click', () => {
            window.open('https://www.iqair.com/br/brazil/sao-paulo/tambau', '_blank');
        });
    </script>

    <!-- JS compartilhado das telas -->
    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>

    <!-- ==========================================================
         ALTO CONTRASTE + FONTE (mesma chave e classe das outras telas)
    ========================================================== -->
    <script>
        /* =========================
           ALTO CONTRASTE (um único toggle, com persistência)
        ========================= */
        (function () {
            const CHAVE = 'altoContraste';

            // Sincroniza gráficos e botões com o estado salvo
            atualizarCoresGraficos();

            // Captura o clique antes de qualquer outro código tratar o botão
            document.addEventListener('click', function (e) {
                if (!e.target.closest('#contraste-btn')) return;

                e.stopImmediatePropagation();

                const ativo = document.body.classList.toggle('alto-contraste');
                localStorage.setItem(CHAVE, ativo);

                // Espera o navegador aplicar a classe antes de redesenhar os gráficos
                requestAnimationFrame(atualizarCoresGraficos);
            }, true);
        })();

        /* =========================
           FONTE (mesma chave e limites das outras telas)
        ========================= */
        document.addEventListener('DOMContentLoaded', () => {

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

        /* =========================
           INICIALIZAÇÃO E TIMERS
        ========================= */
        atualizarGraficos();
        buscarClima();

        setInterval(atualizarGraficos, 30 * 1000);
        setInterval(buscarClima, 10 * 60 * 1000);
    </script>

    <!-- ==========================================================
         MENU SANDUÍCHE
    ========================================================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('menuOverlay');

            if (menuToggle && sidebar) {

                const toggleMenu = (abrir) => {
                    const active = abrir !== undefined ? abrir : !sidebar.classList.contains('active');

                    sidebar.classList.toggle('active', active);
                    if (overlay) overlay.classList.toggle('active', active);

                    menuToggle.innerHTML = active
                        ? '<i class="fa-solid fa-xmark"></i>'
                        : '<i class="fa-solid fa-bars"></i>';

                    menuToggle.setAttribute('aria-label', active ? 'Fechar menu' : 'Abrir menu');
                };

                menuToggle.addEventListener('click', () => toggleMenu());
                if (overlay) overlay.addEventListener('click', () => toggleMenu(false));

                document.querySelectorAll('.sidebar .menu-item').forEach(item => {
                    item.addEventListener('click', () => {
                        if (window.innerWidth <= 768) toggleMenu(false);
                    });
                });
            }

        });
        /* =========================
       PAGINAÇÃO - STATUS DOS SISTEMAS AUTOMATIZADOS
    ========================= */
    const linhasSistemas = document.querySelectorAll(".linha-sensor");

    const paginacaoSistemas = document.getElementById("sistemas-pagination");
    const sistemaAnterior = document.getElementById("sistema-anterior");
    const sistemaProxima = document.getElementById("sistema-proxima");
    const sistemaPaginaAtual = document.getElementById("sistema-pagina-atual");

    let paginaSistema = 1;

    const sistemasPorPagina = 4;

    function atualizarPaginacaoSistemas() {

        const totalPaginas = Math.ceil(linhasSistemas.length / sistemasPorPagina);

        // Sem sistemas
        if (totalPaginas === 0) {

            if (paginacaoSistemas) {
                paginacaoSistemas.style.display = "none";
            }

            return;
        }

        // Se couber tudo em uma página, não mostra os botões
        if (totalPaginas <= 1) {

            if (paginacaoSistemas) {
                paginacaoSistemas.style.display = "none";
            }

            linhasSistemas.forEach(function (linha) {
                linha.style.display = "";
            });

            paginaSistema = 1;

            return;
        }

        // Garante que a página atual seja válida
        if (paginaSistema > totalPaginas) {
            paginaSistema = totalPaginas;
        }

        const inicio = (paginaSistema - 1) * sistemasPorPagina;
        const fim = inicio + sistemasPorPagina;

        // Mostra somente os sistemas da página atual
        linhasSistemas.forEach(function (linha, indice) {
            linha.style.display = (indice >= inicio && indice < fim) ? "" : "none";
        });

        if (paginacaoSistemas) {
            paginacaoSistemas.style.display = "flex";
        }

        if (sistemaPaginaAtual) {
            sistemaPaginaAtual.textContent = `Página ${paginaSistema} de ${totalPaginas}`;
        }

        if (sistemaAnterior) {
            sistemaAnterior.style.display = paginaSistema === 1 ? 'none' : 'inline-flex';
        }

        if (sistemaProxima) {
            sistemaProxima.style.display = paginaSistema === totalPaginas ? 'none' : 'inline-flex';
        }

    }

    if (sistemaAnterior) {
        sistemaAnterior.addEventListener("click", function () {
            if (paginaSistema > 1) {
                paginaSistema--;
                atualizarPaginacaoSistemas();
            }
        });
    }

    if (sistemaProxima) {
        sistemaProxima.addEventListener("click", function () {
            const totalPaginas = Math.ceil(linhasSistemas.length / sistemasPorPagina);

            if (paginaSistema < totalPaginas) {
                paginaSistema++;
                atualizarPaginacaoSistemas();
            }
        });
    }

    atualizarPaginacaoSistemas();
    </script>
</body>
</html>