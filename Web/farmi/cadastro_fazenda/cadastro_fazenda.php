<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = trim($_POST["nome"]);
        $latitude = trim($_POST["latitude"]);
        $longitude = trim($_POST["longitude"]);
        $logradouro = trim($_POST["logradouro"]);
        $numero = trim($_POST["numero"]);
        $cep = trim($_POST["cep"]);
        $area_total = trim($_POST["area_total"]);

        // ===== VALIDAÇÕES =====

        if (empty($nome) || empty($latitude) || empty($longitude) || empty($logradouro) || empty($numero) || empty($cep) || empty($area_total)) {
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
    <title>FARMI - Cadastro da Fazenda</title>

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
        <h2>Cadastro da Fazenda</h2>

        <?php
            if (isset($erro)) {
                echo "<p class='erroCampo'>$erro</p>";
            }

            if (isset($sucesso)) {
                echo "<p class='sucesso'>$sucesso</p>";
            }
        ?>

        <form id="formCadastro" method="POST" action="">

            <label>Nome:</label><br>
            <input type="text" name="nome" id="nome" required placeholder="ex: Fazenda Boa Esperança"><br>
            <span id="erroNome" class="erro"></span>

            <label>Latitude:</label><br>
            <input type="text" name="latitude" id="latitude" required placeholder="ex: -23.550520"><br>
            <span id="erroLatitude" class="erro"></span>

            <label>Longitude:</label><br>
            <input type="text" name="longitude" id="longitude" required placeholder="ex: -46.633308"><br>
            <span id="erroLongitude" class="erro"></span>

            <label>Logradouro:</label><br>
            <input type="text" name="logradouro" id="logradouro" required placeholder="ex: Rodovia BR-163"><br>
            <span id="erroLogradouro" class="erro"></span>

            <label>Número:</label><br>
            <input type="number" name="numero" id="numero" required placeholder="ex: 1500"><br>
            <span id="erroNumero" class="erro"></span>

            <label>CEP:</label><br>
            <input type="text" name="cep" id="cep" required placeholder="ex: 12345-678"><br>
            <span id="erroCep" class="erro"></span>

            <label>Área total (m²):</label><br>
            <input type="number" name="area_total" id="area_total" required placeholder="ex: 50000"><br>
            <span id="erroArea_total" class="erro"></span>
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