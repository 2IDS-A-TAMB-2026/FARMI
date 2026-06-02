<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Configurações - Fazenda Inteligente</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_config.css') ?>">

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

            <a href="<?= base_url('/sensor') ?>" class="menu-item">
                <i class="fa-solid fa-satellite-dish"></i>
                Sensores
            </a>

            <a href="<?= base_url('/alertas-admin') ?>" class="menu-item">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Alertas
            </a>

            <a href="<?= base_url('/configuracoes-admin') ?>" class="menu-item active">
                <i class="fa-solid fa-gear"></i>
                Configurações
            </a>

        </nav>

    </aside>

    <main class="main-content">

        <header class="header">

            <div>
                <h2>Configurações e Perfil</h2>
                <p style="color: #666;">Gerencie suas informações e preferências.</p>
            </div>

            <div class="user-profile">

                <button id="contraste-btn" aria-label="Alterar contraste">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>

                <button id="aumentar-fonte" aria-label="Aumentar tamanho do texto">A+</button>
                <button id="diminuir-fonte" aria-label="Diminuir tamanho do texto">A-</button>
                <button id="resetar-fonte" aria-label="Tamanho de texto normal">A</button>

                <button class="avatar">
                    <a href="#" class="alterar">
                        <p>G</p>
                    </a>
                </button>

            </div>

        </header>

        <div class="alert alert-success">
            <i class="fa-solid fa-check-circle"></i>
            <span>Configurações salvas com sucesso!</span>
        </div>

        <div class="config-grid">

            <div class="card">

                <h3>
                    <i class="fa-solid fa-address-book"></i>
                    Informações de Contato
                </h3>

                <div class="form-group">
                    <label>Nome Completo:</label>
                    <input type="text" name="nome" id="name" placeholder="Nome....">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" placeholder="nome@email.com">
                </div>

                <div class="form-group">
                    <label>Telefone</label>
                    <input type="tel" name="tel" id="tel" placeholder="(00)00000-0000">
                </div>

                <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 20px;">
                    <button class="btn btn-primary" id="btnSalvar">
                        <i class="fa-solid fa-save"></i>
                        Salvar
                    </button>

                    <button class="btn btn-secondary">
                        <i class="fa-solid fa-undo"></i>
                        Cancelar
                    </button>

                    <a href="<?= base_url('/logout') ?>" style="text-decoration: none;">
                        <button class="btn btn-secondary" type="button">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                    </a>
                </div>

            </div>
        </div>

        <div class="security-section">

            <h3>
                <i class="fa-solid fa-shield-alt"></i>
                Segurança
            </h3>

            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-lock"></i>
                    <span>Senha</span>
                </div>

                <a href="<?= base_url('/alterar-senha-admin') ?>">
                    <button type="button" class="btn btn-outline">
                        <i class="fa-solid fa-envelope-open-text"></i>
                        Alterar senha
                    </button>
                </a>
            </div>

            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Esqueci minha senha</span>
                </div>

                <a href="<?= base_url('/recuperar-senha-admin') ?>" class="alterar">
                    <button class="btn btn-secondary">
                        <i class="fa-solid fa-envelope-open-text"></i>
                        Recuperar
                    </button>
                </a>
            </div>

            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>

        </div>

    </main>

    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>

    <script>
        /* ==========================================
           ACESSIBILIDADE: FONTE (AUMENTAR / DIMINUIR)
           ========================================== */
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

        /* =========================
           SWEET ALERT CONFIRMAR SALVAR
           ========================= */
        const btnSalvar = document.getElementById('btnSalvar');

        if(btnSalvar){
            btnSalvar.addEventListener('click', function(e){
                e.preventDefault();

                Swal.fire({
                    title: 'Salvar alterações?',
                    text: 'Deseja realmente salvar as informações do funcionário?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2e7d32',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sim, salvar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if(result.isConfirmed){
                        Swal.fire({
                            title: 'Salvo!',
                            text: 'As informações foram updated com sucesso.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            });
        }

        /* =========================
           MÁSCARA NOME
           ========================= */
        const name = document.getElementById('name');

        if(name){
            name.addEventListener('keyup', (e) => {
                let value = e.target.value;
                value = value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');
                value = value.replace(/\s+/g, ' ');
                e.target.value = value;
            });
        }

        /* =========================
           MÁSCARA TELEFONE
           ========================= */
        const tel = document.getElementById('tel');

        if(tel){
            tel.addEventListener('input', function () {
                let v = tel.value.replace(/\D/g, '');
                v = v.slice(0, 11);

                if (v.length <= 2) {
                    v = v.replace(/(\d{0,2})/, '($1');
                } else if (v.length <= 6) {
                    v = v.replace(/(\d{2})(\d+)/, '($1) $2');
                } else if (v.length <= 10) {
                    v = v.replace(/(\d{2})(\d{4})(\d+)/, '($1) $2-$3');
                } else {
                    v = v.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                }
                tel.value = v;
            });
        }

        /* =========================
           VALIDAÇÃO EMAIL
           ========================= */
        const email = document.querySelector('#email');

        if(email){
            email.addEventListener('blur', function () {
                const v = email.value;
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (v && !regex.test(v)) {
                    Swal.fire({
                        title: 'Email inválido!',
                        text: 'Digite um endereço de email válido.',
                        icon: 'error',
                        confirmButtonColor: '#d33'
                    });
                    email.style.border = '2px solid red';
                } else {
                    email.style.border = '';
                }
            });
        }
    </script>
</body>

</html>