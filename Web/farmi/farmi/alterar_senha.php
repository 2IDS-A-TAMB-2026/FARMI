<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha - FARMI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #052501 0%, #052501 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header i {
            font-size: 3rem;
            color: #4bc714; 
            margin-bottom: 10px;
        }

        .header h1 {
            color: #4bc714; 
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #052501; mudar
            box-shadow: 0 0 0 3px rgba(46,125,50,0.1);
        }

        .password-requirements {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            color: #666;
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: #4bc714;
            color: white;
        }

        .btn-primary:hover {
            background: #1b5e20;
            transform: translateY(-2px);
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #052501;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <i class="fas fa-lock"></i>
            <h1>Alterar Senha</h1>
            <p>Digite sua nova senha</p>
        </div>

        <form id="changePasswordForm">
            <div class="form-group">
                <label><i class="fas fa-lock"></i> Senha Atual</label>
                <input type="password" id="currentPassword" placeholder="Senha atual" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-key"></i> Nova Senha</label>
                <input type="password" id="newPassword" placeholder="Nova senha" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-check"></i> Confirmar Nova Senha</label>
                <input type="password" id="confirmPassword" placeholder="Confirmar nova senha" required>
            </div>

            <div class="password-requirements">
                <strong>Senha deve conter:</strong><br>
                - Mínimo 8 caracteres<br>
                - Pelo menos 1 número<br>
                - Pelo menos 1 letra maiúscula
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Alterar Senha
            </button>
        </form>

        <div class="back-link">
            <a href="configuracoes.php">
                <i class="fas fa-arrow-left"></i>
                Voltar às Configurações
            </a>
        </div>
    </div>

    <script>
        const form = document.getElementById('changePasswordForm');
        const newPassword = document.getElementById('newPassword');
        const confirmPassword = document.getElementById('confirmPassword');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const currentPass = document.getElementById('currentPassword').value;
            const newPass = newPassword.value;
            const confirmPass = confirmPassword.value;

            if (newPass !== confirmPass) {
                alert('As senhas não coincidem!');
                return;
            }

            if (newPass.length < 8) {
                alert('A senha deve ter pelo menos 8 caracteres!');
                return;
            }

            if (!/[A-Z]/.test(newPass) || !/[0-9]/.test(newPass)) {
                alert('A senha deve conter pelo menos 1 letra maiúscula e 1 número!');
                return;
            }

            // Aqui você enviaria para o servidor
            alert('Senha alterada com sucesso! 🎉');
            form.reset();
        });
    </script>
</body>
</html>