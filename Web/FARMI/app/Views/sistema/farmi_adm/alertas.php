<!DOCTYPE html>
<html lang="pt-br">
    
    <style>
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
        margin-right: 8px; 
    }

    #aumentar-fonte:hover,
    #diminuir-fonte:hover,
    #resetar-fonte:hover {
        transform: scale(1.05);
    }
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
    </style>

<head>
    <!-- Ícone do site -->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertas - FARMI Gestor</title>

    <!-- Ícones -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet"
        href="<?= base_url('assets/css/dashboard/style_alertas.css') ?>">
</head>

<body>
    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Gestor
        </div>

        <nav>
            <a href="<?= base_url('/dashboard-admin') ?>" class="menu-item">
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

            <a href="<?= base_url('/alertas-admin') ?>" class="menu-item active">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Alertas
            </a>

            <a href="<?= base_url('/configuracoes-admin') ?>" class="menu-item">
                <i class="fa-solid fa-gear"></i>
                Configurações
            </a>
        </nav>

    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">

        <!-- HEADER -->
        <header class="header">

            <div>

                <h2>Alertas dos Sensores</h2>

                <p style="color: #666;">

                    Monitoramento em tempo real dos alertas

                </p>

            </div>

            <div class="header-actions">

                <!-- FILTROS -->
                <a href="#"
                    class="btn btn-secondary">

                    <i class="fa-solid fa-filter"></i>

                    Filtros

                </a>

                <!-- LOGIN -->
                <a href="<?= base_url('/logout') ?>"
            style="
                background: #57c91b;
                color: #fff;
                text-decoration: none;

                width: 120px;
                height: 45 px;

                border-radius: 10px;

                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;

                font-size: 14px;
                font-weight: 600;

                margin-right: 15px;

                transition: 0.3s ease;
            ">

            <i class="fa-solid fa-right-from-bracket"></i>

            Logout

        </a>


                <!-- CONTRASTE -->
                <div class="acessibilidade">

    <button id="contraste-btn" aria-label="Alterar contraste">
        <i class="fa-solid fa-circle-half-stroke"></i>
        <button id="aumentar-fonte" aria-label="Aumentar fonte">
        A+
    </button>

    <button id="diminuir-fonte" aria-label="Diminuir fonte">
        A-
    </button>

    <button id="resetar-fonte" aria-label="Resetar fonte">
        A
    </button>
    </button>

