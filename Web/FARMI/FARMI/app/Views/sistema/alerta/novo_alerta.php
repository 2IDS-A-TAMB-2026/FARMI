<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Novo Alerta</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

<h1>Novo Alerta</h1>

<form method="post" action="<?= base_url('alerta/inserir') ?>" onsubmit="verificar_campos(event)">

    <label>Tipo Alerta:</label><br>
    <input type="text" name="TIPO_ALERTA" id="TIPO_ALERTA">
    <br><br>

    <label>Descrição:</label><br>
    <textarea name="DESCRICAO" id="DESCRICAO"></textarea>
    <br><br>

    <label>Nível Gravidade:</label><br>
    <input type="text" name="NIVEL_GRAVIDADE" id="NIVEL_GRAVIDADE">
    <br><br>

    <label>Data Hora:</label><br>
    <input type="datetime-local" name="DATA_HORA" id="DATA_HORA">
    <br><br>

    <label>Status:</label><br>
    <input type="text" name="STATUS" id="STATUS">
    <br><br>

    <label>ID Sensor:</label><br>
    <input type="text" name="FK_ID_SENSOR" id="FK_ID_SENSOR">
    <br><br>

    <button type="submit">Salvar</button>

</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function verificar_campos(event){

    const tipo = document.getElementById("TIPO_ALERTA").value;

    if(tipo == ""){

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