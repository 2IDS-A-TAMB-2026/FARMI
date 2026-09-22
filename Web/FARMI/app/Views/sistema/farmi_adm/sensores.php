<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestor - Gerenciar Sensores</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style.css') ?>">
    <!-- RESPONSIVO -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_responsivo.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ==========================================================
   BOTÕES DE FONTE (PADRONIZADO COM O DASHBOARD)
   ========================================================== */
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

/* ==========================================================
   BOTÃO DE CONTRASTE (PADRONIZADO COM O DASHBOARD)
   ========================================================== */
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

/* ==========================================================
   BOTÃO LOGOUT (PADRONIZADO COM O DASHBOARD)
   ========================================================== */
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

/* AVATAR CIRCULAR */
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

/* AUTO CONTRASTE */
body.contraste .btn-logout {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}

body.contraste .btn-logout i {
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

body.contraste .avatar {
    background: #fff !important;
    color: #000 !important;
}


/* RESPONSIVEL */
@media (max-width: 768px) {

    .table-container {
        overflow-x: auto;
        width: 100%;
    }

    .table-container table {
        min-width: 900px;
    }

}

@media (max-width: 768px) {

    #formSensor {
        grid-template-columns: 1fr !important;
    }

    #formSensor > div:last-child {
        grid-column: auto !important;

        display: flex !important;

        flex-direction: column;

        width: 100%;

        gap: 10px !important;
    }

    #formSensor > div:last-child button {
        width: 100%;
    }

}

/* =========================
   PAGINAÇÃO SENSORES
   ========================= */

.paginacao-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    margin-top: 15px;
    flex-wrap: wrap;
}

.pagina-info {
    font-size: 16px;
    font-weight: 600;
    color: #000;
}

