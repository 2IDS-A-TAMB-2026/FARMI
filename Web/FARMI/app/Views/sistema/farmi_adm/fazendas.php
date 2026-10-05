<!DOCTYPE html>
<html lang="pt-br">
<style>
/* ==========================================================
   BOTÕES DE FONTE
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
   BOTÃO DE CONTRASTE
   ========================================================== */

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

#contraste-btn i {
    color: #000;
    font-size: 22px;
    transition: color 0.3s ease;
}

#contraste-btn:hover i {
    color: #46A302;
}

#contraste-btn:focus,
#contraste-btn:active,
#contraste-btn:focus-visible {
    outline: none !important;
    box-shadow: none !important;
}


/* ==========================================================
   BOTÃO LOGOUT E AVATAR
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

.user-avatar,
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

.user-avatar:hover,
.avatar:hover {
    background-color: #46A302;
}


/* ==========================================================
   ALTO CONTRASTE
   Ativado pela classe .alto-contraste no body
   ========================================================== */

body.alto-contraste {
    background: #000 !important;
    color: #fff !important;
}


/* ==========================================================
   TEXTOS E ÍCONES
   ========================================================== */

body.alto-contraste,
body.alto-contraste p,
body.alto-contraste h1,
body.alto-contraste h2,
body.alto-contraste h3,
body.alto-contraste h4,
body.alto-contraste h5,
body.alto-contraste h6,
body.alto-contraste span,
body.alto-contraste label,
body.alto-contraste a {
    color: #fff !important;
}

body.alto-contraste i,
body.alto-contraste .sidebar i,
body.alto-contraste .card i,
body.alto-contraste .fazenda-card i,
body.alto-contraste button i,
body.alto-contraste a i {
    color: #fff !important;
}


/* ==========================================================
   SIDEBAR / HEADER / CONTEÚDO
   ========================================================== */

body.alto-contraste .sidebar,
body.alto-contraste .header,
body.alto-contraste .main-content {
    background: #000 !important;
    color: #fff !important;
    border-color: #fff !important;
}


/* ==========================================================
   MENU LATERAL
   ========================================================== */

body.alto-contraste .menu-item {
    color: #fff !important;
}

body.alto-contraste .menu-item.active,
body.alto-contraste .menu-item:hover {
    background: #fff !important;
    color: #000 !important;
}

body.alto-contraste .menu-item.active i,
body.alto-contraste .menu-item:hover i {
    color: #000 !important;
}


/* ==========================================================
   BOTÕES DO SISTEMA
   ========================================================== */

body.alto-contraste .btn,
body.alto-contraste .btn-primary,
body.alto-contraste .btn-secondary,
body.alto-contraste .btn-danger,
body.alto-contraste .btn-logout,
body.alto-contraste #aumentar-fonte,
body.alto-contraste #diminuir-fonte,
body.alto-contraste #resetar-fonte,
body.alto-contraste #logout {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}


/* Ícones dos botões */
body.alto-contraste .btn i,
body.alto-contraste .btn-primary i,
body.alto-contraste .btn-secondary i,
body.alto-contraste .btn-danger i,
body.alto-contraste .btn-logout i {
    color: #fff !important;
}


/* ==========================================================
   BOTÃO DE CONTRASTE NO ALTO CONTRASTE
   ========================================================== */

body.alto-contraste #contraste-btn {
    background: #000 !important;
}

body.alto-contraste #contraste-btn i {
    color: #fff !important;
}

body.alto-contraste #contraste-btn:hover i {
    color: #fff !important;
}


/* ==========================================================
   CARDS
   ========================================================== */

body.alto-contraste .card,
body.alto-contraste .fazenda-card {
    background: #000 !important;
    color: #fff !important;
    border-color: #fff !important;
}


/* ==========================================================
   CONTEÚDO DOS CARDS
   ========================================================== */

body.alto-contraste .card h3,
body.alto-contraste .card p,
body.alto-contraste .fazenda-card h3,
body.alto-contraste .fazenda-card p,
body.alto-contraste .fazenda-card span,
body.alto-contraste .info-label,
body.alto-contraste .info-value,
body.alto-contraste .fazenda-status {
    color: #fff !important;
}


/* ==========================================================
   INPUTS / SELECTS / TEXTAREA
   ========================================================== */

body.alto-contraste input,
body.alto-contraste select,
body.alto-contraste textarea {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}

body.alto-contraste input::placeholder,
body.alto-contraste textarea::placeholder {
    color: #bbb !important;
}


/* ==========================================================
   BOTÃO DE PESQUISA
   ========================================================== */

