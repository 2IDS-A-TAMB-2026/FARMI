<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - Fazenda Inteligente</title>
    <!-- Ícones (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style_recuperar.css">
</head>
<body>
    
    <div class="recover-container">
        <!-- HEADER -->
        <div class="recover-header">
            <div class="logo">
                <i class="fa-solid fa-leaf"></i>
                FARMI
            </div>
            <h2>Recuperar Senha</h2>
            <p>Insira seu email para receber instruções de recuperação</p>
        </div>

        <!-- INDICADOR DE PASSOS -->
        <div class="steps-indicator">
            <div class="step active"></div>
            <div class="step"></div>
            <div class="step"></div>
        </div>

        <!-- ALERTA OPCIONAL -->
        <!-- <div class="alert alert-success">
            <i class="fa-solid fa-check-circle"></i>
            <span>Código de verificação enviado para seu email!</span>
        </div> -->

        <!-- FORMULÁRIO -->
        <form id="recoverForm">
            <div class="form-group">
                <button id="contraste-btn" aria-label="Alterar contraste"><i class="fa-solid fa-circle-half-stroke"></i></button>
                <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Digite seu email cadastrado"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-paper-plane"></i>
                Enviar Link de Recuperação
            </button>

            <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                <i class="fa-solid fa-arrow-left"></i>
                Voltar
            </button>
        </form>

        <!-- LINK PARA VOLTAR -->
        <div class="back-link">
            <a href="#">
                <i class="fa-solid fa-sign-in-alt"></i>
                Fazer Login
            </a>
        </div>
    </div>

    <script>
        // Simulação de envio do formulário
        document.getElementById('recoverForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            
            if (email) {
                // Simular envio
                const btn = this.querySelector('.btn-primary');
                const originalText = btn.innerHTML;
                
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Enviando...';
                btn.disabled = true;
                
                setTimeout(() => {
                    btn.innerHTML = '<i class="fa-solid fa-check"></i> Link enviado!';
                    btn.style.backgroundColor = '#4caf50';
                    
                    setTimeout(() => {
                        alert('Link de recuperação enviado para ' + email + '!');
                        window.location.href = 'login_admin.php';
                    }, 1500);
                }, 2000);
            }
        });
    </script>
    <script src="./../script.js"></script>
</body>
</html>