.botao-paginacao {
    width: 42px;
    height: 42px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    background: #57c91b;
    color: white;
    font-weight: bold;
    transition: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.botao-paginacao:hover {
    transform: scale(1.05);
}

.botao-paginacao:disabled {
    display: none;
}

/* AUTO CONTRASTE */

body.contraste .pagina-info {
    color: #fff !important;
}

body.contraste .botao-paginacao {
    background: #000 !important;
    color: #fff !important;
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

            <a href="<?= base_url('/sensor') ?>" class="menu-item active">
                <i class="fa-solid fa-satellite-dish"></i>
                Sensores
            </a>

            <a href="<?= base_url('/alertas-admin') ?>" class="menu-item">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Alertas
            </a>

            <a href="<?= base_url('/configuracoes-admin') ?>" class="menu-item">
                <i class="fa-solid fa-gear"></i>
                Configurações
            </a>

        </nav>

    </aside>

    <main class="main-content">

        <!-- Menu sanduíche -->
        <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <header class="header">

            <div>
                <h2>Gerenciar Sensores</h2>
                <p style="color: #666;">Painel de Gestão</p>
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
            $sensor = $sensor ?? [];
            $total_sensores = count($sensor);
            $sensores_ativos = count(array_filter($sensor, function($s){
                return $s['STATUS'] == 'Ativo';
            }));
        ?>

        <div class="stats-grid">

            <div class="card">
                <div class="card-info">
                    <h3>Total de Sensores</h3>
                    <p><?= $total_sensores; ?></p>
                </div>

                <div class="card-icon">
                    <i class="fa-solid fa-satellite-dish"></i>
                </div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Sensores Ativos</h3>
                    <p><?= $sensores_ativos; ?></p>
                </div>

                <div class="card-icon">
                    <i class="fa-solid fa-wifi"></i>
                </div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Tipos Configurados</h3>
                    <p>4</p>
                </div>

                <div class="card-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
            </div>

        </div>

        <!-- ADICIONAR SENSOR -->
        <div class="form-section">

            <h3 class="section-title">
                <i class="fa-solid fa-plus"></i>
                Adicionar Novo Sensor
            </h3>

            <form action="<?= base_url('/sensor/inserir') ?>"

                method="post"
                id="formSensor"
                class="form-grid">

                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="nome">
                        <i class="fa-solid fa-microchip"></i>
                        Nome do Sensor *
                    </label>
                    <input type="text"
                        id="nome"
                        name="NOME_SENSOR"
                        placeholder="Sensor de Clima"
                        required>
                </div>

                <div class="form-group">
                    <label for="tipo">
                        <i class="fa-solid fa-tags"></i>
                        Tipo de Sensor *
                    </label>
                    <select id="tipo" name="TIPO_SENSOR" required>
                        <option value="">Selecione o tipo</option>
                        <option value="Temperatura">Temperatura</option>
                        <option value="Umidade">Umidade</option>
                        <option value="Luz">Luz</option>
                        <option value="Solo">Solo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="unidade">
                        <i class="fa-solid fa-ruler"></i>
                        Unidade de medida *
                    </label>
                    <input type="text" id="unidade" name="UNIDADE_MEDIDA" placeholder="Definida pelo tipo de sensor" readonly required>
                </div>

                <div class="form-group">
                    <label for="status">
                        <i class="fa-solid fa-toggle-on"></i>
                        Status Inicial
                    </label>
                    <select id="status" name="STATUS">
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="data">
                        <i class="fa-solid fa-calendar-day"></i>
                        Data da Instalação *
                    </label>
                    <input type="date"
                        id="data"
                        name="DATA_INSTALACAO"
                        required>
                </div>

                <div class="form-group">
                    <label for="cultura">
                        <i class="fa-solid fa-seedling"></i>
                        Culturas *
                    </label>
                    <select name="FK_ID_CULTURA"
                        id="cultura"
                        required>
                        <option value="">Selecione uma cultura</option>
                        <?php foreach($culturas as $c): ?>
                            <option value="<?= $c['ID_CULTURA']; ?>">
                                ID <?= $c['ID_CULTURA']; ?> - <?= $c['NOME_CULTURA']; ?>
                            </option>
                        <?php endforeach; ?>
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

        <h3 class="section-title">
            <i class="fa-solid fa-list"></i>
            Lista de Sensores (<?= $total_sensores; ?>)
        </h3>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Unidade</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>ID Cultura</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="sensoresTable">
                    <?php foreach($sensor as $s): ?>
                    <tr class="sensor-item">
                        <td><?= $s['ID_SENSOR']; ?></td>
                        <td>
                            <i class="fa-solid fa-satellite-dish" style="color: var(--verde-claro); margin-right: 8px;"></i>
                             <?= $s['NOME_SENSOR']; ?>
                        </td>
                        <td><?= $s['TIPO_SENSOR']; ?></td>
                        <td><?= $s['UNIDADE_MEDIDA']; ?></td>
                        <td>
                            <span class="status-badge status-<?= strtolower($s['STATUS']); ?>">
                                <?= $s['STATUS']; ?>
                            </span>
                        </td>
                        <td>
                            <?= date('d/m/Y', strtotime($s['DATA_INSTALACAO'])); ?>
                        </td>
                        <td><?= $s['FK_ID_CULTURA']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('/sensor/editar/'.$s['ID_SENSOR']) ?>" class="btn btn-primary">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <a href="<?= base_url('/sensor/excluir/'.$s['ID_SENSOR']) ?>" class="btn btn-danger btn-excluir">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- PAGINAÇÃO -->
        <div class="paginacao-container">

            <button
                id="paginaAnterior"
                class="botao-paginacao"
                type="button">

                <i class="fa-solid fa-chevron-left"></i>

            </button>

            <div id="paginaInfo" class="pagina-info">
                Página 1 de 1
            </div>

            <button
                id="proximaPagina"
                class="botao-paginacao"
                type="button">

                <i class="fa-solid fa-chevron-right"></i>

            </button>

        </div>
    </main>

    <!-- VLibras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <script>
    document.getElementById('tipo').addEventListener('change', function() {
        const unidade = document.getElementById('unidade');

        const unidades = {
            'Temperatura': '°C',
            'Umidade': '%',
            'Luz': 'lux',
            'Solo': '%'
        };

        unidade.value = unidades[this.value] || '';
    });
    </script>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // DATA MÁXIMA = HOJE
            const data = document.querySelector('#data');
            if (data) {
                const hoje = new Date().toISOString().split('T')[0];
                data.setAttribute('max', hoje);
            }

            // SWEET ALERT ADICIONAR SENSOR
            const formSensor = document.getElementById('formSensor');
            if(formSensor){
                formSensor.addEventListener('submit', function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: 'Adicionar sensor?',
                        text: 'Deseja realmente cadastrar este sensor?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#2e7d32',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sim, adicionar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if(result.isConfirmed){
                            Swal.fire({
                                title: 'Sensor adicionado!',
                                text: 'O sensor foi cadastrado com sucesso.',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                formSensor.submit();
                            });
                        }
                    });
                });
            }

            // SWEET ALERT EXCLUIR
            const botoesExcluir = document.querySelectorAll('.btn-excluir');
            botoesExcluir.forEach(botao => {
                botao.addEventListener('click', function (e) {
                    e.preventDefault();
                    const linkExcluir = this.href;
                    Swal.fire({
                        title: 'Tem certeza?',
                        text: 'Você não poderá reverter isso!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sim, excluir!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Excluído!',
                                text: 'O sensor foi excluído com sucesso.',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = linkExcluir;
                            });
                        }
                    });
                });
            });
        });
    </script>

    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>
    
    <script>
    /* =========================
       ACESSIBILIDADE - TAMANHO DA FONTE
    ========================= */
    document.addEventListener('DOMContentLoaded', () => {
        const btnContraste = document.getElementById('contraste-btn');

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

        let tamanhoFonte = parseInt(localStorage.getItem('fonteSite')) || 16;
        document.documentElement.style.fontSize = tamanhoFonte + 'px';

        document.getElementById('aumentar-fonte').addEventListener('click', () => {
            if (tamanhoFonte < 24) {
                tamanhoFonte += 2;
                document.documentElement.style.fontSize = tamanhoFonte + 'px';
                localStorage.setItem('fonteSite', tamanhoFonte);
            }
        });

        document.getElementById('diminuir-fonte').addEventListener('click', () => {
            if (tamanhoFonte > 12) {
                tamanhoFonte -= 2;
                document.documentElement.style.fontSize = tamanhoFonte + 'px';
                localStorage.setItem('fonteSite', tamanhoFonte);
            }
        });

        document.getElementById('resetar-fonte').addEventListener('click', () => {
            tamanhoFonte = 16;
            document.documentElement.style.fontSize = tamanhoFonte + 'px';
            localStorage.setItem('fonteSite', tamanhoFonte);
        });
    });
    </script>

    <script>
    // =========================
    // MENU SANDUÍCHE
    // =========================
    document.addEventListener('DOMContentLoaded', function () {

        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');

        // Cria o fundo escuro
        const overlay = document.createElement('div');
        overlay.classList.add('menu-overlay');

        document.body.appendChild(overlay);


        // Abrir e fechar menu
        menuToggle.addEventListener('click', function () {

            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');

            const aberto = sidebar.classList.contains('active');

            // Troca o ícone
            if (aberto) {
                menuToggle.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                menuToggle.setAttribute('aria-label', 'Fechar menu');
            } else {
                menuToggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
                menuToggle.setAttribute('aria-label', 'Abrir menu');
            }

        });


        // Fecha ao clicar no fundo escuro
        overlay.addEventListener('click', function () {

            sidebar.classList.remove('active');
            overlay.classList.remove('active');

            menuToggle.innerHTML =
                '<i class="fa-solid fa-bars"></i>';

            menuToggle.setAttribute(
                'aria-label',
                'Abrir menu'
            );

        });


        // Fecha o menu ao clicar em um item
        const menuItems =
            document.querySelectorAll('.sidebar .menu-item');

        menuItems.forEach(function (item) {

            item.addEventListener('click', function () {

                if (window.innerWidth <= 768) {

                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');

                    menuToggle.innerHTML =
                        '<i class="fa-solid fa-bars"></i>';

                    menuToggle.setAttribute(
                        'aria-label',
                        'Abrir menu'
                    );

                }

            });

        });

    });
    </script>

    <script>
    // =========================
    // PAGINAÇÃO SENSORES
    // =========================

    const sensores = document.querySelectorAll(".sensor-item");

    const paginaAnterior = document.getElementById("paginaAnterior");
    const proximaPagina = document.getElementById("proximaPagina");
    const paginaInfo = document.getElementById("paginaInfo");

    const SENSORES_POR_PAGINA = 5;

    let paginaAtual = 1;


    function atualizarSensores() {

        const totalSensores = sensores.length;

        const totalPaginas = Math.ceil(
            totalSensores / SENSORES_POR_PAGINA
        );


        // Garante que a página atual seja válida
        if (totalPaginas === 0) {

            paginaAtual = 1;

        } else if (paginaAtual > totalPaginas) {

            paginaAtual = totalPaginas;

        }


        // Atualiza o número da página
        if (totalPaginas > 0) {

            paginaInfo.textContent =
                `Página ${paginaAtual} de ${totalPaginas}`;

        } else {

            paginaInfo.textContent =
                "Nenhuma página";

        }


        // Esconde todos os sensores
        sensores.forEach(function(sensor) {

            sensor.style.display = "none";

        });


        // Calcula o início e o fim da página
        const inicio =
            (paginaAtual - 1) * SENSORES_POR_PAGINA;

        const fim =
            inicio + SENSORES_POR_PAGINA;


        // Mostra somente os sensores da página atual
        Array.from(sensores)
            .slice(inicio, fim)
            .forEach(function(sensor) {

                sensor.style.display = "table-row";

            });


        // =========================
        // BOTÃO ANTERIOR
        // =========================

        if (paginaAtual <= 1) {

            paginaAnterior.style.display = "none";

        } else {

            paginaAnterior.style.display = "flex";

        }


        // =========================
        // BOTÃO PRÓXIMO
        // =========================

        if (
            paginaAtual >= totalPaginas ||
            totalPaginas === 0
        ) {

            proximaPagina.style.display = "none";

        } else {

            proximaPagina.style.display = "flex";

        }

    }


    // =========================
    // BOTÃO ANTERIOR
    // =========================

    paginaAnterior.addEventListener("click", function() {

        if (paginaAtual > 1) {

            paginaAtual--;

            atualizarSensores();

        }

    });


    // =========================
    // BOTÃO PRÓXIMO
    // =========================

    proximaPagina.addEventListener("click", function() {

        const totalSensores = sensores.length;

        const totalPaginas = Math.ceil(
            totalSensores / SENSORES_POR_PAGINA
        );


        if (paginaAtual < totalPaginas) {

            paginaAtual++;

            atualizarSensores();

        }

    });


    // Inicia a paginação
    atualizarSensores();

</script>
</body>

</html>