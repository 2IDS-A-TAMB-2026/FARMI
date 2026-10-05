<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ícone do site -->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <title>Funcionário - Painel Visual</title>

    <!-- Aplica o tamanho da fonte ANTES de renderizar (evita o layout "pular") -->
    <script>
    (function () {
        var f = parseInt(localStorage.getItem('fonteSite'));
        if (isNaN(f)) f = 16;
        f = Math.min(20, Math.max(14, f));
        document.documentElement.style.fontSize = f + 'px';
    })();
    </script>

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_responsivo.css') ?>">

    <style>
        /* ==========================================================
           REGRA DE OURO: tudo que é tamanho de texto, botão, ícone e
           sidebar usa rem. Assim A+ / A- escalam o layout inteiro
           junto, em vez de só alguns textos.
           (1rem = tamanho da fonte do <html>, controlado pelo JS)
        ========================================================== */
        :root {
            --verde-escuro: #052501;
            --verde-claro: #4bc714;
            --verde-claro-hover: #66bb6a;
            --branco: #ffffff;
            --cinza-fundo: #f4f6f8;
            --texto-escuro: #333333;
            --sombra: 0 4px 6px rgba(0,0,0,0.1);
            --largura-sidebar: 15.625rem; /* 250px a 16px */
            --botao-topo: 2.625rem;       /* 42px a 16px */
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
            transition: background-color 0.3s ease;
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
            overflow-y: auto;          /* com fonte grande o menu rola em vez de cortar */
            transition: transform 0.3s ease;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 2.5rem;
            display: flex;
            flex-wrap: wrap;           /* o nome não vaza da sidebar */
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
            flex: 1;
            padding: 1.875rem;
            transition: margin 0.3s ease;
        }

        .header {
            display: flex;
            flex-wrap: wrap;           /* cabeçalho quebra linha em vez de estourar */
            justify-content: space-between;
            align-items: center;
            gap: 0.9375rem;
            margin-bottom: 1.875rem;
        }

        .header-right {
            display: flex;
            flex-wrap: wrap;           /* botões A+ A- A descem se faltar espaço */
            align-items: center;
            gap: 0.9375rem;
        }

        .header h2 {
            color: var(--verde-escuro);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        .avatar {
            width: var(--botao-topo);
            height: var(--botao-topo);
            background-color: var(--verde-claro);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--verde-escuro);
            font-weight: bold;
        }

        /* --- CARDS DE ESTATÍSTICAS --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.875rem;
        }

        .card {
            background: var(--branco);
            padding: 1.25rem;
            border-radius: 0.75rem;
            box-shadow: var(--sombra);
            border-left: 0.3125rem solid var(--verde-escuro);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.625rem;
            transition: all 0.3s ease;
        }

        .card-info {
            min-width: 0;
        }

        .card-info h3 {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 0.3125rem;
        }

        .card-info p {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--verde-escuro);
            overflow-wrap: anywhere;
        }

        .card-icon {
            font-size: 2.5rem;
            color: var(--verde-claro);
            opacity: 0.8;
            flex-shrink: 0;
        }

        /* --- TABELA DE STATUS --- */
        .section-title {
            color: var(--verde-escuro);
            margin-bottom: 0.9375rem;
            font-size: 1.2rem;
        }

        .table-container {
            background: var(--branco);
            padding: 1.25rem;
            border-radius: 0.75rem;
            box-shadow: var(--sombra);
            margin-bottom: 1.875rem;
            transition: all 0.3s ease;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 0.9375rem;
            border-bottom: 1px solid #eee;
        }

        th {
            color: var(--verde-escuro);
            font-weight: 600;
        }

        .status-badge {
            padding: 0.3125rem 0.625rem;
            border-radius: 1.25rem;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .status-ok {
            background-color: rgba(129, 199, 132, 0.2);
            color: var(--verde-escuro);
        }

        .status-alert {
            background-color: rgba(244, 67, 54, 0.2);
            color: #d32f2f;
        }

        /* --- BOTÕES DE AÇÃO --- */
        .btn {
            width: 100%;
            padding: 0.75rem 1.25rem;
            border: none;
            border-radius: 0.625rem;
            cursor: pointer;
            font-weight: bold;
            background-color: #58CC02;
            color: #fff;
            transition: .3s;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn:hover {
            background: var(--verde-claro);
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: var(--verde-escuro);
            color: var(--branco);
        }

        .btn-primary:hover {
            background-color: #1b5e20;
        }

        .btn-secondary {
            background-color: var(--verde-claro);
            color: var(--branco);
        }

        .btn-secondary:hover {
            background-color: var(--verde-claro-hover);
        }

        #contraste-btn {
            background: transparent !important;
            border: none !important;
            display: flex;
            align-items: center;
            justify-content: center;
            width: var(--botao-topo);
            height: var(--botao-topo);
            font-size: 1.25rem;
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

        .logout-btn {
            background: #58CC02;
            color: white;
            text-decoration: none;
            min-height: var(--botao-topo);   /* cresce junto com a fonte */
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.625rem;
            padding: 0 1.125rem;
            border-radius: 0.625rem;
            font-weight: bold;
            white-space: nowrap;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #46A302;
            color: white;
        }

        .accessibility-btn {
            width: var(--botao-topo);
            height: var(--botao-topo);
            background-color: #58CC02;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .accessibility-btn:hover {
            background-color: #46A302;
        }

        /* Coluna esquerda: gráfico de umidade do solo + botão Ver Alertas embaixo */
        .coluna-solo {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            min-width: 0;
        }

        .coluna-solo .btn {
            width: 100%;
        }

        /* Ações no fim do card de sensores */
        .card-actions {
            display: flex;
            flex-direction: column;
            gap: 0.625rem;
            margin-top: 1.25rem;
        }

        /* =========================
           GRID PRINCIPAL
        ========================= */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1.875rem;
        }

        .chart-card,
        .activities-card {
            background: var(--branco);
            padding: 1.5625rem;
            border-radius: 0.9375rem;
            box-shadow: var(--sombra);
        }

        /* =========================
           TÍTULOS
        ========================= */
        .chart-title {
            color: var(--verde-escuro);
            margin-bottom: 1.25rem;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        /* =========================
           GRÁFICO
           (altura FIXA é necessária: o Chart.js usa maintainAspectRatio:false)
        ========================= */
        .grafico-box {
            width: 100%;
            max-width: 100%;
            height: 350px;
            position: relative;
            border-radius: 0.9375rem;
            padding: 0.9375rem;
            overflow: hidden;
        }

        #graficoMonitoramento {
            width: 100% !important;
            height: 100% !important;
        }

        canvas {
            display: block;
            max-width: 100% !important;
        }

        /* =========================
           CULTURAS
        ========================= */
        .status-item {
            text-align: center;
            padding: 1.375rem;
            background: #fff;
            border-radius: 0.9375rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: 0.3s;
            margin-bottom: 1.25rem;
        }

        .status-item:hover {
            transform: translateY(-5px);
        }

        .status-item:last-child {
            margin-bottom: 0;
        }

        .status-item h4 {
            margin-top: 0.625rem;
            color: var(--verde-escuro);
            font-size: 1.2rem;
        }

        .status-item p {
            color: #666;
            font-size: .95rem;
        }

        /* =========================
           BOLINHA STATUS
        ========================= */
        .status-indicator {
            width: 4.6875rem;
            height: 4.6875rem;
            border-radius: 50%;
            margin: 0 auto 0.9375rem;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.8rem;
        }

        .status-saudavel {
            background: rgba(76,199,20,.15);
            border: 3px solid #4bc714;
        }

        .status-atencao {
            background: rgba(255,152,0,.15);
            border: 3px solid #ff9800;
        }

        .status-perigo {
            background: rgba(220,53,69,.15);
            border: 3px solid #dc3545;
        }

        .status-saudavel i { color: #4bc714 !important; }
        .status-atencao i  { color: #ff9800 !important; }
        .status-perigo i   { color: #dc3545 !important; }

        /* ==========================================================
           STATUS DOS SENSORES
        ========================================================== */
        .sensor-status-list {
            display: flex;
            flex-direction: column;
            gap: 0.625rem;
            width: 100%;
        }

        .sensor-status-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.9375rem;
            padding: 0.75rem 0.9375rem;
            border-radius: 0.625rem;
            background: #f8f9fa;
            border: 1px solid #e5e7eb;
            transition: 0.3s;
            width: 100%;
            min-width: 0;
            box-sizing: border-box;
        }

        .sensor-status-item:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }

        .sensor-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-width: 0;
            flex: 1;
        }

        .status-circle {
            position: relative;
            width: 2.5rem;
            height: 2.5rem;
            min-width: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .status-circle.online  { background: #e8f8df; color: #58CC02; }
        .status-circle.warning { background: #fff3cd; color: #f0ad00; }
        .status-circle.offline { background: #ffe5e5; color: #dc3545; }

        .sensor-info { min-width: 0; }

        .sensor-info h4 {
            margin: 0;
            font-size: 0.875rem;
            color: #052501;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .sensor-info p {
            margin: 0.1875rem 0 0;
            font-size: 0.6875rem;
            color: #666;
            overflow-wrap: anywhere;
        }

        .sensor-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .signal-bars {
            display: flex;
            align-items: flex-end;
            gap: 2px;
            height: 1rem;
        }

        .signal-bars i {
            display: block;
            width: 0.25rem;
            background: #58CC02;
            border-radius: 2px;
        }

        .signal-bars i:nth-child(1) { height: 0.3125rem; }
        .signal-bars i:nth-child(2) { height: 0.625rem; }
        .signal-bars i:nth-child(3) { height: 0.9375rem; }

        .sensor-status-list .status-badge {
            padding: 0.3125rem 0.625rem;
            border-radius: 1.25rem;
            font-size: 0.6875rem;
            font-weight: bold;
            white-space: nowrap;
        }

        .sensor-status-list .status-badge.online  { background: #e8f8df; color: #328000; }
        .sensor-status-list .status-badge.warning { background: #fff3cd; color: #946c00; }
        .sensor-status-list .status-badge.offline { background: #ffe5e5; color: #c62828; }

        .pulse-dot {
            position: absolute;
            width: 0.5rem;
            height: 0.5rem;
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

        .sensor-status-vazio {
            text-align: center;
            padding: 1.875rem;
            color: #666;
        }

        /* =========================
           CLIMA
        ========================= */
        .weather-card {
            background: linear-gradient(135deg, #1b5bb5 0%, #3275d2 50%, #4b8be3 100%);
            border-radius: 1.25rem;
            padding: 1rem 1.25rem;
            color: #ffffff;
            font-family: 'Segoe UI', system-ui, sans-serif;
            width: 100%;
            max-width: 100%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            box-sizing: border-box;
        }

        .weather-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .location-selector {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .weather-body {
            display: flex;
            flex-wrap: wrap;           /* temperatura e qualidade do ar não se espremem */
            justify-content: space-between;
            align-items: center;
            gap: 0.75rem;
            margin: 0.9375rem 0;
        }

        .temp-main {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        .temp-main #weather-icon {
            font-size: 2.625rem;
            color: #ffc107;
        }

        .temp-main #temperatura {
            font-size: 3.25rem;
            font-weight: 300;
            line-height: 1;
        }

        .temp-main .unit {
            font-size: 1.25rem;
            vertical-align: top;
            margin-top: -0.9375rem;
        }

        .air-quality {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.375rem 0.625rem;
            border-radius: 0.5rem;
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
            margin-top: 0.625rem;
        }

        .btn-previsao {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: white;
            padding: 0.375rem 1.25rem;
            border-radius: 1.25rem;
            font-size: 0.8125rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-previsao:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .weather-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-top: 1.25rem;
            padding-top: 0.9375rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .detail-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.625rem;
            border-radius: 0.625rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.75rem;
            min-width: 0;
            text-align: center;
        }

        .detail-item i {
            font-size: 1.125rem;
            margin-bottom: 2px;
        }

        .detail-item strong {
            font-size: 0.875rem;
            overflow-wrap: anywhere;
        }

        /* ===========================
           ALTO CONTRASTE
           (classe única: alto-contraste, igual às demais telas)
        ===========================*/
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

        body.alto-contraste .logout-btn,
        body.alto-contraste .accessibility-btn,
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

        body.alto-contraste .sensor-status-item.is-online,
        body.alto-contraste .sensor-status-item.is-offline,
        body.alto-contraste .sensor-status-item.is-warning {
            background: #000 !important;
            color: #fff !important;
            border-color: #fff !important;
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
            background: #000 !important;
            color: #fff !important;
            border-color: #fff !important;
        }

        body.alto-contraste .grafico-box canvas {
            background: #000 !important;
        }

        body.alto-contraste .chart-card .chart-title,
        body.alto-contraste .chart-card .chart-title i {
            color: #fff !important;
        }

        /* ==========================================================
           RESPONSIVO FARMI
        ========================================================== */
        html,
        body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        .main-content {
            min-width: 0;
            width: calc(100% - var(--largura-sidebar));
        }

        .stats-grid,
        .charts-grid {
            width: 100%;
            min-width: 0;
        }

        .card,
        .chart-card,
        .activities-card,
        .weather-card,
        .table-container {
            min-width: 0;
            max-width: 100%;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-container table {
            min-width: 43.75rem;       /* 700px a 16px */
        }

        /* ATÉ 1200px */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        /* TABLET - ATÉ 768px */
        @media (max-width: 768px) {

            .sidebar {
                width: var(--largura-sidebar);
                height: 100vh;
                left: 0;
                top: 0;
                z-index: 1000;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .menu-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                opacity: 0;
                visibility: hidden;
                transition: 0.3s;
            }

            .menu-overlay.active {
                opacity: 1;
                visibility: visible;
            }

            .menu-toggle {
                position: fixed;
                top: 0.9375rem;
                left: 0.9375rem;
                width: 2.8125rem;
                height: 2.8125rem;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #052501;
                color: #ffffff;
                border: none;
                border-radius: 0.625rem;
                font-size: 1.25rem;
                cursor: pointer;
                z-index: 1100;
            }

            .menu-toggle:hover {
                background: #4bc714;
            }

            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                max-width: 100%;
                padding: 4.6875rem 1.25rem 1.875rem;
            }

            .header {
                width: 100%;
                gap: 0.9375rem;
                margin-bottom: 1.5625rem;
            }

            .header h2 {
                font-size: 1.375rem;
            }

            .header-right {
                gap: 0.5rem;
                justify-content: flex-end;
            }

            .logout-btn {
                padding: 0 0.75rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.9375rem;
            }

            .card {
                padding: 1.125rem;
            }

            .card-info h3 {
                font-size: 0.875rem;
                line-height: 1.3;
            }

            .card-info p {
                font-size: 1.5rem;
                white-space: normal;
                overflow-wrap: anywhere;
            }

            .card-icon {
                font-size: 2rem;
                flex-shrink: 0;
                margin-left: 0.625rem;
            }

            .charts-grid {
                grid-template-columns: 1fr;
                gap: 0.9375rem;
            }

            .chart-card,
            .activities-card {
                width: 100%;
                padding: 1.125rem;
            }

            .chart-title {
                font-size: 1.15rem;
                line-height: 1.4;
            }

            .grafico-box {
                width: 100%;
                height: 300px;
                padding: 0.5rem;
            }

            .weather-card {
                width: 100%;
                padding: 1rem;
            }

            .weather-body {
                gap: 0.9375rem;
            }

            .temp-main #temperatura {
                font-size: 2.75rem;
            }

            .temp-main #weather-icon {
                font-size: 2.1875rem;
            }

            .air-quality {
                max-width: 50%;
            }

            .weather-details-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.625rem;
            }

            .sensor-status-item {
                width: 100%;
                min-width: 0;
            }

            .sensor-left,
            .sensor-info {
                min-width: 0;
            }

            .sensor-info h4,
            .sensor-info p {
                overflow-wrap: anywhere;
            }

            .signal-bars {
                display: none;
            }

            .table-container {
                overflow-x: auto;
            }

            .table-container table {
                min-width: 43.75rem;
            }
        }

        /* CELULAR - ATÉ 600px */
        @media (max-width: 600px) {

            .main-content {
                padding: 4.375rem 0.75rem 1.5625rem;
            }

            .header {
                align-items: flex-start;
                flex-direction: column;
            }

            .header h2 {
                font-size: 1.3125rem;
            }

            .header-right {
                width: 100%;
                justify-content: flex-start;
                gap: 0.4375rem;
            }

            .logout-btn {
                min-height: 2.5rem;
                padding: 0 0.75rem;
                font-size: 0.8125rem;
            }

            .accessibility-btn,
            #contraste-btn {
                width: 2.5rem;
                height: 2.5rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .card {
                min-height: 5.625rem;
                padding: 1rem;
            }

            .card-info p {
                font-size: 1.5625rem;
            }

            .chart-card,
            .activities-card {
                padding: 0.875rem;
            }

            .chart-title {
                font-size: 1.05rem;
                margin-bottom: 0.9375rem;
            }

            .grafico-box {
                height: 260px;
                padding: 0.3125rem;
            }

            .weather-card {
                width: 100%;
                padding: 0.9375rem;
            }

            .weather-header {
                font-size: 0.8125rem;
            }

            .weather-body {
                flex-direction: column;
                align-items: stretch;
                gap: 0.9375rem;
            }

            .temp-main {
                justify-content: center;
            }

            .temp-main #temperatura {
                font-size: 3rem;
            }

            .air-quality {
                max-width: 100%;
                width: 100%;
                justify-content: center;
            }

            .weather-details-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .detail-item {
                padding: 0.5625rem 0.3125rem;
                font-size: 0.6875rem;
            }

            .sensor-status-item {
                padding: 0.75rem;
            }

            .sensor-left {
                gap: 0.625rem;
            }

            .status-circle {
                width: 2.625rem;
                height: 2.625rem;
                min-width: 2.625rem;
                flex-shrink: 0;
            }

            .sensor-info h4 {
                font-size: 0.875rem;
            }

            .sensor-info p {
                font-size: 0.75rem;
            }

            .sensor-right {
                gap: 0.375rem;
                display: flex;
                flex-direction: column;
                align-items: flex-end;
            }

            .sensor-status-list .status-badge,
            .status-badge {
                padding: 0.3125rem 0.5625rem;
                font-size: 0.6875rem;
            }
        }

        /* CELULAR PEQUENO - ATÉ 480px */
        @media (max-width: 480px) {

            .main-content {
                padding: 4.25rem 0.625rem 1.25rem;
            }

            .menu-toggle {
                width: 2.625rem;
                height: 2.625rem;
                top: 0.75rem;
                left: 0.75rem;
            }

            .header h2 {
                font-size: 1.1875rem;
            }

            .header p {
                font-size: 0.8125rem;
            }

            .header-right {
                gap: 0.3125rem;
            }

            .logout-btn {
                padding: 0 0.625rem;
                font-size: 0.75rem;
            }

            .logout-btn i {
                margin-right: 0;
            }

            .accessibility-btn,
            #contraste-btn {
                width: 2.375rem;
                height: 2.375rem;
                font-size: 0.9375rem;
            }

            .card {
                padding: 0.875rem;
            }

            .card-info h3 {
                font-size: 0.8125rem;
            }

            .card-info p {
                font-size: 1.4375rem;
            }

            .card-icon {
                font-size: 1.8rem;
            }

            .chart-card,
            .activities-card {
                padding: 0.75rem;
            }

            .chart-title {
                font-size: 1rem;
            }

            .grafico-box {
                height: 230px;
            }

            .weather-card {
                padding: 0.8125rem;
                border-radius: 0.9375rem;
            }

            .temp-main #temperatura {
                font-size: 2.625rem;
            }

            .temp-main #weather-icon {
                font-size: 1.875rem;
            }

            .weather-details-grid {
                gap: 0.4375rem;
            }

            .detail-item {
                padding: 0.5rem 0.1875rem;
            }

            .detail-item strong {
                font-size: 0.75rem;
            }

            .sensor-status-item {
                padding: 0.625rem;
            }

            .status-circle {
                width: 2.375rem;
                height: 2.375rem;
                min-width: 2.375rem;
                font-size: 0.9375rem;
            }

            .sensor-info h4 {
                font-size: 0.8125rem;
            }

            .sensor-info p {
                font-size: 0.6875rem;
            }

            .sensor-status-list .status-badge,
            .status-badge {
                font-size: 0.625rem;
                padding: 0.25rem 0.4375rem;
            }

            .table-container {
                padding: 0.75rem;
            }

            .table-container table {
                min-width: 40.625rem;
            }
        }

        /* CELULAR MUITO PEQUENO - ATÉ 360px */
        @media (max-width: 360px) {

            .main-content {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .header-right {
                flex-wrap: wrap;
            }

            .logout-btn {
                width: 100%;
            }

            .weather-details-grid {
                grid-template-columns: 1fr 1fr;
            }

            .temp-main #temperatura {
                font-size: 2.375rem;
            }
        }

        /* ==========================================================
           PAGINAÇÃO - SENSORES E SISTEMAS
        ========================================================== */
        .sensor-pagination,
        .sistemas-pagination {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 0.625rem;
            margin-top: 0.9375rem;
        }

        .sensor-pagination button,
        .sistemas-pagination button {
            background: #58CC02;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 0.875rem;
            font-size: 0.8125rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .sensor-pagination button:hover:not(:disabled),
        .sistemas-pagination button:hover:not(:disabled) {
            background: #46A302;
        }

        .sensor-pagination button:disabled,
        .sistemas-pagination button:disabled {
            background: #ccc;
            color: #666;
            cursor: not-allowed;
        }

        .sensor-pagination .pagina-atual,
        .sistemas-pagination .pagina-atual {
            font-weight: bold;
            color: #052501;
            min-width: 6.25rem;
            text-align: center;
        }

        body.alto-contraste .sensor-pagination button,
        body.alto-contraste .sistemas-pagination button {
            background: #000 !important;
            color: #fff !important;
            border: 1px solid #fff !important;
        }

        body.alto-contraste .sensor-pagination button:disabled,
        body.alto-contraste .sistemas-pagination button:disabled {
            background: #000 !important;
            color: #777 !important;
            border-color: #777 !important;
        }

        body.alto-contraste .sensor-pagination .pagina-atual,
        body.alto-contraste .sistemas-pagination .pagina-atual {
            color: #fff !important;
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
            <a href="<?= base_url('/dashboard-usuario') ?>" class="menu-item active"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="<?= base_url('/luz') ?>" class="menu-item"><i class="fa-solid fa-lightbulb"></i> Luz</a>
            <a href="<?= base_url('/temperatura') ?>" class="menu-item"><i class="fa-solid fa-temperature-high"></i> Temperatura</a>
            <a href="<?= base_url('/umidade') ?>" class="menu-item"><i class="fa-solid fa-droplet"></i> Umidade</a>
            <a href="<?= base_url('/solo') ?>" class="menu-item"><i class="fa-solid fa-chart-pie"></i> Solo</a>
            <a href="<?= base_url('/alertas-usuario') ?>" class="menu-item"><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
            <a href="<?= base_url('/configuracoes-usuario') ?>" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
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
                <h2>Dashboard</h2>
                <p style="color: #666;">
                    Status geral do Sistema.
                </p>
            </div>

            <div class="header-right">

                <a href="<?= base_url('/logout') ?>" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>

                <button id="contraste-btn" type="button" aria-label="Alterar contraste">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>

                <button class="accessibility-btn" onclick="aumentarFonte()">A+</button>
                <button class="accessibility-btn" onclick="diminuirFonte()">A-</button>
                <button class="accessibility-btn" onclick="resetarFonte()">A</button>

                <div class="user-profile">
                    <div class="avatar">F</div>
                </div>

            </div>

        </header>

        <!-- CARDS DE ESTATÍSTICAS -->
        <div class="stats-grid">
            <div class="card">
                <div class="card-info">
                    <h3>Temperatura Atual</h3>
                    <p><?= number_format($temperatura_atual, 1, ',', '.') ?>°C</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-seedling"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Umidade Atual</h3>
                    <p><?= number_format($umidade_atual, 1, ',', '.') ?>%</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-droplet"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Luminosidade</h3>
                    <p><?= number_format($lux, 0, ',', '.') ?> Lux</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-sun"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Sensores Totais</h3>
                    <p><?= $total_sensores ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-wifi"></i></div>
            </div>
        </div>

        <!-- GRÁFICOS -->
        <div class="charts-grid">

            <!-- TEMPERATURA -->
            <div class="chart-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-chart-line"></i>
                    Temperatura do Ar (°C)
                </h3>
                <div class="grafico-box">
                    <canvas id="graficoMonitoramento"></canvas>
                </div>
            </div>

            <!-- CLIMA -->
            <div class="weather-card" id="weather-widget">

                <!-- CABEÇALHO (Cidade) -->
                <div class="weather-header">
                    <div class="location-selector">
                        <i class="fa-solid fa-location-arrow"></i>
                        <span id="cidade-nome">Tambaú</span>
                    </div>
                </div>

                <!-- CORPO (Temperatura e Qualidade do Ar) -->
                <div class="weather-body">
                    <div class="temp-main">
                        <i class="fa-solid fa-sun" id="weather-icon"></i>
                        <span id="temperatura">--</span><span class="unit">°C</span>
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

                <!-- RODAPÉ DO CLIMA -->
                <div class="weather-footer">
                    <button class="btn-previsao" id="btn-previsao-completa">Ver a previsão completa</button>
                </div>

                <!-- MÉTRICAS ADICIONAIS -->
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
                    <i class="fa-solid fa-droplet"></i>
                    Umidade do Ar (%)
                </h3>
                <div class="grafico-box">
                    <canvas id="graficoUmidade"></canvas>
                </div>
            </div>

            <!-- LUMINOSIDADE -->
            <div class="chart-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-sun"></i>
                    Luminosidade (Lux)
                </h3>
                <div class="grafico-box">
                    <canvas id="graficoLux" width="200"></canvas>
                </div>
            </div>

            <!-- UMIDADE DO SOLO + BOTÃO VER ALERTAS -->
            <div class="coluna-solo">

                <div class="chart-card">
                    <h3 class="chart-title">
                        <i class="fa-solid fa-seedling"></i>
                        Umidade do Solo (%)
                    </h3>
                    <div class="grafico-box">
                        <canvas id="graficoUmidadeSolo"></canvas>
                    </div>
                </div>

                <a href="<?= base_url('/alertas-usuario') ?>" class="btn">
                    Ver Alertas
                </a>

            </div>

            <!-- STATUS DOS SENSORES -->
            <div class="activities-card">

                <h3 class="chart-title">
                    <i class="fa-solid fa-microchip"></i>
                    Status dos Sensores
                </h3>

                <div class="sensor-status-list" id="sensor-status-list">
                    <div class="sensor-status-vazio">Carregando sensores...</div>
                    <!-- Preenchido dinamicamente por atualizarStatusSensores() -->
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

                <!-- AÇÕES -->
                <div class="card-actions">
                    <a href="<?= base_url('/relatorio') ?>" class="logout-btn">
                        <i class="fa-solid fa-print"></i>
                        Imprimir Relatório
                    </a>
                </div>

            </div>

        </div>

        <!-- TABELA DE STATUS DOS SISTEMAS -->
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
                        case 'Temperatura':
                            $icone = 'fa-temperature-high';
                            break;

                        case 'Umidade':
                            $icone = 'fa-droplet';
                            break;

                        case 'Luz':
                            $icone = 'fa-lightbulb';
                            break;

                        case 'Solo':
                            $icone = 'fa-seedling';
                            break;
                    }
                    ?>

                    <tr class="linha-sensor">

                        <td>
                            <?= esc($sensor['ID_SENSOR']) ?>
                        </td>

                        <td>
                            <i class="fa-solid <?= $icone ?>"
                               style="color: var(--verde-claro); margin-right: 8px;"></i>
                            <?= esc($sensor['NOME_SENSOR']) ?>
                        </td>

                        <td>
                            <?= esc($sensor['NOME_CULTURA']) ?>
                            <small>ID: <?= esc($sensor['ID_CULTURA']) ?></small>
                        </td>

                        <td>
                            <?= esc($sensor['NOME_FAZENDA']) ?>
                        </td>

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
                            <span class="status-badge status-ok">
                                <?= esc($sensor['STATUS']) ?>
                            </span>
                        </td>

                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>

            <!-- PAGINAÇÃO DOS SISTEMAS AUTOMATIZADOS -->
            <div class="sistemas-pagination" id="sistemas-pagination" style="display:none;">
                <button id="sistema-anterior" type="button">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <span class="pagina-atual" id="sistema-pagina-atual">
                    Página 1
                </span>

                <button id="sistema-proxima" type="button">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- ==========================================================
         GRÁFICOS
    ========================================================== -->
    <script>
    // Estado do alto contraste (lido direto do localStorage, pois a classe
    // ainda pode não ter sido aplicada no body quando os gráficos são criados)
    const contrasteAtivoInicial = localStorage.getItem('altoContraste') === 'true';
    const corEixos = contrasteAtivoInicial ? '#ffffff' : '#052501';
    const corGrade = contrasteAtivoInicial ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9';

    // Fator de escala da fonte (1 = 16px). Lê o tamanho real aplicado no <html>,
    // então os textos dentro dos gráficos acompanham o A+ / A-.
    function fatorFonte() {
        const px = parseFloat(getComputedStyle(document.documentElement).fontSize) || 16;
        return px / 16;
    }

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

    // Variáveis globais para permitir atualização do Chart.js
    let chartTemperatura = null;
    let chartUmidade = null;
    let chartSolo = null;
    let chartLux = null;

    /* =========================
       GRÁFICO - TEMPERATURA
    ========================= */
    const ctxTemperatura = document.getElementById('graficoMonitoramento');
    if (ctxTemperatura) {
        chartTemperatura = new Chart(ctxTemperatura, {
            type: 'line',
            data: { labels: ultimas10Labels, datasets: datasetsTemperatura10 },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: { color: corEixos, font: { size: Math.round(13 * fatorFonte()), weight: 'bold' } }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: corEixos,
                            font: { size: Math.round(12 * fatorFonte()) },
                            callback: function (value) { return value + 'ºC'; }
                        },
                        grid: { color: corGrade }
                    },
                    x: {
                        ticks: { color: corEixos, font: { size: Math.round(12 * fatorFonte()) } },
                        grid: { color: corGrade }
                    }
                }
            }
        });
    }

    /* =========================
       GRÁFICO - UMIDADE DO AR
    ========================= */
    const ctxUmidade = document.getElementById('graficoUmidade');
    if (ctxUmidade) {
        chartUmidade = new Chart(ctxUmidade, {
            type: 'line',
            data: { labels: ultimas10Labels, datasets: datasetsUmidade10 },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: { color: corEixos, font: { size: Math.round(13 * fatorFonte()), weight: 'bold' } }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            color: corEixos,
                            font: { size: Math.round(12 * fatorFonte()) },
                            callback: function (value) { return value + '%'; }
                        },
                        grid: { color: corGrade }
                    },
                    x: {
                        ticks: { color: corEixos, font: { size: Math.round(12 * fatorFonte()) } },
                        grid: { color: corGrade }
                    }
                }
            }
        });
    }

    /* =========================
       GRÁFICO - UMIDADE DO SOLO
    ========================= */
    const ctxUmidadeSolo = document.getElementById('graficoUmidadeSolo');
    if (ctxUmidadeSolo) {
        chartSolo = new Chart(ctxUmidadeSolo, {
            type: 'line',
            data: { labels: ultimas10Labels, datasets: datasetsSolo10 },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: { color: corEixos, font: { size: Math.round(13 * fatorFonte()), weight: 'bold' } }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label + ': ' + context.parsed.y + '%';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 100,
                        ticks: {
                            color: corEixos,
                            font: { size: Math.round(12 * fatorFonte()) },
                            callback: function (value) { return value + '%'; }
                        },
                        grid: { color: corGrade }
                    },
                    x: {
                        ticks: { color: corEixos, font: { size: Math.round(12 * fatorFonte()) } },
                        grid: { color: corGrade }
                    }
                }
            }
        });
    }

    /* =========================
       GRÁFICO - LUMINOSIDADE
    ========================= */
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
                    const f = fatorFonte();

                    ctx.save();

                    // Ícone de sol
                    ctx.font = Math.round(32 * f) + 'px Arial';
                    ctx.fillStyle = contraste ? '#ffffff' : '#052501';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText('☼', centroX, centroY - 28 * f);

                    // Valor
                    ctx.font = 'bold ' + Math.round(28 * f) + 'px Arial';
                    ctx.fillStyle = contraste ? '#ffffff' : '#052501';
                    ctx.fillText(
                        Number(valorLuxAtual).toLocaleString('pt-BR'),
                        centroX,
                        centroY + 18 * f
                    );

                    // Unidade
                    ctx.font = Math.round(16 * f) + 'px Arial';
                    ctx.fillStyle = contraste ? '#ffffff' : '#666666';
                    ctx.fillText('Lux', centroX, centroY + 43 * f);

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
       FONTES DOS GRÁFICOS (chamada pelo A+ / A- / A)
    ========================= */
    function atualizarFontesGraficos() {
        const f = fatorFonte();

        [chartTemperatura, chartUmidade, chartSolo].forEach(function (chart) {
            if (!chart) return;
            chart.options.plugins.legend.labels.font.size = Math.round(13 * f);
            chart.options.scales.x.ticks.font = { size: Math.round(12 * f) };
            chart.options.scales.y.ticks.font = { size: Math.round(12 * f) };
            chart.resize();
            chart.update();
        });

        // O texto do gauge é recalculado no afterDraw usando fatorFonte()
        if (chartLux) {
            chartLux.resize();
            chartLux.update();
        }
    }
    window.atualizarFontesGraficos = atualizarFontesGraficos;

    /* =========================
       CORES DOS GRÁFICOS NO ALTO CONTRASTE
    ========================= */
    function atualizarCoresGraficosContraste() {
        const ativo = document.body.classList.contains('alto-contraste');
        const cor   = ativo ? '#ffffff' : '#052501';
        const grade = ativo ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9';

        [chartTemperatura, chartUmidade, chartSolo].forEach(function (chart) {
            if (!chart) return;
            chart.options.plugins.legend.labels.color = cor;
            chart.options.scales.x.ticks.color = cor;
            chart.options.scales.x.grid.color  = grade;
            chart.options.scales.y.ticks.color = cor;
            chart.options.scales.y.grid.color  = grade;
            chart.update();
        });

        // O texto do gauge é recalculado sozinho no afterDraw
        if (chartLux) chartLux.update();
    }
    window.atualizarCoresGraficosContraste = atualizarCoresGraficosContraste;

    /* =========================
       OBSERVA O ALTO CONTRASTE
       Recolore os gráficos sempre que a classe "alto-contraste"
       for ligada/desligada no <body> (independe do script.js).
    ========================= */
    new MutationObserver(function () {
        atualizarCoresGraficosContraste();
    }).observe(document.body, { attributes: true, attributeFilter: ['class'] });

    // Garante o estado correto ao carregar a página
    atualizarCoresGraficosContraste();

    /* =========================
       ATUALIZA OS GRÁFICOS
    ========================= */
    async function atualizarGraficos() {
        try {
            const resposta = await fetch('<?= base_url('dados-graficos') ?>');
            if (!resposta.ok) throw new Error('Erro ao buscar dados dos gráficos');

            const dados = await resposta.json();

            // TEMPERATURA
            if (chartTemperatura && dados.temperatura) {
                chartTemperatura.data.labels = dados.horarios;
                chartTemperatura.data.datasets = dados.temperatura;
                chartTemperatura.update();
            }

            // UMIDADE DO AR
            if (chartUmidade && dados.umidade) {
                chartUmidade.data.labels = dados.horarios;
                chartUmidade.data.datasets = dados.umidade;
                chartUmidade.update();
            }

            // UMIDADE DO SOLO
            if (chartSolo && dados.solo) {
                chartSolo.data.labels = dados.horarios;
                chartSolo.data.datasets = dados.solo;
                chartSolo.update();
            }

            // LUX
            if (dados.lux !== undefined && chartLux) {
                atualizarLux(dados.lux);
            }

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
        return String(valor ?? '').replace(/[&<>"']/g, function (c) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
        });
    }

    // Só aceita classes de ícone seguras (fa-xxx)
    function iconeSeguro(icone) {
        return /^fa-[a-z0-9-]+$/i.test(icone || '') ? icone : 'fa-microchip';
    }

    function totalPaginasSensores() {
        return Math.max(1, Math.ceil(sensoresTodos.length / sensoresPorPagina));
    }

    // Converte minutos_atras em estado; qualquer valor inválido = offline
    function classificarSensor(minutosAtras) {
        const minutos = (minutosAtras === null || minutosAtras === undefined || minutosAtras === '')
            ? NaN
            : Number(minutosAtras);

        if (Number.isNaN(minutos) || minutos > 20) {
            return { estado: 'offline', classe: 'is-offline', texto: 'Offline', pulso: '' };
        }
        if (minutos <= 5) {
            return { estado: 'online', classe: 'is-online', texto: 'Online', pulso: '<span class="pulse-dot"></span>' };
        }
        return { estado: 'warning', classe: 'is-warning', texto: 'Oscilando', pulso: '' };
    }

    async function atualizarStatusSensores() {
        const lista = document.getElementById('sensor-status-list');
        if (!lista) return;

        try {
            const resposta = await fetch('<?= base_url('status-sensores') ?>', { cache: 'no-store' });

            if (!resposta.ok) {
                throw new Error('Erro ao buscar status dos sensores');
            }

            const dados = await resposta.json();

            if (!Array.isArray(dados)) {
                throw new Error('Resposta inválida em status-sensores');
            }

            sensoresTodos = dados;

            // Se a página atual deixou de existir, volta para a última
            if (paginaSensor > totalPaginasSensores()) {
                paginaSensor = totalPaginasSensores();
            }

            mostrarPaginaSensores();

        } catch (erro) {
            console.error('Erro ao atualizar status dos sensores:', erro);

            // Se já havia dados na tela, mantém; senão avisa
            if (sensoresTodos.length === 0) {
                lista.innerHTML = '<div class="sensor-status-vazio">Erro ao carregar sensores.</div>';

                const paginacao = document.getElementById('sensor-pagination');
                if (paginacao) paginacao.style.display = 'none';
            }
        }
    }

    function mostrarPaginaSensores() {
        const lista = document.getElementById('sensor-status-list');
        const paginacao = document.getElementById('sensor-pagination');
        const botaoAnterior = document.getElementById('sensor-anterior');
        const botaoProxima = document.getElementById('sensor-proxima');
        const textoPagina = document.getElementById('sensor-pagina-atual');

        if (!lista) return;

        if (sensoresTodos.length === 0) {
            lista.innerHTML = '<div class="sensor-status-vazio">Nenhum sensor encontrado.</div>';
            if (paginacao) paginacao.style.display = 'none';
            return;
        }

        const inicio = (paginaSensor - 1) * sensoresPorPagina;
        const sensoresPagina = sensoresTodos.slice(inicio, inicio + sensoresPorPagina);

        lista.innerHTML = sensoresPagina.map(function (s) {
            const st = classificarSensor(s.minutos_atras);

            return `
                <div class="sensor-status-item ${st.classe}">
                    <div class="sensor-left">
                        <span class="status-circle ${st.estado}">
                            <i class="fa-solid ${iconeSeguro(s.icone)}"></i>
                            ${st.pulso}
                        </span>
                        <div class="sensor-info">
                            <h4>${escaparHtml(s.nome || 'Sensor')}</h4>
                            <p>${escaparHtml(s.tipo || 'Sensor')} · ${escaparHtml(s.tempo_texto || 'Sem leitura')}</p>
                        </div>
                    </div>
                    <div class="sensor-right">
                        <span class="signal-bars"><i></i><i></i><i></i></span>
                        <span class="status-badge ${st.estado}">${st.texto}</span>
                    </div>
                </div>`;
        }).join('');

        const totalPaginas = totalPaginasSensores();

        // Só mostra a paginação se houver mais de uma página
        if (paginacao && totalPaginas > 1) {
            paginacao.style.display = 'flex';
            textoPagina.textContent = `Página ${paginaSensor} de ${totalPaginas}`;
            botaoAnterior.style.display = paginaSensor <= 1 ? 'none' : 'inline-flex';
            botaoProxima.style.display = paginaSensor >= totalPaginas ? 'none' : 'inline-flex';
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
    <script>

    /* =========================
       FONTE
       Limites desta tela: 14px a 20px, passo de 2px.
       (acima de 20px o layout deixa de caber)
    ========================= */
    const FONTE_MIN = 14;
    const FONTE_MAX = 20;
    const FONTE_PADRAO = 16;
    const FONTE_PASSO = 2;

    let tamanhoFonte = parseInt(localStorage.getItem('fonteSite'));
    if (isNaN(tamanhoFonte)) tamanhoFonte = FONTE_PADRAO;
    tamanhoFonte = Math.min(FONTE_MAX, Math.max(FONTE_MIN, tamanhoFonte));
    document.documentElement.style.fontSize = tamanhoFonte + 'px';

    function salvarFonte() {
        document.documentElement.style.fontSize = tamanhoFonte + 'px';
        localStorage.setItem('fonteSite', tamanhoFonte);

        // Redesenha os gráficos com o novo tamanho de texto
        if (typeof window.atualizarFontesGraficos === 'function') {
            window.atualizarFontesGraficos();
        }
    }

    function aumentarFonte() {
        if (tamanhoFonte < FONTE_MAX) {
            tamanhoFonte += FONTE_PASSO;
            salvarFonte();
        }
    }

    function diminuirFonte() {
        if (tamanhoFonte > FONTE_MIN) {
            tamanhoFonte -= FONTE_PASSO;
            salvarFonte();
        }
    }

    function resetarFonte() {
        tamanhoFonte = FONTE_PADRAO;
        salvarFonte();
    }
    </script>

    <!-- ==========================================================
         CLIMA
    ========================================================== -->
    <script>
    async function buscarClima() {
        // Coordenadas de Tambaú - SP
        const lat = -21.7056;
        const lon = -47.2728;

        try {
            // Temperatura, vento, umidade, chuva, UV, sensação térmica e ponto de orvalho
            const resClima = await fetch(
                `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,relative_humidity_2m,precipitation,wind_speed_10m,uv_index,apparent_temperature,dewpoint_2m`
            );
            const dataClima = await resClima.json();
            const atual = dataClima.current;

            document.getElementById('temperatura').textContent = Math.round(atual.temperature_2m);

            if (document.getElementById('dado-vento')) {
                document.getElementById('dado-vento').textContent = `${Math.round(atual.wind_speed_10m)} km/h`;
            }
            if (document.getElementById('dado-umidade')) {
                document.getElementById('dado-umidade').textContent = `${atual.relative_humidity_2m}%`;
            }
            if (document.getElementById('dado-chuva')) {
                document.getElementById('dado-chuva').textContent = `${atual.precipitation} mm`;
            }
            if (document.getElementById('dado-uv')) {
                document.getElementById('dado-uv').textContent = Math.round(atual.uv_index);
            }
            if (document.getElementById('dado-sensacao')) {
                document.getElementById('dado-sensacao').textContent = `${Math.round(atual.apparent_temperature)} °C`;
            }
            if (document.getElementById('dado-orvalho')) {
                document.getElementById('dado-orvalho').textContent = `${Math.round(atual.dewpoint_2m)} °C`;
            }

            // Qualidade do ar
            const resAr = await fetch(
                `https://air-quality-api.open-meteo.com/v1/air-quality?latitude=${lat}&longitude=${lon}&current=european_aqi`
            );
            const dataAr = await resAr.json();
            const aqi = dataAr.current.european_aqi;

            let textoAr = "Boa";
            if (aqi > 20 && aqi <= 40) textoAr = "Moderada";
            if (aqi > 40) textoAr = "Ruim";

            document.getElementById('qualidade-ar').textContent = textoAr;

        } catch (erro) {
            console.error("Erro ao carregar dados do clima:", erro);

            // Contingência em caso de falha
            document.getElementById('temperatura').textContent = "23";
            document.getElementById('qualidade-ar').textContent = "Moderada";

            if (document.getElementById('dado-vento')) document.getElementById('dado-vento').textContent = "-- km/h";
            if (document.getElementById('dado-umidade')) document.getElementById('dado-umidade').textContent = "--%";
            if (document.getElementById('dado-chuva')) document.getElementById('dado-chuva').textContent = "0.0 mm";
            if (document.getElementById('dado-uv')) document.getElementById('dado-uv').textContent = "--";
            if (document.getElementById('dado-sensacao')) document.getElementById('dado-sensacao').textContent = "-- °C";
            if (document.getElementById('dado-orvalho')) document.getElementById('dado-orvalho').textContent = "-- °C";
        }
    }

    // Ações dos botões do clima
    const btnPrevisao = document.getElementById('btn-previsao-completa');
    if (btnPrevisao) {
        btnPrevisao.addEventListener('click', () => {
            window.open('https://www.msn.com/pt-br/clima/forecast/in-Tamba%C3%BA,S%C3%A3o-Paulo,Brasil', '_blank');
        });
    }

    const btnAr = document.getElementById('btn-qualidade-ar');
    if (btnAr) {
        btnAr.addEventListener('click', () => {
            window.open('https://www.iqair.com/br/brazil/sao-paulo/tambau', '_blank');
        });
    }

    // Execução inicial e atualização a cada 10 minutos
    buscarClima();
    setInterval(buscarClima, 10 * 60 * 1000);
    </script>

    <!-- ==========================================================
         MENU SANDUÍCHE + PAGINAÇÃO DOS SISTEMAS
    ========================================================== -->
    <script>
    /* =========================
       MENU SANDUÍCHE
    ========================= */
    document.addEventListener('DOMContentLoaded', function () {

        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');

        // Cria o fundo escuro
        const overlay = document.createElement('div');
        overlay.classList.add('menu-overlay');
        document.body.appendChild(overlay);

        function fecharMenu() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            menuToggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
            menuToggle.setAttribute('aria-label', 'Abrir menu');
        }

        // Abrir e fechar menu
        menuToggle.addEventListener('click', function () {

            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');

            if (sidebar.classList.contains('active')) {
                menuToggle.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                menuToggle.setAttribute('aria-label', 'Fechar menu');
            } else {
                menuToggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
                menuToggle.setAttribute('aria-label', 'Abrir menu');
            }

        });

        // Fecha ao clicar no fundo escuro
        overlay.addEventListener('click', fecharMenu);

        // Fecha o menu ao clicar em um item (mobile)
        document.querySelectorAll('.sidebar .menu-item').forEach(function (item) {
            item.addEventListener('click', function () {
                if (window.innerWidth <= 768) {
                    fecharMenu();
                }
            });
        });

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
    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>
</body>
</html>