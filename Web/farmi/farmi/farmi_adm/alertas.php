<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertas - FARMI Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style_alertas.css">
</head>
<body>
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            FARMI Admin
        </div>
        <nav>
            <a href="dashboard.php" class="menu-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="sensores.php" class="menu-item"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="usuarios.php" class="menu-item"><i class="fa-solid fa-users"></i> Usuários</a>
            <a href="fazendas.php" class="menu-item"><i class="fa-solid fa-cow"></i> Fazendas</a>
            <a href="cultura.php" class="menu-item "><i class="fa-solid fa-seedling"></i> Culturas</a>
            <a href="alertas.php" class="menu-item active"><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
            <a href="configuracoes.php" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
        </nav>
    </aside>

    <!-- Conteúdo Principal -->
    <main class="main-content">
        <header class="header">
            <div>
                <h2>Alertas dos Sensores</h2>
                <p style="color: #666;">Monitoramento em tempo real dos alertas</p>
            </div>
            <div class="header-actions">
                <a href="#" class="btn btn-secondary">
                    <i class="fa-solid fa-filter"></i> Filtros
                </a>
                <div class="avatar">ADM</div>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="card">
                <div>
                    <h3>Alertas Ativos</h3>
                    <p style="color: var(--vermelho);">12</p>
                </div>
                <i class="fa-solid fa-triangle-exclamation" style="color: var(--vermelho); font-size: 2.5rem;"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Críticos</h3>
                    <p style="color: var(--vermelho);">3</p>
                </div>
                <i class="fa-solid fa-fire" style="color: var(--vermelho); font-size: 2.5rem;"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Médios</h3>
                    <p style="color: var(--laranja);">5</p>
                </div>
                <i class="fa-solid fa-exclamation-triangle" style="color: var(--laranja); font-size: 2.5rem;"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Baixos</h3>
                    <p style="color: var(--azul);">4</p>
                </div>
                <i class="fa-solid fa-bell" style="color: var(--azul); font-size: 2.5rem;"></i>
            </div>
        </div>

        <!-- Alertas Container -->
        <div class="alerts-container">
          

            <div class="alerts-list">
                <!-- Alerta Crítico -->
                <div class="alert-item alert-critico">
                    <div class="alert-icon">
                        <i class="fa-solid fa-temperature-high"></i>
                    </div>
                    <div class="alert-content">
                        <h4>Temperatura Crítica - Estufa A</h4>
                        <p>Temp: 38.2°C (Limite: 32°C) - Risco de dano às plantas</p>
                        <div class="alert-meta">
                            <span class="alert-time"><i class="fa-solid fa-clock"></i> 12min atrás</span>
                            <span class="alert-status status-ativo">Ativo</span>
                        </div>
                    </div>
                </div>

                <!-- Alerta Médio -->
                <div class="alert-item alert-medio">
                    <div class="alert-icon">
                        <i class="fa-solid fa-tint"></i>
                    </div>
                    <div class="alert-content">
                        <h4>Umidade Baixa - Campo B</h4>
                        <p>Umidade: 22% (Limite: 35%) - Solo seco</p>
                        <div class="alert-meta">
                            <span class="alert-time"><i class="fa-solid fa-clock"></i> 45min atrás</span>
                            <span class="alert-status status-ativo">Ativo</span>
                        </div>
                    </div>
                </div>

                <!-- Alerta Crítico -->
                <div class="alert-item alert-critico">
                    <div class="alert-icon">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div class="alert-content">
                        <h4>Falha Elétrica - Estufa C</h4>
                        <p>Sensor de solo desconectado - Sistema  parado</p>
                        <div class="alert-meta">
                            <span class="alert-time"><i class="fa-solid fa-clock"></i> 1h atrás</span>
                            <span class="alert-status status-ativo">ativo</span>
                        </div>
                    </div>
                </div>

                <!-- Alerta Baixo -->
                <div class="alert-item alert-baixo">
                    <div class="alert-icon">
                        <i class="fa-solid fa-sun"></i>
                    </div>
                    <div class="alert-content">
                        <h4>Baixa Luminosidade - Estufa D</h4>
                        <p>Luz: 280 lux (Ideal: 450 lux) - Suplementação necessária</p>
                        <div class="alert-meta">
                            <span class="alert-time"><i class="fa-solid fa-clock"></i> 2h atrás</span>
                            <span class="alert-status status-ativo">Ativo</span>
                        </div>
                    </div>
                </div>

                <!-- Mais alertas... -->
                <div class="alert-item alert-medio">
                    <div class="alert-icon">
                        <i class="fa-solid fa-wind"></i>
                    </div>
                    <div class="alert-content">
                        <h4>Vento Forte - Campo A</h4>
                        <p>Velocidade: 28 km/h (Limite: 25 km/h)</p>
                        <div class="alert-meta">
                            <span class="alert-time"><i class="fa-solid fa-clock"></i> 3h atrás</span>
                            <span class="alert-status status-ativo">Ativo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>