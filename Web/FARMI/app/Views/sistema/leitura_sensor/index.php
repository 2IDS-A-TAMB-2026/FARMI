<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Leituras dos Sensores</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

<h1>Leituras dos Sensores</h1>

<?= view('sistema/layout/header') ?>

<a href="<?= base_url('leitura_sensor/novo') ?>">Nova Leitura</a>

<br><br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Valor</th>
    <th>Data/Hora</th>
    <th>Sensor</th>
    <th>Ações</th>
</tr>

<?php foreach($leitura as $l): ?>

<tr>

    <td><?= $l['ID_LEITURA'] ?></td>

    <td><?= $l['VALOR'] ?></td>

    <td><?= $l['DATA_HORA'] ?></td>

    <td><?= $l['FK_ID_SENSOR'] ?></td>

    <td>

        <a href="<?= base_url('leitura_sensor/editar/'.$l['ID_LEITURA']) ?>">
            Editar
        </a>

        <a href="<?= base_url('leitura_sensor/excluir/'.$l['ID_LEITURA']) ?>"
           onclick="mostrarAlerta(event, this.href)">
            Excluir
        </a>

    </td>

</tr>

<?php endforeach; ?>

</table>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function mostrarAlerta(event, url){

    event.preventDefault();

    Swal.fire({
        title: "Você tem certeza disso?",
        text: "Essa ação não pode ser revertida!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, excluir",
        cancelButtonText: "Cancelar"
    }).then((result) => {

        if (result.isConfirmed) {

            window.location.href = url;

        }

    });

}

</script>

</body>
</html>