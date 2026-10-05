<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ícone do site -->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <title>Monitoramento de Temperatura - Fazenda Inteligente</title>

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
            /* Cores para temperatura */
            --temp-baixa: #2196F3;
            --temp-media: #FF9800;
            --temp-alta: #d32f2f;
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

        .header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            background-color: var(--verde-claro);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #000;
            font-weight: bold;
            font-size: 16px;
        }

        /* --- BOTÕES DO CABEÇALHO --- */
        .btn-logout {
            background: #57c91b;
            color: #fff;
            text-decoration: none;
            width: 120px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 16px;
            font-weight: 600;
            margin-right: 15px;
            transition: 0.3s ease;
        }

        #contraste-btn {
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 50%;
            background: #fff;
            color: #000;
            cursor: pointer;
            font-size: 18px;
        }

        #contraste-btn i {
            color: #000;
        }

        #aumentar-fonte,
        #diminuir-fonte,
        #resetar-fonte {
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: #57c91b;
            color: white;
            font-weight: bold;
            transition: .3s;
            margin-right: 7.5px;
            font-size: 16px;
        }

        #aumentar-fonte:hover,
        #diminuir-fonte:hover,
        #resetar-fonte:hover {
            transform: scale(1.05);
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

        .temperature-meter {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 8px solid var(--verde-claro);
            background: linear-gradient(135deg, #fff3e0, #fff);
            box-shadow: 0 0 30px rgba(255, 152, 0, 0.5);
        }

        .temperature-meter .temp-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--verde-escuro);
        }

        .temperature-meter .temp-unit {
            font-size: 1rem;
            color: #666;
        }

        .temperature-meter .status {
            margin-top: 10px;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .status-optimal {
            background-color: rgba(129, 199, 132, 0.3);
            color: var(--verde-escuro);
        }

        .status-low {
            background-color: rgba(33, 150, 243, 0.3);
            color: var(--temp-baixa);
        }

        .status-high {
            background-color: rgba(211, 47, 47, 0.3);
            color: var(--temp-alta);
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

        /* --- INDICADOR DE TEMPERATURA --- */
        .temperature-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .temperature-normal {
            background: linear-gradient(135deg, #4bc714, #052501);
            color: white;
        }

        .temperature-low {
            background: linear-gradient(135deg, #2196F3, #1976d2);
            color: white;
        }

        .temperature-high {
            background: linear-gradient(135deg, #d32f2f, #b71c1c);
            color: white;
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

        /* =========================
           ALTO CONTRASTE
        ========================= */
        .alto-contraste {
            background: #000 !important;
            color: #fff !important;
        }

        .alto-contraste * {
            background-color: #000 !important;
            color: #fff !important;
            border-color: #fff !important;
        }

        .alto-contraste a,
        .alto-contraste i {
            color: #ffff00 !important;
        }

        /* Botões */
        .alto-contraste #aumentar-fonte,
        .alto-contraste #diminuir-fonte,
        .alto-contraste #resetar-fonte,
        .alto-contraste a[href*="logout"] {
            background: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
        }

        .alto-contraste a[href*="logout"] i {
            color: #fff !important;
        }

        .alto-contraste #aumentar-fonte:hover,
        .alto-contraste #diminuir-fonte:hover,
        .alto-contraste #resetar-fonte:hover,
        .alto-contraste a[href*="logout"]:hover {
            background: #222 !important;
        }

        /* Avatar */
        body.alto-contraste .avatar {
            background: #fff !important;
            color: #000 !important;
            border: 2px solid #fff !important;
        }

        /* Botão de contraste */
        body.alto-contraste #contraste-btn,
        body.alto-contraste #contraste-btn:hover,
        body.alto-contraste #contraste-btn:focus,
        body.alto-contraste #contraste-btn:active,
        body.alto-contraste #contraste-btn:focus-visible {
            background: transparent !important;
            color: #fff !important;
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
        }

        body.alto-contraste #contraste-btn i,
        body.alto-contraste #contraste-btn:hover i {
            background: transparent !important;
            color: #fff !important;
        }

        /* Paginação */
        body.alto-contraste .botao-paginacao {
            background: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
        }

        body.alto-contraste .botao-paginacao i,
        body.alto-contraste .botao-paginacao:hover i {
            background: transparent !important;
            color: #fff !important;
        }

        body.alto-contraste .botao-paginacao:hover {
            background: #222 !important;
            color: #fff !important;
        }
        /* =========================
   AJUSTE PARA FONTE GRANDE
   ========================= */

.logo {
    overflow-wrap: break-word;
    word-break: normal;
}

html[style*="font-size: 18px"] .sidebar,
html[style*="font-size: 20px"] .sidebar,
html[style*="font-size: 22px"] .sidebar {
    width: 280px;
}

html[style*="font-size: 18px"] .main-content,
html[style*="font-size: 20px"] .main-content,
html[style*="font-size: 22px"] .main-content {
    margin-left: 280px;
}

html[style*="font-size: 18px"] .logo,
html[style*="font-size: 20px"] .logo,
html[style*="font-size: 22px"] .logo {
    font-size: 1.35rem;
    line-height: 1.15;
}

.header {
    min-width: 0;
}

.header > div:first-child {
    min-width: 0;
}

.header h2,
.header p {
    overflow-wrap: break-word;
}

.temperature-indicator span {
    overflow-wrap: break-word;
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
            <a href="<?= base_url('/temperatura') ?>" class="menu-item active"><i class="fa-solid fa-temperature-high"></i> Temperatura</a>
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
                <h2>Monitoramento de Temperatura</h2>
                <p style="color: #666;">
                    Dados em tempo real dos sensores de Temperatura.
                </p>
            </div>

            <div class="header-actions">

                <!-- LOGOUT -->
                <a class="btn-logout" href="<?= base_url('/logout') ?>">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>

                <!-- CONTRASTE -->
                <button id="contraste-btn" aria-label="Alterar contraste">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>

                <!-- FONTES -->
                <button id="aumentar-fonte" aria-label="Aumentar fonte">A+</button>
                <button id="diminuir-fonte" aria-label="Diminuir fonte">A-</button>
                <button id="resetar-fonte" aria-label="Resetar fonte">A</button>

                <!-- AVATAR -->
                <div class="avatar">F</div>

            </div>
        </header>

        <?php
            $temperatura = (float)($temperatura_atual ?? 0);
            $sensorPrincipal = $sensores[0] ?? null;

            if ($temperatura < 18) {
                $status = 'low';
            } elseif ($temperatura > 35) {
                $status = 'high';
            } else {
                $status = 'optimal';
            }

            $ultimaLeitura = !empty($sensorPrincipal['DATA_HORA'])
                ? date('d/m/Y H:i', strtotime($sensorPrincipal['DATA_HORA']))
                : '--';

            $sensores_ativos = count(array_filter($sensores, function ($s) {
                return $s['STATUS'] == 'Ativo';
            }));
        ?>

        <!-- INDICADOR DE TEMPERATURA -->
        <div style="margin-bottom: 20px;">
            <div class="temperature-indicator temperature-normal">
                <i class="fa-solid fa-temperature-high"></i>
                <span>Monitoramento de Temperatura - Ativo</span>
            </div>
        </div>

        <!-- VISUALIZAÇÃO DO SENSOR -->
        <div class="sensor-visualization">
            <h3><i class="fa-solid fa-temperature-high"></i> Medidor de Temperatura</h3>
            <div class="temperature-meter">
                <span class="temp-value"><?= number_format($temperatura, 1, ',', '.') ?>°C</span>
                <span class="temp-unit">Celsius</span>
                <span class="status status-<?= $status ?>">
                    <i class="fa-solid fa-check"></i>
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
                    <h3>Temperatura Atual</h3>
                    <p><?= number_format($temperatura, 1, ',', '.') ?>°C</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-temperature-high"></i></div>
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

        <!-- TABELA DE STATUS DOS SENSORES -->
        <h3 class="section-title">Status dos Sensores de Temperatura</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sensor</th>
                        <th>Cultura</th>
                        <th>Localização</th>
                        <th>Última Atualização</th>
                        <th>Temperatura</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sensores as $sensor): ?>
                        <tr>
                            <td>
                                <?= esc($sensor['ID_SENSOR']) ?>
                            </td>

                            <td>
                                <i class="fa-solid fa-temperature-high"
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
                                <?= isset($sensor['VALOR'])
                                    ? number_format((float)$sensor['VALOR'], 1, ',', '.') . '°C'
                                    : '--' ?>
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

    <!-- JS compartilhado das telas -->
    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>

    <script>
    /* =========================
       ALTO CONTRASTE (um único toggle, com persistência)
    ========================= */
    (function () {
        const CHAVE = 'altoContraste';

        // Aplica o estado salvo ao abrir a tela
        if (localStorage.getItem(CHAVE) === 'true') {
            document.body.classList.add('alto-contraste');
        }

        // Captura o clique antes de qualquer outro código tratar o botão
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('#contraste-btn');
            if (!btn) return;

            e.stopImmediatePropagation();

            const ativo = document.body.classList.toggle('alto-contraste');
            localStorage.setItem(CHAVE, ativo);
        }, true);
    })();

    /* =========================
       ACESSIBILIDADE - TAMANHO DA FONTE
    ========================= */
    document.addEventListener('DOMContentLoaded', () => {

        let tamanhoFonte = parseInt(localStorage.getItem('fonteSite')) || 16;

        document.documentElement.style.fontSize = tamanhoFonte + 'px';

        document.getElementById('aumentar-fonte').addEventListener('click', () => {
            if (tamanhoFonte < 22) {
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
    </script>

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

        // Texto da página
        paginaInfo.textContent = totalPaginas > 0
            ? `Página ${paginaAtual} de ${totalPaginas}`
            : "Nenhuma página";

        // Esconde todos e mostra só os da página atual
        sensores.forEach(sensor => {
            sensor.style.display = "none";
        });

        const inicio = (paginaAtual - 1) * SENSORES_POR_PAGINA;
        const fim = inicio + SENSORES_POR_PAGINA;

        Array.from(sensores).slice(inicio, fim).forEach(sensor => {
            sensor.style.display = "table-row";
        });

        // Setas
        paginaAnterior.style.display = paginaAtual > 1 ? "flex" : "none";
        proximaPagina.style.display = paginaAtual < totalPaginas ? "flex" : "none";
    }

    paginaAnterior.addEventListener("click", function () {
        if (paginaAtual > 1) {
            paginaAtual--;
            atualizarSensores();
        }
    });

    proximaPagina.addEventListener("click", function () {
        const totalPaginas = Math.ceil(
            sensores.length / SENSORES_POR_PAGINA
        );

        if (paginaAtual < totalPaginas) {
            paginaAtual++;
            atualizarSensores();
        }
    });

    atualizarSensores();
    </script>
</body>
</html>