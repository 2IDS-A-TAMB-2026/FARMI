<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor - Gerenciar Usuários</title>
    <!-- Ícones  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
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
            <a href="usuarios.php" class="menu-item active"><i class="fa-solid fa-users"></i> Usuários</a>
            <a href="sensores.php" class="menu-item"><i class="fa-solid fa-satellite-dish"></i> Sensores</a>
            <a href="alertas.php" class="menu-item "><i class="fa-solid fa-triangle-exclamation"></i> Alertas</a>
            <a href="configuracoes.php" class="menu-item"><i class="fa-solid fa-gear"></i> Configurações</a>
            
        </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
        
        <!-- CABEÇALHO -->
        <header class="header">
            <div>
                <h2>Gerenciar Usuários</h2>
                <p style="color: #666;">Painel de Gestão</p>
            </div>
            <button id="contraste-btn" aria-label="Alterar contraste"><i class="fa-solid fa-circle-half-stroke"></i></button>
            <div class="user-profile">
                <div class="avatar">G</div>
            </div>
        </header>

        <!-- LÓGICA PHP (Simulação de Dados) -->
        <?php
            // Simulando dados de usuários do banco
            $usuarios = [
                ['id' => 1, 'nome' => 'João Silva', 'email' => 'joao@farmsi.com', 'telefone' => '(11) 99999-9999', 'perfil' => 'Administrador', 'status' => 'Ativo', 'data_cadastro' => '15/03/2024'],
                ['id' => 2, 'nome' => 'Maria Santos', 'email' => 'maria@farmsi.com', 'telefone' => '(11) 88888-8888', 'perfil' => 'Usuário', 'status' => 'Ativo', 'data_cadastro' => '10/03/2024'],
                ['id' => 3, 'nome' => 'Pedro Oliveira', 'email' => 'pedro@farmsi.com', 'telefone' => '(11) 77777-7777', 'perfil' => 'Usuário', 'status' => 'Inativo', 'data_cadastro' => '05/03/2024'],
                ['id' => 4, 'nome' => 'Ana Costa', 'email' => 'ana@farmsi.com', 'telefone' => '(11) 66666-6666', 'perfil' => 'Administrador', 'status' => 'Ativo', 'data_cadastro' => '01/03/2024'],
            ];
            $total_usuarios = count($usuarios);
            $usuarios_ativos = count(array_filter($usuarios, fn($u) => $u['status'] === 'Ativo'));
            $admins = count(array_filter($usuarios, fn($u) => $u['perfil'] === 'Administrador'));
        ?>

        <!-- CARDS DE ESTATÍSTICAS -->
        <div class="stats-grid">
            <div class="card">
                <div class="card-info">
                    <h3>Total de Usuários</h3>
                    <p><?php echo $total_usuarios; ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-users"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Usuários Ativos</h3>
                    <p><?php echo $usuarios_ativos; ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-user-check"></i></div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Gestores</h3>
                    <p><?php echo $admins; ?></p>
                </div>
                <div class="card-icon"><i class="fa-solid fa-user-shield"></i></div>
            </div>
        </div>

        <!-- FORMULÁRIO ADICIONAR USUÁRIO -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fa-solid fa-user-plus"></i>
                Adicionar Novo Usuário
            </h3>
            <form id="formUsuario" class="form-grid">
                <div class="form-group">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" id="nome" name="nome" required placeholder="Ex: João Silva">
                </div>
                <div class="form-group">
                    <label for="email">E-mail *</label>
                    <input type="email" id="email" name="email" required placeholder="Ex: joao@farmsi.com">
                </div>
                <div class="form-group">
                    <label for="senha">Senha *</label>
                    <input type="senha" id="senha" name="senha" required placeholder="********">
                </div>
                <div class="form-group">
                    <label for="perfil">Perfil *</label>
                    <select id="perfil" name="perfil" required>
                        <option value="">Selecione o perfil</option>
                        <option value="Administrador">Gestor</option>
                        <option value="Usuário">Funcionário</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF *</label>
                    <input type="cpf" id="cpf" name="cpf" required placeholder="Ex: 44020904820">
                </div>
                <div class="form-group">
                    <label for="status">Status Inicial *</label>
                    <select id="status" name="status">
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>
                
                 <div class="form-group">
                    <label for="status">Fazendas *</label>
                    <div class="dropdown">
                        <div class="dropdown-btn" onclick="toggleDropdown()">
                            Selecione opções
                        </div>

                        <div class="dropdown-content" id="dropdown">
                            <label><input type="checkbox" value="1"> Opção 1</label>
                            <label><input type="checkbox" value="2"> Opção 2</label>
                            <label><input type="checkbox" value="3"> Opção 3</label>
                            <label><input type="checkbox" value="4"> Opção 4</label>
                        </div>
                    </div>
                </div>
                <script>
                function toggleDropdown() {
                var dropdown = document.getElementById("dropdown");
                dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
                }
                </script>



                <div style="grid-column: 1 / -1; display: flex; gap: 15px; align-items: end;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-user-plus"></i>
                        Adicionar Usuário
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fa-solid fa-refresh"></i>
                        Limpar
                    </button>
                </div>
            </form>
        </div>

        <!-- TABELA DE USUÁRIOS -->
        <h3 class="section-title">
            <i class="fa-solid fa-list"></i>
            Lista de Usuários (<?php echo $total_usuarios; ?>)
        </h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>CPF</th>
                        <th>Usuário</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Perfil</th>
                        <th>Status</th>
                        <th>Data Cadastro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="usuariosTable">
                    <?php foreach($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="user-avatar"><?php echo strtoupper(substr($usuario['nome'], 0, 1)); ?></div>
                                <?php echo $usuario['nome']; ?>
                            </div>
                        </td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td><?php echo $usuario['telefone']; ?></td>
                        <td>
                            <span class="role-badge role-<?php echo strtolower(str_replace(' ', '-', $usuario['perfil'])); ?>">
                                <?php echo $usuario['perfil']; ?>
                            </span>
                        </td>
                        <td>
                            <span class="status-badge status-<?php echo strtolower($usuario['status']); ?>">
                                <?php echo $usuario['status']; ?>
                            </span>
                        </td>
                        <td><?php echo $usuario['data_cadastro']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-primary" onclick="editarUsuario(<?php echo $usuario['id']; ?>)">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <button class="btn btn-danger" onclick="excluirUsuario(<?php echo $usuario['id']; ?>)">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="./../script.js"></script>
</html>