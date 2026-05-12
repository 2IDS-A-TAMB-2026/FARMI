<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FARMI Gestor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style_dashboard.css">
</head>
<body>
     <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Gestor
        </div>
        <nav>
            <a href="dashboard.php" class="menu-item active"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="fazendas.php" class="menu-item"><i class="fa-solid fa-cow"></i> Fazendas</a>
            <a href="cultura.php" class="menu-item "><i class="fa-solid fa-seedling"></i> Culturas</a>
            <a href="usuarios.php" class="menu-item"><i class="fa-solid fa-users"></i> Usuários</a>
            <a href="sensores.php" class="menu-item"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="alertas.php" class="menu-item "><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
            <a href="configuracoes.php" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
        </nav>
        </nav>
    </aside>

    <!-- Conteúdo Principal -->
    <main class="main-content">
        <header class="header">
            <div>
                <h2>Dashboard</h2>
                <p style="color: #666;">Visão geral do sistema</p>
            </div>
            <div class="avatar">G</div>
        </header>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="card">
                <div>
                    <h3>Sensores Totais</h3>
                    <p>4</p>
                </div>
                <i class="fa-solid fa-satellite-dish" style="color: var(--verde-claro)"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Fazendas</h3>
                    <p>3</p>
                </div>
                <i class="fa-solid fa-cow" style="color: var(--verde-claro)"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Usuários</h3>
                    <p>4</p>
                </div>
                <i class="fa-solid fa-users" style="color: var(--verde-claro)"></i>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="charts-grid">
            <div class="chart-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-chart-line"></i> Monitoramento
                </h3>
                <div style="height: 300px; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #666;">
                    📊
                </div>
            </div>
            <div class="chart-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-circle-info"></i> Culturas
                </h3>
                <div class="status-item">
                    <div class="status-indicator status-online"><i class="fa-solid fa-server"></i></div>
                    <h4>Servidor</h4><p>Online</p>
                </div>
                <div class="status-item">
                    <div class="status-indicator status-online"><i class="fa-solid fa-database"></i></div>
                    <h4>DB</h4><p>Online</p>
                </div>
            </div>
        </div>

        <!-- Activities & Alerts -->
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
            <div class="activities-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-clock-rotate-left"></i> Atividades
                </h3>
                <div class="activity-item">
                    <div class="activity-icon" style="background: rgba(76,199,20,.2); color: var(--verde-claro)">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Novo sensor</h4>
                        <p>Estufa C • 2min</p>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon" style="background: rgba(33,150,243,.2); color: var(--azul)">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Novo usuário</h4>
                        <p>João Silva • 1h</p>
                    </div>
                </div>
            </div>

            <div class="activities-card">
                <h3 class="chart-title">
                    <i class="fa-solid fa-bell"></i> Alertas (3)
                </h3>
                <div style="height: 200px; background: linear-gradient(135deg, #fff5f5 0%, #ffebee 100%); border-radius: 8px; padding: 15px; overflow-y: auto; font-size: .9rem;">
                    <div style="color: var(--vermelho); margin-bottom: 10px;">⚠️ Temp alta Estufa A</div>
                    <div style="color: var(--laranja); margin-bottom: 10px;">🌡️ Umidade baixa Campo B</div>
                    <div style="color: var(--azul);">💡 Luz fraca Estufa C</div>
                </div>
                <a href="alertas.php" class="btn" style="width: 100%; justify-content: center; margin-top: 10px;">Alertas</a>
            </div>
        </div>
    </main>
</body>
</html>