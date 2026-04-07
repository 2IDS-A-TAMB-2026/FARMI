<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - Fazenda Inteligente</title>
    <!-- Ícones (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --verde-escuro: #052501;
            --verde-claro: #4bc714;
            --verde-claro-hover: #66bb6a;
            --branco: #ffffff;
            --cinza-fundo: #f4f6f8;
            --texto-escuro: #333333;
            --sombra: 0 4px 6px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #052501;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .recover-container {
            background: var(--branco);
            padding: 40px;
            border-radius: 12px;
            box-shadow: var(--sombra);
            border-left: 5px solid var(--verde-escuro);
            max-width: 450px;
            width: 100%;
        }

        .recover-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .recover-header .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--verde-escuro);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .recover-header .logo i {
            color: var(--verde-claro);
            font-size: 2rem;
        }

        .recover-header h2 {
            color: var(--verde-escuro);
            margin-bottom: 10px;
        }

        .recover-header p {
            color: #666;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: var(--texto-escuro);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: 0.3s;
            background-color: var(--branco);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--verde-claro);
            box-shadow: 0 0 0 3px rgba(129, 199, 132, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: var(--verde-escuro);
            color: var(--branco);
        }

        .btn-primary:hover {
            background-color: #4bc714;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--verde-escuro);
            border: 2px solid var(--verde-escuro);
        }

        .btn-secondary:hover {
            background-color: #4bc714;
            color: var(--branco);
        }

        .steps-indicator {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .step {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ddd;
            transition: 0.3s;
        }

        .step.active {
            background-color: var(--verde-claro);
            transform: scale(1.2);
        }

        .step.completed {
            background-color: var(--verde-escuro);
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
        }

        .alert-success {
            background-color: rgba(129, 199, 132, 0.2);
            color: var(--verde-escuro);
            border-left: 4px solid var(--verde-escuro);
        }

        .alert-warning {
            background-color: rgba(255, 193, 7, 0.2);
            color: #f57f17;
            border-left: 4px solid #f57f17;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: var(--verde-escuro);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: 0.3s;
        }

        .back-link a:hover {
            color: var(--verde-claro-hover);
        }

        /* RESPONSIVO */
        @media (max-width: 480px) {
            .recover-container {
                padding: 30px 20px;
                margin: 10px;
            }
            
            .recover-header .logo {
                font-size: 1.5rem;
            }
        }
    </style>
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
            <a href="login.php">
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
                        window.location.href = 'login.php';
                    }, 1500);
                }, 2000);
            }
        });
    </script>
</body>
</html>