<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor - Gerenciar Funcionários</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style.css') ?>">
    
    <style>
    /* CSS unificado, espaçado e com o botão de contraste preto */
    #aumentar-fonte,
    #diminuir-fonte,
    #resetar-fonte {
        width: 42px;
        height: 42px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        background: #57c91b;
        color: white;
        font-weight: bold;
        margin-left: 5px;
        transition: .3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* ESTILIZAÇÃO DO BOTÃO DE CONTRASTE (PRETO) */
    #contraste-btn {
        width: 42px;
        height: 42px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        background: #000; /* Fundo Preto */
        color: #000;     /* Ícone Branco */
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

    /* Efeito de hover mantendo as cores corretas */
    #contraste-btn:hover {
        transform: scale(1.05);
        background: #000; /* Mantém preto no hover */
        color: #fff;
    }

    #aumentar-fonte:hover,
    #diminuir-fonte:hover,
    #resetar-fonte:hover {
        transform: scale(1.05);
    }
    
    .user-profile {
        display: flex;
        align-items: center;
    }
</style>
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
            <a href="<?= base_url('/cultura-admin') ?>" class="menu-item "><i class="fa-solid fa-seedling"></i> Culturas</a>
            <a href="<?= base_url('/usuarios-admin') ?>" class="menu-item active"><i class="fa-solid fa-users"></i> Funcionários</a>
            <a href="<?= base_url('/sensor') ?>"  class="menu-item"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="<?= base_url('/alertas-admin') ?>"  class="menu-item "><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
           <a href="<?= base_url('/configuracoes-admin') ?>" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
            
        </nav>
    </aside>

    <main class="main-content">
        
        <header class="header">
            <div>
                <h2>Gerenciar Funcionários</h2>
                <p style="color: #666;">Painel de Gestão</p>
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
                <i class="fa-solid fa-user-plus"></i>
                Editar Funcionário
            </h3>
            <form action="<?= base_url('usuarios/atualizar/'.$usuarios['CPF']) ?>" method="post"
                id="formUsuario" class="form-grid" >
                <div class="form-group">
                    <label for="nome">
                        <i class="fa-solid fa-user"></i>
                        Nome Completo *
                    </label>
                    <input type="text" id="NOME" name="NOME"  value="<?= $usuarios['NOME'] ?>" />
                </div>

                <div class="form-group">
                    <label for="EMAIL">
                        <i class="fa-solid fa-envelope"></i>
                        E-mail *
                    </label>
                    <input type="EMAIL" id="EMAIL" name="EMAIL" required value= <?= $usuarios['EMAIL'] ?> >
                </div>

                <div class="form-group">
                    <label for="PERFIL">
                        <i class="fa-solid fa-user-tag"></i>
                        Perfil *
                    </label>
                    <select id="PERFIL" name="PERFIL" required >
                        <option value="">Selecione o perfil</option>
                        <option value="Gestor"
                        <?= $usuarios['PERFIL'] == 'Gestor' ? 'selected' : '' ?>>
                        Gestor
                        </option>
                        <option value="Funcionário"
                        <?= $usuarios['PERFIL'] == 'Funcionário' ? 'selected' : '' ?>>
                        Funcionário
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="CPF">
                        <i class="fa-solid fa-id-card"></i>
                        CPF *
                    </label>
                    <input type="CPF" id="CPF" name="CPF" required value="<?= $usuarios['CPF'] ?>">
                </div>

                <div class="form-group">
                    <label for="STATUS">
                        <i class="fa-solid fa-toggle-on"></i>
                        Status Inicial *
                    </label>
                    <select id="STATUS" name="STATUS">
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
                                        value="<?= $fazenda['ID_FAZENDA']; ?>"
                                        <?= in_array(
                                                $fazenda['ID_FAZENDA'],
                                                $fazendasSelecionadas
                                            ) ? 'checked' : ''; ?>
                                    >

                                    <?= $fazenda['NOME']; ?>
                                </label>
                            <?php endforeach; ?>

                        </div>

                    </div>

                </div>

                <script>
                function toggleDropdown() {
                var dropdown = document.getElementById("dropdown");
                dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
                }
                </script>

                <div style="grid-column: 1 / -1; display: flex; gap: 15px; align-items: end;">

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-user-pen"></i>
                        Editar Funcionário
                    </button>

                    <a href="<?= base_url('/usuarios-admin') ?>"
                       class="btn btn-secondary"
                       style="text-decoration:none; display:flex; align-items:center; gap:8px;">
                        <i class="fa-solid fa-arrow-left"></i>
                        Voltar
                    </a>

                </div>
            </form>
        </div>
    </main>
    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const cpf = document.querySelector('#cpf');

    if (!cpf) return;

    cpf.addEventListener('input', function () {
        let v = cpf.value.replace(/\D/g, '').slice(0, 11);

        // aplica máscara progressiva
        v = v.replace(/^(\d{3})(\d)/, '$1.$2');
        v = v.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
        v = v.replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3-$4');

        cpf.value = v;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const senha = document.querySelector('#senha');

    if (!senha) return;

    senha.addEventListener('input', function () {
        const v = senha.value;

        if (v.length < 8) {
            senha.style.border = '2px solid red';
        } else {
            senha.style.border = '2px solid green';
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const email = document.querySelector('#email');

    if (!email) return;

    email.addEventListener('blur', function () {
        const v = email.value;

        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (v && !regex.test(v)) {
            alert('Email inválido!');
            email.style.border = '2px solid red';
        } else {
            email.style.border = '';
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const nome = document.querySelector('#nome');

    if (!nome) return;

    nome.addEventListener('input', function () {
        let v = nome.value;

        // remove números e símbolos
        v = v.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');

        nome.value = v;
    });
});
if(document.getElementById('DATA_CADASTRO')) {
    document.getElementById('DATA_CADASTRO').addEventListener('change', function() {
        const dataSelecionada = new Date(this.value);
        const hoje = new Date();
        hoje.setHours(0, 0, 0, 0);

        if (dataSelecionada > hoje) {
            this.value = '';
            Swal.fire({
                icon: 'error',
                title: 'Data inválida',
                text: 'A data de cadastro não pode ser maior que a data atual.',
                confirmButtonColor: '#57c91b'
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {

    let tamanhoFonte = parseFloat(localStorage.getItem('tamanhoFonte')) || 100;

    aplicarFonte(tamanhoFonte);

    document.getElementById('aumentar-fonte').addEventListener('click', function () {
        tamanhoFonte += 10;
        aplicarFonte(tamanhoFonte);
    });

    document.getElementById('diminuir-fonte').addEventListener('click', function () {
        tamanhoFonte -= 10;

        if (tamanhoFonte < 80) {
            tamanhoFonte = 80;
        }

        aplicarFonte(tamanhoFonte);
    });

    document.getElementById('resetar-fonte').addEventListener('click', function () {
        tamanhoFonte = 100;
        aplicarFonte(tamanhoFonte);
    });

    function aplicarFonte(valor) {
        document.body.style.fontSize = valor + '%';
        localStorage.setItem('tamanhoFonte', valor);
    }

});

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formUsuario');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Confirmar edição?',
            text: 'Deseja realmente salvar as alterações deste funcionário?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#57c91b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, editar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Editando...',
                    text: 'Salvando alterações.',
                    icon: 'success',
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    form.submit();
                }, 1200);
            }
        });
    });

});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>