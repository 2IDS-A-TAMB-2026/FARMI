<!DOCTYPE html>
<html lang="pt-br">

<head>

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

.dropdown {
    position: relative;
    width: 100%;
}

.dropdown-btn {
    width: 100%;
    height: 46.4px;

   
    border-radius: 10px;

    background: #FAFBFC;

    padding: 12px 15px;

    display: flex;
    align-items: center;

    font-size: 16px Arial;
    color: #000;

    cursor: pointer;

    box-sizing: border-box;
}

.dropdown-btn:hover {
    border-color: #57c91b;
}
</style>

    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestor - Gerenciar Funcionários</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet"
        href="<?= base_url('assets/css/dashboard/style.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

            <a href="<?= base_url('/usuarios-admin') ?>" class="menu-item active">
                <i class="fa-solid fa-users"></i>
                Funcionários
            </a>

            <a href="<?= base_url('/sensor') ?>" class="menu-item">
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
                <h2>Gerenciar Funcionários</h2>
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

            $total_usuarios = count($usuarios);

            $funcionarios = count(array_filter($usuarios, fn($u) =>
                $u['PERFIL'] === 'Funcionário'
            ));

            $admins = count(array_filter($usuarios, fn($u) =>
                $u['PERFIL'] === 'Gestor'
            ));

        ?>

        <div class="stats-grid">

            <div class="card">
                <div class="card-info">
                    <h3>Total de Funcionários</h3>
                    <p><?= $total_usuarios; ?></p>
                </div>
                <div class="card-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Funcionários</h3>
                    <p><?= $funcionarios; ?></p>
                </div>
                <div class="card-icon">
                    <i class="fa-solid fa-user-check"></i>
                </div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Gestores</h3>
                    <p><?= $admins; ?></p>
                </div>
                <div class="card-icon">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>

        </div>


        <div class="form-section">

            <h3 class="section-title">
                <i class="fa-solid fa-user-plus"></i>
                Adicionar Novo Funcionário
            </h3>

            <form action="<?= base_url('/usuarios/inserir') ?>" method="post" class="form-grid" id="formUsuario">

                <div class="form-group">
                    <label for="nome">
                        <i class="fa-solid fa-user"></i>
                        Nome Completo *
                    </label>
                    <input 
                        type="text" 
                        id="nome" 
                        name="NOME" 
                        required 
                        placeholder="Ex: João Silva">
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fa-solid fa-envelope"></i>
                        E-mail *
                    </label>
                    <input
                        type="type"
                        id="email"
                        name="EMAIL"
                        required
                        placeholder="Ex: joao@farmi.com">
                </div>

                <div class="form-group">
                    <label for="senha">
                        <i class="fa-solid fa-lock"></i>
                        Senha *
                    </label>
                    <input
                        type="password"
                        id="senha"
                        name="SENHA"
                        required
                        minlength="8"
                        placeholder="********">
                </div>

                <div class="form-group">
                    <label for="perfil">
                        <i class="fa-solid fa-user-tag"></i>
                        Perfil *
                    </label>
                    <select id="perfil" name="PERFIL" required>
                        <option value="">Selecione o perfil</option>

                        <option value="Gestor">Gestor</option>
                        <option value="Funcionário">Funcionário</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cpf">
                        <i class="fa-solid fa-id-card"></i>
                        CPF *
                    </label>
                    <input
                        type="text"
                        id="cpf"
                        name="CPF"
                        required
                        maxlength="14"
                        placeholder="000.000.000-00">
                </div>

                <div class="form-group">
                    <label for="status">
                        <i class="fa-solid fa-toggle-on"></i>
                        Status Inicial *
                    </label>
                    <select id="status" name="STATUS">
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>
                        <i class="fa-solid fa-tractor"></i>
                        Fazendas *
                    </label>
                    <div class="dropdown">

                        <div class="dropdown-btn" onclick="toggleDropdown()">
                            Selecionar Fazendas
                        </div>

                        <div class="dropdown-content" id="dropdown">

                            <?php foreach($fazendas as $fazenda): ?>

                                <label>
                                    <input
                                        type="checkbox"
                                        name="FAZENDAS[]"
                                        value="<?= $fazenda['ID_FAZENDA']; ?>">
                                    <?= $fazenda['NOME']; ?>
                                </label>

                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

                <div style="grid-column: 1 / -1; display: flex; gap: 15px; align-items: end;">

                    <button type="submit" class="btn btn-primary">

                        <i class="fa-solid fa-user-plus"></i>
                        Adicionar Funcionário

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
            Lista de Funcionários (<?= $total_usuarios; ?>)
        </h3>

        <div class="table-container">
            <table>

                <thead>
                    <tr>
                        <th>CPF</th>
                        <th>Funcionário</th>
                        <th>E-mail</th>
                        <th>Perfil</th>
                        <th>Status</th>
                        <th>Data Cadastro</th>
                        <th>Fazenda</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody id="usuariosTable">
                    <?php foreach($usuarios as $usuario): ?>
                    <tr>

                        <td><?= $usuario['CPF']; ?></td>

                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="user-avatar">
                                    <?= strtoupper(substr($usuario['NOME'], 0, 1)); ?>
                                </div>
                                <?= $usuario['NOME']; ?>
                            </div>
                        </td>

                        <td><?= $usuario['EMAIL']; ?></td>

                        <td>
                            <span class="role-badge role-<?= strtolower(str_replace(' ', '-', $usuario['PERFIL'])); ?>">
                                <?= $usuario['PERFIL']; ?>
                            </span>
                        </td>

                        <td>
                            <span class="status-badge status-<?= strtolower($usuario['STATUS']); ?>">
                                <?= $usuario['STATUS']; ?>
                            </span>
                        </td>

                        <td><?= date('d/m/Y', strtotime($usuario['DATA_CADASTRO'])); ?></td>

                        <td>
                            <button type="button" class="btn btn-primary" onclick="detalhesFazenda('<?= $usuario['FAZENDAS']; ?>')">
                            +
                            </button>
                        </td>

                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('usuarios_editar/'.$usuario['CPF']) ?>"
                                    class="btn btn-primary">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <a href="<?= base_url('/usuarios/excluir/'.$usuario['CPF']) ?>"
                                    class="btn btn-danger btn-excluir">
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

        // ==========================================
        // ACESSIBILIDADE: FONTE (AUMENTAR / DIMINUIR)
        // ==========================================
        document.addEventListener('DOMContentLoaded', function () {
            const contrasteBtn = document.getElementById('contraste-btn');
    if (contrasteBtn) {
        contrasteBtn.addEventListener('click', () => {
            document.body.classList.toggle('contraste');
        });
    }

            const btnAumentar = document.getElementById('aumentar-fonte');
            const btnDiminuir = document.getElementById('diminuir-fonte');
            const btnResetar = document.getElementById('resetar-fonte');
            
            // Define o tamanho padrão em porcentagem para manter a proporção do layout
            let tamanhoAtual = parseInt(localStorage.getItem('fontSizePreferencia')) || 100;
            
            // Aplica o tamanho salvo ao iniciar a página
            document.body.style.fontSize = tamanhoAtual + '%';

            function atualizarFonte(novoTamanho) {
                // Limites de segurança para não quebrar completamente o layout (entre 70% e 140%)
                if (novoTamanho >= 70 && novoTamanho <= 140) {
                    tamanhoAtual = novoTamanho;
                    document.body.style.fontSize = tamanhoAtual + '%';
                    localStorage.setItem('fontSizePreferencia', tamanhoAtual);
                }
            }

            btnAumentar.addEventListener('click', function() {
                atualizarFonte(tamanhoAtual + 10);
            });

            btnDiminuir.addEventListener('click', function() {
                atualizarFonte(tamanhoAtual - 10);
            });

            btnResetar.addEventListener('click', function() {
                atualizarFonte(100);
            });
        });

        // =========================
        // DROPDOWN
        // =========================

        function toggleDropdown() {

            const dropdown =
                document.getElementById("dropdown");

            dropdown.style.display =
                dropdown.style.display === "block"
                ? "none"
                : "block";

        }

        document.addEventListener('DOMContentLoaded', function () {

            // =========================
            // CPF
            // =========================

            const cpf = document.querySelector('#cpf');

            if (cpf) {

                cpf.addEventListener('input', function () {

                    let v = cpf.value
                        .replace(/\D/g, '')
                        .slice(0, 11);

                    v = v.replace(/^(\d{3})(\d)/, '$1.$2');
                    v = v.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
                    v = v.replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3-$4');

                    cpf.value = v;

                });

            }

            // =========================
            // SENHA
            // =========================

            const senha = document.querySelector('#senha');

            if (senha) {

                senha.addEventListener('input', function () {

                    if (senha.value.length < 8) {

                        senha.style.border =
                            '2px solid red';

                    } else {

                        senha.style.border =
                            '2px solid green';

                    }

                });

            }

            // =========================
            // EMAIL
            // =========================

            const email = document.querySelector('#email');

            if (email) {

                email.addEventListener('blur', function () {

                    const regex =
                        /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (
                        email.value &&
                        !regex.test(email.value)
                    ) {

                        Swal.fire({

                            title: 'Email inválido!',
                            text: 'Digite um email válido.',
                            icon: 'error',

                            confirmButtonColor: '#d33'

                        });

                        email.style.border =
                            '2px solid red';

                    } else {

                        email.style.border = '';

                    }

                });

            }

            // =========================
            // NOME
            // =========================

            const nome = document.querySelector('#nome');

            if (nome) {

                nome.addEventListener('input', function () {

                    nome.value =
                        nome.value.replace(
                            /[^a-zA-ZÀ-ÿ\s]/g,
                            ''
                        );

                });

            }

            // =========================
            // CONFIRMAR ADICIONAR
            // =========================

            const formUsuario =
                document.getElementById('formUsuario');

            if (formUsuario) {

                formUsuario.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({

                        title: 'Adicionar funcionário?',
                        text: 'Deseja realmente cadastrar este funcionário?',

                        icon: 'question',

                        showCancelButton: true,

                        confirmButtonColor: '#2e7d32',
                        cancelButtonColor: '#6c757d',

                        confirmButtonText: 'Sim, adicionar',
                        cancelButtonText: 'Cancelar'

                    }).then((result) => {

                        if (result.isConfirmed) {

                            Swal.fire({

                                title: 'Funcionário adicionado!',
                                text: 'Cadastro realizado com sucesso.',

                                icon: 'success',

                                timer: 1500,
                                showConfirmButton: false

                            }).then(() => {

                                formUsuario.submit();

                            });

                        }

                    });

                });

            }

            // =========================
            // CONFIRMAR EXCLUIR
            // =========================

            const botoesExcluir =
                document.querySelectorAll('.btn-excluir');

            botoesExcluir.forEach(botao => {

                botao.addEventListener('click', function (e) {

                    e.preventDefault();

                    const linkExcluir = this.href;

                    Swal.fire({

                        title: 'Tem certeza?',
                        text: 'O funcionário será excluído do sistema.',

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
                                text: 'Funcionário removido com sucesso.',

                                icon: 'success',

                                timer: 1500,
                                showConfirmButton: false

                            }).then(() => {

                                window.location.href =
                                    linkExcluir;

                            });

                        }

                    });

                });

            });

        });

    </script>

    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>

    <script>
        function detalhesFazenda(fazendas)
        {
            let listaHtml = '';

            // separa as fazendas
            let arrayFazendas = fazendas.split('|');

            arrayFazendas.forEach(function(fazenda)
            {
                if(fazenda.trim() != '')
                {
                    listaHtml += `
                        <div style="
                            background: #f5f5f5;
                            padding: 10px;
                            border-radius: 10px;
                            margin-bottom: 10px;
                            text-align: left;
                        ">
                            <i class="fa-solid fa-cow" style="color: #4CAF50;"></i>
                            ${fazenda}
                        </div>
                    `;
                }
            });

            Swal.fire({
                title: 'Fazendas Vinculadas',
                icon: 'info',

                html: `
                    <div style="margin-top:15px;">
                        ${listaHtml}
                    </div>
                `,

                confirmButtonText: 'Fechar',
                confirmButtonColor: '#4CAF50'
            });
        }
    </script>

</body>

</html>