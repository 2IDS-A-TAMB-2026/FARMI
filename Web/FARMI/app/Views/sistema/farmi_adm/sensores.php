<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestor - Gerenciar Sensores</title>

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
            margin-right: 8px; 
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

        /* Espaço entre o Physiology (último botão A) e o Avatar G */
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
        body.contraste #btn-logout,
body.alto-contraste #btn-logout {
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

        <header class="header">

            <div>
                <h2>Gerenciar Sensores</h2>
                <p style="color: #666;">Painel de Gestão</p>
            </div>

            <div class="user-profile">

                <a href="<?= base_url('/logout') ?>"
                    class="btn btn-secondary"
                    style="
                        text-decoration: none;
                        display: flex;
                        align-items: center;
                        justify-content: center;

                        width: 120px;
                        height: 42px;

                        gap: 8px;
                        margin-right: 15px;

                        font-size: 14px;
                        font-weight: 600;

                        border-radius: 10px;
                    " id="btn-logout">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    Logout

                </a>

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

        <div class="form-section">

            <h3 class="section-title">
                <i class="fa-solid fa-plus"></i>
                Adicionar Novo Sensor
            </h3>

            <form action="<?= base_url('/sensor/inserir') ?>"
                method="post"
                id="formSensor"
                class="form-grid">

                <div class="form-group">
                    <label for="nome">Nome do Sensor</label>
                    <input type="nome"
                        id="nome"
                        name="NOME_SENSOR"
                        placeholder="Sensor de Clima"
                        required>
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo de Sensor *</label>
                    <select id="tipo" name="TIPO_SENSOR" required>
                        <option value="">Selecione o tipo</option>
                        <option value="Temperatura">Temperatura</option>
                        <option value="Umidade">Umidade</option>
                        <option value="Luz">Luz</option>
                        <option value="Solo">Solo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="unidade">Unidade de medida *</label>
                    <select id="unidade" name="UNIDADE_MEDIDA" required>
                        <option value="">Selecione a unidade</option>
                        <option value="%">%</option>
                        <option value="°C">°C</option>
                        <option value="Lux">Lux</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status Inicial *</label>
                    <select id="status" name="STATUS">
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="data">Data da Instalação *</label>
                    <input type="date"
                        id="data"
                        name="DATA_INSTALACAO"
                        required>
                </div>

                <div class="form-group">
                    <label for="cultura">Culturas *</label>
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
                    <tr>
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

    </main>

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