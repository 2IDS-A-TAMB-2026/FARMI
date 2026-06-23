<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor - Gerenciar Culturas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        
        /* Botão de Contraste */
        #contraste-btn {
    width: 42px;
    height: 42px;
    background: #fff;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: 0.3s;
    outline: none;
    box-shadow: none;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}

#contraste-btn:hover {
    color: #46A302;
    opacity: 1;
}

#contraste-btn:focus,
#contraste-btn:active,
#contraste-btn:focus-visible {
    outline: none !important;
    box-shadow: none !important;
    background: transparent !important;
}

        /* Botões de Acessibilidade (A+, A-, A) com espaçamento adicionado */
        #acessibilidade-fonte button,
        #aumentar-fonte,
#diminuir-fonte,
#resetar-fonte {
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

#aumentar-fonte:hover,
#diminuir-fonte:hover,
#resetar-fonte:hover {
    background-color: #46A302;
    opacity: 1;
}
  body.contraste .btn-logout,
body.alto-contraste .btn-logout {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}
.btn-logout {
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
    margin-right: 15px;
}

.btn-logout:hover {
    background: #46A302;
    color: white;
}
.avatar {
    background: #57c91b;
    color: #000;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
}
body.contraste .btn-logout,
body.alto-contraste .btn-logout {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}

body.contraste .btn-logout i,
body.alto-contraste .btn-logout i {
    color: #fff !important;
}

body.contraste #aumentar-fonte,
body.contraste #diminuir-fonte,
body.contraste #resetar-fonte {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}

body.contraste #contraste-btn {
    color: #fff !important;
}

body.alto-contraste .avatar {
    background: #fff !important;
    color: #000 !important;
    border: 2px solid #fff !important;
}

    </style>
</head>
<body>
    

    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Gestor
        </div>
        <nav>
            <a href="<?= base_url('/dashboard-admin') ?>" class="menu-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="<?= base_url('/fazendas-admin') ?>" class="menu-item"><i class="fa-solid fa-cow"></i> Fazendas</a>
            <a href="<?= base_url('/cultura-admin') ?>" class="menu-item active "><i class="fa-solid fa-seedling"></i> Culturas</a>
            <a href="<?= base_url('/usuarios-admin') ?>" class="menu-item"><i class="fa-solid fa-users"></i> Funcionários</a>
            <a href="<?= base_url('/sensor') ?>"  class="menu-item"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="<?= base_url('/alertas-admin') ?>"  class="menu-item "><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
            <a href="<?= base_url('/configuracoes-admin') ?>" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
            
        </nav>
    </aside>

    <main class="main-content">
        
<header class="header">

    <div>
        <h2>Gerenciar Culturas</h2>
        <p style="color: #666;">Controle total das culturas plantadas</p>
    </div>

    <div style="display:flex; align-items:center; gap:8px;">

    <a href="<?= base_url('/logout') ?>" class="btn-logout">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>

    <button id="contraste-btn" style="margin-right: 5px;" aria-label="Alterar contraste">
        <i class="fa-solid fa-circle-half-stroke"></i>
    </button>

    <button id="aumentar-fonte" aria-label="Aumentar fonte">A+</button>
    <button id="diminuir-fonte" aria-label="Diminuir fonte">A-</button>
    <button id="resetar-fonte" aria-label="Resetar fonte">A</button>

    <div class="avatar">G</div>

</div>

