<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gerenciar Sensores</title>
    <!-- Ícones  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Admin
        </div>
        <nav>
            <a href="dashboard.php" class="menu-item "><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="sensores.php" class="menu-item active"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="usuarios.php" class="menu-item"><i class="fa-solid fa-users"></i> Usuários</a>
            <a href="fazendas.php" class="menu-item"><i class="fa-solid fa-cow"></i> Fazendas</a>
            <a href="cultura.php" class="menu-item "><i class="fa-solid fa-seedling"></i> Culturas</a>
            <a href="alertas.php" class="menu-item"><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
            <a href="configuracoes.php" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
        </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
        
        <!-- CABEÇALHO -->
        <header class="header">
            <div>
                <h2>Gerenciar Sensores</h2>
                <p style="color: #666;">Painel administrativo</p>
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
                    </select>
                </div>
                <div class="form-group">
                    <label for="unidade">Unidade de Medida*</label>
                    <input type="number" id="unidade" name="unidade" required placeholder="Ex: % (porcentagem) ou °C">
                </div>
                <div class="form-group">
                    <label for="status">Status Inicial*</label>
                    <select id="status" name="status">
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Data da Instalação*</label>
                    <input type="date" id="data" name="data" required>
                </div>
                
                                 <div class="form-group">
                    <label for="status">Culturas *</label>
                    <div class="dropdown">
                        <div class="dropdown-btn" onclick="toggleDropdown()">
                            Selecione opções
                        </div>

                        <div class="dropdown-content" id="dropdown">
                            <label><input type="checkbox" value="1"> Opção 1</label>
                            <label><input type="checkbox" value="2"> Opção 2</label>
                            <label><input type="checkbox" value="3"> Opção 3</label>
                            <label><input type="checkbox" value="4"> Opção 4</label>
                        </div>
                    </div>
                </div>
                <script>
                function toggleDropdown() {
                var dropdown = document.getElementById("dropdown");
                dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
                }
                </script>
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
                        <th>Unidade de medida</th>
                        <th>Status</th>
                        <th>Data Instalação</th>
                        <th>ID da Cultura</th>
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
                        <td><?php echo $sensor['localizacao']; ?></td>
                        <td><?php echo $sensor['id']; ?></td>
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