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
    width: 42px;
    height: 42px;
    border-radius: 50%; /* Transforma em um círculo perfeito */
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
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

body.contraste #contraste-btn {
    color: #fff !important;
}

body.contraste .avatar {
    background: #fff !important;
    color: #000 !important;
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
        <div class="chart-card">

            <h3 class="chart-title">
                <i class="fa-solid fa-circle-info"></i>
                Culturas
            </h3>

            <!-- MILHO -->
            <div class="status-item">
                <div class="status-indicator status-saudavel">
                    <i class="fa-solid fa-wheat-awn"></i>
                </div>
                <h4>Milho</h4>
                <p id="statusMilho">Saudável</p>
            </div>

            <!-- SOJA -->
            <div class="status-item">
                <div class="status-indicator status-atencao">
                    <i class="fa-solid fa-seedling"></i>
                </div>
                <h4>Soja</h4>
                <p id="statusSoja">Em atenção</p>
            </div>

            <!-- CAFÉ -->
            <div class="status-item">
                <div class="status-indicator status-perigo">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <h4>Café</h4>
                <p id="statusCafe">Crítico</p>
            </div>
        </div>

        <!-- UMIDADE DO SOLO -->
        <div class="chart-card">
            <h3 class="chart-title">
                <i class="fa-solid fa-droplet"></i>
                Umidade do Solo (%)
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

    </div>


    <!-- ATIVIDADES E ALERTAS -->
    <div style="display:grid; grid-template-columns:2fr 1fr; gap:20px;">

        <!-- ATIVIDADES -->
        <div class="activities-card">
            <h3 class="chart-title">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Atividades
            </h3>

            <div class="activity-item">

                <div class="activity-icon"
                     style="background:rgba(76,199,20,.2); color:var(--verde-claro)">
                    <i class="fa-solid fa-plus"></i>
                </div>

                <div class="activity-content">
                    <h4>Novo sensor</h4>
                    <p>Estufa C • 2min</p>
                </div>

            </div>

            <div class="activity-item">

                <div class="activity-icon"
                     style="background:rgba(33,150,243,.2); color:var(--azul)">
                    <i class="fa-solid fa-user-plus"></i>
                </div>

                <div class="activity-content">
                    <h4>Novo funcionário</h4>
                    <p>João Silva • 1h</p>
                </div>

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

</main>

<!-- SCRIPT -->
<script>

/* =========================
   GRÁFICO
========================= */

const ctx = document.getElementById('graficoMonitoramento');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: [
            'Seg',
            'Ter',
            'Qua',
            'Qui',
            'Sex',
            'Sáb',
            'Dom'
        ],

        datasets: [

            {
                label: 'Temperatura',
                data: [22, 25, 19, 30, 27, 35, 29],
                borderColor: '#4bc714',
                backgroundColor: 'rgba(75,199,20,0.2)',
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#4bc714',
                pointRadius: 5
            }

        ]
    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                labels: {

                    color: '#052501',

                    font: {
                        size: 14
                    }
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
   GRÁFICO UMIDADE DO SOLO
========================= */
const ctxUmidade = document.getElementById('graficoUmidade');

new Chart(ctxUmidade, {

    type: 'line',

    data: {

        labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],

        datasets: [{
            label: 'Umidade do Solo (%)',
            data: [65, 72, 68, 80, 75, 70, 78],
            backgroundColor: 'rgba(33,150,243,0.7)',
            borderColor: '#2196f3',
            borderWidth: 2,
            borderRadius: 6
        }]
    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        scales: {

            y: {

                beginAtZero: true,
                max: 100,

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
        },

        plugins: {

            legend: {
                labels: {
                    color: '#052501'
                }
            }
        }
    }

});


/* =========================
   GRÁFICO LUMINOSIDADE
========================= */
const valorLux = 10320; // valor real do sensor

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


/* =========================
   ACESSIBILIDADE DE FONTE
========================= */

const contrasteBtn = document.getElementById('contraste-btn');

contrasteBtn.addEventListener('click', () => {
    document.body.classList.toggle('contraste');
});
let tamanhoFonte = 100;

const aumentarFonte =
    document.getElementById('aumentar-fonte');

const diminuirFonte =
    document.getElementById('diminuir-fonte');

const resetarFonte =
    document.getElementById('resetar-fonte');

function aplicarFonte() {

    document.documentElement.style.fontSize =
        tamanhoFonte + '%';

    localStorage.setItem(
        'tamanhoFonteDashboard',
        tamanhoFonte
    );
}
function atualizarCulturas() {

    document.getElementById('statusMilho').innerText = 'Saudável';
    document.getElementById('statusSoja').innerText = 'Em atenção';
    document.getElementById('statusCafe').innerText = 'Crítico';

}

setInterval(atualizarCulturas, 5000);

const fonteSalva =
    localStorage.getItem(
        'tamanhoFonteDashboard'
    );

if (fonteSalva) {

    tamanhoFonte = parseInt(fonteSalva);

    aplicarFonte();
}

aumentarFonte.addEventListener('click', () => {

    if (tamanhoFonte < 150) {

        tamanhoFonte += 10;

        aplicarFonte();
    }
});

diminuirFonte.addEventListener('click', () => {

    if (tamanhoFonte > 70) {

        tamanhoFonte -= 10;

        aplicarFonte();
    }
});

resetarFonte.addEventListener('click', () => {

    tamanhoFonte = 100;

    aplicarFonte();
});



</script>

<!-- JS -->
<script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>

</body>
</html>