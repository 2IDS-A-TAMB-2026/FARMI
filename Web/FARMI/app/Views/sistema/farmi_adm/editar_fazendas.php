<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Endereço - Fazenda Inteligente</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_recuperar.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ========================================================
           BARRA DE ACESSIBILIDADE CORRIGIDA (FLUTUANTE EM LINHA)
           ======================================================== */
        
        /* Força o container principal a aceitar o posicionamento correto sem cortar os botões */
        .recover-container {
            position: relative !important;
            padding-top: 75px !important; 
            box-sizing: border-box !important;
            overflow: visible !important; /* Impede que os botões fiquem cortados ou sumam */
        }

        /* Container dos botões: isolado no topo direito interno do card */
        .acessibilidade-container {
            position: absolute !important;
            top: 20px !important;
            right: 20px !important;
            display: flex !important;
            flex-direction: row !important; /* Garante que fiquem lado a lado */
            align-items: center !important;
            gap: 6px !important;            /* Espaçamento exato entre os botões */
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            width: auto !important;
            height: auto !important;
            z-index: 9999 !important;       /* Fica acima de qualquer outro elemento */
        }

        /* Estilo base reduzido idêntico para todos os botões de tamanho */
        .acessibilidade-container button {
            background: #57c91b !important;
            border: none !important;
            border-radius: 5px !important;
            width: 34px !important;         /* Padronizado com as outras telas */
            height: 34px !important;        /* Padronizado com as outras telas */
            font-weight: bold !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: 0.2s !important;
            color: #fff !important;
            font-size: 13px !important;     /* Fonte proporcional ao botão */
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
        .acessibilidade-container button:hover {
            opacity: .85 !important;
        }

        /* CAMPOS EM 2 COLUNAS */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row.full-width {
            grid-template-columns: 1fr;
        }

        /* Ajuste para telas menores/celular */
        @media (max-width: 768px) {
            .recover-container {
                padding-top: 85px !important;
            }
            .acessibilidade-container {
                top: 15px !important;
                right: 15px !important;
            }
            .acessibilidade-container button {
                width: 30px !important;
                height: 30px !important;
                font-size: 11px !important;
            }
            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }

        /* VALIDAÇÃO VISUAL */
        input:invalid {
            border: 2px solid #ff4d4d;
        }

        input:valid {
            border: 2px solid #4caf50;
        }
    </style>
</head>

<body>

    <div id="div_principal" class="recover-container">

        <div class="acessibilidade-container">
            <button id="contraste-btn" type="button" aria-label="Alterar contraste">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>
            <button id="aumentar-fonte" type="button" aria-label="Aumentar fonte">A+</button>
            <button id="diminuir-fonte" type="button" aria-label="Diminuir fonte">A-</button>
            <button id="resetar-fonte" type="button" aria-label="Resetar fonte">A</button>
        </div>

        <div class="recover-header">
            <div class="logo">
                <i class="fa-solid fa-leaf"></i>
                FARMI
            </div>
            <h2>Cadastrar Endereço</h2>
            <p>Preencha os dados do endereço da fazenda</p>
        </div>

        <form action="<?= base_url('fazenda/atualizar/'.$fazenda['ID_FAZENDA']) ?>"
                method="post"
                id="formSensor"
                class="form-grid">

            <div class="form-group">
                <label for="NOME">
                    <i class="fa-solid fa-tractor"></i>
                    Nome
                </label>
                <input
                    type="text"
                    id="NOME"
                    name="NOME"
                    minlength="3"
                    required
                    value="<?= $fazenda['NOME'] ?>"
                >
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="LATITUDE">
                        <i class="fa-solid fa-map-pin"></i>
                        Latitude
                    </label>
                    <input
                        type="number"
                        step="any"
                        id="LATITUDE"
                        name="LATITUDE"
                        value="<?= $fazenda['LATITUDE'] ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="LONGITUDE">
                        <i class="fa-solid fa-map-marked-alt"></i>
                        Longitude
                    </label>
                    <input
                        type="number"
                        step="any"
                        id="LONGITUDE"
                        name="LONGITUDE"
                        value="<?= $fazenda['LONGITUDE'] ?>"
                        required
                    >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="LOGRADOURO">
                        <i class="fa-solid fa-road"></i>
                        Logradouro
                    </label>
                    <input
                        type="text"
                        id="LOGRADOURO"
                        name="LOGRADOURO"
                        value="<?= $fazenda['LOGRADOURO'] ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="numero">
                        <i class="fa-solid fa-hashtag"></i>
                        Número
                    </label>
                    <input
                        type="number"
                        id="NUMERO"
                        name="NUMERO"
                        value="<?= $fazenda['NUMERO'] ?>"
                        maxlength="10"
                        required
                    >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="AREA_TOTAL">
                        <i class="fa-solid fa-ruler-combined"></i>
                        Área Total (ha)
                    </label>
                    <input
                        type="number"
                        step="0.01"
                        id="AREA_TOTAL"
                        name="AREA_TOTAL"
                        value="<?= $fazenda['AREA_TOTAL'] ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="CEP">
                        <i class="fa-solid fa-mail-bulk"></i>
                        CEP
                    </label>
                    <input
                        type="text"
                        id="CEP"
                        name="CEP"
                        maxlength="9"
                        value="<?= $fazenda['CEP'] ?>"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-save"></i>
                Salvar Endereço
            </button>

            <a href="<?= base_url('/fazendas-admin') ?>">
                <button type="button" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i>
                    Voltar
                </button>
            </a>

        </form>

        <div class="back-link">
            <a href="<?= base_url('/dashboard-admin') ?>">
                <i class="fa-solid fa-tachometer-alt"></i>
                Dashboard
            </a>
        </div>

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
    // ========================================================
    // SWEET ALERT FORM
    // ========================================================
    const formSensor = document.getElementById('formSensor');
    if(formSensor){
        formSensor.addEventListener('submit', function(e){
            e.preventDefault();
            const btn = this.querySelector('.btn-primary');
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Salvando...';
            btn.disabled = true;

            Swal.fire({
                title: 'Endereço salvo!',
                text: 'Os dados da fazenda foram atualizados com sucesso.',
                icon: 'success',
                confirmButtonColor: '#2e7d32',
                confirmButtonText: 'OK'
            }).then(() => {
                formSensor.submit();
            });
        });
    }


    /* =========================
    MÁSCARA LATITUDE
    ========================= */

    const latitude = document.getElementById('LATITUDE');

    if(latitude){
        latitude.setAttribute('maxlength', '10');

        latitude.addEventListener('input', function(e){
            let value = e.target.value;

            value = value.replace(/[^0-9.-]/g, '');

            const partes = value.split('.');

            if(partes.length > 2){
                value = partes[0] + '.' + partes[1];
            }

            value = value.substring(0, 10);

            e.target.value = value;
        });

    }


    /* =========================
    MÁSCARA LONGITUDE
    ========================= */

    const longitude = document.getElementById('LONGITUDE');

    if(longitude){
        longitude.setAttribute('maxlength', '10');

        longitude.addEventListener('input', function(e){
            let value = e.target.value;

            value = value.replace(/[^0-9.-]/g, '');

            const partes = value.split('.');

            if(partes.length > 2){
                value = partes[0] + '.' + partes[1];
            }

            value = value.substring(0, 10);

            e.target.value = value;
        });

    }

    /* =========================
    MÁSCARA LOGRADOURO
    ========================= */

    const logradouro = document.getElementById('LOGRADOURO');

    if(logradouro){
    logradouro.addEventListener('input', function(e){
    let value = e.target.value;

        value = value.replace(/[^a-zA-ZÀ-ÿ0-9\s]/g, '');

        value = value.replace(/\s+/g, ' ');

        e.target.value = value;
    });

    }


    // =========================
    // MÁSCARA NÚMERO
    // SOMENTE 7 NÚMEROS
    // =========================
    const numero = document.getElementById('NUMERO');

    if(numero){

        numero.addEventListener('input', function(e){

            // PEGA SOMENTE NÚMEROS
            let value = e.target.value.replace(/\D/g, '');

            // LIMITA A 7 NÚMEROS
            value = value.substring(0, 7);

            e.target.value = value;

        });

    }

    /* =========================
    MÁSCARA ÁREA TOTAL
    ========================= */

    const areaTotal = document.getElementById('AREA_TOTAL');

    if(areaTotal){
    areaTotal.setAttribute('maxlength', '9');

    areaTotal.addEventListener('input', function(e){
        let value = e.target.value;

        value = value.replace(/[^0-9,]/g, '');

        const partes = value.split(',');

        if(partes.length > 2){
            value = partes[0] + ',' + partes[1];
        }

        value = value.substring(0, 9);

        e.target.value = value;
    });

    }


    /* =========================
       MÁSCARA CEP
    ========================= */
    document.addEventListener('DOMContentLoaded', function () {
        const cep = document.getElementById('CEP');

        if (!cep) return;

        cep.addEventListener('input', function (e) {
            let value = e.target.value;

            // mantém só números
            value = value.replace(/\D/g, '');

            // limita 8 dígitos
            value = value.slice(0, 8);

            // aplica máscara
            if (value.length > 5) {
                value = value.replace(/^(\d{5})(\d{1,3})$/, '$1-$2');
            }

            e.target.value = value;
        });
    });

    // =========================
    // MÁSCARA NOME
    // LETRAS, NÚMEROS E ESPAÇOS
    // =========================

    const nome = document.getElementById('NOME');

    if (nome) {

        nome.addEventListener('keyup', (e) => {
            let value = e.target.value;

            // REMOVE TUDO QUE NÃO FOR LETRA, NÚMERO OU ESPAÇO
            value = value.replace(/[^a-zA-ZÀ-ÿ0-9\s]/g, '');

            // REMOVE ESPAÇOS DUPLOS
            value = value.replace(/\s+/g, ' ');

            e.target.value = value;
        });

    }

    // ========================================================
    // ACESSIBILIDADE DE FONTE
    // ========================================================
    let tamanhoFonte = 100;
    const aumentarFonte = document.getElementById('aumentar-fonte');
    const diminuirFonte = document.getElementById('diminuir-fonte');
    const resetarFonte = document.getElementById('resetar-fonte');

    function aplicarFonte() {
        document.documentElement.style.fontSize = tamanhoFonte + '%';
        localStorage.setItem('tamanhoFonteEndereco', tamanhoFonte);
    }

    const fonteSalva = localStorage.getItem('tamanhoFonteEndereco');
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

    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>
</body>
</html>