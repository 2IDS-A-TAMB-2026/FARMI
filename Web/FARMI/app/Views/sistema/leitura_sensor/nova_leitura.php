<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Nova Leitura</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

<h1>Nova Leitura Sensor</h1>

<form method="post" action="<?= base_url('leitura_sensor/inserir') ?>" onsubmit="verificar_campos(event)">

    <label>Valor:</label><br>
    <input type="text" name="VALOR" id="VALOR">
    <br><br>

    <label>Data Hora:</label><br>
    <input type="datetime-local" name="DATA_HORA" id="DATA_HORA">
    <br><br>

    <label>ID Sensor:</label><br>
    <input type="text" name="FK_ID_SENSOR" id="FK_ID_SENSOR">
    <br><br>

    <button type="submit">Salvar</button>

</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function verificar_campos(event){

    const valor = document.getElementById("VALOR").value;

    if(valor == ""){

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