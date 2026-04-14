<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Segoe UI,sans-serif}

        body{
            background: #052501;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px}

        .container{background:white;
            padding:30px;
            border-radius:16px;
            box-shadow:0 20px 40px rgba(0,0,0,0.1);
            width:100%;
            max-width:350px;
            text-align:center}

        .header{margin-bottom:25px}

        .header i{font-size:2.5rem;
            color: #4bc714;
            margin-bottom:10px}

        h1{color: #4bc714;
            font-size:1.3rem;
            margin-bottom:5px}

        .info{margin-bottom:25px}

        .avatar{width:80px;
            height:80px;
            border-radius:50%;
            margin:0 auto 15px;
            border:4px solid #4bc714;
            background: #4bc714;
            color: #052501;
            font-weight:bold;
            font-size:1.5rem;
            display:flex;
            align-items:center;
            justify-content:center}

        .nome{color: #052501;
            font-size:1.1rem;
            font-weight:500;
            margin-bottom:5px}

        .email{color: #052501;
            font-size:0.9rem}

        .btn{width:100%;
            padding:14px;
            border:none;
            border-radius:8px;
            font-weight:bold;
            cursor:pointer;
            transition:all 0.3s;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            font-size:1rem;
            margin-bottom:10px}

        .logout{background:#d32f2f;
            color:white}

        .logout:hover{background:#b71c1c;
            transform:translateY(-1px)}

        .foto{background:transparent;
            color:#2E7D32;
            border:2px solid #2E7D32}

        .foto:hover{background:#2E7D32;
            color:white}

        .back{margin-top:15px}

        .back a{color: #052501;
            text-decoration:none;
            font-weight:500;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:5px}

        .back a:hover{text-decoration:underline}

        @media(max-width:480px){.container{padding:25px 20px}}
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <i class="fas fa-user"></i>
            <h1>Meu Perfil</h1>
        </div>

        <div class="info">
            <div class="avatar" id="avatar">JD</div>
            <div class="nome" id="nomeUsuario">João da Silva</div>
            <div class="email" id="emailUsuario">joao@farmsi.com</div>
        </div>

        <button id="logoutBtn" class="btn logout">
            <i class="fas fa-sign-out-alt"></i> Sair da Conta
        </button>

        <div class="back">
            <a href="dashboard.php">
                <i class="fas fa-arrow-left"></i> Voltar ao Dashboard
            </a>
        </div>
    </div>

    <script>
        // Dados do usuário 
        const usuario = {
            nome: 'João da Silva',
            email: 'joao@farmsi.com',
            initials: 'US'
        };

        // Preenche perfil
        document.getElementById('avatar').textContent = usuario.initials;
        document.getElementById('nomeUsuario').textContent = usuario.nome;
        document.getElementById('emailUsuario').textContent = usuario.email;

        // Logout
        document.getElementById('logoutBtn').onclick = function() {
            if(confirm('Deseja realmente sair da conta?')){
                // Limpa dados locais
                localStorage.clear();
                sessionStorage.clear();
                
                // Redireciona para login
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 500);
            }
        };
    </script>
</body>
</html>