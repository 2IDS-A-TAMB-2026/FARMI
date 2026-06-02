<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestor - Editar Sensor</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* BOTÕES DE ALTERAR FONTE (VERDES COM LETRAS BRANCAS) */
        #aumentar-fonte,
        #diminuir-fonte,
        #resetar-fonte {
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: #57c91b;
            color: white; /* Letras brancas */
            font-weight: bold;
            margin-left: 5px;
            transition: .3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* BOTÃO DE CONTRASTE (TOTALMENTE PRETO) */
        #contraste-btn {
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: #000; /* Fundo Preto */
            color: #000;      /* Ícone Preto (faz o ícone sumir/ficar totalmente preto) */
            margin-left: 5px;
            transition: .3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Espaço entre o último botão (A) e o Avatar G */
        #resetar-fonte {
            margin-right: 15px; 
        }

        /* Efeito de hover mantendo as cores pretas no botão de contraste */
        #contraste-btn:hover {
            transform: scale(1.05);
            background: #000; /* Mantém fundo preto no hover */
            color: #000;      /* Mantém ícone preto no hover */
        }

        /* Efeito de hover dos botões verdes */
        #aumentar-fonte:hover,
        #diminuir-fonte:hover,
        #resetar-fonte:hover {
            transform: scale(1.05);
        }

        /* Alinhamento do contêiner */
        .user-profile {
            display: flex;
            align-items: center;
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

        <header class="header">

            <div>
                <h2>Editar Sensor</h2>
                <p style="color: #4BC714;">Painel de Gestão</p>
            </div>

            <div class="user-profile">

                <button id="contraste-btn" aria-label="Alterar contraste">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>

                <button id="aumentar-fonte" aria-label="Aumentar fonte">
                    A+
                </button>

                <button id="diminuir-fonte" aria-label="Diminuir fonte">
                    A-
                </button>

                <button id="resetar-fonte" aria-label="Resetar fonte">
                    A
                </button>

                <div class="avatar">G</div>

            </div>

        </header>

        <div class="form-section">

            <h3 class="section-title">
                <i class="fa-solid fa-pen"></i>
                Editar Sensor
            </h3>

            <form action="<?= base_url('sensor/atualizar/'.$sensor['ID_SENSOR']) ?>"
                method="post"
                id="formSensor"
                class="form-grid">

                <div class="form-group">
                    <label for="NOME">Nome do Sensor</label>
                    <input type="text"
                        id="NOME"
                        name="NOME_SENSOR"
                        value="<?= $sensor['NOME_SENSOR'] ?>"
                        required>
                    <br>
                    </div>
                    <div class="form-group">
                    <label for="TIPO_SENSOR">Tipo de Sensor</label>
                    <select id="TIPO_SENSOR" name="TIPO_SENSOR" required>
                        <option value="">Selecione o tipo</option>
                        <option value="Temperatura" <?= $sensor['TIPO_SENSOR'] == 'Temperatura' ? 'selected' : '' ?>>Temperatura</option>
                        <option value="Umidade" <?= $sensor['TIPO_SENSOR'] == 'Umidade' ? 'selected' : '' ?>>Umidade</option>
                        <option value="Luz" <?= $sensor['TIPO_SENSOR'] == 'Luz' ? 'selected' : '' ?>>Luz</option>
                        <option value="Solo" <?= $sensor['TIPO_SENSOR'] == 'Solo' ? 'selected' : '' ?>>Solo</option>
                    </select>
                    </div>
                

                <div class="form-group">
                    <label for="UNIDADE_MEDIDA">Unidade de medida *</label>
                    <select id="UNIDADE_MEDIDA" name="UNIDADE_MEDIDA" required>
                        <option value="">Selecione a unidade</option>
                        <option value="%" <?= $sensor['UNIDADE_MEDIDA'] == '%' ? 'selected' : '' ?>>%</option>
                        <option value="°C" <?= $sensor['UNIDADE_MEDIDA'] == '°C' ? 'selected' : '' ?>>°C</option>
                        <option value="Lux" <?= $sensor['UNIDADE_MEDIDA'] == 'Lux' ? 'selected' : '' ?>>Lux</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="STATUS">Status Inicial *</label>
                    <select id="STATUS" name="STATUS" required>
                        <option value="">Selecione o status</option>
                        <option value="Ativo" <?= $sensor['STATUS'] == 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="Inativo" <?= $sensor['STATUS'] == 'Inativo' ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="DATA_INSTALACAO">Data da Instalação *</label>
                    <input type="date"
                        id="DATA_INSTALACAO"
                        name="DATA_INSTALACAO"
                        value="<?= $sensor['DATA_INSTALACAO'] ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="FK_ID_CULTURA">Culturas *</label>
                    <select name="FK_ID_CULTURA" id="FK_ID_CULTURA" required>
                        <option value="">Selecione uma cultura</option>
                        <?php foreach($culturas as $c): ?>
                            <option value="<?= $c['ID_CULTURA']; ?>" <?= $sensor['FK_ID_CULTURA'] == $c['ID_CULTURA'] ? 'selected' : ''; ?>>
                                ID <?= $c['ID_CULTURA']; ?> - <?= $c['NOME_CULTURA']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="grid-column: 1 / -1; display: flex; gap: 15px; align-items: end; flex-wrap: wrap;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-pen"></i>
                        Salvar Alterações
                    </button>

                    <a href="<?= base_url('/sensor') ?>"
                        class="btn btn-primary"
                        style="
                            text-decoration: none;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            gap: 8px;
                        ">
                        <i class="fa-solid fa-arrow-left"></i>
                        Voltar aos Sensores
                    </a>
                </div>

            </form>

        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // DATA MÁXIMA = HOJE
            const data = document.querySelector('#DATA_INSTALACAO');
            if (data) {
                const hoje = new Date().toISOString().split('T')[0];
                data.setAttribute('max', hoje);
            }

            // CONFIRMAR EDIÇÃO
            const form = document.getElementById('formSensor');
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Salvar alterações?',
                    text: 'Deseja realmente editar este sensor?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, salvar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Atualizado!',
                            text: 'O sensor foi atualizado com sucesso.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            form.submit();
                        });
                    }
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
</body>

</html>