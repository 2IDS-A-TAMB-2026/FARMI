<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha - FARMI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style_alterar.css">
</head>
<body>
    
    <div class="container">
        <div class="header">
            <i class="fas fa-lock"></i>
            <h1>Alterar Senha</h1>
            <p>Digite sua nova senha</p>
        </div>

        <form id="changePasswordForm">
            <button id="contraste-btn" aria-label="Alterar contraste"><i class="fa-solid fa-circle-half-stroke"></i></button>
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


    <script src="./../script.js"></script>
</body>
</html>