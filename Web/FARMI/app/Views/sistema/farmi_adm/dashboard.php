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
        }

        #contraste-btn:hover {
            color: #46A302;
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

        .status-circle.online { background: #e8f8df; color: #58CC02; }
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

        .sensor-status-list .status-badge.online { background: #e8f8df; color: #328000; }
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
           ALTO CONTRASTE
           ========================================================== */
        body.contraste .table-container {
            background: #191717 !important;
            border: 1px solid #fff;
        }

        body.contraste .table-container th,
        body.contraste .table-container td {
            color: #fff !important;
            border-bottom: 1px solid #fff;
        }

        body.contraste .table-container .status-badge,
        body.contraste .sensor-status-list .status-badge {
            background: #fff !important;
            color: #000 !important;
            border: 1px solid #fff;
        }

        body.contraste .sensor-status-item {
            background: #000 !important;
            border: 1px solid #fff !important;
        }

        body.contraste .sensor-info h4,
        body.contraste .sensor-info p {
            color: #fff !important;
        }

        body.contraste .status-circle {
            background: #000 !important;
            color: #fff !important;
            border: 1px solid #fff;
        }

        body.contraste .signal-bars i,
        body.contraste .pulse-dot {
            background: #fff !important;
        }

        body.contraste .avatar {
            background: #ffffff !important;
            color: #000000 !important;
            border: none !important;
        }

        body.contraste canvas,
        body.contraste .status-indicator,
        body.contraste .activity-icon {
            filter: grayscale(0%) brightness(200%) contrast(300%) !important;
        }

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

        /* ==========================================================
           COMPONENTES GERAIS & WEATHER
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
    </style>
</head>
<body>

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
        <button class="menu-toggle" id="menuToggle">
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
                <button id="contraste-btn" style="margin-right: 5px;">
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
        </div>

        <!-- GRÁFICOS & WEATHER -->
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
                <div class="grafico-box" style="position: relative;">
                    <canvas id="graficoLux"></canvas>
                    <!-- Exibição do valor no centro -->
                    <div style="position: absolute; bottom: 15%; left: 50%; transform: translateX(-50%); text-align: center; pointer-events: none;">
                        <span id="valorLuxNum" style="font-size: 32px; font-weight: bold; color: #052501;">0</span>
                        <small style="display: block; font-size: 14px; color: #666;">Lux</small>
                    </div>
                </div>
            </div>

            <!-- UMIDADE DO SOLO -->
            <div class="chart-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-seedling"></i> Umidade do Solo (%)
                </h3>
                <div class="grafico-box">
                    <canvas id="graficoUmidadeSolo"></canvas>
                </div>
            </div>

            <!-- STATUS DOS SENSORES -->
            <div class="activities-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-microchip"></i> Status dos Sensores
                </h3>
                <div class="sensor-status-list" id="sensor-status-list">
                    <div style="text-align:center; padding:30px; color:#666;">Carregando sensores...</div>
                </div>
            </div>

            <!-- BOTÕES -->
            <a href="<?= base_url('/alertas-admin') ?>" class="btn">Ver Alertas</a>
            <a href="<?= base_url('/relatorio') ?>" class="btn-logout">
                <i class="fa-solid fa-print"></i> Imprimir Relatório
            </a>
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
                            <td><?= date('d/m/Y H:i', strtotime($sensor['DATA_HORA'])) ?></td>
                            <td>
                                <?php
                                    switch ($sensor['TIPO_SENSOR']) {
                                        case 'Temperatura': echo number_format($sensor['VALOR'], 1, ',', '.') . ' °C'; break;
                                        case 'Umidade':
                                        case 'Solo':        echo number_format($sensor['VALOR'], 1, ',', '.') . ' %'; break;
                                        case 'Luz':         echo number_format($sensor['VALOR'], 0, ',', '.') . ' Lux'; break;
                                        default:            echo $sensor['VALOR'];
                                    }
                                ?>
                            </td>
                            <td>
                                <span class="status-badge status-ok"><?= $sensor['STATUS'] ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div id="mostrarMaisSensores" class="mostrar-mais">
                Mostrar mais <i class="fa-solid fa-chevron-down"></i>
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

    <!-- JAVASCRIPT PRINCIPAL -->
    <script>
        // Dados Iniciais do Servidor
        const isContraste = document.body.classList.contains('contraste');
        const labelsEixoX = <?= json_encode($grafico_horarios ?? []) ?>;
        const datasetsTemperatura = <?= json_encode($datasets_temperatura ?? []) ?>;
        const datasetsUmidade = <?= json_encode($datasets_umidade ?? []) ?>;
        const datasetsSolo = <?= json_encode($datasets_solo ?? []) ?>;
        const datasetsLux = <?= json_encode($datasets_lux ?? []) ?>;
        let valorLuxAtual = <?= floatval($lux ?? 0) ?>;

        let chartTemperatura = null;
        let chartUmidade = null;
        let chartSolo = null;
        let chartLux = null;

        // Gráfico Temperatura
        const ctxTemperatura = document.getElementById('graficoMonitoramento');
        if (ctxTemperatura) {
            chartTemperatura = new Chart(ctxTemperatura, {
                type: 'line',
                data: { labels: labelsEixoX, datasets: datasetsTemperatura },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true, labels: { color: '#052501', font: { size: 13, weight: 'bold' } } }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { color: '#052501', callback: v => v + 'ºC' }, grid: { color: '#dfe6e9' } },
                        x: { ticks: { color: '#052501' }, grid: { color: '#dfe6e9' } }
                    }
                }
            });
        }

        // Gráfico Umidade
        const ctxUmidade = document.getElementById('graficoUmidade');
        if (ctxUmidade) {
            chartUmidade = new Chart(ctxUmidade, {
                type: 'line',
                data: { labels: labelsEixoX, datasets: datasetsUmidade },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true, labels: { color: '#052501', font: { size: 13, weight: 'bold' } } }
                    },
                    scales: {
                        y: { beginAtZero: true, max: 100, ticks: { color: '#052501', callback: v => v + '%' }, grid: { color: '#dfe6e9' } },
                        x: { ticks: { color: '#052501' }, grid: { color: '#dfe6e9' } }
                    }
                }
            });
        }

        // Gráfico Umidade do Solo
        const ctxUmidadeSolo = document.getElementById('graficoUmidadeSolo');
        if (ctxUmidadeSolo) {
            chartSolo = new Chart(ctxUmidadeSolo, {
                type: 'line',
                data: { labels: labelsEixoX, datasets: datasetsSolo },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { display: true, labels: { color: '#052501', font: { size: 13, weight: 'bold' } } },
                        tooltip: { callbacks: { label: ctx => `${ctx.dataset.label}: ${ctx.parsed.y}%` } }
                    },
                    scales: {
                        y: { beginAtZero: true, min: 0, max: 100, ticks: { color: '#052501', callback: v => v + '%' }, grid: { color: '#dfe6e9' } },
                        x: { ticks: { color: '#052501' }, grid: { color: '#dfe6e9' } }
                    }
                }
            });
        }

        /* ==========================================================
            (MANTEVE AS CORES ORIGINAIS + EXIBE VALOR)
        ========================================================== */
        const graficoLuxCanvas = document.getElementById('graficoLux');

        if (graficoLuxCanvas) {
            chartLux = new Chart(graficoLuxCanvas, {
                type: 'dougLUMINOSIDADEhnut',
                data: {
                    labels: ['Faixa 1', 'Faixa 2', 'Faixa 3', 'Faixa 4', 'Faixa 5'],
                    datasets: [{
                        data: [5, 10, 20, 30, 35], // Suas faixas de cores originais
                        backgroundColor: ['#4b5563', '#3b82f6', '#add1ff', '#84cc16', '#ef4444'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    rotation: -90,
                    circumference: 180,
                    cutout: '70%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    }
                }
            });
        }

        // Função apenas para atualizar o valor lido na tela
        function atualizarLux(novoValor) {
            valorLuxAtual = Number(novoValor) || 0;
            
            const elemTexto = document.getElementById('valorLuxNum');
            if (elemTexto) {
                elemTexto.textContent = valorLuxAtual.toLocaleString('pt-BR');
            }
        }

        // Atualiza o texto com o valor vindo do PHP na inicialização
        atualizarLux(valorLuxAtual);

        // Atualização Dinâmica dos Gráficos
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
                    valorLuxAtual = dados.lux;
                    chartLux.update();
                }
            } catch (erro) {
                console.error('Erro ao atualizar gráficos:', erro);
            }
        }

        // Status dos Sensores via AJAX
        async function atualizarStatusSensores() {
            const lista = document.getElementById('sensor-status-list');
            if (!lista) return;

            try {
                const resposta = await fetch('<?= base_url('status-sensores') ?>', { cache: 'no-store' });
                if (!resposta.ok) throw new Error('Erro ao buscar status');
                const sensores = await resposta.json();

                if (!Array.isArray(sensores) || sensores.length === 0) {
                    lista.innerHTML = `<div style="text-align:center; padding:30px; color:#666;">Nenhum sensor encontrado.</div>`;
                    return;
                }

                lista.innerHTML = sensores.map(sensor => {
                    let circulo = 'offline', badge = 'offline', texto = 'Offline', pulso = '';

                    if (sensor.minutos_atras !== null && Number(sensor.minutos_atras) <= 5) {
                        circulo = 'online'; badge = 'online'; texto = 'Online';
                        pulso = '<span class="pulse-dot"></span>';
                    } else if (sensor.minutos_atras !== null && Number(sensor.minutos_atras) <= 20) {
                        circulo = 'warning'; badge = 'warning'; texto = 'Oscilando';
                    }

                    return `
                        <div class="sensor-status-item">
                            <div class="sensor-left">
                                <span class="status-circle ${circulo}">
                                    <i class="fa-solid ${sensor.icone || 'fa-microchip'}"></i>
                                    ${pulso}
                                </span>
                                <div class="sensor-info">
                                    <h4>${sensor.nome || 'Sensor'}</h4>
                                    <p>${sensor.tipo || 'Sensor'} · ${sensor.tempo_texto || 'Sem leitura'}</p>
                                </div>
                            </div>
                            <div class="sensor-right">
                                <span class="signal-bars"><i></i><i></i><i></i></span>
                                <span class="status-badge ${badge}">${texto}</span>
                            </div>
                        </div>
                    `;
                }).join('');
            } catch (erro) {
                console.error('Erro nos sensores:', erro);
                lista.innerHTML = `<div style="text-align:center; padding:30px; color:#888;">Erro ao carregar sensores.</div>`;
            }
        }

        // Integração Clima Open-Meteo
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

        // Alternar Alto Contraste
        const contrasteBtn = document.getElementById('contraste-btn');
        if (contrasteBtn) {
            contrasteBtn.addEventListener('click', () => {
                document.body.classList.toggle('contraste');
                const eContraste = document.body.classList.contains('contraste');
                const corTexto = eContraste ? '#ffffff' : '#052501';
                const corGrade = eContraste ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9';

                Object.values(Chart.instances).forEach(chart => {
                    if (chart.options.scales?.x) {
                        chart.options.scales.x.ticks.color = corTexto;
                        chart.options.scales.x.grid.color = corGrade;
                    }
                    if (chart.options.scales?.y) {
                        chart.options.scales.y.ticks.color = corTexto;
                        chart.options.scales.y.grid.color = corGrade;
                    }
                    if (chart.options.plugins?.legend) {
                        chart.options.plugins.legend.labels.color = corTexto;
                    }
                    chart.update();
                });
            });
        }

        // Acessibilidade de Fonte
        let tamanhoFonte = parseInt(localStorage.getItem('tamanhoFonteDashboard')) || 100;
        const aplicarFonte = () => {
            document.documentElement.style.fontSize = tamanhoFonte + '%';
            localStorage.setItem('tamanhoFonteDashboard', tamanhoFonte);
        };
        aplicarFonte();

        document.getElementById('aumentar-fonte')?.addEventListener('click', () => { if (tamanhoFonte < 150) { tamanhoFonte += 10; aplicarFonte(); } });
        document.getElementById('diminuir-fonte')?.addEventListener('click', () => { if (tamanhoFonte > 70) { tamanhoFonte -= 10; aplicarFonte(); } });
        document.getElementById('resetar-fonte')?.addEventListener('click', () => { tamanhoFonte = 100; aplicarFonte(); });

        // Redirecionamentos de Clima
        document.getElementById('btn-previsao-completa')?.addEventListener('click', () => {
            window.open('https://www.msn.com/pt-br/clima/forecast/in-Tamba%C3%BA,S%C3%A3o-Paulo,Brasil', '_blank');
        });
        document.getElementById('btn-qualidade-ar')?.addEventListener('click', () => {
            window.open('https://www.iqair.com/br/brazil/sao-paulo/tambau', '_blank');
        });

        // Inicializadores e Timers
        atualizarStatusSensores();
        atualizarGraficos();
        buscarClima();

        setInterval(atualizarStatusSensores, 30000);
        setInterval(atualizarGraficos, 30000);
        setInterval(buscarClima, 600000);
    </script>

    <!-- JS DE INTERAÇÃO COM A DOM -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Menu Sanduíche Mobile
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.menu-overlay');

            if (menuToggle && sidebar) {
                const toggleMenu = (abrir) => {
                    const active = abrir !== undefined ? abrir : !sidebar.classList.contains('active');
                    sidebar.classList.toggle('active', active);
                    if (overlay) overlay.classList.toggle('active', active);
                    menuToggle.innerHTML = active ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
                };

                menuToggle.addEventListener('click', () => toggleMenu());
                if (overlay) overlay.addEventListener('click', () => toggleMenu(false));

                document.querySelectorAll('.sidebar .menu-item').forEach(item => {
                    item.addEventListener('click', () => {
                        if (window.innerWidth <= 768) toggleMenu(false);
                    });
                });
            }

            // Paginação da Tabela ("Mostrar Mais")
            const linhas = document.querySelectorAll('.linha-sensor');
            const botao = document.getElementById('mostrarMaisSensores');
            let quantidade = 5;

            function atualizarTabela() {
                linhas.forEach((linha, indice) => {
                    linha.style.display = indice < quantidade ? '' : 'none';
                });
                if (botao) {
                    botao.style.display = quantidade >= linhas.length ? 'none' : 'flex';
                }
            }

            atualizarTabela();
            if (botao) {
                botao.addEventListener('click', function () {
                    quantidade += 5;
                    atualizarTabela();
                });
            }
        });
    </script>

    <!-- JS EXTERNO DO DASHBOARD -->
    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>
</body>
</html>