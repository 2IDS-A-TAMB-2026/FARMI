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

        /* MODO ALTO CONTRASTE */
        [data-high-contrast="true"] {
            --verde-escuro: #ffff !important; 
            --verde-claro: #ffff !important;
            --verde-claro-hover: #ffff !important; 
            --branco: #ffff !important; 
            --cinza-fundo: #000000 !important; /* Preto */
            --texto-escuro: #ffff !important; 
        }

        [data-high-contrast="true"] * {
            color: #ffff !important;
            background-color: #000000 !important;
            border-color: #ffff !important;
        }


        [data-high-contrast="true"] .card,
        [data-high-contrast="true"] .table-container {
            background-color: #111111 !important;
            border-color: #ffff!important;
        }

        [data-high-contrast="true"] th,
        [data-high-contrast="true"] td {
            border-bottom-color: #505152 !important;
        }

        [data-high-contrast="true"] .status-badge {
            background-color: #fff !important;
            color: #000000 !important;
            border: 1px solid #ffff!important;
        }

        [data-high-contrast="true"] .status-alert {
            background-color: #000!important;
            color: #ffff!important;
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
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
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
body.alto-contraste button:not(.accessibility-btn):not(.logout-btn),
body.alto-contraste .btn:not(.accessibility-btn):not(.logout-btn) {

    background: #fff !important;
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
            <a href="<?= base_url('/configuracoes-usuario') ?>" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
        </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
        
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
                    <p>
                        <?= !empty($temperatura_valores)
                        ? number_format(end($temperatura_valores), 1, ',', '.')
                        : '0,0' ?>°C
                    </p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-seedling"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Umidade Atual do solo</h3>
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

            <!-- CULTURAS -->
            <div class="chart-card" id="culturas">

                <h3 class="chart-title">
                    <i class="fa-solid fa-circle-info"></i>
                    Culturas
                </h3>

                <!-- MILHO -->
                <div class="status-item" id="culturas">
                    <div class="status-indicator status-saudavel">
                        <i class="fa-solid fa-wheat-awn"></i>
                    </div>
                    <h4>Milho</h4>
                    <p id="statusMilho">Saudável</p>
                </div>

                <!-- SOJA -->
                <div class="status-item" id="culturas">
                    <div class="status-indicator status-atencao">
                        <i class="fa-solid fa-seedling"></i>
                    </div>
                    <h4>Soja</h4>
                    <p id="statusSoja">Em atenção</p>
                </div>

                <!-- CAFÉ -->
                <div class="status-item" id="culturas">
                    <div class="status-indicator status-perigo">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <h4>Café</h4>
                    <p id="statusCafe">Crítico</p>
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
                    <canvas id="graficoLux"></canvas>
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

            <a href="<?= base_url('/alertas-admin') ?>"
               class="btn">

                Ver Alertas3

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

                <tr>

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
                        color: '#052501',
                        font: {size: 14}
                    }
                }
            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {
                        color: '#052501'
                    },

                    grid: {
                        color: '#dfe6e9'
                    }
                },

                x: {

                    ticks: {
                        color: '#052501'
                    },

                    grid: {
                        color: '#dfe6e9'
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
                            color: '#052501',
                            font: { size: 13, weight: 'bold' }
                        }
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            color: '#052501',
                            callback: v => v + '%'
                        },
                        grid: { color: '#dfe6e9' }
                    },

                    x: {
                        ticks: { color: '#052501' },
                        grid: { color: '#dfe6e9' }
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
                            color: '#052501',
                            font: { size: 13, weight: 'bold' }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            color: '#052501',
                            callback: function(value) {
                                return value + '%';
                            }
                        },
                        grid: { color: '#dfe6e9' }
                    },
                    x: {
                        ticks: { color: '#052501' },
                        grid: { color: '#dfe6e9' }
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

            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                }
            }
        },

        plugins: [{

            id: 'gaugeText',

            afterDraw(chart) {

                const {
                    ctx,
                    chartArea: { width, height }
                } = chart;

                ctx.save();

                // Valor Lux
                ctx.font = 'bold 26px Arial';
                ctx.fillStyle = '#052501';
                ctx.textAlign = 'center';

                ctx.fillText(
                    valorLux.toLocaleString('pt-BR'),
                    width / 2,
                    height - 55
                );

                // Unidade
                ctx.font = '16px Arial';

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
                ctx.fillStyle = '#666';

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

        // Alto contraste
        const contrasteBtn = document.getElementById("contraste-btn");

        contrasteBtn.addEventListener("click", () => {

            const ativo =
                document.body.getAttribute("data-high-contrast") === "true";

            document.body.setAttribute(
                "data-high-contrast",
                !ativo
            );

        });
    </script>
</body>
</html>