<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento de Luz - Fazenda Inteligente</title>
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
            /* Cores para luz */
            --luz-baixa: #ff0000;
            --luz-media: #ffe600;
            --luz-alta: #29de32;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        .light-meter {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 8px solid var(--verde-claro);
            background: linear-gradient(135deg, #fff9c4, #fff);
            box-shadow: 0 0 30px rgba(255, 235, 59, 0.5);
            transition: all 0.3s ease;
        }

        .light-meter .lux-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--verde-escuro);
        }

        .light-meter .lux-unit {
            font-size: 1rem;
            color: #666;
        }

        .light-meter .status {
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
            background-color: rgba(211, 47, 47, 0.3);
            color: var(--luz-baixa);
        }

        .status-high {
            background-color: rgba(255, 235, 59, 0.3);
            color: #f57f17;
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

        /* --- INDICADOR DE LUZ --- */
        .light-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .light-normal {
            background: linear-gradient(135deg, #4bc714, #052501);
            color: white;
        }

        .light-low {
            background: linear-gradient(135deg, #d32f2f, #b71c1c);
            color: white;
        }

        .light-high {
            background: linear-gradient(135deg, #ffeb3b, #f57f17);
            color: #333;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Usuário
        </div>
        <nav>
            <a href="dashboard.php" class="menu-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="luz.php" class="menu-item active"><i class="fa-solid fa-lightbulb"></i> Luz</a>
            <a href="temperatura.php" class="menu-item"><i class="fa-solid fa-temperature-high"></i> Temperatura</a>
            <a href="umidade.php" class="menu-item"><i class="fa-solid fa-droplet"></i> Umidade</a>
            <a href="solo.php" class="menu-item"><i class="fa-solid fa-chart-pie"></i> Solo</a>
            <a href="configuracoes.php" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
        </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
        
        <!-- CABEÇALHO -->
        <header class="header">
            <div>
                <h2>Monitoramento de Luz </h2>
                <p style="color: #666;">Dados em tempo real dos sensores de luminosidade.</p>
            </div>
            <div class="user-profile">
                <div class="avatar">US</div>
            </div>
        </header>

        <!-- INDICADOR DE LUZ -->
        <div style="margin-bottom: 20px;">
            <div class="light-indicator light-normal">
                <i class="fa-solid fa-sun"></i>
                <span>Monitoramento de Luz - Modo Fotossensível Ativo</span>
            </div>
        </div>

        <!-- LÓGICA PHP (Simulação de Dados do Sensor LDR) -->
        <?php
            // Simulando dados do sensor LDR
            $sensor_data = [
                'lux' => rand(5000, 15000),
                'ldr_value' => rand(0, 1024),
                'device_on' => true,
                'status' => 'optimal',
                'ultima_leitura' => date('H:i:s'),
                'data_leitura' => date('d/m/Y'),
                'localizacao' => 'Estufa A'
            ];

            // Determinar status baseado na luminosidade
            if ($sensor_data['lux'] < 5000) {
                $sensor_data['status'] = 'low';
            } elseif ($sensor_data['lux'] > 12000) {
                $sensor_data['status'] = 'high';
            }
        ?>

        <!-- VISUALIZAÇÃO DO SENSOR -->
        <div class="sensor-visualization">
            <h3><i class="fa-solid fa-lightbulb"></i> Medidor de Luz</h3>
            <div class="light-meter">
                <span class="lux-value"><?php echo $sensor_data['lux']; ?></span>
                <span class="lux-unit">LUZ</span>
                <span class="status status-<?php echo $sensor_data['status']; ?>">
                    <i class="fa-solid fa-check"></i> 
                    <?php 
                        if($sensor_data['status'] == 'optimal') echo 'Ótimo';
                        elseif($sensor_data['status'] == 'low') echo 'Baixa';
                        else echo 'Alta';
                    ?>
                </span>
            </div>
            <p style="color: #666;">Última leitura: <?php echo $sensor_data['ultima_leitura']; ?></p>
        </div>

        <!-- CARDS DE ESTATÍSTICAS -->
        <div class="stats-grid">
            <div class="card">
                <div class="card-info">
                    <h3>Luminosidade Atual</h3>
                    <p><?php echo $sensor_data['lux']; ?> Lux</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-lightbulb"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Valor LDR</h3>
                    <p><?php echo $sensor_data['ldr_value']; ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-microchip"></i></div>
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
        <h3 class="section-title">Status dos Sensores de Luz</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Sensor</th>
                        <th>Localização</th>
                        <th>Última Atualização</th>
                        <th>Luminosidade</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                             <i class="fa-solid fa-droplet" style="color: var(--verde-claro); margin-right: 8px;"></i>
                            Sensor LDR
                        </td>
                        <td>Estufa B</td>
                        <td><?php echo $sensor_data['ultima_leitura']; ?></td>
                        <td><?php echo $sensor_data['lux']; ?></td>
                        <td><span class="status-badge status-ok">Normal</span></td>
                        <td><button class="btn btn-secondary" style="padding: 5px 10px; font-size:"> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>