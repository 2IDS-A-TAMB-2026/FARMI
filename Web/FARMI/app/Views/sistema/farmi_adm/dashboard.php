<!DOCTYPE html>
<html lang="pt-br">
    
<head>

<style>
/* ==========================================================
   BOTÕES DE FONTE (PADRONIZADO COM O DASHBOARD)
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
    opacity: 1; /* Remove o opacidade antiga para usar a troca de cor idêntica ao dashboard */
}

/* ==========================================================
   ESTILIZAÇÃO DA TABELA DE SISTEMAS (VINDOS DO USUÁRIO)
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
    color: #052501;
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
    color: #052501;
}
/* ==========================================================
   ESTILIZAÇÃO DA TABELA DOS SISTEMAS AUTOMATIZADOS
   ========================================================== */
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

.table-container th, .table-container td {
    text-align: left;
    padding: 15px;
    border-bottom: 1px solid #eee;
}

.table-container th {
    color: #052501;
    font-weight: 600;
}

.status-badge {
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

/* Integração com o Alto Contraste do Admin */
body.contraste .table-container {
    background: #191717 !important;
    border: 1px solid #fff;
}
body.contraste .table-container th,
body.contraste .table-container td {
    color: #fff !important;
    border-bottom: 1px solid #fff;
}
body.contraste .status-badge {
    background: #fff !important;
    color: #000 !important;
    border: 1px solid #fff;
}

/* ==========================================================
   BOTÃO DE CONTRASTE (PADRONIZADO COM O DASHBOARD)
   ========================================================== */
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
    color: #46A302;
    opacity: 1;
}

#contraste-btn:focus,
#contraste-btn:active,
#contraste-btn:focus-visible {
    outline: none !important;
    box-shadow: none !important;
    background: transparent !important;
}

/* ==========================================================
   BOTÃO LOGOUT (PADRONIZADO COM O DASHBOARD)
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
    padding: 0 18px; /* Removido width fixo de 120px para usar o preenchimento igual ao comum */
    border-radius: 10px;
    font-weight: bold;
    transition: 0.3s;
    margin-right: 15px; /* Mantém o espaçamento específico do layout Admin */
}

.btn-logout:hover {
    background: #46A302;
    color: white;
}

/* AVATAR CIRCULAR */
.avatar {
    background: #57c91b;
    color: #000;
    width: 50px;
    height: 50px;
    border-radius: 50%; /* Transforma em um círculo perfeito */
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
}

/* AUTO CONTRASTE */

/* ==========================================================
   GRÁFICOS EM ALTO CONTRASTE (BRANCO PURO)
   ========================================================== */
body.contraste canvas {
    /* Deixa cinza, dobra o brilho e aumenta o contraste para forçar o branco */
    filter: grayscale(100%) brightness(200%) contrast(300%) !important;
}

/* Para os ícones de culturas e atividades acompanharem e ficarem brancos */
body.contraste .status-indicator,
body.contraste .activity-icon {
    filter: grayscale(100%) brightness(200%) contrast(300%) !important;
    color: #fff !important; 
}
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

body.contraste #contraste-btn {
    color: #fff !important;
}

body.contraste .avatar {
    background: #fff !important;
    color: #000!important;
}
</style>
    <!-- Ícone -->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - FARMI Gestor</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_dashboard.css') ?>">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">

    <div class="logo">
        <i class="fa-solid fa-leaf"></i>
        FARMI Gestor
    </div>

    <nav>

        <a href="<?= base_url('/dashboard-admin') ?>" class="menu-item active">
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

        <a href="<?= base_url('/configuracoes-admin') ?>" class="menu-item">
            <i class="fa-solid fa-gear"></i>
            Configurações
        </a>

    </nav>

</aside>

