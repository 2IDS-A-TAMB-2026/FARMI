<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $sensor_luz = trim($_POST["sensor_luz"]);
        $sensor_clima_tempo = trim($_POST["sensor_clima_tempo"]);
        $sensor_clima_umidade = trim($_POST["sensor_clima_umidade"]);
        $sensor_solo = trim($_POST["sensor_solo"]);

        // ===== VALIDAÇÕES =====

        if (empty($sensor_luz) || empty($sensor_clima_tempo) || empty($sensor_clima_umidade) || empty($sensor_solo)) {
            $erro = "*Todos os campos são obrigatórios.";
        }
        else {
            // Simulação de cadastro realizado
            $sucesso = "Cadastro realizado com sucesso!";

        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FARMI - Cadastro da Cultura 2</title>

    <!--Ícone do site-->
    <link rel="icon" href="../images/about.png" type="image/png" />

    <!-- Fonte Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Mesmo CSS do login -->
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="login-box">
        <h2>Cadastro da Cultura com os sensores</h2>

        <?php
            if (isset($erro)) {
                echo "<p class='erroCampo'>$erro</p>";
            }

            if (isset($sucesso)) {
                echo "<p class='sucesso'>$sucesso</p>";
            }
        ?>

        <form id="formCadastro" method="POST" action="">

            <p style="font-size:13px;">*Adicione os dados pedidos de cada sensor para a cultura cadastrada. Use a MÉDIA para informar. 
                Exemplo: Sensor de clima (temperatura): 20°C a 28°C = 24</p><br>
            
            <label>Sensor de luz (Lux):</label><br>
            <input type="number" name="sensor_luz" id="sensor_luz" required placeholder="ex: 50000 lux"><br>
            <span id="erroSensor_luz" class="erro"></span>

            <label>Sensor de clima (Temperatura °C):</label><br>
            <input type="number" name="sensor_clima_tempo" id="sensor_clima_tempo" required placeholder="ex: 24°C"><br>
            <span id="erroSensor_clima_tempo" class="erro"></span>

            <label>Sensor de clima (Umidade %):</label><br>
            <input type="number" name="sensor_clima_umidade" id="sensor_clima_umidade" required placeholder="ex: 65%"><br>
            <span id="erroSensor_clima_umidade" class="erro"></span>

            <label>Sensor de umidade do Solo (%):</label><br>
            <input type="number" name="sensor_solo" id="sensor_solo" required placeholder="ex: 70%"><br>
            <span id="erroSensor_solo" class="erro"></span>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
    
    <?php if (isset($sucesso)) : ?>
        <script>
            alert("Cadastro realizado com sucesso! 🟢");
        </script>
    <?php endif; ?>

</body>
</html>