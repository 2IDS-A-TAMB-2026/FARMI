<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!--Ícone do site-->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Endereço - Fazenda Inteligente</title>

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_recuperar.css') ?>">

    <style>

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

        @media (max-width: 768px) {
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
        /* =========================
   ACESSIBILIDADE
========================= */

.recover-container{
    position: relative;
    padding-top: 75px;
    overflow: visible;
}

.acessibilidade-container{
    position: absolute;
    top: 20px;
    right: 20px;
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 6px;
    z-index: 100;
}

.acessibilidade-container button{
    background: #57c91b;
    border: none;
    border-radius: 5px;
    width: 34px;
    height: 34px;
    color: #fff;
    font-size: 13px;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: .2s;
    box-shadow: 0 2px 4px rgba(0,0,0,.1);
}

.acessibilidade-container button:hover{
    opacity: .85;
}

#contraste-btn{
    background: #000;
    color: #fff;
}

@media(max-width:768px){

    .recover-container{
        padding-top: 85px;
    }

    .acessibilidade-container{
        top: 15px;
        right: 15px;
    }

    .acessibilidade-container button{
        width: 30px;
        height: 30px;
        font-size: 11px;
    }

}

    </style>
</head>


<body>

    <div id="div_principal" class="recover-container">

       <div class="acessibilidade-container">
    <button id="contraste-btn" type="button" aria-label="Alterar contraste">
        <i class="fa-solid fa-circle-half-stroke"></i>
    </button>

    <button id="aumentar-fonte" type="button" aria-label="Aumentar fonte">
        A+
    </button>

    <button id="diminuir-fonte" type="button" aria-label="Diminuir fonte">
        A-
    </button>

    <button id="resetar-fonte" type="button" aria-label="Resetar fonte">
        A
    </button>
</div>

        <!-- HEADER -->
        <div class="recover-header">

            <div class="logo">
                <i class="fa-solid fa-leaf"></i>
                FARMI
            </div>

            <h2>Cadastrar Endereço</h2>
            <p>Preencha os dados do endereço da fazenda</p>

        </div>


        <!-- FORM -->
        <form action="<?= base_url('/fazenda/inserir') ?>" method="post" id="addressForm">

            <!-- NOME -->
            <div class="form-group">

                <label for="nome">
                    <i class="fa-solid fa-tractor"></i>
                    Nome
                </label>

                <input
                    type="text"
                    id="nome"
                    name="NOME"
                    minlength="3"
                    placeholder="Ex: Fazenda São Jorge"
                    required
                >

            </div>

            <!-- LATITUDE + LONGITUDE -->
            <div class="form-row">

                <div class="form-group">

                    <label for="latitude">
                        <i class="fa-solid fa-map-pin"></i>
                        Latitude
                    </label>

                    <input
                        type="number"
                        step="any"
                        id="latitude"
                        name="LATITUDE"
                        maxlength="10"
                        placeholder="Ex: -23.550520"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="longitude">
                        <i class="fa-solid fa-map-marked-alt"></i>
                        Longitude
                    </label>

                    <input
                        type="number"
                        step="any"
                        id="longitude"
                        name="LONGITUDE"
                        maxlength="10"
                        placeholder="Ex: -46.633308"
                        required
                    >

                </div>

            </div>

            <!-- LOGRADOURO + NUMERO -->
            <div class="form-row">

                <div class="form-group">

                    <label for="logradouro">
                        <i class="fa-solid fa-road"></i>
                        Logradouro
                    </label>

                    <input
                        type="text"
                        id="logradouro"
                        name="LOGRADOURO"
                        placeholder="Rua, Avenida, Estrada..."
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
                        id="numero"
                        name="NUMERO"
                        placeholder="Ex: 123 "
                        maxlength="10"
                        required
                    >

                </div>

            </div>

            <!-- AREA + CEP -->
            <div class="form-row">

                <div class="form-group">

                    <label for="area_total">
                        <i class="fa-solid fa-ruler-combined"></i>
                        Área Total (ha)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        id="area_total"
                        name="AREA_TOTAL"
                        maxlength="8"
                        placeholder="Ex: 150,50"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="cep">
                        <i class="fa-solid fa-mail-bulk"></i>
                        CEP
                    </label>

                    <input
                        type="text"
                        id="cep"
                        name="CEP"
                        maxlength="9"
                        placeholder="Ex: 01234-567"
                        required
                    >

                </div>

            </div>

            <!-- BOTÃO -->
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-save"></i>
                Salvar Endereço
            </button>

            <!-- VOLTAR -->
            <a href="<?= base_url('/fazendas-admin') ?>">

                <button type="button" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i>
                    Voltar
                </button>

            </a>

        </form>

        <!-- DASHBOARD -->
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
/* =========================
   MÁSCARAS E HIGIENIZAÇÃO DE INPUTS
========================= */

// Trata latitude e longitude permitindo vírgula ou ponto
function aplicarMascaraCoordenada(input) {
    if (!input) return;

    input.addEventListener('input', function (e) {
        let value = e.target.value;

        // Converte vírgula para ponto no momento da digitação
        value = value.replace(',', '.');

        // Mantém apenas números, ponto e o hífen inicial (para coordenadas negativas)
        value = value.replace(/(?!^-)[^0-9.]/g, '');

        // Impede mais de um ponto decimal
        const partes = value.split('.');
        if (partes.length > 2) {
            value = partes[0] + '.' + partes.slice(1).join('');
        }

        e.target.value = value;
    });
}

