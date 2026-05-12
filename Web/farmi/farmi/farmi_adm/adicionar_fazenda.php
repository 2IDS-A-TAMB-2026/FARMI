<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Endereço - Fazenda Inteligente</title>
    <!-- Ícones (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style_recuperar.css">
    
    <style>
        /* Estilos para dividir campos em 2 colunas */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-row.full-width {
            grid-template-columns: 1fr;
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
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
            <h2>Cadastrar Endereço</h2>
            <p>Preencha os dados do endereço da fazenda</p>
        </div>

        <!-- INDICADOR DE PASSOS -->
        <div class="steps-indicator">
            <div class="step active"></div>
            <div class="step"></div>
            <div class="step"></div>
        </div>

        <!-- FORMULÁRIO -->
        <form id="addressForm">
            <div class="form-group">
                    <label for="nome"><i class="fa-solid fa-tractor"></i></i> Nome</label>
                    <input 
                        type="text" 
                        id="nome" 
                        name="nome" 
                        step="any"
                        placeholder="Ex: Fazenda São Jorge"
                        required
                    >
                </div>
            <div class="form-row">
                
                <div class="form-group">
                    <label for="latitude"><i class="fa-solid fa-map-pin"></i> Latitude</label>
                    <input 
                        type="number" 
                        id="latitude" 
                        name="latitude" 
                        step="any"
                        placeholder="Ex: -23.550520"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="longitude"><i class="fa-solid fa-map-marked-alt"></i> Longitude</label>
                    <input 
                        type="number" 
                        id="longitude" 
                        name="longitude" 
                        step="any"
                        placeholder="Ex: -46.633308"
                        required
                    >
                </div>
            </div>

            <!-- Linha 2: Logradouro + Número -->
            <div class="form-row">
                <div class="form-group">
                    <label for="logradouro"><i class="fa-solid fa-road"></i> Logradouro</label>
                    <input 
                        type="text" 
                        id="logradouro" 
                        name="logradouro" 
                        placeholder="Rua, Avenida, Estrada, etc."
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="numero"><i class="fa-solid fa-hashtag"></i> Número</label>
                    <input 
                        type="text" 
                        id="numero" 
                        name="numero" 
                        placeholder="Ex: 123, S/N"
                        required
                    >
                </div>
            </div>

            <!-- Linha 3: Área Total + CEP (lado a lado) -->
            <div class="form-row">
                <div class="form-group">
                    <label for="area_total"><i class="fa-solid fa-ruler-combined"></i> Área Total (ha)</label>
                    <input 
                        type="number" 
                        id="area_total" 
                        name="area_total" 
                        step="0.01"
                        placeholder="Ex: 150.50"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="cep"><i class="fa-solid fa-mail-bulk"></i> CEP</label>
                    <input 
                        type="text" 
                        id="cep" 
                        name="cep" 
                        maxlength="9"
                        placeholder="Ex: 01234-567"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-save"></i>
                Salvar Endereço
            </button>

            <a href="fazendas.php">
                <button type="button" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i>
                    Voltar
                </button>
            </a>
        </form>

        <!-- LINK PARA VOLTAR -->
        <div class="back-link">
            <a href="dashboard.php">
                <i class="fa-solid fa-tachometer-alt"></i>
                Dashboard
            </a>
        </div>
    </div>

    <script>
        // Máscara para CEP
        document.getElementById('cep').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
            e.target.value = value;
        });

        // Simulação de envio do formulário
        document.getElementById('addressForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;
            const logradouro = document.getElementById('logradouro').value;
            const numero = document.getElementById('numero').value;
            const area_total = document.getElementById('area_total').value;
            const cep = document.getElementById('cep').value;
            
            if (latitude && longitude && logradouro && numero && area_total && cep) {
                // Simular envio
                const btn = this.querySelector('.btn-primary');
                const originalText = btn.innerHTML;
                
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Salvando...';
                btn.disabled = true;
                
                setTimeout(() => {
                    btn.innerHTML = '<i class="fa-solid fa-check"></i> Endereço salvo!';
                    btn.style.backgroundColor = '#4caf50';
                    
                    setTimeout(() => {
                        alert('Endereço cadastrado com sucesso!');
                        window.location.href = 'dashboard.php';
                    }, 1500);
                }, 2000);
            }
        });
    </script>
</body>
</html>