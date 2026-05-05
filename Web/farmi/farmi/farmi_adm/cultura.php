<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gerenciar Culturas</title>
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
            <a href="dashboard.php" class="menu-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="sensores.php" class="menu-item"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="usuarios.php" class="menu-item"><i class="fa-solid fa-users"></i> Usuários</a>
            <a href="fazendas.php" class="menu-item"><i class="fa-solid fa-cow"></i> Fazendas</a>
            <a href="cultura.php" class="menu-item active"><i class="fa-solid fa-seedling"></i> Culturas</a>
            <a href="alertas.php" class="menu-item"><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
            <a href="configuracoes.php" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
        </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
        
        <!-- CABEÇALHO -->
        <header class="header">
            <div>
                <h2>Gerenciar Culturas</h2>
                <p style="color: #666;">Controle total das culturas plantadas</p>
            </div>
            <div class="user-profile">
                <div class="avatar">ADM</div>
            </div>
        </header>

        <!-- LÓGICA PHP (Simulação de Dados) -->
        <?php
            // Simulando dados de culturas do banco
            $culturas = [
                ['id' => 1, 'nome' => 'Milho Safrinha', 'data_plantio' => '2024-03-15', 'ciclo' => 120, 'tipo' => 'Grãos', 'area' => 25.5,'sensorLuz' =>'50000','sensorTemp' =>'25°C','sensorUmi'=>'55%','sensorSolo' =>'70%', 'status' => 'Plantado'],
                ['id' => 2, 'nome' => 'Soja GM 8478', 'data_plantio' => '2024-02-20', 'ciclo' => 150, 'tipo' => 'Grãos', 'area' => 45.0,'sensorLuz' =>'50000','sensorTemp' =>'25°C','sensorUmi'=>'55%','sensorSolo' =>'70%', 'status' => 'Colhendo'],
                ['id' => 3, 'nome' => 'Feijão Carioca', 'data_plantio' => '2024-04-01', 'ciclo' => 90, 'tipo' => 'Leguminosas', 'area' => 12.8, 'sensorLuz' =>'50000','sensorTemp' =>'25°C','sensorUmi'=>'55%','sensorSolo' =>'70%','status' => 'Plantado'],
                ['id' => 4, 'nome' => 'Tomate Híbrido', 'data_plantio' => '2024-01-10', 'ciclo' => 75, 'tipo' => 'Hortaliças', 'area' => 8.2, 'sensorLuz' =>'50000','sensorTemp' =>'25°C','sensorUmi'=>'55%','sensorSolo' =>'70%', 'status' => 'Concluído'],
            ];
            $total_culturas = count($culturas);
            $area_total = array_sum(array_column($culturas, 'area'));
        ?>

        <!-- CARDS DE ESTATÍSTICAS -->
        <div class="stats-grid">
            <div class="card">
                <div class="card-info">
                    <h3>Total de Culturas</h3>
                    <p><?php echo $total_culturas; ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-seedling"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Área Total Plantada</h3>
                    <p><?php echo number_format($area_total, 1); ?> ha</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-ruler-combined"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Em Produção</h3>
                    <p>2</p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-leaf"></i></div>
            </div>
        </div>

        <!-- FORMULÁRIO ADICIONAR CULTURA -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fa-solid fa-plus"></i>
                Adicionar Nova Cultura
            </h3>
            <form id="formCultura" class="form-grid">
                <div class="form-group">
                    <label for="nomeCultura">
                        <i class="fa-solid fa-tag"></i>
                        Nome da Cultura *
                    </label>
                    <input type="text" id="nomeCultura" name="nomeCultura" required 
                           placeholder="Ex: Milho Safrinha, Soja GM 8478">
                </div>
                
                <div class="form-group">
                    <label for="dataPlantio">
                        <i class="fa-solid fa-calendar-day"></i>
                        Data do Plantio *
                    </label>
                    <input type="date" id="dataPlantio" name="dataPlantio" required>
                </div>

                <div class="form-group">
                    <label for="cicloProdutivo">
                        <i class="fa-solid fa-clock"></i>
                        Ciclo Produtivo (dias) *
                    </label>
                    <input type="number" id="cicloProdutivo" name="cicloProdutivo" 
                           min="30" max="365" required placeholder="120">
                </div>

                <div class="form-group">
                    <label for="tipoCultura">
                        <i class="fa-solid fa-seedling"></i>
                        Tipo da Cultura *
                    </label>
                    <select id="tipoCultura" name="tipoCultura" required>
                        <option value="">Selecione o tipo</option>
                        <option value="Grãos">Grãos (Milho, Soja, Trigo)</option>
                        <option value="Leguminosas">Leguminosas (Feijão, Ervilha)</option>
                        <option value="Hortaliças">Hortaliças (Tomate, Cenoura)</option>
                        <option value="Raízes">Raízes e Tubérculos (Batata, Mandioca)</option>
                        <option value="Folhosas">Folhosas (Alface, Repolho)</option>
                        <option value="Frutas">Frutas (Melancia, Melão)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="areaCultivada">
                        <i class="fa-solid fa-ruler-combined"></i>
                        Área Cultivada (ha) *
                    </label>
                    <input type="number" id="areaCultivada" name="areaCultivada" 
                           min="0" step="0.01" required placeholder="25.50">
                </div>
                
            <form id="formCultura" class="form-grid">
                <div class="form-group">
                    <label for="sensorLuz">
                        <i class="fa-solid fa-lightbulb"></i>
                         Sensor de luz (lux):
                    </label>
                    <input type="text" id="sensorLuz" name="sensorLuz" required 
                           placeholder="Ex: 50000 lux">
                </div>
                
                <div class="form-group">
                    <label for="sensorTemp">
                        <i class="fa-solid fa-cloud"></i>
                        Sensor de clima (Temperatura °C):
                    </label>
                    <input type="text" id="sensorTemp" name="sensorTemp" required
                            placeholder="Ex: 24°C">
                </div>

                <div class="form-group">
                    <label for="sensorUmi">
                        <i class="fa-solid fa-temperature-empty"></i>
                        Sensor de clima (Umidade %):
                    </label>
                    <input type="text" id="sensorUmi" name="sensorUmi" required
                            placeholder="Ex: 65%">
                </div>


                <div class="form-group">
                    <label for="sensorSolo">
                        <i class="fa-solid fa-mound"></i>
                        Sensor de umidade do Solo (%):
                    </label>
                    <input type="text" id="sensorSolo" name="sensorSolo" 
                           placeholder="Ex: 70%">
                </div>

                <div class="form-group full-width" style="display: flex; gap: 15px; align-items: end;">
                    <button type="submit" class="btn btn-primary" style="width:180px">
                        <i class="fa-solid fa-save"></i>
                        Cadastrar 
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fa-solid fa-refresh"></i>
                        Limpar Formulário
                    </button>
                </div>
            </form>
        </div>

     <!-- TABELA DE CULTURAS -->