</header>

        <?php
            $total_culturas = count($culturas);
            $area_total = 0;
            $culturas_ativas = 0;

            foreach($culturas as $cultura){
                $area_total += (float)$cultura['AREA_CULTIVADA'];

                if($cultura['STATUS'] == 'Ativa'){
                    $culturas_ativas++;
                }
            }
        ?>

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
                    <h3>Culturas ativas</h3>
                    <p><?php echo $culturas_ativas; ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-leaf"></i></div>
            </div>
        </div>

        <!-- ADICIONAR CULTURA -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fa-solid fa-plus"></i>
                Adicionar Nova Cultura
            </h3>

            <form action="<?= base_url('/cultura/inserir') ?>" method="POST" id="formCultura" class="form-grid">
                <div class="form-group">
                    <label>
                        <i class="fa-solid fa-cow"></i>
                        Fazenda *
                    </label>
                    <select name="FK_ID_FAZENDA" class="form-control" required>
                        <option value="">Selecione uma fazenda</option>

                        <?php foreach($fazendas as $fazenda): ?>
                            <option value="<?= $fazenda['ID_FAZENDA'] ?>">
                                <?= $fazenda['NOME'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nomeCultura">
                        <i class="fa-solid fa-tag"></i>
                        Nome da Cultura *
                    </label>
                    <input type="text" id="nome" name="NOME_CULTURA" required 
                        placeholder="Ex: Milho Safrinha">
                </div>
                
                <div class="form-group">
                    <label for="dataPlantio">
                        <i class="fa-solid fa-calendar-day"></i>
                        Data do Plantio *
                    </label>
                    <input type="date" id="data" name="DATA_PLANTIO" required>
                </div>

                <div class="form-group">
                    <label for="cicloProdutivo">
                        <i class="fa-solid fa-clock"></i>
                        Ciclo Produtivo (dias) *
                    </label>
                    <input type="number" id="ciclo" name="CICLO_PRODUTIVO" 
                           min="30" max="365" required placeholder="120">
                </div>

                <div class="form-group">
                    <label for="tipoCultura">
                        <i class="fa-solid fa-seedling"></i>
                        Tipo da Cultura *
                    </label>
                    <select id="tipoCultura" name="TIPO_CULTURA" required>
                        <option value="">Selecione o tipo</option>
                        <option value="Grãos">Grãos (Milho, Soja, Trigo)</option>
                        <option value="Leguminosas">Leguminosas (Feijão, Ervilha)</option>
                        <option value="Hortaliças">Hortaliças (Tomate, Cenoura)</option>
                        <option value="Tubérculos"> Tubérculos (Batata, Mandioca)</option>
                        <option value="Folhosas">Folhosas (Alface, Repolho)</option>
                        <option value="Frutas">Frutas (Melancia, Melão)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="areaCultivada">
                        <i class="fa-solid fa-ruler-combined"></i>
                        Área Cultivada (ha) *
                    </label>
                    <input type="number"
                    id="area"
                    name="AREA_CULTIVADA"
                     min="0.01"
                    max="1000000"
                    step="0.01"
                     required
                placeholder="25.50">
                </div>

                <div class="form-group">
                    <label for="sensorLuz">
                        <i class="fa-solid fa-lightbulb"></i>
                         Sensor de luz (lux):
                    </label>
                    <input type="text" id="lux" name="SENSOR_LUZ" required 
                           placeholder="Ex: 50000 lux">
                </div>
                
                <div class="form-group">
                    <label for="sensorTemp">
                        <i class="fa-solid fa-cloud"></i>
                        Sensor de clima (Temperatura °C):
                    </label>
                    <input type="text" id="temperatura" name="SENSOR_CLIMA_TEMPO" required
                            placeholder="Ex: 24°C">
                </div>

                <div class="form-group">
                    <label for="sensorUmi">
                        <i class="fa-solid fa-temperature-empty"></i>
                        Sensor de clima (Umidade %):
                    </label>
                    <input type="text" id="umidade_ar" name="SENSOR_CLIMA_UMIDADE" required
                            placeholder="Ex: 65%">
                </div>

                <div class="form-group">
                    <label for="sensorSolo">
                        <i class="fa-solid fa-mound"></i>
                        Sensor de umidade do Solo (%):
                    </label>
                    <input type="text" id="umidade_solo" name="SENSOR_SOLO" 
                           placeholder="Ex: 70%">
                </div>

                <div class="form-group">
                    <label for="STATUS">
                        <i class="fa-solid fa-seedling"></i>
                        Status da Cultura *
                    </label>
                    <select id="STATUS" name="STATUS" required>
                         <option value="">Selecione o status</option>
                        <option value="Ativa">Ativa</option>
                        <option value="Desativa">Desativa</option>
                    </select>
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

    <!-- LISTA CULTURA -->
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
                    <th>Status</th>
                    <th>Sensores</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="culturasTable">
                <?php if(!empty($culturas)): ?> 
                <?php foreach($culturas as $c): ?>
                <tr>

                    <td><?= $c['ID_CULTURA'] ?></td>

                    <td>
                        <i class="fa-solid fa-seedling"
                        style="color: var(--verde-claro); margin-right: 8px;"></i>
                        <?= $c['NOME_CULTURA'] ?>
                    </td>

                    <td><?= date('d/m/Y', strtotime($c['DATA_PLANTIO'])); ?></td>
                    <td><?= $c['CICLO_PRODUTIVO'] ?> dias</td>
                    <td><?= $c['TIPO_CULTURA'] ?></td>
                    <td><?= $c['AREA_CULTIVADA'] ?> ha</td>
                    <td><?= $c['STATUS'] ?></td>

                    <td>
                        <button 
                            class="btn btn-primary"
                            onclick="detalhesSensores(
                                '<?= $c['NOME_FAZENDA'] ?>',
                                '<?= $c['SENSOR_LUZ'] ?>',
                                '<?= $c['SENSOR_CLIMA_TEMPO'] ?>',
                                '<?= $c['SENSOR_CLIMA_UMIDADE'] ?>',
                                '<?= $c['SENSOR_SOLO'] ?>')">
                            <i class="fa-solid fa-microchip"></i>
                            Ver
                        </button>
                    </td>
                    

                    <td>
                        <div class="btn-group">
                            <a href="<?= base_url('/cultura/editar_culturas/'.$c['ID_CULTURA']) ?>" class="btn btn-primary">
                                <i class="fa-solid fa-edit"></i> </a>
                            <a href="javascript:void(0)"
                                class="btn btn-danger"
                                onclick="excluirCultura(<?= $c['ID_CULTURA'] ?>)">
                                    <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>
    </div>

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

    <script>
    // =========================
    // DROPDOWN
    // =========================
    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle('open');
    }

    // Fecha dropdown clicando fora
    document.addEventListener('click', function(event) {

        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(function(dropdown) {

            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove('open');
            }

        });

    });

    // =========================
    // CADASTRAR CULTURA
    // =========================
    /*
    document.getElementById('formCultura').addEventListener('submit', function(e) {

        Swal.fire({
            title: 'Cadastro realizado!',
            text: 'A cultura foi cadastrada com sucesso.',
            icon: 'success',
            confirmButtonColor: '#2e7d32',
            confirmButtonText: 'OK'
        });

        this.reset();

    });
    */
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('formCultura');

        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Confirmar cadastro?',
                text: 'Deseja realmente cadastrar esta cultura?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sim, cadastrar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#2e7d32',
                cancelButtonColor: '#d33'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit(); // envia corretamente
                }

            });
        });

    });

    // =========================
    // EDITAR CULTURA
    // =========================
    function editarCultura(id) {

        Swal.fire({
            title: 'Editar Cultura',
            text: 'Editar cultura ID: ' + id,
            icon: 'info',
            confirmButtonColor: '#1976d2',
            confirmButtonText: 'OK'
        });

    }

    // =========================
    // EXCLUIR CULTURA
    // =========================
    function excluirCultura(id) {
        Swal.fire({
            title: 'Tem certeza?',
            text: 'Essa cultura será excluída!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Excluído!',
                    text: 'Cultura removida com sucesso.',
                    icon: 'success',
                    confirmButtonColor: '#2e7d32'
                }).then(() => {

                    window.location.href = '<?= base_url('/cultura/excluir') ?>/' + id;

                });

            }

        });

    }
