<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazendas - FARMI Gestor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style_alertas.css">
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
            <a href="fazendas.php" class="menu-item active"><i class="fa-solid fa-cow"></i> Fazendas</a>
            <a href="cultura.php" class="menu-item "><i class="fa-solid fa-seedling"></i> Culturas</a>
            <a href="usuarios.php" class="menu-item"><i class="fa-solid fa-users"></i> Usuários</a>
            <a href="sensores.php" class="menu-item"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="alertas.php" class="menu-item "><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
            <a href="configuracoes.php" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
            
        </nav>
    </aside>

    <!-- Conteúdo Principal -->
    <main class="main-content">
        <header class="header">
            <div>
                <h2>Controle de Fazendas</h2>
                <p style="color: #666;">Gerencie todas as fazendas do sistema</p>
            </div>
            <button id="contraste-btn" aria-label="Alterar contraste"><i class="fa-solid fa-circle-half-stroke"></i></button>
            <div class="avatar">G</div>
        </header>

        <!-- Barra de pesquisa -->
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Pesquisar fazendas...">
            <a href="#" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                Pesquisar
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="card">
                <div>
                    <h3>Fazendas Totais</h3>
                    <p>3</p>
                </div>
                <i class="fa-solid fa-cow" style="color: var(--verde-claro)"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Ativas</h3>
                    <p>2</p>
                </div>
                <i class="fa-solid fa-leaf" style="color: var(--verde-claro)"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Sensores</h3>
                    <p>10</p>
                </div>
                <i class="fa-solid fa-satellite-dish" style="color: var(--verde-claro)"></i>
            </div>
            <div class="card">
                <div>
                    <h3>Hectares</h3>
                    <p>2.450 ha</p>
                </div>
                <i class="fa-solid fa-ruler-combined" style="color: var(--verde-claro)"></i>
            </div>
        </div>

        <!-- Grid de Fazendas -->
        <div class="fazendas-grid">
            <!-- Card Adicionar Fazenda -->
            <a href="adicionar_fazenda.php" class="fazenda-card add-fazenda">
                <i class="fa-solid fa-plus"></i>
                <h3 style="color: var(--verde); margin-bottom: 10px;">Adicionar Nova Fazenda</h3>
                <p style="color: #666; font-size: 0.9rem;">Clique para cadastrar</p>
            </a>

            <!-- Fazenda 1 -->
            <div class="fazenda-card">
                <div class="fazenda-header">
                    <div>
                        <h3>Fazenda São João</h3>
                        <p style="opacity: 0.9; font-size: 0.9rem;">Região Sul - 250 ha</p>
                    </div>
                    <div class="fazenda-status">
                        <div class="status-dot status-online"></div>
                        <span>Online</span>
                    </div>
                </div>
                <div class="fazenda-body">
                    <div class="fazenda-info">
                        <div class="info-item">
                            <span class="info-label">Latitude</span>
                            <span class="info-value">-23.334564</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Longitude</span>
                            <span class="info-value">-46.7899987</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Logradouro</span>
                            <span class="info-value">Rodovia José Santos</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Número</span>
                            <span class="info-value">34</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">CEP</span>
                            <span class="info-value">12345-678</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Área total</span>
                            <span class="info-value">50000</span>
                        </div>
                    </div>
                    <div class="fazenda-actions">
                        <a href="#" class="btn btn-primary"><i class="fa-solid fa-trash"></i> Excluir</a>
                        <a href="#" class="btn btn-secondary"><i class="fa-solid fa-pen"></i> Editar</a>
                        <a href="#" class="btn btn-success"><i class="fa-solid fa-play"></i> Ativar</a>
                    </div>
                </div>
            </div>

            <!-- Fazenda 2 -->
            <div class="fazenda-card">
                <div class="fazenda-header">
                    <div>
                        <h3>Fazenda Verde Vale</h3>
                        <p style="opacity: 0.9; font-size: 0.9rem;">Região Norte - 180 ha</p>
                    </div>
                    <div class="fazenda-status">
                        <div class="status-dot status-online"></div>
                        <span>Online</span>
                    </div>
                </div>
                <div class="fazenda-body">
                    <div class="fazenda-info">
                        <div class="info-item">
                            <span class="info-label">Latitude</span>
                            <span class="info-value">-23.334564</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Longitude</span>
                            <span class="info-value">-46.7899987</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Logradouro</span>
                            <span class="info-value">Rodovia José Santos</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Número</span>
                            <span class="info-value">34</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">CEP</span>
                            <span class="info-value">12345-678</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Área total</span>
                            <span class="info-value">50000</span>
                        </div>
                    </div>
                    <div class="fazenda-actions">
                        <a href="#" class="btn btn-primary"><i class="fa-solid fa-trash"></i> Excluir</a>
                        <a href="#" class="btn btn-secondary"><i class="fa-solid fa-pen"></i> Editar</a>
                        <a href="#" class="btn btn-success"><i class="fa-solid fa-play"></i> Ativar</a>
                    </div>
                </div>
            </div>
            <!-- Fazenda 3 -->
            <div class="fazenda-card">
                <div class="fazenda-header">
                    <div>
                        <h3>Fazenda Nova Esperança</h3>
                        <p style="opacity: 0.9; font-size: 0.9rem;">Região Centro - 320 ha</p>
                    </div>
                    <div class="fazenda-status">
                        <div class="status-dot status-offline"></div>
                        <span>Offline</span>
                    </div>
                </div>
                <div class="fazenda-body">
                    <div class="fazenda-info">
                        <div class="info-item">
                            <span class="info-label">Latitude</span>
                            <span class="info-value">-23.334564</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Longitude</span>
                            <span class="info-value">-46.7899987</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Logradouro</span>
                            <span class="info-value">Rodovia José Santos</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Número</span>
                            <span class="info-value">34</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">CEP</span>
                            <span class="info-value">12345-678</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Área total</span>
                            <span class="info-value">50000</span>
                        </div>
                    </div>
                    <div class="fazenda-actions">
                        <a href="#" class="btn btn-primary"><i class="fa-solid fa-trash"></i> Excluir</a>
                        <a href="#" class="btn btn-secondary"><i class="fa-solid fa-pen"></i> Editar</a>
                        <a href="#" class="btn btn-success"><i class="fa-solid fa-play"></i> Ativar</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="./../script.js"></script>
</body>
</html>