<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor - Gerenciar Culturas</title>
    <!-- Ícones  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Estilos para o dropdown de fazendas */
        .dropdown {
            position: relative;
            display: block;
        }
        .dropdown-btn {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            cursor: pointer;
            font-size: 14px;
            color: #495057;
            transition: all 0.3s ease;
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .dropdown-btn:hover {
            border-color: var(--verde-claro);
            background: #e8f5e8;
        }
        .dropdown-btn::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-left: auto;
        }
        .dropdown-content {
            position: absolute;
            background: white;
            min-width: 100%;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border-radius: 8px;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #e9ecef;
            display: none;
            top: 100%;
            left: 0;
        }
        .dropdown-content label {
            display: block;
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 1px solid #f1f3f4;
            font-size: 14px;
            transition: background 0.2s;
        }
        .dropdown-content label:hover {
            background: #f8f9fa;
        }
        .dropdown-content label:last-child {
            border-bottom: none;
        }
        .dropdown-content input[type="checkbox"] {
            margin-right: 8px;
        }
        .dropdown.open .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
    

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Gestor
        </div>
        <nav>
            <a href="dashboard.php" class="menu-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="fazendas.php" class="menu-item"><i class="fa-solid fa-cow"></i> Fazendas</a>
            <a href="cultura.php" class="menu-item active "><i class="fa-solid fa-seedling"></i> Culturas</a>
            <a href="usuarios.php" class="menu-item"><i class="fa-solid fa-users"></i> Usuários</a>
            <a href="sensores.php" class="menu-item"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="alertas.php" class="menu-item "><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
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
                <button id="contraste-btn" aria-label="Alterar contraste"><i class="fa-solid fa-circle-half-stroke"></i></button>
                <div class="avatar">G</div>
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

                <!-- CAMPO FAZENDAS (NOVO) - ANTES DO NOME DA CULTURA -->
                <div class="form-group">
                    <label for="fazendas">
                        <i class="fa-solid fa-cow"></i>
                        Fazendas *
                    </label>
                    <div class="dropdown" id="fazendasDropdown">
                        <div onclick="toggleDropdown('fazendasDropdown')">
                            Selecione opções
                        </div>
                        <div class="dropdown-content" id="dropdownFazendas">
                            <label><input type="checkbox" value="1"> Fazenda São João</label>
                            <label><input type="checkbox" value="2"> Fazenda Santa Cruz</label>
                            <label><input type="checkbox" value="3"> Fazenda Verde Vale</label>
                            <label><input type="checkbox" value="4"> Fazenda Nova Esperança</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nomeCultura">
                        <i class="fa-solid fa-tag"></i>
                        Nome da Cultura *
                    </label>
                    <input type="text" id="nome" name="nomeCultura" required 
                           placeholder="Ex: Milho Safrinha">
                </div>
                
                <div class="form-group">
                    <label for="dataPlantio">
                        <i class="fa-solid fa-calendar-day"></i>
                        Data do Plantio *
                    </label>
                    <input type="date" id="data" name="dataPlantio" required>
                </div>

                <div class="form-group">
                    <label for="cicloProdutivo">
                        <i class="fa-solid fa-clock"></i>
                        Ciclo Produtivo (dias) *
                    </label>
                    <input type="number" id="ciclo" name="cicloProdutivo" 
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
                    <input type="number" id="area" name="areaCultivada" 
                           min="0" step="0.01" required placeholder="25.50">
                </div>

                <div class="form-group">
                    <label for="sensorLuz">
                        <i class="fa-solid fa-lightbulb"></i>
                         Sensor de luz (lux):
                    </label>
                    <input type="text" id="lux" name="sensorLuz" required 
                           placeholder="Ex: 50000 lux">
                </div>
                
                <div class="form-group">
                    <label for="sensorTemp">
                        <i class="fa-solid fa-cloud"></i>
                        Sensor de clima (Temperatura °C):
                    </label>
                    <input type="text" id="temperatura" name="sensorTemp" required
                            placeholder="Ex: 24°C">
                </div>

                <div class="form-group">
                    <label for="sensorUmi">
                        <i class="fa-solid fa-temperature-empty"></i>
                        Sensor de clima (Umidade %):
                    </label>
                    <input type="text" id="umidade_ar" name="sensorUmi" required
                            placeholder="Ex: 65%">
                </div>

                <div class="form-group">
                    <label for="sensorSolo">
                        <i class="fa-solid fa-mound"></i>
                        Sensor de umidade do Solo (%):
                    </label>
                    <input type="text" id="umidade_solo" name="sensorSolo" 
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
                        <button class="btn btn-primary" onclick="editarCultura(<?php echo $cultura['id']; ?>)">
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
        // Função para toggle do dropdown de fazendas
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('open');
        }

        // Fechar dropdown ao clicar fora
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(function(dropdown) {
                if (!dropdown.contains(event.target)) {
                    dropdown.classList.remove('open');
                }
            });
        });

        // Submit do formulário principal
        document.getElementById('formCultura').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Cultura adicionada com sucesso! (Simulação)');
            this.reset();
        });

        function editarCultura(id) {
            alert('Editar cultura ID: ' + id + ' (Implementar modal de edição)');
        }

        function excluirCultura(id) {
            if(confirm('Deseja realmente excluir esta cultura?')) {
                alert('Cultura ID: ' + id + ' excluída com sucesso! (Simulação)');
                location.reload();
            }
        }
    </script>
    <script src="./../script.js"></script>
</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const nome = document.querySelector('#nome');

    if (!nome) return;

    nome.addEventListener('input', function () {
        nome.value = nome.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const data = document.querySelector('#data');
    if (!data) return;

    const hoje = new Date().toISOString().split('T')[0];
    data.setAttribute('max', hoje);
});
document.addEventListener('DOMContentLoaded', function () {
    const ciclo = document.querySelector('#ciclo');

    if (!ciclo) return;

    ciclo.addEventListener('input', function () {
        ciclo.value = ciclo.value.replace(/\D/g, '').slice(0, 3);
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const area = document.querySelector('#area');

    if (!area) return;

    area.addEventListener('input', function () {
        let v = area.value.replace(/\D/g, '');

        // força decimal com ponto
        v = (Number(v) / 100).toFixed(2).replace('.', '.');

        area.value = v;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const lux = document.querySelector('#lux');

    if (!lux) return;

    lux.addEventListener('input', function () {
        lux.value = lux.value.replace(/\D/g, '');
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const temp = document.querySelector('#temperatura');

    if (!temp) return;

    temp.addEventListener('input', function () {
        let v = temp.value.replace(/[^0-9-]/g, '');

        // permite só um "-"
        if ((v.match(/-/g) || []).length > 1) {
            v = v.replace(/-/g, '');
        }

        temp.value = v;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const temp = document.querySelector('#temperatura');

    if (!temp) return;

    temp.addEventListener('input', function () {
        let v = temp.value.replace(/[^0-9-]/g, '');

        // permite só um "-"
        if ((v.match(/-/g) || []).length > 1) {
            v = v.replace(/-/g, '');
        }

        temp.value = v;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const umidade = document.querySelector('#umidade_ar');

    if (!umidade) return;

    umidade.addEventListener('input', function () {
        let v = umidade.value.replace(/\D/g, '');

        if (v > 100) v = 100;

        umidade.value = v;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const solo = document.querySelector('#umidade_solo');

    if (!solo) return;

    solo.addEventListener('input', function () {
        let v = solo.value.replace(/\D/g, '');

        if (v > 100) v = 100;

        solo.value = v;
    });
});
</script>