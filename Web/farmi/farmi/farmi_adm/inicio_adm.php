<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gerenciar Sensores</title>
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
            --vermelho: #dc3545;
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

        /* --- FORMULÁRIO ADICIONAR SENSOR --- */
        .form-section {
            background: var(--branco);
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--sombra);
            margin-bottom: 30px;
        }

        .section-title {
            color: var(--verde-escuro);
            margin-bottom: 20px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 8px;
            color: var(--texto-escuro);
            font-weight: 500;
        }

        .form-group input, .form-group select {
            padding: 12px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: var(--verde-claro);
        }

        /* --- TABELA DE SENSores --- */
        .table-container {
            background: var(--branco);
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--sombra);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th, td {
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        th {
            color: var(--verde-escuro);
            font-weight: 600;
            background-color: #f8f9fa;
        }

        /* --- BOTÕES DE AÇÃO --- */
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: var(--verde-escuro);
            color: var(--branco);
        }

        .btn-primary:hover {
            background-color: #1b5e20;
        }

        .btn-success {
            background-color: var(--verde-claro);
            color: var(--verde-escuro);
        }

        .btn-success:hover {
            background-color: var(--verde-claro-hover);
        }

        .btn-danger {
            background-color: var(--vermelho);
            color: var(--branco);
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-group {
            display: flex;
            gap: 8px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .status-active {
            background-color: rgba(129, 199, 132, 0.2);
            color: var(--verde-escuro);
        }

        .status-inactive {
            background-color: rgba(244, 67, 54, 0.2);
            color: #d32f2f;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Admin
        </div>
        <nav>
            <a href="dashboard.php" class="menu-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="sensores.php" class="menu-item active"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="usuarios.php" class="menu-item"><i class="fa-solid fa-users"></i> Usuários</a>
            <a href="relatorios.php" class="menu-item"><i class="fa-solid fa-file-chart-column"></i> Relatórios</a>
            <a href="configuracoes.php" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
        </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
        
        <!-- CABEÇALHO -->
        <header class="header">
            <div>
                <h2>Gerenciar Sensores</h2>
                <p style="color: #666;">Painel administrativo completo</p>
            </div>
            <div class="user-profile">
                <div class="avatar">ADM</div>
            </div>
        </header>

        <!-- LÓGICA PHP (Simulação de Dados) -->
        <?php
            // Simulando dados de sensores do banco
            $sensores = [
                ['id' => 1, 'nome' => 'Sensor Temp 01', 'tipo' => 'Temperatura', 'localizacao' => 'Estufa A', 'status' => 'Ativo'],
                ['id' => 2, 'nome' => 'Sensor Umid 01', 'tipo' => 'Umidade', 'localizacao' => 'Estufa B', 'status' => 'Ativo'],
                ['id' => 3, 'nome' => 'Sensor Luz 01', 'tipo' => 'Luz', 'localizacao' => 'Campo Aberto', 'status' => 'Inativo'],
                ['id' => 4, 'nome' => 'Sensor Solo 01', 'tipo' => 'Solo', 'localizacao' => 'Soja 1', 'status' => 'Ativo'],
            ];
            $total_sensores = count($sensores);
            $sensores_ativos = count(array_filter($sensores, fn($s) => $s['status'] === 'Ativo'));
        ?>

        <!-- CARDS DE ESTATÍSTICAS -->
        <div class="stats-grid">
            <div class="card">
                <div class="card-info">
                    <h3>Total de Sensores</h3>
                    <p><?php echo $total_sensores; ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-satellite-dish"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Sensores Ativos</h3>
                    <p><?php echo $sensores_ativos; ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-wifi"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Tipos Configurados</h3>
                    <p>4</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-layer-group"></i></div>
            </div>
        </div>

        <!-- FORMULÁRIO ADICIONAR SENSOR -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fa-solid fa-plus"></i>
                Adicionar Novo Sensor
            </h3>
            <form id="formSensor" class="form-grid">
                <div class="form-group">
                    <label for="nome">Nome do Sensor *</label>
                    <input type="text" id="nome" name="nome" required placeholder="Ex: Sensor Temp 05">
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo de Sensor *</label>
                    <select id="tipo" name="tipo" required>
                        <option value="">Selecione o tipo</option>
                        <option value="Temperatura">Temperatura</option>
                        <option value="Umidade">Umidade</option>
                        <option value="Luz">Luz</option>
                        <option value="Solo">Solo</option>
                        <option value="pH">pH</option>
                        <option value="CO2">CO2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="localizacao">Localização *</label>
                    <input type="text" id="localizacao" name="localizacao" required placeholder="Ex: Estufa A">
                </div>
                <div class="form-group">
                    <label for="status">Status Inicial</label>
                    <select id="status" name="status">
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>
                <div style="grid-column: 1 / -1; display: flex; gap: 15px; align-items: end;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Adicionar Sensor
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fa-solid fa-refresh"></i>
                        Limpar
                    </button>
                </div>
            </form>
        </div>

        <!-- TABELA DE SENSores -->
        <h3 class="section-title">
            <i class="fa-solid fa-list"></i>
            Lista de Sensores (<?php echo $total_sensores; ?>)
        </h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Localização</th>
                        <th>Status</th>
                        <th>Data Cadastro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="sensoresTable">
                    <?php foreach($sensores as $sensor): ?>
                    <tr>
                        <td><?php echo $sensor['id']; ?></td>
                        <td>
                            <i class="fa-solid fa-satellite-dish" style="color: var(--verde-claro); margin-right: 8px;"></i>
                            <?php echo $sensor['nome']; ?>
                        </td>
                        <td><?php echo $sensor['tipo']; ?></td>
                        <td><?php echo $sensor['localizacao']; ?></td>
                        <td>
                            <span class="status-badge status-<?php echo strtolower($sensor['status']); ?>">
                                <?php echo $sensor['status']; ?>
                            </span>
                        </td>
                        <td><?php echo date('d/m/Y'); ?></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-success" onclick="editarSensor(<?php echo $sensor['id']; ?>)">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <button class="btn btn-danger" onclick="excluirSensor(<?php echo $sensor['id']; ?>)">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // Simulação de funcionalidades
        document.getElementById('formSensor').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Sensor adicionado com sucesso! (Simulação)');
            this.reset();
        });

        function editarSensor(id) {
            alert('Editar sensor ID: ' + id + ' (Implementar modal de edição)');
        }

        function excluirSensor(id) {
            if(confirm('Deseja realmente excluir este sensor?')) {
                alert('Sensor ID: ' + id + ' excluído com sucesso! (Simulação)');
                location.reload();
            }
        }
    </script>
</body>
</html>