<h1>Editar Alerta</h1>

<form method="post" action="<?= base_url('alerta/atualizar/' . $alerta['ID_ALERTA']) ?>">

    <label>Tipo Alerta:</label><br>
    <input type="text" name="TIPO_ALERTA" value="<?= $alerta['TIPO_ALERTA'] ?>">
    <br><br>

    <label>Descrição:</label><br>
    <textarea name="DESCRICAO"><?= $alerta['DESCRICAO'] ?></textarea>
    <br><br>

    <label>Nível Gravidade:</label><br>
    <input type="text" name="NIVEL_GRAVIDADE" value="<?= $alerta['NIVEL_GRAVIDADE'] ?>">
    <br><br>

    <label>Data e Hora:</label><br>
    <input type="text" name="DATA_HORA" value="<?= $alerta['DATA_HORA'] ?>">
    <br><br>

    <label>Status:</label><br>
    <input type="text" name="STATUS" value="<?= $alerta['STATUS'] ?>">
    <br><br>

    <label>Sensor:</label><br>
    <input type="text" name="FK_ID_SENSOR" value="<?= $alerta['FK_ID_SENSOR'] ?>">
    <br><br>

    <button type="submit">Atualizar</button>

</form>