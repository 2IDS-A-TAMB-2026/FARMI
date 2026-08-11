<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha - FARMI</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style_alterar.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ========================================================
           BARRA E BOTÕES DE ACESSIBILIDADE CORRIGIDOS EM LINHA
           ======================================================== */
        
        /* Garante que o card principal seja a referência e dê espaço no topo */
        .container {
            position: relative !important;
            padding-top: 75px !important; 
            box-sizing: border-box !important;
            overflow: visible !important; /* Impede que os botões deformem ou sumam para fora */
        }

        /* Container que alinha os botões horizontalmente no topo direito interno */
        .acessibilidade-container {
            position: absolute !important;
            top: 20px !important;
            right: 20px !important;
            display: flex !important;
            flex-direction: row !important; /* Força os botões a ficarem na mesma linha */
            align-items: center !important;
            gap: 6px !important;            /* Distância exata entre eles */
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            z-index: 100 !important;
        }

        /* Estilo base dos botões reduzido para caber perfeitamente no card */
        .acessibilidade-container button {
            background: #57c91b !important;
            border: none !important;
            border-radius: 5px !important;
            width: 34px !important;         /* Tamanho ajustado para não estourar */
            height: 34px !important;        /* Tamanho ajustado para não estourar */
            font-weight: bold !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: 0.2s !important;
            color: #fff !important;
            font-size: 13px !important;     /* Fonte proporcional ao botão */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box !important;
        }

        /* Botão de Contraste (Totalmente Preto com ícone Branco) */
        #contraste-btn {
            background: #000000 !important;
            color: #ffffff !important;
        }

        /* Efeito Hover padrão */
        .acessibilidade-container button:hover {
            opacity: .85 !important;
        }

        @media (max-width: 768px) {
            .container {
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
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="acessibilidade-container">
            <button id="contraste-btn" type="button" aria-label="Alterar contraste">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>
            <button id="aumentar-fonte" type="button" aria-label="Aumentar fonte">A+</button>
            <button id="diminuir-fonte" type="button" aria-label="Diminuir fonte">A-</button>
            <button id="resetar-fonte" type="button" aria-label="Resetar fonte">A</button>
        </div>

        <div class="header">
            <i class="fas fa-lock"></i>
            <h1>Alterar Senha</h1>
            <p>Digite sua nova senha</p>
        </div>

     <form id="changePasswordForm" method="post" action="<?= base_url('/alterar-senha') ?>">

    <div class="form-group">
        <label for="currentPassword">
            <i class="fas fa-lock"></i>
            Senha Atual
        </label>
        <input type="password" id="currentPassword" name="currentPassword" placeholder="Senha atual" required>
    </div>

    <div class="form-group">
        <label for="newPassword">
            <i class="fas fa-key"></i>
            Nova Senha
        </label>
        <input type="password" id="newPassword" name="newPassword" placeholder="Nova senha" maxlength="8" required>
    </div>

    <div class="form-group">
        <label for="confirmPassword">
            <i class="fas fa-check"></i>
            Confirmar Nova Senha
        </label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmar nova senha" maxlength="8" required>
    </div>

    <div class="password-requirements">
        <strong>Senha deve conter:</strong><br>
        - Exatamente 8 caracteres
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>
        Alterar Senha
    </button>

</form>

        <div class="back-link">
            <a href="<?= base_url('/configuracoes-admin') ?>">
                <i class="fas fa-arrow-left"></i>
                Voltar às Configurações
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
        /* ========================================================
           SISTEMA DE ACESSIBILIDADE DE FONTE 
           ======================================================== */
        let tamanhoFonte = 100;

        const aumentarFonte = document.getElementById('aumentar-fonte');
        const diminuirFonte = document.getElementById('diminuir-fonte');
        const resetarFonte = document.getElementById('resetar-fonte');

        function aplicarFonte() {
            document.documentElement.style.fontSize = tamanhoFonte + '%';
            localStorage.setItem('tamanhoFonteAlterar', tamanhoFonte);
        }

        const fonteSalva = localStorage.getItem('tamanhoFonteAlterar');
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

        /* ========================================================
           VALIDAÇÃO DO FORMULÁRIO COM SWEETALERT
           ======================================================== */
        const form = document.getElementById('changePasswordForm');

        form.addEventListener('submit', function(e){
            e.preventDefault();

            const senhaAtual = document.getElementById('currentPassword').value.trim();
            const novaSenha = document.getElementById('newPassword').value.trim();
            const confirmarSenha = document.getElementById('confirmPassword').value.trim();

            if(!senhaAtual || !novaSenha || !confirmarSenha){
                Swal.fire({
                    title: 'Campos obrigatórios!',
                    text: 'Preencha todos os campos.',
                    icon: 'warning',
                    confirmButtonColor: '#2e7d32'
                });
                return;
            }

            if(novaSenha !== confirmarSenha){
                Swal.fire({
                    title: 'Erro!',
                    text: 'As senhas não coincidem.',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
                return;
            }

            const regex = /^.{8}$/;
            if(!regex.test(novaSenha)){
                Swal.fire({
                    title: 'Senha inválida!',
                    text: 'A senha deve ter exatamente 8 caracteres.',
                    icon: 'warning',
                    confirmButtonColor: '#d33'
                });
                return;
            }

            Swal.fire({
                title: 'Salvar alterações?',
                text: 'Deseja realmente alterar sua senha?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2e7d32',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sim, alterar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if(result.isConfirmed){
                    Swal.fire({
                        title: 'Senha altered!',
                        text: 'Sua senha foi atualizada com sucesso.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        form.submit();
                    });
                }
            });
        });
    </script>

    <script src="<?= base_url('assets/js/dashboard/script.js') ?>"></script>

</body>
</html>