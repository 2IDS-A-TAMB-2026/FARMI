<h1>Editar Leitura</h1>

<form method="post" action="<?= base_url('leitura_sensor/atualizar/' . $leitura['ID_LEITURA']) ?>">

    <label>Valor:</label><br>
    <input type="text" name="VALOR" value="<?= $leitura['VALOR'] ?>">
    <br><br>

    <label>Data Hora:</label><br>
    <input type="datetime-local" name="DATA_HORA" value="<?= $leitura['DATA_HORA'] ?>">
    <br><br>

    <label>ID Sensor:</label><br>
    <input type="text" name="FK_ID_SENSOR" value="<?= $leitura['FK_ID_SENSOR'] ?>">
    <br><br>

    <button type="submit">Atualizar</button>

</form>