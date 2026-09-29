<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Ícone do site -->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertas - FARMI Funcionário</title>

    <!-- Ícones -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_alertas.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_alto_contraste.css') ?>">

    <!-- RESPONSIVO -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_responsivo.css') ?>">

    <style>
        /* =========================
           BOTÕES DE FONTE
        ========================= */
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

        /* =========================
           FILTRO
        ========================= */
        .filtro-dropdown {
            position: relative;
        }

        .filtro-menu {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            width: 230px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,.15);
            overflow: hidden;
            z-index: 1000;
            font-size: 16px;
        }

        .filtro-menu.show {
            display: block;
        }

        .filtro-item {
            padding: 12px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filtro-item:hover {
            background: #f5f5f5;
        }

        .filtro-item i {
            color: #57c91b;
        }

        #btnFiltro {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #57c91b;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-weight: 600;
            cursor: pointer;
            transition: .3s;
            font-size: 16px;
        }

        #btnFiltro i {
            color: #fff;
        }

        .btn-secondary {
            font-size: 16px !important;
            height: 42px;
            padding: 0 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border-radius: 10px;
        }

        /* =========================
           CONTRASTE / AVATAR
        ========================= */
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
            cursor: pointer;
            background: #57c91b;
            color: white;
            font-weight: bold;
            transition: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .botao-paginacao:hover {
            transform: scale(1.05);
        }

        .botao-paginacao:disabled {
            display: none;
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

        /* Filtro */
        .alto-contraste a#btnFiltro,
        .alto-contraste button#btnFiltro {
            background: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
        }

        .alto-contraste a#btnFiltro i,
        .alto-contraste button#btnFiltro i {
            background: transparent !important;
            color: #fff !important;
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
            <a href="<?= base_url('/dashboard-usuario') ?>" class="menu-item">
                <i class="fa-solid fa-chart-line"></i>
                Dashboard
            </a>

            <a href="<?= base_url('/luz') ?>" class="menu-item">
                <i class="fa-solid fa-lightbulb"></i>
                Luz
            </a>

            <a href="<?= base_url('/temperatura') ?>" class="menu-item">
                <i class="fa-solid fa-temperature-high"></i>
                Temperatura
            </a>

            <a href="<?= base_url('/umidade') ?>" class="menu-item">
                <i class="fa-solid fa-droplet"></i>
                Umidade
            </a>

            <a href="<?= base_url('/solo') ?>" class="menu-item">
                <i class="fa-solid fa-chart-pie"></i>
                Solo
            </a>

            <a href="<?= base_url('/alertas-usuario') ?>" class="menu-item active">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Alertas
            </a>

            <a href="<?= base_url('/configuracoes-usuario') ?>" class="menu-item">
                <i class="fa-solid fa-gear"></i>
                Configurações
            </a>
        </nav>

    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">

        <!-- Menu sanduíche -->
        <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- HEADER -->
        <header class="header">

            <div>
                <h2>Alertas dos Sensores</h2>
                <p style="color: #666;">
                    Monitoramento em tempo real dos alertas
                </p>
            </div>

            <div class="header-actions" style="display: flex; align-items: center; gap: 8px;">

                <!-- FILTROS -->
                <div class="filtro-dropdown">
                    <button class="btn btn-secondary" id="btnFiltro">
                        <i class="fa-solid fa-filter"></i>
                        Filtros
                    </button>
                    <div class="filtro-menu" id="filtroMenu">
                        <div class="filtro-item" data-filtro="todos"><i class="fa-solid fa-list"></i> Todos os Sensores</div>
                        <div class="filtro-item" data-filtro="Temperatura"><i class="fa-solid fa-temperature-half"></i> Temperatura</div>
                        <div class="filtro-item" data-filtro="Umidade"><i class="fa-solid fa-cloud-rain"></i> Umidade</div>
                        <div class="filtro-item" data-filtro="Solo"><i class="fa-solid fa-seedling"></i> Solo</div>
                        <div class="filtro-item" data-filtro="Luz"><i class="fa-solid fa-sun"></i> Luz</div>
                    </div>
                </div>

                <!-- LOGOUT -->
                <a class="btn-logout" href="<?= base_url('/logout') ?>"
                   style="background: #57c91b; color: #fff; text-decoration: none; width: 120px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 16px; font-weight: 600; margin-right: 15px; transition: 0.3s ease;">
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

        <!-- CARDS -->
        <div class="stats-grid">

            <!-- ALERTAS ATIVOS -->
            <div class="card">
                <div>
                    <h3>Alertas Ativos</h3>
                    <p style="color: var(--vermelho);">
                        <?= $totalAlertas ?>
                    </p>
                </div>
                <i class="fa-solid fa-triangle-exclamation"
                    style="color: var(--vermelho); font-size: 2.5rem;"></i>
            </div>

            <!-- CRÍTICOS -->
            <div class="card">
                <div>
                    <h3>Críticos</h3>
                    <p style="color: var(--vermelho);">
                        <?= $totalCriticos ?>
                    </p>
                </div>
                <i class="fa-solid fa-fire"
                    style="color: var(--vermelho); font-size: 2.5rem;"></i>
            </div>

            <!-- MÉDIOS -->
            <div class="card">
                <div>
                    <h3>Médios</h3>
                    <p style="color: var(--laranja);">
                        <?= $totalMedios ?>
                    </p>
                </div>
                <i class="fa-solid fa-exclamation-triangle"
                    style="color: var(--laranja); font-size: 2.5rem;"></i>
            </div>

            <!-- BAIXOS -->
            <div class="card">
                <div>
                    <h3>Baixos</h3>
                    <p style="color: var(--azul);">
                        <?= $totalBaixos ?>
                    </p>
                </div>
                <i class="fa-solid fa-bell"
                    style="color: var(--azul); font-size: 2.5rem;"></i>
            </div>

        </div>

        <!-- ALERTAS -->
        <div class="alerts-container">

            <div class="alerts-list">

                <?php foreach($alerta as $a) {
                    // Define a classe do card com base na gravidade do alerta
                    $classeGravidade = 'alert-medio';
                    if ($a['NIVEL_GRAVIDADE'] == 'Alto') {
                        $classeGravidade = 'alert-critico';
                    } elseif ($a['NIVEL_GRAVIDADE'] == 'Baixo') {
                        $classeGravidade = 'alert-baixo';
                    }
                ?>

                <div class="alert-item <?= $classeGravidade ?> alerta" data-sensor="<?= $a['TIPO_SENSOR']; ?>">

                    <div class="alert-icon">
                        <?php if($a['TIPO_SENSOR'] == 'Temperatura'){ ?>
                            <i class="fa-solid fa-temperature-high"></i>
                        <?php } elseif($a['TIPO_SENSOR'] == 'Umidade'){ ?>
                            <i class="fa-solid fa-percent"></i>
                        <?php } elseif($a['TIPO_SENSOR'] == 'Luz'){ ?>
                            <i class="fa-solid fa-sun"></i>
                        <?php } elseif($a['TIPO_SENSOR'] == 'Solo'){ ?>
                            <i class="fa-solid fa-droplet"></i>
                        <?php } else { ?>
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        <?php } ?>
                    </div>

                    <div class="alert-content">
                        <h4><?= $a['NOME_FAZENDA']; ?></h4>
                        <h4><?= $a['TIPO_ALERTA']; ?> - Cultura <?= $a['NOME_CULTURA']; ?> - <?= $a['TIPO_CULTURA']; ?></h4>
                        <p>
                            <?= $a['DESCRICAO']; ?> - Gravidade: <?= $a['NIVEL_GRAVIDADE']; ?>
                        </p>
                        <div class="alert-meta">
                            <span class="alert-time">
                                <i class="fa-solid fa-clock"></i>
                                <?= date('d/m/Y H:i', strtotime($a['DATA_HORA'])) ?>
                            </span>

                            <?php if($a['STATUS'] == "Ativo"){ ?>
                                <span class="alert-status status-ativo">
                                    <?= $a['STATUS']; ?>
                                </span>
                            <?php } else { ?>
                                <span class="alert-status status-resolvido">
                                    <?= $a['STATUS']; ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>
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

    <!-- JS (o alto contraste é controlado por este arquivo, igual ao gestor) -->
    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>

    <script>
    /* =========================
       ACESSIBILIDADE - TAMANHO DA FONTE
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
       MENU DE FILTRO
    ========================= */
    const btnFiltro = document.getElementById('btnFiltro');
    const filtroMenu = document.getElementById('filtroMenu');

    btnFiltro.addEventListener('click', function (e) {
        e.stopPropagation();
        filtroMenu.classList.toggle('show');
    });

    document.addEventListener('click', function () {
        filtroMenu.classList.remove('show');
    });

    /* =========================
       PAGINAÇÃO + FILTRO
    ========================= */
    const alertas = document.querySelectorAll(".alerta");

    const paginaAnterior = document.getElementById("paginaAnterior");
    const proximaPagina = document.getElementById("proximaPagina");
    const paginaInfo = document.getElementById("paginaInfo");

    const ALERTAS_POR_PAGINA = 5;

    let paginaAtual = 1;
    let filtroAtual = "todos";

    function getAlertasFiltrados() {
        return Array.from(alertas).filter(alerta => {
            return (
                filtroAtual === "todos" ||
                alerta.dataset.sensor === filtroAtual
            );
        });
    }

    function atualizarAlertas() {

        const alertasFiltrados = getAlertasFiltrados();

        const totalPaginas = Math.ceil(
            alertasFiltrados.length / ALERTAS_POR_PAGINA
        );

        // Corrige a página atual
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
        alertas.forEach(alerta => {
            alerta.style.display = "none";
        });

        const inicio = (paginaAtual - 1) * ALERTAS_POR_PAGINA;
        const fim = inicio + ALERTAS_POR_PAGINA;

        alertasFiltrados.slice(inicio, fim).forEach(alerta => {
            alerta.style.display = "flex";
        });

        // Setas
        paginaAnterior.style.display = paginaAtual <= 1 ? "none" : "flex";

        proximaPagina.style.display =
            (paginaAtual >= totalPaginas || totalPaginas === 0) ? "none" : "flex";
    }

    paginaAnterior.addEventListener("click", function () {
        if (paginaAtual > 1) {
            paginaAtual--;
            atualizarAlertas();
        }
    });

    proximaPagina.addEventListener("click", function () {
        const totalPaginas = Math.ceil(
            getAlertasFiltrados().length / ALERTAS_POR_PAGINA
        );

        if (paginaAtual < totalPaginas) {
            paginaAtual++;
            atualizarAlertas();
        }
    });

    document.querySelectorAll(".filtro-item").forEach(item => {
        item.addEventListener("click", function () {
            filtroAtual = this.dataset.filtro;
            paginaAtual = 1;
            atualizarAlertas();
            filtroMenu.classList.remove("show");
        });
    });

    atualizarAlertas();
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
</script>
</body>
</html>