body.alto-contraste .search-bar button,
body.alto-contraste .search-bar .btn {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}

body.alto-contraste .search-bar button i,
body.alto-contraste .search-bar .btn i {
    color: #fff !important;
}


/* ==========================================================
   CARD "ADICIONAR NOVA FAZENDA"
   ========================================================== */

body.alto-contraste .add-fazenda {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}

body.alto-contraste .add-fazenda i {
    color: #fff !important;
}

body.alto-contraste .add-fazenda h3,
body.alto-contraste .add-fazenda p {
    color: #fff !important;
}


/* ==========================================================
   STATUS DA FAZENDA
   ========================================================== */

body.alto-contraste .status-dot {
    border: 2px solid #fff !important;
}

body.alto-contraste .status-online {
    background: #fff !important;
}

body.alto-contraste .fazenda-status span {
    color: #fff !important;
}


/* ==========================================================
   AVATAR
   ========================================================== */

body.alto-contraste .avatar,
body.alto-contraste .user-avatar {
    background: #fff !important;
    color: #000 !important;
    border: 2px solid #fff !important;
}

body.alto-contraste .avatar:hover,
body.alto-contraste .user-avatar:hover {
    background: #fff !important;
    color: #000 !important;
}


/* ==========================================================
   MENU SANDUÍCHE
   ========================================================== */

body.alto-contraste .menu-toggle {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}

body.alto-contraste .menu-toggle i {
    color: #fff !important;
}


/* ==========================================================
   OVERLAY DO MENU
   ========================================================== */

body.alto-contraste .menu-overlay {
    background: rgba(0, 0, 0, 0.85) !important;
}
</style>
<head>
    <!--Ícone do site-->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazendas - FARMI Gestor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- RESPONSIVO -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_responsivo.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_alertas.css') ?>">
    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Gestor
        </div>
        <nav>
            <a href="<?= base_url('/dashboard-admin') ?>"       class="menu-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="<?= base_url('/fazendas-admin') ?>"        class="menu-item active"><i class="fa-solid fa-cow"></i> Fazendas</a>
            <a href="<?= base_url('/cultura-admin') ?>"         class="menu-item "><i class="fa-solid fa-seedling"></i> Culturas</a>
            <a href="<?= base_url('/usuarios-admin') ?>"        class="menu-item"><i class="fa-solid fa-users"></i> Funcionários</a>
            <a href="<?= base_url('/sensor') ?>"        class="menu-item"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="<?= base_url('/alertas-admin') ?>"         class="menu-item "><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
            <a href="<?= base_url('/configuracoes-admin') ?>"   class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
            
        </nav>
    </aside>

    <!-- Conteúdo Principal -->
    <main class="main-content">

        <!-- Menu sanduíche -->
        <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu">
            <i class="fa-solid fa-bars"></i>
        </button>

    <header class="header">

    <div>
        <h2>Controle de Fazendas</h2>
        <p style="color: #666;">Gerencie todas as fazendas do sistema</p>
    </div>
    
    <div class="header-actions">

        <!-- BOTÃO LOGIN -->
        <a href="<?= base_url('/logout') ?>" class="btn-logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>
        <!-- CONTRASTE -->
        <button id="contraste-btn" aria-label="Alterar contraste">
            <i class="fa-solid fa-circle-half-stroke"></i>
        </button>
        <!-- ACESSIBILIDADE DE FONTE -->
        <button id="aumentar-fonte" aria-label="Aumentar fonte">A+</button>
        <button id="diminuir-fonte" aria-label="Diminuir fonte">A-</button>
        <button id="resetar-fonte" aria-label="Resetar fonte">A</button>

        <div class="avatar">G</div>

    </div>

</header>

    <!-- Barra de pesquisa -->
    <form action="<?= base_url('/fazendas-admin') ?>" method="GET" class="search-bar">

    <input
        type="text"
        name="pesquisar"
        id="pesquisar"
        class="search-input"
        placeholder="Pesquisar fazendas..."
    >

    <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-magnifying-glass"></i>
        Pesquisar
    </button>