aplicarMascaraCoordenada(document.getElementById('latitude'));
aplicarMascaraCoordenada(document.getElementById('longitude'));

/* MÁSCARA ÁREA TOTAL (Permite vírgula ou ponto, converte para ponto) */
const areaTotal = document.getElementById('area_total');
if (areaTotal) {
    areaTotal.addEventListener('input', function (e) {
        let value = e.target.value;

        value = value.replace(',', '.');
        value = value.replace(/[^0-9.]/g, '');

        const partes = value.split('.');
        if (partes.length > 2) {
            value = partes[0] + '.' + partes.slice(1).join('');
        }

        e.target.value = value;
    });
}

/* MÁSCARA LOGRADOURO */
const logradouro = document.getElementById('logradouro');
if (logradouro) {
    logradouro.addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/[^a-zA-ZÀ-ÿ0-9\s.,-]/g, '');
        value = value.replace(/\s+/g, ' ');
        e.target.value = value;
    });
}

/* MÁSCARA NÚMERO (Apenas números, máximo de 7) */
const numero = document.getElementById('numero');
if (numero) {
    numero.addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/\D/g, '').substring(0, 7);
    });
}

/* MÁSCARA CEP (00000-000) */
const cep = document.getElementById('cep');
if (cep) {
    cep.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '').slice(0, 8);
        if (value.length > 5) {
            value = value.replace(/^(\d{5})(\d{1,3})$/, '$1-$2');
        }
        e.target.value = value;
    });
}

/* MÁSCARA NOME */
const nome = document.getElementById('nome');
if (nome) {
    nome.addEventListener('input', (e) => {
        let value = e.target.value;
        value = value.replace(/[^a-zA-ZÀ-ÿ0-9\s]/g, '');
        value = value.replace(/\s+/g, ' ');
        e.target.value = value;
    });
}


/* =========================
   VALIDAÇÃO DE ENVIO DO FORMULÁRIO
========================= */
const addressForm = document.getElementById('addressForm');

if (addressForm) {
    addressForm.addEventListener('submit', function (e) {
        const nomeEl = document.getElementById('nome');
        const latEl = document.getElementById('latitude');
        const lngEl = document.getElementById('longitude');
        const areaEl = document.getElementById('area_total');
        const cepEl = document.getElementById('cep');
        const numEl = document.getElementById('numero');

        // Garante a conversão final de vírgulas em pontos antes do envio ao backend
        latEl.value = latEl.value.replace(',', '.');
        lngEl.value = lngEl.value.replace(',', '.');
        areaEl.value = areaEl.value.replace(',', '.');

        const nomeVal = nomeEl ? nomeEl.value.trim() : '';
        const latVal = parseFloat(latEl.value);
        const lngVal = parseFloat(lngEl.value);
        const areaVal = parseFloat(areaEl.value);
        const cepVal = cepEl ? cepEl.value.trim() : '';
        const numVal = numEl ? numEl.value.trim() : '';

        // 1. Validação do Nome
        if (nomeVal.length < 3) {
            e.preventDefault();
            Swal.fire('Campo Inválido', 'O nome precisa ter pelo menos 3 caracteres.', 'warning');
            return;
        }

        // 2. Validação da Latitude (-90 até 90)
        if (isNaN(latVal) || latVal < -90 || latVal > 90) {
            e.preventDefault();
            Swal.fire('Latitude Inválida', 'A Latitude deve ser um número entre -90 e 90.', 'warning');
            return;
        }

        // 3. Validação da Longitude (-180 até 180)
        if (isNaN(lngVal) || lngVal < -180 || lngVal > 180) {
            e.preventDefault();
            Swal.fire('Longitude Inválida', 'A Longitude deve ser um número entre -180 e 180.', 'warning');
            return;
        }

        // 4. Validação do Número
        if (!numVal) {
            e.preventDefault();
            Swal.fire('Número Incompleto', 'Por favor, informe o número do endereço.', 'warning');
            return;
        }

        // 5. Validação da Área Total
        if (isNaN(areaVal) || areaVal <= 0) {
            e.preventDefault();
            Swal.fire('Área Inválida', 'Informe um valor de área válido e maior que 0.', 'warning');
            return;
        }

        // 6. Validação do CEP (deve conter os 8 dígitos formatados)
        if (cepVal.length < 9) {
            e.preventDefault();
            Swal.fire('CEP Incompleto', 'Por favor, digite o CEP completo no formato 00000-000.', 'warning');
            return;
        }

        // Bloqueia cliques múltiplos e exibe feedback visual
        const btn = this.querySelector('.btn-primary');
        if (btn) {
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Salvando...';
            btn.disabled = true;
        }
    });
}


/* =========================
   ACESSIBILIDADE DE FONTE
========================= */
let tamanhoFonte = 100;

const aumentarFonte = document.getElementById('aumentar-fonte');
const diminuirFonte = document.getElementById('diminuir-fonte');
const resetarFonte = document.getElementById('resetar-fonte');

function aplicarFonte() {
    document.documentElement.style.fontSize = tamanhoFonte + '%';
    localStorage.setItem('tamanhoFonteFazenda', tamanhoFonte);
}

const fonteSalva = localStorage.getItem('tamanhoFonteFazenda');
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
    

</body>
</html>