<!-- MAIN -->
<main class="main-content">

    <!-- HEADER -->
    <header class="header">

        <div>
            <h2>Dashboard</h2>
            <p style="color:#666;">Visão geral do sistema</p>
        </div>

        <div style="display:flex; align-items:center; gap:8px;">

            <a href="<?= base_url('/logout') ?>" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
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
            <i class="fa-solid fa-satellite-dish"
               style="color: var(--verde-claro)">
            </i>
        </div>

        <div class="card">
            <div>
                <h3>Fazendas</h3>
                <p><?= $total_fazendas ?></p>
            </div>
            <i class="fa-solid fa-cow"
               style="color: var(--verde-claro)">
            </i>
        </div>

        <div class="card">
            <div>
                <h3>Funcionários</h3>
                <p><?= $total_usuarios ?></p>
            </div>
            <i class="fa-solid fa-users"
               style="color: var(--verde-claro)">
            </i>
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
                    <i class="fa-solid fa-wheat-awn" id="fotoMilho"></i>
                </div>
                <h4>Milho</h4>
                <p id="statusMilho">Saudável</p>
            </div>

            <!-- SOJA -->
            <div class="status-item" id="culturas">
                <div class="status-indicator status-atencao">
                    <i class="fa-solid fa-seedling" id="fotoSoja"></i>
                </div>
                <h4>Soja</h4>
                <p id="statusSoja">Em atenção</p>
            </div>

            <!-- CAFÉ -->
            <div class="status-item" id="culturas">
                <div class="status-indicator status-perigo">
                    <i class="fa-solid fa-leaf" id="fotoCafe"></i>
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

                Ver Alertas

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
<script>

// 1. CAPTURA AS VARIÁVEIS ESTRUTURADAS VINDAS DO CONTROLLER
const labelsEixoX = <?= json_encode($grafico_horarios ?? []) ?>;
const datasetsTemperatura = <?= json_encode($datasets_temperatura ?? []) ?>;
const datasetsUmidade = <?= json_encode($datasets_umidade ?? []) ?>;
const datasetsSolo = <?= json_encode($datasets_solo ?? []) ?>;
const valorLux = <?= floatval($lux ?? 0) ?>;

/* =========================
   GRÁFICO - TEMPERATURA (MÚLTIPLOS SENSORES)
========================= */
const ctxTemperatura = document.getElementById('graficoMonitoramento');

if (ctxTemperatura) {
    new Chart(ctxTemperatura, {
        type: 'line',
        data: {
            labels: labelsEixoX,
            datasets: datasetsTemperatura // Desenha as múltiplas linhas configuradas pelo PHP
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true, // Mostra as legendas superiores identificando cada sensor e cor
                    labels: {
                        color: '#052501',
                        font: { size: 13, weight: 'bold' }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { 
                        color: '#052501', 
                        callback: function(value) {
                            return value + 'ºC';
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
   GRÁFICO UMIDADE DO AR (MÚLTIPLOS SENSORES)
========================= */
const ctxUmidade = document.getElementById('graficoUmidade');

if (ctxUmidade) {
    new Chart(ctxUmidade, {
        type: 'line',
        data: {
            labels: labelsEixoX,
            datasets: datasetsUmidade // Desenha as múltiplas linhas independentes de umidade
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
                    ticks: { color: '#052501',
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
   GRÁFICO LUMINOSIDADE (VELOCÍMETRO DIGITAL)
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
function atualizarCulturas() {
    const elMilho = document.getElementById('statusMilho');
    const elSoja = document.getElementById('statusSoja');
    const elCafe = document.getElementById('statusCafe');
    
    if (elMilho) elMilho.innerText = 'Saudável';
    if (elSoja) elSoja.innerText = 'Em atenção';
    if (elCafe) elCafe.innerText = 'Crítico';
}

atualizarCulturas();
setInterval(atualizarCulturas, 5000);

/* =========================
   ACESSIBILIDADE DE FONTE E CONTRASTE
========================= */
const contrasteBtn = document.getElementById('contraste-btn');
if (contrasteBtn) {
    contrasteBtn.addEventListener('click', () => {
        document.body.classList.toggle('contraste');
    });
}

let tamanhoFonte = 100;
const aumentarFonte = document.getElementById('aumentar-fonte');
const diminuirFonte = document.getElementById('diminuir-fonte');
const resetarFonte = document.getElementById('resetar-fonte');

function aplicarFonte() {
    document.documentElement.style.fontSize = tamanhoFonte + '%';
    localStorage.setItem('tamanhoFonteDashboard', tamanhoFonte);
}

const fonteSalva = localStorage.getItem('tamanhoFonteDashboard');
if (fonteSalva) {
    tamanhoFonte = parseInt(fonteSalva);
    aplicarFonte();
}

if (aumentarFonte) {
    aumentarFonte.addEventListener('click', () => {
        if (tamanhoFonte < 150) { tamanhoFonte += 10; aplicarFonte(); }
    });
}
if (diminuirFonte) {
    diminuirFonte.addEventListener('click', () => {
        if (tamanhoFonte > 70) { tamanhoFonte -= 10; aplicarFonte(); }
    });
}
if (resetarFonte) {
    resetarFonte.addEventListener('click', () => {
        tamanhoFonte = 100; aplicarFonte();
    });
}

</script>
<!-- JS -->
<script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>

</body>
</html>