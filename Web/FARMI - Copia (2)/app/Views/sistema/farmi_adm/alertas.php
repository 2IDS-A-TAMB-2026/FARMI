<!DOCTYPE html>
<html lang="pt-br">
    
    <style>
    #aumentar-fonte,
    #diminuir-fonte,
    #resetar-fonte {
        width: 39.5px;
        height: 39.5px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        background: #57c91b;
        color: white;
        font-weight: bold;
        transition: .3s;
        margin-right: 7.5px; 
        
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
    /* BOTÕES NO MODO ALTO CONTRASTE */
.alto-contraste #aumentar-fonte,
.alto-contraste #diminuir-fonte,
.alto-contraste #resetar-fonte,

.alto-contraste a[href*="logout"] {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}

    /* Ícones dos botões */
    
    .alto-contraste a[href*="logout"] i {
        color: #fff !important;
    }

    /* Hover */
    .alto-contraste #aumentar-fonte:hover,
    .alto-contraste #diminuir-fonte:hover,
    .alto-contraste #resetar-fonte:hover,
    
    .alto-contraste a[href*="logout"]:hover {
        background: #222 !important;
    }
    #contraste-btn{
    width: 42px;
    height: 42px;
    border: none;
    border-radius: 50%;
    background: #57c91b;
    color: #000;
    cursor: pointer;
    font-size: 18px;
}

#contraste-btn i{
    color: #000;
}

.alto-contraste #contraste-btn{
    background: #fff !important;
    color: #000 !important;
    border: 2px solid #000 !important;
}

.alto-contraste #contraste-btn i{
    color: #fff !important;
}
.btn-secondary {
    font-size: 14px !important;
}
    /* =========================
   RESPONSIVIDADE
========================= */

@media (max-width: 1024px) {

    .header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .header-actions {
        width: 100%;
        flex-wrap: wrap;
        gap: 10px;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .alerts-container {
        overflow-x: auto;
    }
}

@media (max-width: 768px) {

    /* Sidebar vira topo */
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        padding: 15px;
    }

    .sidebar nav {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .menu-item {
        flex: 1 1 45%;
        min-width: 140px;
    }

    .main-content {
        margin-left: 0 !important;
        width: 100%;
        padding: 15px;
    }

    .header {
        flex-direction: column;
        align-items: stretch;
    }

    .header-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .acessibilidade {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .card {
        width: 100%;
    }

    .alert-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .alert-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .avatar {
        align-self: center;
    }
}

@media (max-width: 480px) {

    h2 {
        font-size: 1.4rem;
    }

    .logo {
        font-size: 1.2rem;
        text-align: center;
        width: 100%;
    }

    .menu-item {
        flex: 1 1 100%;
    }

    .btn,
    .btn-secondary {
        width: 100%;
        justify-content: center;
    }

    .header-actions a[href*="logout"] {
        width: 100% !important;
        margin-right: 0 !important;
    }

    .acessibilidade {
        width: 100%;
        justify-content: center;
    }

    #aumentar-fonte,
    #diminuir-fonte,
    #resetar-fonte,
    #contraste-btn {
        width: 40px;
        height: 40px;
    }

    .alert-content h4,
    .alert-content p {
        word-break: break-word;
    }
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
    <button id="menu-toggle">
    <i class="fa-solid fa-bars"></i>
</button>
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
            </button>

            <button id="aumentar-fonte" aria-label="Aumentar fonte">
                A+
            </button>

            <button id="diminuir-fonte" aria-label="Diminuir fonte">
                A-
            </button>

            <button id="resetar-fonte" aria-label="Resetar fonte">
                A
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