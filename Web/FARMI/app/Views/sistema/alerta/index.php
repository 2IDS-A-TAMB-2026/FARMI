<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Lista de Alertas</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

<h1>Lista de Alertas</h1>

<?= view('sistema/layout/header') ?>

<a href="<?= base_url('alerta/novo') ?>">Novo Alerta</a>

<br><br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Tipo</th>
    <th>Descrição</th>
    <th>Nível de Gravidade</th>
    <th>Data e Hora</th>
    <th>Status</th>
    <th>Sensor</th>
    <th>Ações</th>
</tr>

<?php foreach($alerta as $a): ?>

<tr>

    <td><?= $a['ID_ALERTA'] ?></td>

    <td><?= $a['TIPO_ALERTA'] ?></td>

    <td><?= $a['DESCRICAO'] ?></td>

    <td><?= $a['NIVEL_GRAVIDADE'] ?></td>

    <td><?= $a['DATA_HORA'] ?></td>

    <td><?= $a['STATUS'] ?></td>

    <td><?= $a['FK_ID_SENSOR'] ?></td>

    <td>

        <a href="<?= base_url('alerta/editar/'.$a['ID_ALERTA']) ?>">
            Editar
        </a>

        <a href="<?= base_url('alerta/excluir/'.$a['ID_ALERTA']) ?>"
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