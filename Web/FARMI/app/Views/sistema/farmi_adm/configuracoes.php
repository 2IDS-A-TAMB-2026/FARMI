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
.campo-visualizacao {
    width: 100%;
    padding: 14px 16px;
    border-radius: 12px;
    background: linear-gradient(145deg, #f9f9f9, #f1f1f1);
    border: 1px solid #e3e3e3;
    font-size: 15px;
    color: #333;
    min-height: 45px;
    display: flex;
    align-items: center;
    transition: 0.3s;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.campo-visualizacao:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.1);
    border-color: #58CC02;
}
.form-group label {
    font-weight: 600;
    font-size: 13px;
    color: #555;
    margin-bottom: 6px;
    display: block;
    letter-spacing: 0.3px;
}
.card {
    background: #fff;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    border: 1px solid #eee;
    transition: 0.3s;
}

.card:hover {
    box-shadow: 0 12px 35px rgba(0,0,0,0.12);
}
h3 {
    font-size: 18px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #2e2e2e;
    margin-bottom: 20px;
}

h3 i {
    color: #58CC02;
}

body.contraste .campo-visualizacao {
    background: #000 !important;
    color: #fff !important;
    border: 2px solid #fff !important;
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

        

        <div class="config-grid">

            <div class="card">

                <h3>
                    <i class="fa-solid fa-address-book"></i>
                    Informações do Perfil
                </h3>

                <div class="form-group">
    <label>Nome Completo:</label>
    <div class="campo-visualizacao">
        <?= esc($usuario['NOME']) ?>
    </div>
</div>

                <div class="form-group">
    <label>CPF:</label>
    <div class="campo-visualizacao">
        <?= esc($usuario['CPF']) ?>
    </div>
</div>

<div class="form-group">
    <label>Email:</label>
    <div class="campo-visualizacao">
        <?= esc($usuario['EMAIL']) ?>
    </div>
</div>

<div class="form-group">
    <label>Perfil:</label>
    <div class="campo-visualizacao">
        <?= esc($usuario['PERFIL']) ?>
    </div>
</div>

<div class="form-group">
    <label>Data de cadastro:</label>
    <div class="campo-visualizacao">
        <?= isset($usuario['DATA_CADASTRO']) 
            ? date('d/m/Y H:i', strtotime($usuario['DATA_CADASTRO'])) 
            : 'Não informado' ?>
    </div>
</div>

<div class="form-group">
    <label>Status:</label>
    <div class="campo-visualizacao">
        <?= esc($usuario['STATUS']) ?>
    </div>
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

            </div>

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

    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>

    <script>
        /* ==========================================
           ACESSIBILIDADE: FONTE (AUMENTAR / DIMINUIR)
           ========================================== */
        document.addEventListener('DOMContentLoaded', () => {
            const contrasteBtn = document.getElementById('contraste-btn');
    if (contrasteBtn) {
        contrasteBtn.addEventListener('click', () => {
            document.body.classList.toggle('contraste');
        });
    }

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