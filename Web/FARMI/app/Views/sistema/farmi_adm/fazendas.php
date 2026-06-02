<!DOCTYPE html>
<html lang="pt-br">
    <style>
        #aumentar-fonte,
#diminuir-fonte,
#resetar-fonte {
     background: #57c91b;
        border: none;
        border-radius: 8px;
        width: 42px;
        height: 42px;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
        color: #fff;
        margin-right: 8px; 
}

#aumentar-fonte:hover,
#diminuir-fonte:hover,
#resetar-fonte:hover {
    opacity: 0.85;
}

.btn-logout{
    background: #57c91b;
    color: #fff;
    text-decoration: none;

    width: 120px;
    height: 42px;

    border-radius: 10px;

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    font-size: 14px;
    font-weight: 600;

    margin-right: 15px;

    transition: 0.3s ease;
    border: none;
}
body.contraste .btn-logout{
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}

body.contraste .btn-logout i{
    color: #fff !important;
}
body.contraste #aumentar-fonte,
body.contraste #diminuir-fonte,
body.contraste #resetar-fonte{
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
}
</style>
<head>
    <!--Ícone do site-->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazendas - FARMI Gestor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        <div class="search-bar">
            <input type="text" id="pesquisar"class="search-input" placeholder="Pesquisar fazendas...">
            <a href="#" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                Pesquisar
            </a>
        </div>

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
    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>
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
const contrasteBtn = document.getElementById('contraste-btn');

contrasteBtn.addEventListener('click', () => {
    document.body.classList.toggle('contraste');
});
</script>