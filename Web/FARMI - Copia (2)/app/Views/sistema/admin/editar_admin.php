<h1>Editar Administrador</h1>

<form method="post" action="<?= base_url('admin/atualizar/' . $admin['CPF']) ?>">

    <label>CPF:</label><br>
    <input type="text" name="CPF" value="<?= $admin['CPF'] ?>">
    <br><br>

    <label>Nome:</label><br>
    <input type="text" name="NOME" value="<?= $admin['NOME'] ?>">
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="EMAIL" value="<?= $admin['EMAIL'] ?>">
    <br><br>

    <label>Data Cadastro:</label><br>
    <input type="date" name="DATA_CADASTRO" value="<?= $admin['DATA_CADASTRO'] ?>">
    <br><br>

    <button type="submit">Atualizar</button>

</form>