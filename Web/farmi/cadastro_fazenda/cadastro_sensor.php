<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $tipo_sensor = trim($_POST["tipo_sensor"]);
        $unidade_medida = trim($_POST["unidade_medida"]);
        $status = trim($_POST["status"]);
        $data_instalacao = trim($_POST["data_instalacao"]);
        $fk_id_cultura = trim($_POST["fk_id_cultura"]);

        // ===== VALIDAÇÕES =====

        if (empty($tipo_sensor) || empty($unidade_medida) || empty($status) || empty($data_instalacao) || empty($fk_id_cultura)) {
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
    <title>FARMI - Cadastro do Sensor</title>

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
        <h2>Cadastro do Sensor</h2>

        <?php
            if (isset($erro)) {
                echo "<p class='erroCampo'>$erro</p>";
            }

            if (isset($sucesso)) {
                echo "<p class='sucesso'>$sucesso</p>";
            }
        ?>

        <form id="formCadastro" method="POST" action="">

            <label>Tipo do Sensor:</label><br>
            <input type="text" name="tipo_sensor" id="tipo_sensor" required placeholder="ex: Sensor de umidade do solo"><br>
            <span id="erroTipo_sensor" class="erro"></span>

            <label>Unidade de Medida:</label><br>
            <input type="text" name="unidade_medida" id="unidade_medida" required placeholder="ex: % (porcentagem) ou °C"><br>
            <span id="erroUnidade_medida" class="erro"></span>

            <label>Status do Sensor:</label><br>
            <input type="text" name="status" id="status" required placeholder="ex: Ativo, Inativo, Manutenção"><br>
            <span id="erroStatus" class="erro"></span>

            <label>Data da Instalação:</label><br>
            <input type="date" name="data_instalacao" id="data_instalacao" required placeholder="ex: Selecione a data de instalação"><br>
            <span id="erroData_instalacao" class="erro"></span>

            <p style="font-size:13px;">*Veja no painel de configuração o ID da cultura que pretende colocar o sensor</p>
            
            <label>ID da cultura:</label><br>
            <input type="number" name="fk_id_cultura" id="fk_id_cultura" required placeholder="ex: 1 (ID da cultura)"><br>
            <span id="erroFk_id_cultura" class="erro"></span>
            <br>

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