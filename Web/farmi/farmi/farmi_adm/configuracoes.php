<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - Fazenda Inteligente</title>
    <!-- Ícones (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style_config.css">
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Gestor
        </div>
        <nav>
            <a href="dashboard.php" class="menu-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="fazendas.php" class="menu-item"><i class="fa-solid fa-cow"></i> Fazendas</a>
            <a href="cultura.php" class="menu-item "><i class="fa-solid fa-seedling"></i> Culturas</a>
            <a href="usuarios.php" class="menu-item"><i class="fa-solid fa-users"></i> Usuários</a>
            <a href="sensores.php" class="menu-item"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="alertas.php" class="menu-item "><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
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
                    <a href="#" class="alterar"><i></i></i> G</a>
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

                <a href="alterar_senha_admin.php ">
                <button type="button" class="btn btn-outline">
                    <i class="fa-solid fa-envelope-open-text"></i></i> Alterar senha
                </button>
                </a>
            </div>

            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-envelope"></i> 
                    <span>Esqueci minha senha</span>
                </div>

                <a href="recuperar_senha_admin.php" class="alterar">
                <button class="btn btn-secondary">
                    <i class="fa-solid fa-envelope-open-text"></i> Recuperar
                </button>
                </a>
            </div>

            <div class="security-item">
                <div class="info">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
</body>
</html>



       