</form>

        <!-- Stats Cards -->
        <?php
            $fazenda = $fazenda ?? [];

            $total_fazendas = count($fazenda);
            $total_hectares = array_sum(array_column($fazenda, 'AREA_TOTAL'));
        ?>

        <div class="stats-grid">
            <div class="card">
                <div>
                    <h3>Fazendas Totais</h3>
                    <p><?= $total_fazendas; ?></p>
                </div>
                <i class="fa-solid fa-cow" style="color: var(--verde-claro)"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Ativas</h3>
                    <p><?= $total_fazendas; ?></p>
                </div>
                <i class="fa-solid fa-leaf" style="color: var(--verde-claro)"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Sensores</h3>
                    <p>10</p>
                </div>
                <i class="fa-solid fa-satellite-dish" style="color: var(--verde-claro)"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Hectares</h3>
                    <p><?= number_format($total_hectares, 0, ',', '.'); ?> ha</p>
                </div>
                <i class="fa-solid fa-ruler-combined" style="color: var(--verde-claro)"></i>
            </div>
        </div>

        <!-- Grid de Fazendas -->
        <div class="fazendas-grid">
            <!-- Card Adicionar Fazenda -->
            <a href="<?= base_url('/adicionar-fazenda') ?>" class="fazenda-card add-fazenda">
                <i class="fa-solid fa-plus"></i>
                <h3 style="color: var(--verde); margin-bottom: 10px;">Adicionar Nova Fazenda</h3>
                <p style="color: #666; font-size: 0.9rem;">Clique para cadastrar</p>
            </a>

            <!-- FAZENDAS -->
            <?php foreach($fazenda as $f): ?>
                <div class="fazenda-card">
                    <div class="fazenda-header">

                        <div>
                            <h3><?= $f['NOME']; ?></h3>
                            <p style="opacity: 0.9; font-size: 0.9rem;">
                                <?= number_format($f['AREA_TOTAL'], 0, ',', '.'); ?> ha
                            </p>
                        </div>

                        <div class="fazenda-status">
                            <div class="status-dot status-online"></div>
                            <span>Online</span>
                        </div>
                    </div>

                    <div class="fazenda-body">
                        <div class="fazenda-info">

                            <div class="info-item">
                                <span class="info-label">Latitude</span>
                                <span class="info-value"><?= $f['LATITUDE']; ?></span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Longitude</span>
                                <span class="info-value"><?= $f['LONGITUDE']; ?></span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Logradouro</span>
                                <span class="info-value"><?= $f['LOGRADOURO']; ?></span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Número</span>
                                <span class="info-value"><?= $f['NUMERO']; ?></span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">CEP</span>
                                <span class="info-value"><?= $f['CEP']; ?></span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Área total</span>

                                <span class="info-value">
                                    <?= number_format($f['AREA_TOTAL'], 0, ',', '.'); ?> ha
                                </span>
                            </div>

                        </div>

                        <div class="fazenda-actions">

                            <button 
                            class="btn btn-primary"
                            onclick="excluirFazenda('<?= base_url('/fazenda/excluir/'.$f['ID_FAZENDA']) ?>')">

                            <i class="fa-solid fa-trash"></i>
                                Excluir
                            </button>

                            <a href="<?= base_url('/fazenda/editar/'.$f['ID_FAZENDA']) ?>"
                            class="btn btn-secondary">
                                <i class="fa-solid fa-pen"></i>
                                Editar

                            </a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if(session()->getFlashdata('erro')): ?>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Fazenda não encontrada',
            text: '<?= session()->getFlashdata('erro') ?>',
            confirmButtonColor: '#4bc714'
        });
        </script>
    <?php endif; ?>

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

</body>
</html>
<script>
    // =========================
    // PESQUISA
    // =========================
    const pesquisar = document.getElementById('pesquisar');

    if (pesquisar) {

        pesquisar.addEventListener('keyup', (e) => {

            let value = e.target.value;

            // Remove caracteres inválidos
            value = value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');

            // Remove espaços duplos
            value = value.replace(/\s+/g, ' ');

            e.target.value = value;

        });

    }

    // =========================
    // EXCLUIR FAZENDA
    // =========================
    function excluirFazenda(url) {

        Swal.fire({
            title: 'Tem certeza?',
            text: 'Essa fazenda será excluída!',
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
                    text: 'A fazenda foi removida com sucesso.',
                    icon: 'success',
                    confirmButtonColor: '#2e7d32'
                }).then(() => {

                    window.location.href = url;

                });

            }

        });

    }
    // =========================
// ACESSIBILIDADE DE FONTE
// =========================

let tamanhoFonte = 100;

const aumentarFonte = document.getElementById('aumentar-fonte');
const diminuirFonte = document.getElementById('diminuir-fonte');
const resetarFonte = document.getElementById('resetar-fonte');

function aplicarFonte() {
    document.body.style.fontSize = tamanhoFonte + '%';
    localStorage.setItem('tamanhoFonte', tamanhoFonte);
}

// Recupera tamanho salvo
const fonteSalva = localStorage.getItem('tamanhoFonte');

if (fonteSalva) {
    tamanhoFonte = parseInt(fonteSalva);
    aplicarFonte();
}

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
</script>
<script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>