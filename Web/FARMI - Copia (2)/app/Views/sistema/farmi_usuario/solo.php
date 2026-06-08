<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Ícone do site-->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <title>Monitoramento de Solo - Fazenda Inteligente</title>
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
            /* Cores para solo */
            --solo-seco: #d32f2f;
            --solo-ideal: #4bc714;
            --solo-úmido: #2196F3;
        }
        body.contraste .header-right a.btn-secondary,
body.contraste .header-right a.btn-secondary * {
    color: #000 !important;
}

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:  'Arial';
        }
        body.contraste .logout-btn {
    background: #fff !important;
    color: #000 !important;
    border: none !important;
}

body.contraste .logout-btn *,
body.contraste .logout-btn i {
    color: #000 !important;
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

/* ==========================================
   PADRONIZAÇÃO INTEGRAL CONFORME DASHBOARD
   ========================================== */

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
}

#contraste-btn:hover {
    color: var(--verde-claro);
}

.logout-btn {
    background: #58CC02;
    color: white;
    text-decoration: none;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 0 18px;
    border-radius: 10px;
    font-weight: bold;
    transition: 0.3s;
}

.logout-btn:hover {
    background: #46A302;
    color: white;
}

.accessibility-btn {
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

.accessibility-btn:hover {
    background-color: #46A302;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
}

.avatar {
    width: 42px;
    height: 42px;
    background-color: var(--verde-claro);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: var(--verde-escuro);
    font-weight: bold;
}

/* Regras de Alto Contraste específicas para estes botões */
body.contraste .logout-btn {
    background: #fff !important;
    color: #000 !important;
    border: none !important;
}

body.contraste .logout-btn i {
    color: #000 !important;
}

/* AVATAR DO USUÁRIO */
.avatar {
    width: 42px;
    height: 42px;
    background-color: #4bc714;
    border: none;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #052501;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    text-decoration: none;
}

.avatar a {
    text-decoration: none;
    color: inherit;
}

/* ALTO CONTRASTE - BOTÕES DE FONTE */
body.contraste #aumentar-fonte,
body.contraste #diminuir-fonte,
body.contraste #resetar-fonte,
body.contraste .user-profile .btn-logout {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 42px;
            height: 42px;
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

        .soil-meter {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 8px solid var(--verde-claro);
            background: linear-gradient(135deg, #f5f5f5, #fff);
            box-shadow: 0 0 30px rgba(129, 199, 132, 0.5);
            transition: all 0.3s ease;
        }

        .soil-meter .soil-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--verde-escuro);
        }

        .soil-meter .soil-unit {
            font-size: 1rem;
            color: #666;
        }

        .soil-meter .status {
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

        .status-dry {
            background-color: rgba(211, 47, 47, 0.3);
            color: var(--solo-seco);
        }

        .status-wet {
            background-color: rgba(33, 150, 243, 0.3);
            color: var(--solo-úmido);
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

        /* --- INDICADOR DE SOLO --- */
        .soil-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .soil-normal {
            background: linear-gradient(135deg, #4bc714, #052501);
            color: white;
        }

        .soil-dry {
            background: linear-gradient(135deg, #d32f2f, #b71c1c);
            color: white;
        }

        .soil-wet {
            background: linear-gradient(135deg, #2196F3, #1976d2);
            color: white;
        }
        /* =========================
   TODOS OS ELEMENTOS
========================= */

/* 
Seleciona TODOS os elementos dentro do body
quando o alto contraste estiver ativo

O * significa "todos os elementos"
*/
body.contraste * {

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
body.contraste div,
body.contraste section,
body.contraste main,
body.contraste aside,
body.contraste nav,
body.contraste header,
body.contraste footer,
body.contraste form {

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
body.contraste input,
body.contraste select,
body.contraste textarea {

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
body.contraste input::placeholder {

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
body.contraste button,
body.contraste .btn {

    /* fundo branco */
    background: #fff !important;

    /* texto preto */
    color: #000 !important;

    /* borda branca */
    border: 2px solid #fff !important;
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
body.contraste table,
body.contraste thead,
body.contraste tbody,
body.contraste tr,
body.contraste td,
body.contraste th {

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
body.contraste i {

    /* deixa os ícones brancos */
    color: #fff !important;
}
body.contraste .chart-container {
    background: #222426 !important;
    border: 2px solid white;
    border-radius: 10px;
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
            <a href="<?= base_url('/umidade') ?>" class="menu-item"><i class="fa-solid fa-droplet"></i> Umidade</a>
            <a href="<?= base_url('/solo') ?>" class="menu-item active"><i class="fa-solid fa-chart-pie"></i> Solo</a>
            <a href="<?= base_url('/configuracoes-usuario') ?>" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
            

        </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
        
        <!-- CABEÇALHO -->
        <!-- CABEÇALHO -->
        <header class="header">
    <div>
        <h2>Monitoramento de Solo</h2>
        <p style="color: #666;">Dados em tempo real dos sensores de solo.</p>
    </div>

    <div style="display:flex; align-items:center; gap:15px;">

    <a href="<?= base_url('/logout') ?>" class="logout-btn">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>

    <button id="contraste-btn" aria-label="Alterar contraste">
        <i class="fa-solid fa-circle-half-stroke"></i>
    </button>

    <button class="accessibility-btn" id="aumentar-fonte" aria-label="Aumentar fonte">A+</button>
    <button class="accessibility-btn" id="diminuir-fonte" aria-label="Diminuir fonte">A-</button>
    <button class="accessibility-btn" id="resetar-fonte" aria-label="Resetar fonte">A</button>

    <div class="user-profile">
        <div class="avatar">F</div>
    </div>

</div>
</header>


        <!-- INDICADOR DE SOLO -->
        <div style="margin-bottom: 20px;">
            <div class="soil-indicator soil-normal">
                <i class="fa-solid fa-seedling"></i>
                <span>Monitoramento de Solo - Sensor Capacitivo Ativo</span>
            </div>
        </div>

        <!-- LÓGICA PHP (Simulação de Dados do Sensor Capacitivo) -->
        <?php
            // Simulando dados do sensor de solo capacitivo
            $sensor_data = [
                'umidade_solo' => rand(20, 80),
                'resistencia' => rand(100, 1000),
                'sensor_on' => true,
                'status' => 'optimal',
                'ultima_leitura' => date('H:i:s'),
                'data_leitura' => date('d/m/Y'),
                'localizacao' => 'Estufa A'
            ];

            // Determinar status baseado na umidade do solo
            if ($sensor_data['umidade_solo'] < 30) {
                $sensor_data['status'] = 'dry';
            } elseif ($sensor_data['umidade_solo'] > 70) {
                $sensor_data['status'] = 'wet';
            }
        ?>

        <!-- VISUALIZAÇÃO DO SENSOR -->
        <div class="sensor-visualization">
            <h3><i class="fa-solid fa-seedling"></i> Medidor de Umidade do Solo</h3>
            <div class="soil-meter">
                <span class="soil-value"><?php echo $sensor_data['umidade_solo']; ?>%</span>
                <span class="soil-unit">Umidade do Solo</span>
                <span class="status status-<?php echo $sensor_data['status']; ?>">
                    <i class="fa-solid fa-check"></i> 
                    <?php 
                        if($sensor_data['status'] == 'optimal') echo 'Ideal';
                        elseif($sensor_data['status'] == 'dry') echo 'Seco';
                        else echo 'Úmido';
                    ?>
                </span>
            </div>
            <p style="color: #666;">Última leitura: <?php echo $sensor_data['ultima_leitura']; ?></p>
        </div>

        <!-- CARDS DE ESTATÍSTICAS -->
        <div class="stats-grid">
            <div class="card">
                <div class="card-info">
                    <h3>Umidade do Solo</h3>
                    <p><?php echo $sensor_data['umidade_solo']; ?>%</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-seedling"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Sensores Ativos</h3>
                    <p>1</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-wifi"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Alertas</h3>
                    <p><?php echo ($sensor_data['status'] == 'optimal') ? '0' : '1'; ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            </div>
        </div>

        <!-- TABELA DE STATUS DOS SISTEMAS -->
        <h3 class="section-title">Status dos Sensores de Solo</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Sensor</th>
                        <th>Localização</th>
                        <th>Última Atualização</th>
                        <th>Solo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                             <i class="fa-solid fa-droplet" style="color: var(--verde-claro); margin-right: 8px;"></i>
                            DHT22
                        </td>
                        <td>Estufa E</td>
                        <td><?php echo $sensor_data['ultima_leitura']; ?></td>
                        <td><?php echo $sensor_data['umidade_solo']; ?>%</td>
                        <td><span class="status-badge status-ok">Normal</span></td>
                        <td><button class="btn btn-secondary" style="padding: 5px 10px; font-size:"></td>
                    </tr>
                </body>
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

    <script src="./../script.js"></script>
    
   <script>
    document.addEventListener('DOMContentLoaded', () => {
    
    // ==========================================
    // ACESSIBILIDADE: FONTE (PADRONIZADO EM %)
    // ==========================================
    let tamanhoFonte = 100;

    function aplicarFonte() {
        document.documentElement.style.fontSize = tamanhoFonte + '%';
        localStorage.setItem('tamanhoFonteDashboard', tamanhoFonte);
    }

    const aumentarFonte = document.getElementById('aumentar-fonte');
    const diminuirFonte = document.getElementById('diminuir-fonte');
    const resetarFonte = document.getElementById('resetar-fonte');

    if (aumentarFonte) {
        aumentarFonte.addEventListener('click', () => {
            if (tamanhoFonte < 150) {
                tamanhoFonte += 10;
                aplicarFonte();
            }
        });
    }

    if (diminuirFonte) {
        diminuirFonte.addEventListener('click', () => {
            if (tamanhoFonte > 70) {
                tamanhoFonte -= 10;
                aplicarFonte();
            }
        });
    }

    if (resetarFonte) {
        resetarFonte.addEventListener('click', () => {
            tamanhoFonte = 100;
            aplicarFonte();
        });
    }

    // Carrega a fonte salva no localStorage
    const fonteSalva = localStorage.getItem('tamanhoFonteDashboard');
    if (fonteSalva) {
        tamanhoFonte = parseInt(fonteSalva);
        aplicarFonte();
    }

    // ==========================================
    // ACESSIBILIDADE: ALTO CONTRASTE ('contraste')
    // ==========================================
    const btnContraste = document.getElementById('contraste-btn');
    
    if (btnContraste) {
        // Mantém a gravação do estado anterior, se desejado, usando a nova classe
        const isAltoContraste = localStorage.getItem('altoContraste') === 'true';

        if (isAltoContraste) {
            document.body.classList.add('contraste');
        }

        btnContraste.addEventListener('click', () => {
            document.body.classList.toggle('contraste');
            const ativo = document.body.classList.contains('contraste');
            localStorage.setItem('altoContraste', ativo);
        });
    }
});
</script>