</script>
    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>
</body>
</html>
<script>

/* =========================
   NOME CULTURA
========================= */
document.addEventListener('DOMContentLoaded', function () {
    const nome = document.querySelector('#nome');

    if (!nome) return;

    nome.addEventListener('input', function () {

        nome.value = nome.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');

    });

});

/* =========================
   DATA DO PLANTIO
========================= */
document.addEventListener('DOMContentLoaded', function () {
    const data = document.querySelector('#data');

    if (!data) return;

    const hoje = new Date().toISOString().split('T')[0];

    data.setAttribute('max', hoje);
});

/* =========================
   CICLO PRODUTIVO
========================= */
document.addEventListener('DOMContentLoaded', function () {
    const ciclo = document.querySelector('#ciclo');

    if (!ciclo) return;

    ciclo.addEventListener('input', function () {

        let v = ciclo.value.replace(/\D/g, '');

        if (v > 365) {
            v = 365;
        }

        if (v < 30 && v !== '') {
            ciclo.setCustomValidity('O ciclo deve ser no mínimo 30 dias.');
        } else {
            ciclo.setCustomValidity('');
        }

        ciclo.value = v;
    });

});

/* =========================
   ÁREA CULTIVADA
   MÁXIMO: 1.000.000
========================= */
document.addEventListener('DOMContentLoaded', function () {
    const area = document.querySelector('#area');

    if (!area) return;

    area.addEventListener('input', function () {

        let v = area.value.replace(/[^0-9.]/g, '');
        const partes = v.split('.');

        if (partes.length > 2) {
            v = partes[0] + '.' + partes[1];
        }

        if (parseFloat(v) > 1000000) {
            v = '1000000';
        }

        area.value = v;
    });

});

/* =========================
   SENSOR DE LUZ
   MÁXIMO: 100.000
========================= */
document.addEventListener('DOMContentLoaded', function () {
    const lux = document.querySelector('#lux');

    if (!lux) return;

    lux.addEventListener('input', function () {

        let v = lux.value.replace(/\D/g, '');

        if (parseInt(v) > 100000) {
            v = '100000';
        }

        lux.value = v;
    });

});

