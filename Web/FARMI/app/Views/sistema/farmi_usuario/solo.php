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
    gap: 15px;
}

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
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
body.alto-contraste button,
body.alto-contraste .btn {

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

    width: 40px;
    height: 40px;

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

.header-right .btn-secondary {
    width: 50px;
    height: 40px;
    padding: 0;
    border-radius: 8px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #4bc714;
    color: #fff;
    font-weight: bold;
    font-size: 1.0rem;
}

.header-right .btn-secondary:hover {
    background: #3da510;
}

.header-right a.btn-secondary {
    width: auto;
    padding: 10px 18px;
    gap: 10px;
    text-decoration: none;
}

#contraste-btn {
    background: transparent !important;
    border: none !important;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 40px;
    height: 40px;

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

.header-right .btn-secondary {
    width: 50px;
    height: 40px;
    padding: 0;
    border-radius: 8px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #4bc714;
    color: #fff;
    font-weight: bold;
    font-size: 1rem;
}

.header-right .btn-secondary:hover {
    background: #3da510;
}

.header-right a.btn-secondary {
    width: auto;
    padding: 10px 18px;
    gap: 10px;
    text-decoration: none;
}

.header-right{
    display:flex;
    align-items:center;
    gap:15px;
}

.header-right .btn-secondary{
    background:#4bc714;
    color:#fff;
    border:none;

    height:45px;          /* menor altura */
    border-radius:10px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-weight:bold;
    font-size:14px;       /* texto menor */

    text-decoration:none;
    transition:0.3s;
}

.header-right a.btn-secondary{
    padding:10px 18px;       /* logout menor */
    gap:8px;
}

.header-right button.btn-secondary{
    width:50px;           /* A+, A-, A menores */
    padding:0;
}

/* CONTRASTE */
#contraste-btn{
    background:transparent !important;
    border:none !important;

    width:40px;
    height:40px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:28px;
    color:#000;

    cursor:pointer;

    outline:none !important;
    box-shadow:none !important;
}

#contraste-btn:hover{
    color:#000;
}

#contraste-btn:focus,
#contraste-btn:active{
    outline:none !important;
    box-shadow:none !important;
}

/* AVATAR */
.avatar{
    width:50px;
    height:50px;
    border-radius:50%;
    background:#4bc714;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#000;
    font-weight:bold;
    font-size:18px;
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
        <p style="color: #666;">
            Dados em tempo real dos sensores de solo.
        </p>
    </div>

    <div class="header-right">

    <!-- Logout -->
    <a href="<?= base_url('/logout') ?>" class="btn btn-secondary">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>

    <!-- Contraste -->
    <button id="contraste-btn" aria-label="Alto Contraste">
        <i class="fa-solid fa-circle-half-stroke"></i>
    </button>

    <!-- A+ -->
    <button id="aumentar-fonte" class="btn btn-secondary">
        A+
    </button>

    <!-- A- -->
    <button id="diminuir-fonte" class="btn btn-secondary">
        A-
    </button>

    <!-- A -->
    <button id="fonte-normal" class="btn btn-secondary">
        A
    </button>

    <!-- Avatar -->
    <div class="user-profile">
        <div class="avatar">FUN</div>
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
    <script src="./../script.js"></script>
   <script>
let tamanhoFonte = 100;

document.getElementById('aumentar-fonte').addEventListener('click', () => {
    tamanhoFonte += 10;
    document.body.style.fontSize = tamanhoFonte + '%';
});

document.getElementById('diminuir-fonte').addEventListener('click', () => {
    tamanhoFonte -= 10;
    document.body.style.fontSize = tamanhoFonte + '%';
});

document.getElementById('fonte-normal').addEventListener('click', () => {
    tamanhoFonte = 100;
    document.body.style.fontSize = '100%';
});

document.getElementById('contraste-btn').addEventListener('click', () => {
    document.body.classList.toggle('alto-contraste');
});
</script>