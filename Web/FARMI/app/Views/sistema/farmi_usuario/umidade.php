<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Ícone do site-->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <title>Monitoramento de Umidade - Fazenda Inteligente</title>
    <!-- RESPONSIVO -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_responsivo.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_alto_contraste.css') ?>">
    <!-- Ícones (FontAwesome) -->
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
            /* Cores para umidade */
            --umidade-baixa: #2196F3;
            --umidade-media: #FF9800;
            --umidade-alta: #4CAF50;
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

        /* agrupa avatar + botão */
        .header-right {
            display: flex;
            align-items: center;
            gap: 15px; /* Ajustado de 10px para 15px igual ao dADMIN */
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

        /* --- VISUALIZAÇÃO DO SENSOR --- */
        .sensor-visualization {
            background: var(--branco);
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--sombra);
            margin-bottom: 30px;
            text-align: center;
        }

        .sensor-visualization h3 {
            color: var(--verde-escuro);
            margin-bottom: 20px;
        }

        .humidity-meter {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 8px solid var(--verde-claro);
            background: linear-gradient(135deg, #e3f2fd, #fff);
            box-shadow: 0 0 30px rgba(33, 150, 243, 0.5);
        }

        .humidity-meter .hum-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--verde-escuro);
        }

        .humidity-meter .hum-unit {
            font-size: 1rem;
            color: #666;
        }

        .humidity-meter .status {
            margin-top: 10px;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .status-optimal {
            background-color: rgba(76, 175, 80, 0.3);
            color: var(--umidade-alta);
        }

        .status-low {
            background-color: rgba(33, 150, 243, 0.3);
            color: var(--umidade-baixa);
        }

        .status-high {
            background-color: rgba(255, 152, 0, 0.3);
            color: var(--umidade-media);
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

        .status-warning {
            background-color: rgba(255, 193, 7, 0.2);
            color: #f57f17;
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
            color: var(--verde-escuro);
        }

        .btn-secondary:hover {
            background-color: var(--verde-claro-hover);
        }

        /* --- INDICADOR DE UMIDADE --- */
        .humidity-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .humidity-normal {
            background: linear-gradient(135deg, #4bc714, #052501);
            color: white;
        }

        .humidity-low {
            background: linear-gradient(135deg, #2196F3, #1976d2);
            color: white;
        }

        .humidity-high {
            background: linear-gradient(135deg, #FF9800, #f57c00);
            color: white;
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
        PAGINAÇÃO
        ========================= */

        .paginacao-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-top: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .pagina-info {
            font-size: 16px;
            font-weight: 600;
            color: #000000;
        }

        .botao-paginacao {
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 8px;
            background-color: #57c91b;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: 0.3s;
        }

        .botao-paginacao:hover {
            transform: scale(1.05);
            background-color: #46a814;
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
           <a href="<?= base_url('/dashboard-usuario') ?>" class="menu-item "><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="<?= base_url('/luz') ?>" class="menu-item "><i class="fa-solid fa-lightbulb"></i> Luz</a>
            <a href="<?= base_url('/temperatura') ?>" class="menu-item"><i class="fa-solid fa-temperature-high"></i> Temperatura</a>
            <a href="<?= base_url('/umidade') ?>" class="menu-item active"><i class="fa-solid fa-droplet"></i> Umidade</a>
            <a href="<?= base_url('/solo') ?>" class="menu-item"><i class="fa-solid fa-chart-pie"></i> Solo</a>
            <a href="<?= base_url('/alertas-usuario') ?>" class="menu-item"><i class="fa-solid fa-triangle-exclamation"></i>Alertas</a>
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
        <!-- CABEÇALHO -->
        <header class="header">
    <div>
        <h2>Monitoramento de Umidade</h2>
        <p style="color: #666;">
            Dados em tempo real dos sensores de Umidade.
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


        <!-- INDICADOR DE UMIDADE -->
        <div style="margin-bottom: 20px;">
            <div class="humidity-indicator humidity-normal">
                <i class="fa-solid fa-droplet"></i>
                <span>Monitoramento de Umidade - Ativo</span>
            </div>
        </div>
        
        <?php
            $umidade = (float)($umidade_atual ?? 0);
            $sensorPrincipal = $sensores[0] ?? null;

            if ($umidade < 40) {
                $status = 'low';
            } elseif ($umidade > 70) {
                $status = 'high';
            } else {
                $status = 'optimal';
            }

            $ultimaLeitura = !empty($sensorPrincipal['DATA_HORA'])
                ? date('d/m/Y H:i', strtotime($sensorPrincipal['DATA_HORA']))
                : '--';
        ?>

        <?php
            $total_sensores = count($sensores);

            $sensores_ativos = count(array_filter($sensores, function($s){
                return $s['STATUS'] == 'Ativo';
            }));
        ?>

        <!-- VISUALIZAÇÃO DO SENSOR -->
        <div class="sensor-visualization">
            <h3><i class="fa-solid fa-droplet"></i> Medidor de Umidade</h3>
            <div class="humidity-meter">
                <span class="hum-value"><?= number_format($umidade, 1, ',', '.') ?>%</span>
                <span class="hum-unit">Umidade Relativa</span>
                <span class="status status-<?= $status ?>"><i class="fa-solid fa-check"></i>
                    <?php
                    if ($status == 'optimal') {
                        echo 'Normal';
                    } elseif ($status == 'low') {
                        echo 'Baixa';
                    } else {
                        echo 'Alta';
                    }
                    ?>
                </span>

            </div>
            <p style="color: #666;">Última leitura: <?= $ultimaLeitura ?></p>
        </div>

        <!-- CARDS DE ESTATÍSTICAS -->
        <div class="stats-grid">
            <div class="card">
                <div class="card-info">
                    <h3>Umidade Atual</h3>
                    <p><?= number_format($umidade, 1, ',', '.') ?>%</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-droplet"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Sensores Ativos</h3>
                    <p><?= $sensores_ativos; ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-wifi"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Sensores Totais</h3>
                    <p><?= count($sensores) ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-microchip"></i></div>
            </div>
        </div>

        <!-- TABELA DE STATUS DOS SISTEMAS -->
        <h3 class="section-title">Status dos Sensores de Umidade</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sensor</th>
                        <th>Cultura</th>
                        <th>Localização</th>
                        <th>Última Atualização</th>
                        <th>Umidade</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                        $sensorPrincipal = $sensores[0] ?? null;

                        $umidade = $sensorPrincipal['VALOR'] ?? 0;

                        if ($umidade < 40) {
                            $status = 'low';
                        } elseif ($umidade > 70) {
                            $status = 'high';
                        } else {
                            $status = 'optimal';
                        }
                    ?>
                    <?php foreach ($sensores as $sensor): ?>

                    <tr>

                        <td>
                            <?= esc($sensor['ID_SENSOR']) ?>
                        </td>

                        <td>
                            <i class="fa-solid fa-droplet"
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
                            <?= !empty($sensor['DATA_HORA'])
                                ? date('d/m/Y H:i', strtotime($sensor['DATA_HORA']))
                                : '--' ?>
                        </td>

                        <td>
                            <?= $sensor['VALOR'] ?? '--' ?>%
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
            </div>
            <!-- PAGINAÇÃO -->
            <div class="paginacao-container">
                <button id="paginaAnterior" class="botao-paginacao" type="button">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <div id="paginaInfo" class="pagina-info">
                    Página 1 de 1
                </div>

                <button id="proximaPagina" class="botao-paginacao" type="button">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
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

document.getElementById("contraste-btn").addEventListener("click", function () {
    document.body.classList.toggle("alto-contraste");
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
    <script>
/* =========================
   PAGINAÇÃO DOS SENSORES
========================= */

const sensores = document.querySelectorAll("tbody tr");

const paginaAnterior = document.getElementById("paginaAnterior");
const proximaPagina = document.getElementById("proximaPagina");
const paginaInfo = document.getElementById("paginaInfo");

const SENSORES_POR_PAGINA = 5;

let paginaAtual = 1;

function atualizarSensores() {

    const totalPaginas = Math.ceil(
        sensores.length / SENSORES_POR_PAGINA
    );

    // Garante que a página atual seja válida
    if (totalPaginas === 0) {
        paginaAtual = 1;
    } else if (paginaAtual > totalPaginas) {
        paginaAtual = totalPaginas;
    }

    // Atualiza o texto da página
    if (totalPaginas > 0) {
        paginaInfo.textContent =
            `Página ${paginaAtual} de ${totalPaginas}`;
    } else {
        paginaInfo.textContent =
            "Nenhuma página";
    }

    // Esconde todos os sensores
    sensores.forEach(sensor => {
        sensor.style.display = "none";
    });

    // Calcula quais sensores serão exibidos
    const inicio =
        (paginaAtual - 1) * SENSORES_POR_PAGINA;

    const fim =
        inicio + SENSORES_POR_PAGINA;

    // Mostra somente os sensores da página atual
    Array.from(sensores)
        .slice(inicio, fim)
        .forEach(sensor => {
            sensor.style.display = "table-row";
        });

    // ANTERIOR
    // Esconde na primeira página
    if (paginaAtual > 1) {
        paginaAnterior.style.display = "flex";
    } else {
        paginaAnterior.style.display = "none";
    }

    // PRÓXIMA
    // Esconde na última página
    if (paginaAtual < totalPaginas) {
        proximaPagina.style.display = "flex";
    } else {
        proximaPagina.style.display = "none";
    }
}


// Botão ANTERIOR
paginaAnterior.addEventListener("click", function () {

    if (paginaAtual > 1) {
        paginaAtual--;
        atualizarSensores();
    }

});


// Botão PRÓXIMA
proximaPagina.addEventListener("click", function () {

    const totalPaginas = Math.ceil(
        sensores.length / SENSORES_POR_PAGINA
    );

    if (paginaAtual < totalPaginas) {
        paginaAtual++;
        atualizarSensores();
    }

});


// Inicia a paginação
atualizarSensores();

</script>
</body>
</html>