/* =========================
   SENSOR TEMPERATURA
   MÁXIMO: 50°C
========================= */
document.addEventListener('DOMContentLoaded', function () {
    const temp = document.querySelector('#temperatura');

    if (!temp) return;

    temp.addEventListener('input', function () {

        let v = temp.value.replace(/\D/g, '');

        if (parseInt(v) > 50) {
            v = '50';
        }

        temp.value = v;
    });

});

/* =========================
   UMIDADE DO AR
   MÁXIMO: 100%
========================= */
document.addEventListener('DOMContentLoaded', function () {
    const umidade = document.querySelector('#umidade_ar');

    if (!umidade) return;

    umidade.addEventListener('input', function () {
        let v = umidade.value.replace(/\D/g, '');

        if (parseInt(v) > 100) {
            v = '100';
        }

        umidade.value = v;
    });

});

/* =========================
   UMIDADE DO SOLO
   MÁXIMO: 100%
========================= */
document.addEventListener('DOMContentLoaded', function () {
    const solo = document.querySelector('#umidade_solo');

    if (!solo) return;

    solo.addEventListener('input', function () {
        let v = solo.value.replace(/\D/g, '');

        if (parseInt(v) > 100) {
            v = '100';
        }

        solo.value = v;
    });

});

/* =========================
   FORMULÁRIO
========================= */
/*
document.getElementById('formCultura').addEventListener('submit', function (e) {
    const area = parseFloat(document.getElementById('area').value) || 0;
    const lux = parseInt(document.getElementById('lux').value) || 0;
    const temp = parseInt(document.getElementById('temperatura').value) || 0;

    if (area > 1000000) {

        e.preventDefault();

        Swal.fire({
            icon: 'error',
            title: 'Área inválida',
            text: 'A área cultivada não pode ultrapassar 1.000.000 ha.'
        });

        return;
    }

    if (lux > 100000) {

        e.preventDefault();

        Swal.fire({
            icon: 'error',
            title: 'Sensor de luz inválido',
            text: 'O sensor de luz não pode ultrapassar 100.000 lux.'
        });

        return;
    }

    if (temp > 50) {

        e.preventDefault();

        Swal.fire({
            icon: 'error',
            title: 'Temperatura inválida',
            text: 'A temperatura não pode ultrapassar 50°C.'
        });

        return;
    }

    Swal.fire({
        title: 'Cadastro realizado!',
        text: 'A cultura foi cadastrada com sucesso.',
        icon: 'success',
        confirmButtonColor: '#2e7d32',
        confirmButtonText: 'OK'
    });

});
*/

</script>

<script>
function detalhesSensores(fazenda, luz, temperatura, umidade, solo)
{
    let html = `
        <div style="display:flex; flex-direction:column; gap:12px; margin-top:15px;">

            <div style="
                background:#e8f5e9;
                padding:12px;
                border-radius:10px;
                text-align:left;
                margin-bottom:12px;
            ">
                <i class="fa-solid fa-tractor" style="color:#2e7d32;"></i>
                <strong> Fazenda:</strong> ${fazenda}
            </div>

            <div style="
                background:#f5f5f5;
                padding:12px;
                border-radius:10px;
                text-align:left;
            ">
                <i class="fa-solid fa-lightbulb" style="color:#fbc02d;"></i>
                <strong> Sensor de Luz:</strong>
                ${luz} lux
            </div>

            <div style="
                background:#f5f5f5;
                padding:12px;
                border-radius:10px;
                text-align:left;
            ">
                <i class="fa-solid fa-temperature-half" style="color:#ef5350;"></i>
                <strong> Sensor de Temperatura:</strong>
                ${temperatura}°C
            </div>

            <div style="
                background:#f5f5f5;
                padding:12px;
                border-radius:10px;
                text-align:left;
            ">
                <i class="fa-solid fa-cloud-rain" style="color:#42a5f5;"></i>
                <strong> Sensor de Umidade:</strong>
                ${umidade}%
            </div>

            <div style="
                background:#f5f5f5;
                padding:12px;
                border-radius:10px;
                text-align:left;
            ">
                <i class="fa-solid fa-seedling" style="color:#66bb6a;"></i>
                <strong> Sensor do Solo:</strong>
                ${solo}%
            </div>

        </div>
    `;

    Swal.fire({
        title: 'Sensores da Cultura',
        icon: 'info',
        html: html,
        confirmButtonText: 'Fechar',
        confirmButtonColor: '#4CAF50',
        width: '600px'
    });
}
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