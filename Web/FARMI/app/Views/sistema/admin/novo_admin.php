<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Novo Administrador</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

<h1>Novo Administrador</h1>

<form method="post" action="<?= base_url('admin/inserir') ?>" onsubmit="verificar_campos(event)">

    <label>CPF:</label><br>
    <input type="text" name="CPF" id="CPF">
    <br><br>

    <label>Nome:</label><br>
    <input type="text" name="NOME" id="NOME">
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="EMAIL" id="EMAIL">
    <br><br>

    <label>Senha:</label><br>
    <input type="password" name="SENHA" id="SENHA">
    <br><br>

    <label>Data Cadastro:</label><br>
    <input type="date" name="DATA_CADASTRO" id="DATA_CADASTRO">
    <br><br>

    <button type="submit">Salvar</button>

</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function verificar_campos(event){

    const nome = document.getElementById("NOME").value;
    const email = document.getElementById("EMAIL").value;

    if(nome == "" || email == ""){

        event.preventDefault();

        Swal.fire({
            title: 'Erro!',
            text: 'Preencha os campos!',
            icon: 'error'
        });

    }

}

</script>

</body>
</html>