</div>

                <!-- AVATAR -->
                <div class="avatar">

                    G

                </div>

            </div>

        </header>

        <!-- CARDS -->
        <div class="stats-grid">

            
            <!-- ALERTAS ATIVOS -->
            <div class="card">

                <div>

                    <h3>Alertas Ativos</h3>

                    <p style="color: var(--vermelho);">
                        12
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
                        3
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
                        5
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
                        4
                    </p>

                </div>

                <i class="fa-solid fa-bell"
                    style="color: var(--azul); font-size: 2.5rem;"></i>

            </div>

        </div>

        <!-- ALERTAS -->
        
        <div class="alerts-container">

            <div class="alerts-list">
                
                <?php
                foreach($alerta as $a){
                ?>
                <div class="alert-item alert-critico">
                    <div class="alert-icon">
                        <?php if($a['TIPO_SENSOR'] == 'Umidade'){ ?>
                            <i class="fa-solid fa-temperature-high"></i>
                        <?php } ?>
                        <?php if($a['TIPO_SENSOR'] == 'Temperatura'){ ?>
                            <i class="fa-solid fa-percent"></i>
                        <?php } ?>
                        <?php if($a['TIPO_SENSOR'] == 'Luz'){ ?>
                            <i class="fa-solid fa-sun"></i>
                        <?php } ?>
                        <?php if($a['TIPO_SENSOR'] == 'Solo'){ ?>
                            <i class="fa-solid fa-droplet"></i>
                        <?php } ?>
                    </div>
                    <div class="alert-content">
                        <h4><?= $a['NOME_FAZENDA']; ?></h4>
                        <h4><?= $a['TIPO_ALERTA']; ?> - Cultura <?= $a['NOME_CULTURA']; ?> - <?= $a['TIPO_CULTURA']; ?></h4>
                        <p>
                            <?= $a['VALOR'].$a['UNIDADE_MEDIDA']; ?> - <?= $a['DESCRICAO']; ?> - <?= $a['NIVEL_GRAVIDADE']; ?>
                        </p>
                        <div class="alert-meta">
                            <span class="alert-time">
                                <i class="fa-solid fa-clock"></i>
                                <?= $a['DATA_HORA']; ?>
                            </span>

                            <?php
                            if($a['STATUS'] == "Ativo"){
                            ?>
                                <span class="alert-status status-ativo">
                                    <?= $a['STATUS']; ?>
                                </span>
                            <?php
                            }
                            ?>

                            <?php
                            if($a['STATUS'] != "Ativo"){
                            ?>
                                <span class="btn-warning">
                                    <?= $a['STATUS']; ?>
                                </span>
                            <?php
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>

                <!-- ALERTA MÉDIO -->
                <!-- <div class="alert-item alert-medio">

                    <div class="alert-icon">

                        <i class="fa-solid fa-tint"></i>

                    </div>

                    <div class="alert-content">

                        <h4>Umidade Baixa - Campo B</h4>

                        <p>
                            Umidade: 22% (Limite: 35%) - Solo seco
                        </p>

                        <div class="alert-meta">

                            <span class="alert-time">

                                <i class="fa-solid fa-clock"></i>

                                45min atrás

                            </span>

                            <span class="alert-status status-ativo">

                                Ativo

                            </span>

                        </div>

                    </div>

                </div> -->

                <!-- ALERTA CRÍTICO -->
                <!-- <div class="alert-item alert-critico">

                    <div class="alert-icon">

                        <i class="fa-solid fa-bolt"></i>

                    </div>

                    <div class="alert-content">

                        <h4>Falha Elétrica - Estufa C</h4>

                        <p>
                            Sensor de solo desconectado - Sistema parado
                        </p>

                        <div class="alert-meta">

                            <span class="alert-time">

                                <i class="fa-solid fa-clock"></i>

                                1h atrás

                            </span>

                            <span class="alert-status status-ativo">

                                Ativo

                            </span>

                        </div>

                    </div>

                </div> -->

                <!-- ALERTA BAIXO -->
                <!-- <div class="alert-item alert-baixo">

                    <div class="alert-icon">

                        <i class="fa-solid fa-sun"></i>

                    </div>

                    <div class="alert-content">

                        <h4>Baixa Luminosidade - Estufa D</h4>

                        <p>
                            Luz: 280 lux (Ideal: 450 lux) - Suplementação necessária
                        </p>

                        <div class="alert-meta">

                            <span class="alert-time">

                                <i class="fa-solid fa-clock"></i>

                                2h atrás

                            </span>

                            <span class="alert-status status-ativo">

                                Ativo

                            </span>

                        </div>

                    </div>

                </div> -->

                <!-- ALERTA MÉDIO -->
                <!-- <div class="alert-item alert-medio">

                    <div class="alert-icon">

                        <i class="fa-solid fa-wind"></i>

                    </div>

                    <div class="alert-content">

                        <h4>Vento Forte - Campo A</h4>

                        <p>
                            Velocidade: 28 km/h (Limite: 25 km/h)
                        </p>

                        <div class="alert-meta">

                            <span class="alert-time">

                                <i class="fa-solid fa-clock"></i>

                                3h atrás

                            </span>

                            <span class="alert-status status-ativo">

                                Ativo

                            </span>

                        </div>

                    </div>

                </div> -->

            </div>

        </div>

    </main>

    <!-- JS -->
    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>
    <script>
/* =========================
   ACESSIBILIDADE - TAMANHO DA FONTE
========================= */

document.addEventListener('DOMContentLoaded', () => {

    let tamanhoFonte =
        parseInt(localStorage.getItem('fonteSite')) || 16;

    document.documentElement.style.fontSize =
        tamanhoFonte + 'px';

    document
        .getElementById('aumentar-fonte')
        .addEventListener('click', () => {

            if (tamanhoFonte < 24) {

                tamanhoFonte += 2;

                document.documentElement.style.fontSize =
                    tamanhoFonte + 'px';

                localStorage.setItem(
                    'fonteSite',
                    tamanhoFonte
                );
            }
document.addEventListener('DOMContentLoaded', () => {

    let tamanhoFonte =
        parseInt(localStorage.getItem('fonteSite')) || 16;

    document.documentElement.style.fontSize =
        tamanhoFonte + 'px';

    // =====================
    // CONTRASTE
    // =====================

    const btnContraste =
        document.getElementById('contraste-btn');

    if (localStorage.getItem('altoContraste') === 'true') {
        document.body.classList.add('alto-contraste');
    }

    btnContraste.addEventListener('click', () => {

        document.body.classList.toggle('alto-contraste');

        localStorage.setItem(
            'altoContraste',
            document.body.classList.contains('alto-contraste')
        );

    });

    // =====================
    // FONTE
    // =====================

    document
        .getElementById('aumentar-fonte')
        .addEventListener('click', () => {

            if (tamanhoFonte < 24) {

                tamanhoFonte += 2;

                document.documentElement.style.fontSize =
                    tamanhoFonte + 'px';

                localStorage.setItem(
                    'fonteSite',
                    tamanhoFonte
                );
            }

        });

    document
        .getElementById('diminuir-fonte')
        .addEventListener('click', () => {

            if (tamanhoFonte > 12) {

                tamanhoFonte -= 2;

                document.documentElement.style.fontSize =
                    tamanhoFonte + 'px';

                localStorage.setItem(
                    'fonteSite',
                    tamanhoFonte
                );
            }

        });

    document
        .getElementById('resetar-fonte')
        .addEventListener('click', () => {

            tamanhoFonte = 16;

            document.documentElement.style.fontSize =
                tamanhoFonte + 'px';

            localStorage.setItem(
                'fonteSite',
                tamanhoFonte
            );

        });

});
        });

    document
        .getElementById('diminuir-fonte')
        .addEventListener('click', () => {

            if (tamanhoFonte > 12) {

                tamanhoFonte -= 2;

                document.documentElement.style.fontSize =
                    tamanhoFonte + 'px';

                localStorage.setItem(
                    'fonteSite',
                    tamanhoFonte
                );
            }

        });

    document
        .getElementById('resetar-fonte')
        .addEventListener('click', () => {

            tamanhoFonte = 16;

            document.documentElement.style.fontSize =
                tamanhoFonte + 'px';

            localStorage.setItem(
                'fonteSite',
                tamanhoFonte
            );

        });

});
</script>

</body>

</html>