<h3 class="section-title">
    <i class="fa-solid fa-list"></i>
    Lista de Culturas (<?php echo $total_culturas; ?>)
</h3>
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cultura</th>
                <th>Data Plantio</th>
                <th>Ciclo (dias)</th>
                <th>Tipo</th>
                <th>Área</th>
                <th>Sensor de Luz</th>
                <th>Sensor de Temperatura</th>
                <th>Sensor de Umidade</th>
                <th>Sensor de Solo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="culturasTable">
            <?php foreach($culturas as $cultura): ?>
            <tr>
                <td><?php echo $cultura['id']; ?></td>
                <td>
                    <i class="fa-solid fa-seedling" style="color: var(--verde-claro); margin-right: 8px;"></i>
                    <?php echo $cultura['nome']; ?>
                </td>
                <td><?php echo $cultura['data_plantio']; ?></td>
                <td><?php echo $cultura['ciclo']; ?></td>
                <td><?php echo $cultura['tipo']; ?></td>
                <td><?php echo $cultura['area']; ?></td>
                <td><?php echo $cultura['sensorLuz']; ?></td>
                <td><?php echo $cultura['sensorTemp']; ?></td>
                <td><?php echo $cultura['sensorUmi']; ?></td>
                <td><?php echo $cultura['sensorSolo']; ?></td>

                <td>
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="editarCultura(<?php echo $cultura['id']; ?>)">
                            <i class="fa-solid fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="excluirCultura(<?php echo $cultura['id']; ?>)">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
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