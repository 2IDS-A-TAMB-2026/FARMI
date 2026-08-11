<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Ícone do site-->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <title>Funcionário - Painel Visual</title>
    <!-- Ícones  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- RESPONSIVO -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_responsivo.css') ?>">
    
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
            background-color: var(--cinza-fundo);
            display: flex;
            min-height: 100vh;
            transition: all 0.3s ease;
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
            transition: all 0.3s ease;
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
            transition: all 0.3s ease;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 15px; /* Ajustado de 10px para 15px igual ao dADMIN */
        }

                .header h2 {
                    color: var(--verde-escuro);
                }

                .user-profile {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }

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

        /* --- CARDS DE ESTATÍSTICAS --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: var(--branco);
            padding: 20px;
            border-radius: 12px;
            box-shadow: var(--sombra);
            border-left: 5px solid var(--verde-escuro);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .card-info h3 {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 5px;
        }

        .card-info p {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--verde-escuro);
        }

        .card-icon {
            font-size: 2.5rem;
            color: var(--verde-claro);
            opacity: 0.8;
        }

        /* --- TABELA DE STATUS --- */
        .section-title {
            color: var(--verde-escuro);
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .table-container {
            background: var(--branco);
            padding: 20px;
            border-radius: 12px;
            box-shadow: var(--sombra);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        th {
            color: var(--verde-escuro);
            font-weight: 600;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
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
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            background-color: #052501;
            color: #fff;
            transition: .3s;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn:hover{
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


/* =========================
   GRID PRINCIPAL
========================= */

.charts-grid{
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

.chart-card,
.activities-card{
    background: var(--branco);
    padding: 25px;
    border-radius: 15px;
    box-shadow: var(--sombra);
}

/* =========================
   TITULOS
========================= */

.chart-title{
    color: var(--verde);
    margin-bottom: 20px;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* =========================
   GRÁFICO
========================= */


.grafico-box{
    width: 100%;
    min-height: 350px;
    position: relative;
    border-radius: 15px;
    padding: 15px;
    overflow: hidden;
}

#graficoMonitoramento{
    width: 100% !important;
    height: 100% !important;
}

canvas{
    display: block;
}

/* =========================
   CULTURAS
========================= */

.status-item{
    text-align: center;

    padding: 22px;

    background: #fff;

    border-radius: 15px;

    box-shadow: 0 4px 10px rgba(0,0,0,0.08);

    transition: 0.3s;

    margin-bottom: 20px;
}

.status-item:hover{
    transform: translateY(-5px);
}

.status-item:last-child{
    margin-bottom: 0;
}

.status-item h4{
    margin-top: 10px;

    color: var(--verde);

    font-size: 1.2rem;
}

.status-item p{
    color: #666;

    font-size: .95rem;
}

/* =========================
   BOLINHA STATUS
========================= */

.status-indicator{
    width: 75px;
    height: 75px;

    border-radius: 50%;

    margin: 0 auto 15px;

    display: flex;
    justify-content: center;
    align-items: center;

    font-size: 1.8rem;
}

/* =========================
   STATUS CULTURAS
========================= */

.status-saudavel{
    background: rgba(76,199,20,.15);
    border: 3px solid #4bc714;
}

.status-atencao{
    background: rgba(255,152,0,.15);
    border: 3px solid #ff9800;
}

.status-perigo{
    background: rgba(220,53,69,.15);
    border: 3px solid #dc3545;
}

/* COR DOS ÍCONES */

.status-saudavel i{
    color: #4bc714 !important;
}

.status-atencao i{
    color: #ff9800 !important;
}

.status-perigo i{
    color: #dc3545 !important;
}

.weather-card {
    background: linear-gradient(135deg, #1b5bb5 0%, #3275d2 50%, #4b8be3 100%);
    border-radius: 20px;
    padding: 16px 20px;
    color: #ffffff;
    font-family: 'Segoe UI', system-ui, sans-serif;
    width: 592px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    position: relative;
    overflow: hidden;
}

/* Cabeçalho */
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

/* Corpo */
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
    color: #ffc107; /* Cor do sol */
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

/* Qualidade do ar */
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

/* Rodapé */
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

/* ===========================
   ALTO CONTRASTE (CORRIGIDO)
===========================*/

body.contraste{
    background:#000 !important;
    color:#fff !important;
}

body.contraste *{
    color:#fff !important;
    border-color:#fff !important;
}

body.contraste .sidebar{
    background:#000 !important;
    border-right:2px solid #fff;
}

body.contraste .main-content{
    background:#000 !important;
}

body.contraste .card,
body.contraste .table-container,
body.contraste .chart-card,
body.contraste .activities-card,
body.contraste .weather-card,
body.contraste .status-item{
    background:#111 !important;
    color:#fff !important;
    border:2px solid #fff !important;
    box-shadow:none !important;
}

/* CORREÇÃO DO ALERTA: Troca o fundo rosa/branco do alerta por preto */
body.contraste .activities-card > div {
    background: #000 !important;
    border: 1px solid #fff !important;
}
/* Sobrescreve o botão 'Ver Alertas' exclusivamente no Alto Contraste */
body.contraste .activities-card .btn {
    background-color: #ffffff !important;
    color: #000000 !important;
    border: 2px solid #ffffff !important;
}

body.contraste .activities-card .btn:hover {
    background-color: #e6e6e6 !important;
    color: #000000 !important;
}

body.contraste table,
body.contraste tr,
body.contraste td,
body.contraste th{
    background:#111 !important;
    color:#fff !important;
    border:1px solid #fff !important;
}

body.contraste .status-badge{
    background:#fff !important;
    color:#000 !important;
}

body.contraste .logout-btn,
body.contraste .accessibility-btn,
body.contraste .btn,
body.contraste .mostrar-mais {
    background:#000 !important;
    color:#fff !important;
    border:2px solid #fff !important;
}
body.contraste *{
    color:#fff !important;
    border-color:#fff !important;
}

#contraste-btn:hover {
    color: var(--verde-claro) !important;
}

body.contraste #contraste-btn:hover {
    color: #fff !important;
}

body.contraste .avatar{
    background:#fff !important;
    color:#000 !important;
}

body.contraste input,
body.contraste select,
body.contraste textarea{
    background:#000 !important;
    color:#fff !important;
    border:2px solid #fff !important;
}

/* CORREÇÃO DOS EIXOS DOS GRÁFICOS (X e Y):
   Aplica o filtro invert para transformar os eixos/textos pretos do Chart.js em brancos */

/* ==========================================================
   DASHBOARD FARMI - RESPONSIVIDADE ESPECÍFICA
   ========================================================== */
.dashboard-container {
    width: 100%;
    max-width: 100%;
    min-width: 0;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 20px;
    width: 100%;
}
.stats-grid .card {
    width: 100%;
    min-width: 0;
    overflow: hidden;
}
.card-info {
    min-width: 0;
}
.card-info h3 {
    overflow-wrap: break-word;
}
.card-info p {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
/* GRÁFICOS */
.charts-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
    width: 100%;
    min-width: 0;
}
.chart-card {
    width: 100%;
    min-width: 0;
    overflow: hidden;
}
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
/* SEÇÕES */
.dashboard-section {
    width: 100%;
    max-width: 100%;
    min-width: 0;
}
/* SENSORES */
.sensor-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 20px;
    width: 100%;
}
.sensor-card {
    width: 100%;
    min-width: 0;
    overflow: hidden;
}
/* TABELAS */
.dashboard-table-container {
    width: 100%;
    max-width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.dashboard-table-container table {
    min-width: 700px;
}
/* NOTEBOOK / DESKTOP MENOR */
@media (max-width: 1200px) {
    .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    .charts-grid {
        grid-template-columns: 1fr;
    }
    .sensor-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}
/* TABLET */
@media (max-width: 768px) {
    .main-content {
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 100%;
        padding: 75px 15px 25px;
    }
    .dashboard-container {
        width: 100%;
        max-width: 100%;
    }
    .header {
        width: 100%;
        margin-bottom: 20px;
    }
    .header h2 {
        font-size: 22px;
        line-height: 1.3;
    }
    .header p {
        font-size: 14px;
        line-height: 1.5;
    }
    .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
    }
    .stats-grid .card {
        min-height: 110px;
    }
    .card-info h3 {
        font-size: 14px;
    }
    .card-info p {
        font-size: 24px;
    }
    .charts-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    .chart-card {
        width: 100%;
        padding: 15px;
    }
    .chart-container {
        height: 280px;
    }
    .sensor-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
    }
    .sensor-card {
        padding: 15px;
    }
    .dashboard-table-container {
        width: 100%;
        overflow-x: auto;
    }
    .dashboard-table-container table {
        min-width: 650px;
    }
}
/* CELULAR */
@media (max-width: 600px) {
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    .stats-grid .card {
        min-height: 95px;
    }
    .card-info h3 {
        font-size: 15px;
    }
    .card-info p {
        font-size: 26px;
    }
    .charts-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    .chart-card {
        padding: 12px;
    }
    .chart-container {
        height: 250px;
    }
    .sensor-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    .sensor-card {
        width: 100%;
    }
    .section-title {
        font-size: 18px;
        line-height: 1.4;
    }
}
/* CELULAR PEQUENO */
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
    .stats-grid .card {
        padding: 15px;
    }
    .card-info h3 {
        font-size: 14px;
    }
    .card-info p {
        font-size: 23px;
    }
    .chart-card {
        padding: 10px;
    }
    .chart-container {
        height: 220px;
    }
    .dashboard-table-container table {
        min-width: 600px;
    }
}
.mostrar-mais{
    color: var(--verde-escuro);
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: 0.3s;
    background: transparent;
    cursor: pointer;
    padding: 10px;
    background-color: #57c91b;
    color: #fff;
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
            <a href="<?= base_url('/luz') ?>" class="menu-item "><i class="fa-solid fa-lightbulb"></i> Luz</a>
            <a href="<?= base_url('/temperatura') ?>" class="menu-item"><i class="fa-solid fa-temperature-high"></i> Temperatura</a>
            <a href="<?= base_url('/umidade') ?>" class="menu-item"><i class="fa-solid fa-droplet"></i> Umidade</a>
            <a href="<?= base_url('/solo') ?>" class="menu-item"><i class="fa-solid fa-chart-pie"></i> Solo</a>
            <a href="<?= base_url('/alertas-usuario') ?>" class="menu-item"><i class="fa-solid fa-triangle-exclamation"></i>Alertas</a>
            <a href="<?= base_url('/configuracoes-usuario') ?>" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
        </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">

    <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu">
        <i class="fa-solid fa-bars"></i>
    </button>
        
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

            <button id="contraste-btn" aria-label="Alterar contraste">
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
                    <p><?= number_format($temperatura_atual, 1, ',', '.') ?>°C </p>
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
                <div class="card-icon"><i class="fa-solid fa-sun"></i></i></div>
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

            <!-- TEMPERATURA - MONITORAMENTO -->
            <div class="chart-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-chart-line"></i>
                    Temperatura
                </h3>
                <div class="grafico-box">
                    <canvas id="graficoMonitoramento"></canvas>
                </div>
            </div>

            <!-- CLIMA -->
        <div class="weather-card" id="weather-widget">
    <!-- CABEÇALHO (Cidade e Opções) -->
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

    <!-- METRICAS AGRÍCOLAS ADICIONAIS -->
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

            <!-- UMIDADE DO Ar -->
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

            <!-- UMIDADE DO Solo -->
            <div class="chart-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-seedling"></i>
                    Umidade do Solo (%)
                </h3>
                <div class="grafico-box">
                    <canvas id="graficoUmidadeSolo"></canvas>
                </div>
            </div>
            
            <!-- ALERTAS -->
        <div class="activities-card">

            <h3 class="chart-title">
                <i class="fa-solid fa-bell"></i>
                Alertas (3)
            </h3>

            <div style="
                height:200px;
                background:linear-gradient(135deg,#fff5f5 0%,#ffebee 100%);
                border-radius:8px;
                padding:15px;
                overflow-y:auto;
                font-size:.9rem;
            ">

                <div style="color:var(--vermelho); margin-bottom:10px;">
                    ⚠️ Temperatura alta na Estufa A
                </div>

                <div style="color:var(--laranja); margin-bottom:10px;">
                    🌡️ Umidade baixa no Campo B
                </div>

                <div style="color:var(--azul);">
                    💡 Luz fraca na Estufa C
                </div>

            </div>

            <a href="<?= base_url('/alertas-usuario') ?>"
               class="btn">
                Ver Alertas
            </a>

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
                        style="color: var(--verde-claro); margin-right: 8px;">
                        </i>

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
                        <?= $sensor['DATA_HORA'] ?>
                    </td>

                    <td>
                        <?php
                        switch ($sensor['TIPO_SENSOR']) {
                            case 'Temperatura':
                                echo number_format($sensor['VALOR'], 1, ',', '.') . ' °C';
                                break;

                            case 'Umidade':
                                echo number_format($sensor['VALOR'], 1, ',', '.') . ' %';
                                break;

                            case 'Solo':
                                echo number_format($sensor['VALOR'], 1, ',', '.') . ' %';
                                break;

                            case 'Luz':
                                echo number_format($sensor['VALOR'], 0, ',', '.') . ' Lux';
                                break;

                            default:
                                echo $sensor['VALOR'];
                        }
                        ?>
                    </td>

                    <td>
                        <span class="status-badge status-ok">
                            <?= $sensor['STATUS'] ?>
                        </span>
                    </td>

                </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
            <div id="mostrarMaisSensores" class="mostrar-mais">
                Mostrar mais
            <i class="fa-solid fa-chevron-down"></i>
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

    <script>
    // Detecta se o modo alto contraste já está ativo
const isContraste = document.body.classList.contains('contraste');
const corEixos = isContraste ? '#ffffff' : '#052501';
const corGrade = isContraste ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9';
    const labelsEixoX = <?= json_encode($grafico_horarios ?? []) ?>;
    const datasetsTemperatura = <?= json_encode($datasets_temperatura ?? []) ?>;
    const datasetsUmidade = <?= json_encode($datasets_umidade ?? []) ?>;
    const datasetsSolo = <?= json_encode($datasets_solo ?? []) ?>;
    const valorLux = <?= $lux ?? 0 ?>;

    

    /* =========================
    GRÁFICO - TEMPERATURA
    ========================= */
    const ctx = document.getElementById('graficoMonitoramento');

    new Chart(ctx, {

        type: 'line',

        data: {
            labels: labelsEixoX,
            datasets: datasetsTemperatura
        },

     options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            labels: {
                color: () => document.body.classList.contains('contraste') ? '#ffffff' : '#052501',
                font: { size: 14 }
            }
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            ticks: {
                color: () => document.body.classList.contains('contraste') ? '#ffffff' : '#052501'
            },
            grid: {
                color: () => document.body.classList.contains('contraste') ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9'
            }
        },
        x: {
            ticks: {
                color: () => document.body.classList.contains('contraste') ? '#ffffff' : '#052501'
            },
            grid: {
                color: () => document.body.classList.contains('contraste') ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9'
            }
        }
    }
}

    });

    /* =========================
    GRÁFICO UMIDADE DO AR
    ========================= */
    const ctxUmidade = document.getElementById('graficoUmidade');

    if (ctxUmidade) {

        // 🔧 LIMPA OS DADOS (remove null e garante número)
        const datasetsUmidadeLimpos = datasetsUmidade.map(sensor => {

            return {
                label: sensor.label,
                data: sensor.data.map(v => v ?? 0), // 🔥 AQUI É A CORREÇÃO
                borderColor: sensor.borderColor,
                backgroundColor: 'transparent',
                borderWidth: 3,
                tension: 0.3
            };

        });

        new Chart(ctxUmidade, {

            type: 'line',

            data: {
                labels: labelsEixoX,
                datasets: datasetsUmidadeLimpos
            },

           options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: true,
            labels: {
                color: () => document.body.classList.contains('contraste') ? '#ffffff' : '#052501',
                font: { size: 13, weight: 'bold' }
            }
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            max: 100,
            ticks: {
                color: () => document.body.classList.contains('contraste') ? '#ffffff' : '#052501',
                callback: v => v + '%'
            },
            grid: { 
                color: () => document.body.classList.contains('contraste') ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9' 
            }
        },
        x: {
            ticks: { 
                color: () => document.body.classList.contains('contraste') ? '#ffffff' : '#052501' 
            },
            grid: { 
                color: () => document.body.classList.contains('contraste') ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9' 
            }
        }
    }
}
        });
    }

    /* =========================
    GRÁFICO UMIDADE DO SOLO (MÚLTIPLOS SENSORES)
    ========================= */
    const ctxUmidadeSolo = document.getElementById('graficoUmidadeSolo');

    if (ctxUmidadeSolo) {
        new Chart(ctxUmidadeSolo, {
            type: 'line',
            data: {
                labels: labelsEixoX,
                datasets: datasetsSolo // já vem pronto do PHP
            },
          options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: true,
            labels: {
                color: () => document.body.classList.contains('contraste') ? '#ffffff' : '#052501',
                font: { size: 13, weight: 'bold' }
            }
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            max: 100,
            ticks: {
                color: () => document.body.classList.contains('contraste') ? '#ffffff' : '#052501',
                callback: function(value) { return value + '%'; }
            },
            grid: { 
                color: () => document.body.classList.contains('contraste') ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9' 
            }
        },
        x: {
            ticks: { 
                color: () => document.body.classList.contains('contraste') ? '#ffffff' : '#052501' 
            },
            grid: { 
                color: () => document.body.classList.contains('contraste') ? 'rgba(255, 255, 255, 0.2)' : '#dfe6e9' 
            }
        }
    }
}
        });
    }


    /* =========================
    GRÁFICO LUMINOSIDADE
    ========================= */

    function classificarLux(lux) {

        if (lux <= 10) {
            return {
                status: 'Baixa luminosidade',
                ambiente: 'Noite',
                cor: '#4b5563' // cinza
            };
        }

        if (lux <= 500) {
            return {
                status: 'Baixa luminosidade',
                ambiente: 'Ambiente interno',
                cor: '#3b82f6'
            };
        }

        if (lux <= 5000) {
            return {
                status: 'Moderada',
                ambiente: 'Nublado',
                cor: '#add1ff'
            };
        }

        if (lux <= 25000) {
            return {
                status: 'Ideal',
                ambiente: 'Sol indireto',
                cor: '#84cc16'
            };
        }

        return {
            status: 'Alta luminosidade',
            ambiente: 'Sol forte',
            cor: '#dc2626'
        };
    }

    const infoLux = classificarLux(valorLux);

    new Chart(document.getElementById('graficoLux'), {

        type: 'doughnut',

        data: {
            datasets: [{
                data: [5, 10, 20, 30, 35],
                backgroundColor: [
                    '#4b5563',
                    '#3b82f6',
                    '#add1ff',
                    '#84cc16',
                    '#ef4444'
                ],
                borderWidth: 0
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            rotation: -90,
            circumference: 180,

            cutout: '70%',

          plugins: [{
    id: 'gaugeText',
    afterDraw(chart) {
        const {
            ctx,
            chartArea: { width, height }
        } = chart;

        // Verifica se o modo alto contraste está ativo na página
        const emContraste = document.body.classList.contains('contraste');
        const corTextoPrincipal = emContraste ? '#ffffff' : '#052501';
        const corTextoSecundario = emContraste ? '#ffffff' : '#666666';

        ctx.save();

        // 1. Valor Lux (ex: 16.800)
        ctx.font = 'bold 26px Arial';
        ctx.fillStyle = corTextoPrincipal; // <-- Garante o Branco no Alto Contraste
        ctx.textAlign = 'center';

        ctx.fillText(
            valorLux.toLocaleString('pt-BR'),
            width / 2,
            height - 55
        );

        // 2. Unidade (Lux)
        ctx.font = '16px Arial';
        ctx.fillStyle = corTextoSecundario; // <-- Garante o Branco no Alto Contraste

        ctx.fillText(
            'Lux',
            width / 2,
            height - 30
        );

        // 3. Status (Ideal, Baixa, etc.)
        ctx.font = 'bold 15px Arial';
        ctx.fillStyle = emContraste ? '#ffffff' : infoLux.cor; // Para contraste total, deixa branco ou a cor do status

        ctx.fillText(
            infoLux.status,
            width / 2,
            height - 8
        );

        // 4. Ambiente (Sol indireto, etc.)
        ctx.font = '13px Arial';
        ctx.fillStyle = corTextoSecundario;

        ctx.fillText(
            infoLux.ambiente,
            width / 2,
            height + 15
        );

        ctx.restore();
    }
}]
        },

        plugins: [{

            id: 'gaugeText',

           afterDraw(chart) {
    const {
        ctx,
        chartArea: { width, height }
    } = chart;

    // Detecta se o contraste está ativado
    const isContraste = document.body.classList.contains('contraste');
    const corTextoPrincipal = isContraste ? '#ffffff' : '#052501';
    const corTextoSecundario = isContraste ? '#cccccc' : '#666666';

    ctx.save();

    // Valor Lux
    ctx.font = 'bold 26px Arial';
    ctx.fillStyle = corTextoPrincipal; // <-- Usando a cor dinâmica
    ctx.textAlign = 'center';

    ctx.fillText(
        valorLux.toLocaleString('pt-BR'),
        width / 2,
        height - 55
    );

    // Unidade
    ctx.font = '16px Arial';
    ctx.fillStyle = corTextoPrincipal; // <-- Usando a cor dinâmica

    ctx.fillText(
        'Lux',
        width / 2,
        height - 30
    );

    // Status
    ctx.font = 'bold 15px Arial';
    ctx.fillStyle = infoLux.cor;

    ctx.fillText(
        infoLux.status,
        width / 2,
        height - 8
    );

    // Ambiente
    ctx.font = '13px Arial';
    ctx.fillStyle = corTextoSecundario; // <-- Usando a cor dinâmica

    ctx.fillText(
        infoLux.ambiente,
        width / 2,
        height + 15
    );

    ctx.restore();
}
        }]
    });



    /* =========================
    CULTURAS FIXAS
    ========================= */

    /* MILHO */
    document.getElementById('statusMilho').innerText = 'Saudável';

    /* SOJA */
    document.getElementById('statusSoja').innerText = 'Em atenção';

    /* CAFÉ */
    document.getElementById('statusCafe').innerText = 'Crítico';
    /* Atualiza sozinho */
    setInterval(atualizarCulturas, 5000);

    </script>
    
    <script src="./../script.js"></script>

    <script>
        let tamanhoFonte = 100;

        function aplicarFonte() {
            document.body.style.fontSize = tamanhoFonte + "%";
        }

        function aumentarFonte() {
            if (tamanhoFonte < 150) {
                tamanhoFonte += 10;
                aplicarFonte();
            }
        }

        function diminuirFonte() {
            if (tamanhoFonte > 80) {
                tamanhoFonte -= 10;
                aplicarFonte();
            }
        }

        function resetarFonte() {
            tamanhoFonte = 100;
            aplicarFonte();
        }
const contrasteBtn = document.getElementById("contraste-btn");

// Carrega o estado salvo
if (localStorage.getItem("contraste") === "true") {
    document.body.classList.add("contraste");
}

contrasteBtn.addEventListener("click", () => {
    document.body.classList.toggle("contraste");

    localStorage.setItem(
        "contraste",
        document.body.classList.contains("contraste")
    );

    
});
        


        async function buscarClima() {
    // Coordenadas de Tambaú - SP
    const lat = -21.7056;
    const lon = -47.2728;

    try {
        // Busca Temperatura, Vento, Umidade, Chuva, UV, Sensação Térmica e Ponto de Orvalho
        const resClima = await fetch(
            `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,relative_humidity_2m,precipitation,wind_speed_10m,uv_index,apparent_temperature,dewpoint_2m`
        );
        const dataClima = await resClima.json();
        const atual = dataClima.current;

        // Temperatura principal
        document.getElementById('temperatura').textContent = Math.round(atual.temperature_2m);

        // Preenchimento das 6 métricas em tempo real
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

        // Qualidade do Ar
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

// --- AÇÕES DOS BOTÕES ---

const btnPrevisao = document.getElementById('btn-previsao-completa');
if (btnPrevisao) {
    btnPrevisao.addEventListener('click', () => {
        const urlPrevisao = 'https://www.msn.com/pt-br/clima/forecast/in-Tamba%C3%BA,S%C3%A3o-Paulo,Brasil';
        window.open(urlPrevisao, '_blank');
    });
}

const btnAr = document.getElementById('btn-qualidade-ar');
if (btnAr) {
    btnAr.addEventListener('click', () => {
        const urlQualidadeAr = 'https://www.iqair.com/br/brazil/sao-paulo/tambau';
        window.open(urlQualidadeAr, '_blank');
    });
}

// Execução inicial e atualização a cada 10 minutos
buscarClima();
setInterval(buscarClima, 10 * 60 * 1000);

// Atualiza os dados automaticamente a cada 10 minutos
setInterval(buscarClima, 10 * 60 * 1000);
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

    const linhas = document.querySelectorAll(".linha-sensor");
const botao = document.getElementById("mostrarMaisSensores");

let quantidade = 5; // quantidade inicial

function atualizarTabela() {

    linhas.forEach((linha, indice) => {

        if (indice < quantidade) {
            linha.style.display = "";
        } else {
            linha.style.display = "none";
        }

    });

    if (quantidade >= linhas.length) {
        botao.style.display = "none";
    } else {
        botao.style.display = "flex";
    }
}

atualizarTabela();

botao.addEventListener("click", function () {

    quantidade += 5;

    atualizarTabela();

});
    </script>
</body>
</html>