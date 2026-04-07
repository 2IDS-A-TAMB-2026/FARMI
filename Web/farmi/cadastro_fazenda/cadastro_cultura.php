<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome_cultura = trim($_POST["nome_cultura"]);
        $data_plantio = trim($_POST["data_plantio"]);
        $ciclo_produtivo = trim($_POST["ciclo_produtivo"]);
        $tipo_cultura = trim($_POST["tipo_cultura"]);
        $area_cultivada = trim($_POST["area_cultivada"]);

        // ===== VALIDAÇÕES =====

        if (empty($nome_cultura) || empty($data_plantio) || empty($ciclo_produtivo) || empty($tipo_cultura) || empty($area_cultivada)) {
            $erro = "*Todos os campos são obrigatórios.";
        }
        else {
            // Simulação de cadastro realizado
            $sucesso = "Cadastro realizado com sucesso!";

            header("Location: cadastro2.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FARMI - Cadastro da cultura</title>

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
        <h2>Cadastro da Cultura</h2>

        <?php
            if (isset($erro)) {
                echo "<p class='erroCampo'>$erro</p>";
            }

            if (isset($sucesso)) {
                echo "<p class='sucesso'>$sucesso</p>";
            }
        ?>

        <form id="formCadastro" method="POST" action="">

            <label>Nome da cultura:</label><br>
            <input type="text" name="nome_cultura" id="nome_cultura" required placeholder="ex: Tomate"><br>
            <span id="erroNome_cultura" class="erro"></span>

            <label>Data do começo do plantio:</label><br>
            <input type="date" name="data_plantio" id="data_plantio" required><br>
            <span id="erroData_plantio" class="erro"></span>

            <label>Ciclo produtivo (dias):</label><br>
            <input type="text" name="ciclo_produtivo" id="ciclo_produtivo" required placeholder="ex: 90"><br>
            <span id="erroCiclo_produtivo" class="erro"></span>

            <label>Tipo da cultura:</label><br>
            <input type="text" name="tipo_cultura" id="tipo_cultura" required placeholder="ex: Hortaliça"><br>
            <span id="erroTipo_cultura" class="erro"></span>

            <label>Área cultivada (hectares):</label><br>
            <input type="number" name="area_cultivada" id="area_cultivada" required placeholder="ex: 2"><br>
            <span id="erroarea_cultivada" class="erro"></span>
            

            <button type="submit">Próximo -></button>
        </form>
    </div>

</body>
</html>