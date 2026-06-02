<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Lista de Administradores</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

<?= view('sistema/layout/header') ?>

<h1>Lista de Administradores</h1>

<a href="<?= base_url('admin/novo') ?>">Novo Administrador</a>

<br><br>

<table border="1">

<tr>
    <th>CPF</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Data Cadastro</th>
    <th>Ações</th>
</tr>

<?php foreach($admin as $a): ?>

<tr>

    <td><?= $a['CPF'] ?></td>

    <td><?= $a['NOME'] ?></td>

    <td><?= $a['EMAIL'] ?></td>

    <td><?= $a['DATA_CADASTRO'] ?></td>

    <td>

        <a href="<?= base_url('admin/editar/'.$a['CPF']) ?>">
            Editar
        </a>

        <a href="<?= base_url('admin/excluir/'.$a['CPF']) ?>"
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