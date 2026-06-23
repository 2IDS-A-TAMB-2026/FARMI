<?php

$conn = new mysqli("localhost", "root", "", "farmi");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$pesquisa = $_GET['pesquisar'] ?? '';

$sql = "SELECT * FROM fazendas WHERE NOME LIKE '%$pesquisa%'";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pesquisa de Fazendas</title>
</head>
<body>

<h2>Resultado da pesquisa</h2>

<?php if ($resultado->num_rows > 0): ?>

    <?php while($fazenda = $resultado->fetch_assoc()): ?>
        <p>
            <strong><?= $fazenda['NOME'] ?></strong>
        </p>
    <?php endwhile; ?>

<?php else: ?>

    <p>Nenhuma fazenda encontrada.</p>

<?php endif; ?>

</body>
</html>