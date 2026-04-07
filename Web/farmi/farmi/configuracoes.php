<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - Fazenda Inteligente</title>
    <!-- Ícones (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --verde-escuro: #052501;
            --verde-claro: #4bc714;
            --verde-claro-hover: #a2d4a5;
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
            background-color: var(--cinza-fundo);
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 250px;
            background-color: var(--verde-escuro);
            color: var(--branco);
            display: flex;
            flex-direction: column;
            padding: 20px;
            position: fixed;
            height: 100%;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            color: var(--verde-claro);
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: 0.3s;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255,255,255,0.1);
            color: var(--verde-claro);
        }

        .menu-item i {
            margin-right: 15px;
            width: 20px;
        }

        /* --- CONTEÚDO PRINCIPAL --- */
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h2 {
            color: var(--verde-escuro);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background-color: var(--verde-claro);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--verde-escuro);
            font-weight: bold;
        }

        /* --- CARDS DE CONFIGURAÇÕES --- */
        .config-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: var(--branco);
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--sombra);
            border-left: 5px solid var(--verde-escuro);
        }

        .card h3 {
            color: var(--verde-escuro);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* --- PERFIL --- */
        .profile-section {
            text-align: center;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px;
            border: 4px solid var(--verde-claro);
            overflow: hidden;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.3s;
        }

        .profile-photo:hover {
            border-color: var(--verde-escuro);
        }

        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-photo i {
            font-size: 3rem;
            color: var(--verde-claro);
        }

        .profile-photo .upload-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: var(--verde-escuro);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info h4 {
            color: var(--verde-escuro);
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .profile-info p {
            color: #666;
        }

        /* --- FORMULÁRIOS --- */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: var(--texto-escuro);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--verde-claro);
        }

        .form-group input[readonly] {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }

        /* --- BOTÕES --- */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: var(--verde-escuro);
            color: var(--branco);
        }

        .btn-primary:hover {
            background-color: #a2d4a5;
        }

        .btn-secondary {
            background-color: var(--verde-claro);
            color: var(--verde-escuro);
        }

        .btn-secondary:hover {
            background-color: var(--verde-claro-hover);
        }

        .btn-danger {
            background-color: #d32f2f;
            color: var(--branco);
        }

        .btn-danger:hover {
            background-color: #b71c1c;
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--verde-escuro);
            color: var(--verde-escuro);
        }

        .btn-outline:hover {
            background-color: var(--verde-escuro);
            color: var(--branco);
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-group .btn {
            flex: 1;
        }

        /* --- ALERTAS --- */
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
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

        .alert-error {
            background-color: rgba(244, 67, 54, 0.2);
            color: #d32f2f;
            border-left: 4px solid #d32f2f;
        }

        /* --- SEÇÃO DE SEGURANÇA --- */
        .security-section {
            background: var(--branco);
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--sombra);
            margin-bottom: 30px;
        }

        .security-section h3 {
            color: var(--verde-escuro);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .security-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .security-item:last-child {
            border-bottom: none;
        }

        .security-item .info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .security-item .info i {
            color: var(--verde-claro);
            font-size: 1.2rem;
        }

        .security-item .info span {
            color: var(--texto-escuro);
        }

        /* --- FOOTER --- */
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 0.9rem;
        }

        /* --- UPLOAD INPUT --- */
        .file-input {
            display: none;
        }
       

        /* --- RESPONSIVO --- */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .config-grid {
                grid-template-columns: 1fr;
            }
        }
        .alterar {
            text-decoration: none;
            color: #325807;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Usuario
        </div>
        <nav>
            <a href="dashboard.php" class="menu-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="luz.php" class="menu-item "><i class="fa-solid fa-lightbulb"></i> Luz</a>
            <a href="temperatura.php" class="menu-item"><i class="fa-solid fa-temperature-high"></i> Temperatura</a>
            <a href="umidade.php" class="menu-item"><i class="fa-solid fa-droplet"></i> Umidade</a>
            <a href="solo.php" class="menu-item"><i class="fa-solid fa-chart-pie"></i> Solo</a>
            <a href="configuracoes.php" class="menu-item active"><i class="fa-solid fa-gear"></i> Configurações</a>
        </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
        
        <!-- CABEÇALHO -->
        <header class="header">
            <div>
                <h2>Configurações e Perfil</h2>
                <p style="color: #666;">Gerencie suas informações e preferências.</p>
            </div>
            <div class="user-profile">
                    <button class="avatar">
                    <a href="usuario.php " class="alterar"><i></i></i> US</a>
                    </button>
            </div>
        </header>

        <!-- ALERTA DE SUCESSO -->
        <div class="alert alert-success">
            <i class="fa-solid fa-check-circle"></i>
            <span>Configurações salvas com sucesso!</span>
        </div>

        <!-- CONFIGURAÇÕES DE PERFIL -->
        <div class="config-grid">
            
            

            <!-- INFORMAÇÕES DE CONTATO -->
            <div class="card">
                <h3><i class="fa-solid fa-address-book"></i> Informações de Contato</h3>
                <div class="form-group">
                    <label>Nome Completo:</label>
                    <input type="text"  name="nome" placeholder="Nome...." >
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="nome@email.com" >
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="tel" name="number"  placeholder="(00)00000-0000">
                </div>
                <div class="btn-group">
                    <button class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Salvar
                    </button>
                    <button class="btn btn-secondary">
                        <i class="fa-solid fa-undo"></i> Cancelar
                    </button>
                </div>
            </div>

        </div>

        <!-- SEGURANÇA -->
        <div class="security-section">
            <h3><i class="fa-solid fa-shield-alt"></i> Segurança</h3>
            
            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-lock"></i>
                    <span>Senha</span>
                </div>
                <button class="btn btn-outline">
                    <a href="alterar_senha.php " class="alterar"><i class="fa-solid fa-envelope-open-text"></i></i> Alterar senha</a>
                </button>
            </div>

            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-envelope"></i> 
                    <span>Esqueci minha senha</span>
                </div>
                <button class="btn btn-secondary">
                    <a href="recuperar_senha.php" class="alterar"><i class="fa-solid fa-envelope-open-text"></i> Recuperar</a>
                </button>
            </div>

            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
</body>
</html>



                    
