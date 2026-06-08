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

        [data-high-contrast="true"] .sidebar {
            background-color: #111111 !important;
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
        <!-- LÓGICA PHP (Simulação de Dados) -->
        <?php
            // Simulando dados
            $data = [
                'total_cultivos' => 12,
                'nivel_agua' => 85,
                'sensors_ativos' => 24,
            ];
        ?>

        <!-- CARDS DE ESTATÍSTICAS -->
        <div class="stats-grid">
            <div class="card">
                <div class="card-info">
                    <h3>Solo</h3>
                    <p><?php echo $data['total_cultivos']; ?> Ha</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-seedling"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Umidade do solo</h3>
                    <p><?php echo $data['nivel_agua']; ?>%</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-droplet"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Sensores Ativos</h3>
                    <p><?php echo $data['sensors_ativos']; ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-wifi"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Luz</h3>
                    <p>7000 lux</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-sun"></i></i></div>
            </div>
        </div>

        <!-- TABELA DE STATUS DOS SISTEMAS -->
        <h3 class="section-title">Status dos Sistemas Automatizados</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Sistema</th>
                        <th>Localização</th>
                        <th>Última Atualização</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <i class="fa-solid fa-faucet-drip" style="color: var(--verde-claro); margin-right: 8px;"></i>
                            Sistema  Temperatura
                        </td>
                        <td>Soja 1</td>
                        <td>10:45 AM</td>
                        <td><span class="status-badge status-ok">Operacional</span></td>
                        <td><button class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.8rem;">Ver</button></td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa-solid fa-temperature-arrow-up" style="color: var(--verde-claro); margin-right: 8px;"></i>
                            Controle de umidade
                        </td>
                        <td>Estufa Principal</td>
                        <td>10:42 AM</td>
                        <td><span class="status-badge status-ok">Normal</span></td>
                        <td><button class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.8rem;">Ver</button></td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa-solid fa-bolt" style="color: var(--verde-claro); margin-right: 8px;"></i>
                            Energia Solar 
                        </td>
                        <td>Margaridas </td>
                        <td>10:40 AM</td>
                        <td><span class="status-badge status-alert">Alerta</span></td>
                        <td><button class="btn btn-primary" style="padding: 5px 10px; font-size: 0.8rem;">Corrigir</button></td>
                    </tr>
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