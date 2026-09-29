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

        /* ========================================================
           BARRA DE ACESSIBILIDADE (IGUAL À TELA DE EDITAR FAZENDA)
           ======================================================== */
        .user-profile {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 6px !important;
        }

        /* Estilo base idêntico para todos os botões */
        .user-profile button {
            background: #57c91b !important;
            border: none !important;
            border-radius: 5px !important;
            width: 34px !important;
            height: 34px !important;
            font-weight: bold !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: 0.2s !important;
            color: #fff !important;
            font-size: 13px !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
            box-sizing: border-box !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* APENAS o botão de contraste fica preto com ícone branco */
        #contraste-btn {
            background: #000000 !important;
            color: #ffffff !important;
        }

        /* Efeito de hover padrão */
        .user-profile button:hover {
            opacity: .85 !important;
        }

        /* Espaço entre o último botão (A) e o Avatar G */
        #resetar-fonte {
            margin-right: 9px !important;
        }

        @media (max-width: 768px) {
            .user-profile button {
                width: 30px !important;
                height: 30px !important;
                font-size: 11px !important;
            }
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

    <div class="user-profile">

        <button id="contraste-btn" type="button" aria-label="Alterar contraste">
            <i class="fa-solid fa-circle-half-stroke"></i>
        </button>
        <button id="aumentar-fonte" type="button" aria-label="Aumentar fonte">A+</button>
        <button id="diminuir-fonte" type="button" aria-label="Diminuir fonte">A-</button>
        <button id="resetar-fonte" type="button" aria-label="Resetar fonte">A</button>

        <div class="avatar">G</div>

    </div>

</header>

        <div class="form-section">
            <h3 class="section-title">
                <i class="fa-solid fa-plus"></i>
                Editar Cultura
            </h3>
            <form action="<?= base_url('/cultura/atualizar/'.$cultura['ID_CULTURA']) ?>" method="POST" id="formCultura" class="form-grid">
            <?= csrf_field() ?>
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

                <script>
                function toggleDropdown() {
                var dropdown = document.getElementById("dropdown");
                dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
                }
                </script>

                <div class="form-group">
                    <label for="nomeCultura">
                        <i class="fa-solid fa-tag"></i>
                        Nome da Cultura *
                    </label>
                    <input type="text" id="nome" name="NOME_CULTURA" 
                     value="<?= $cultura['NOME_CULTURA'] ?>">
        
                </div>
                
                <div class="form-group">
                    <label for="dataPlantio">
                        <i class="fa-solid fa-calendar-day"></i>
                        Data do Plantio *
                    </label>
                    <input type="date" id="data" name="DATA_PLANTIO" required
                    value="<?= $cultura['DATA_PLANTIO'] ?>">
                </div>

                <div class="form-group">
                    <label for="CICLO_PRODUTIVO">
                        <i class="fa-solid fa-clock"></i>
                        Ciclo Produtivo (dias) *
                    </label>
                    <input type="text" id="CICLO_PRODUTIVO" name="CICLO_PRODUTIVO" 
                           min="30" max="365" required 
                           value="<?= $cultura['CICLO_PRODUTIVO'] ?>">
                </div>

                <div class="form-group">
                    <label for="TIPO_CULTURA">
                        <i class="fa-solid fa-seedling"></i>
                        Tipo da Cultura *
                    </label>
                    <select id="TIPO_CULTURA" name="TIPO_CULTURA" required>
                        <option value="">Selecione o tipo</option>

                        <option value="Grão"
                        <?= $cultura['TIPO_CULTURA'] == 'Grão' ? 'selected' : '' ?>>
                        Grãos (Milho, Soja, Trigo)</option>

                        <option value="Leguminosas"
                        <?= $cultura['TIPO_CULTURA'] == 'Leguminosas' ? 'selected' : '' ?>>
                        Leguminosas (Feijão, Ervilha)</option>

                        <option value="Hortaliça"
                        <?= $cultura['TIPO_CULTURA'] == 'Hortaliça' ? 'selected' : '' ?>>
                        Hortaliças (Tomate, Cenoura)</option>

                        <option value="Tubérculo"
                        <?= $cultura['TIPO_CULTURA'] == 'Tubérculo' ? 'selected' : '' ?>>
                        Tubérculos (Batata, Mandioca)</option>

                        <option value="Folhosas"
                        <?= $cultura['TIPO_CULTURA'] == 'Folhosas' ? 'selected' : '' ?>>
                        Folhosas (Alface, Repolho)</option>

                        <option value="Frutas"
                        <?= $cultura['TIPO_CULTURA'] == 'Frutas' ? 'selected' : '' ?>>
                        Frutas (Melancia, Melão)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="AREA_CULTIVADA">
                        <i class="fa-solid fa-ruler-combined"></i>
                        Área Cultivada (ha) *
                    </label>
                    <input type="text"
                    id="AREA_CULTIVADA"
                    name="AREA_CULTIVADA"
                     min="0.01"
                    max="1000000"
                    step="0.01"
                     required
                      value="<?= $cultura['AREA_CULTIVADA'] ?>">
                
                </div>

                <div class="form-group">
                    <label for="sensorLuz">
                        <i class="fa-solid fa-lightbulb"></i>
                         Sensor de luz (lux):
                    </label>
                    <input type="text" id="lux" name="SENSOR_LUZ" required 
                           value="<?= $cultura['SENSOR_LUZ'] ?>">
                </div>
                
                <div class="form-group">
                    <label for="sensorTemp">
                        <i class="fa-solid fa-cloud"></i>
                        Sensor de clima (Temperatura °C):
                    </label>
                    <input type="text" id="temperatura" name="SENSOR_CLIMA_TEMPO" required
                            value="<?= $cultura['SENSOR_CLIMA_TEMPO'] ?>">
                </div>

                <div class="form-group">
                    <label for="sensorUmi">
                        <i class="fa-solid fa-temperature-empty"></i>
                        Sensor de clima (Umidade %):
                    </label>
                    <input type="text" id="umidade_ar" name="SENSOR_CLIMA_UMIDADE" required
                            value="<?= $cultura['SENSOR_CLIMA_UMIDADE'] ?>">
                </div>

                <div class="form-group">
                    <label for="sensorSolo">
                        <i class="fa-solid fa-mound"></i>
                        Sensor de umidade do Solo (%):
                    </label>
                    <input type="text" id="umidade_solo" name="SENSOR_SOLO" 
                          value="<?= $cultura['SENSOR_SOLO'] ?>">
                </div>


                <div class="form-group">
                    <label for="STATUS">
                        <i class="fa-solid fa-seedling"></i>
                        Tipo da Cultura *
                    </label>
                    <select id="STATUS" name="STATUS" required>
                         <option value="">
                            Selecione o status
                        </option>
                        <option value="Ativa"
                            <?= $cultura['STATUS'] == 'Ativa' ? 'selected' : '' ?>>

                            Ativo
                        </option>

                        <option value="Inativa"
                            <?= $cultura['STATUS'] == 'Inativa' ? 'selected' : '' ?>>

                            Inativo

                        </option>
                    </select>
                </div>


                <div class="form-group full-width" style="display:flex; flex-direction:row; gap:15px; align-items:center;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i>
                        Editar
                    </button>

                    <a href="<?= base_url('/cultura-admin') ?>"
                       class="btn btn-secondary"
                       style="text-decoration:none; display:flex; align-items:center; justify-content:center;">
                        <i class="fa-solid fa-arrow-left"></i>
                        &nbsp;Voltar 
                    </a>
                </div>
            </form>
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

    <script>
        // ========================================================
        // ACESSIBILIDADE: CONTRASTE
        // ========================================================
        // O estado fica salvo no navegador e vale para todas as páginas
        // que tiverem este mesmo trecho (chave: altoContraste)
        const btnContraste = document.getElementById('contraste-btn');

        if (localStorage.getItem('altoContraste') === 'true') {
            document.body.classList.add('alto-contraste');
        }

        if (btnContraste) {
            btnContraste.addEventListener('click', () => {
                const ativo = document.body.classList.toggle('alto-contraste');
                localStorage.setItem('altoContraste', ativo);
            });
        }

        // ========================================================
        // ACESSIBILIDADE DE FONTE (IGUAL À TELA DE EDITAR FAZENDA)
        // ========================================================
        let tamanhoFonte = 100;
        const aumentarFonte = document.getElementById('aumentar-fonte');
        const diminuirFonte = document.getElementById('diminuir-fonte');
        const resetarFonte = document.getElementById('resetar-fonte');

        function aplicarFonte() {
            document.documentElement.style.fontSize = tamanhoFonte + '%';
            localStorage.setItem('tamanhoFonteCultura', tamanhoFonte);
        }

        const fonteSalva = localStorage.getItem('tamanhoFonteCultura');
        if (fonteSalva) {
            tamanhoFonte = parseInt(fonteSalva);
            aplicarFonte();
        }

        if (aumentarFonte) {
            aumentarFonte.addEventListener('click', () => {
                if (tamanhoFonte < 150) { tamanhoFonte += 10; aplicarFonte(); }
            });
        }
        if (diminuirFonte) {
            diminuirFonte.addEventListener('click', () => {
                if (tamanhoFonte > 70) { tamanhoFonte -= 10; aplicarFonte(); }
            });
        }
        if (resetarFonte) {
            resetarFonte.addEventListener('click', () => {
                tamanhoFonte = 100; aplicarFonte();
            });
        }
    </script>
</body>
</html>