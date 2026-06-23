<?php

namespace App\Controllers;

use App\Models\AlertaModel;
use App\Models\SensorModel;
use App\Controllers\BaseController;

class AlertaController extends BaseController
{
   public function index()
{
    $model = new AlertaModel();

    $cpfGestor = session()->get('usuario_cpf');

    $dados['alerta'] = $model
    ->select('
        ALERTA.*,
        SENSOR.TIPO_SENSOR,
        SENSOR.UNIDADE_MEDIDA,
        LEITURA_SENSOR.VALOR,
        CULTURA.NOME_CULTURA,
        CULTURA.TIPO_CULTURA,
        FAZENDA.NOME AS NOME_FAZENDA
    ')
    ->join(
        'SENSOR',
        'SENSOR.ID_SENSOR = ALERTA.FK_ID_SENSOR'
    )
    ->join(
        'LEITURA_SENSOR',
        'LEITURA_SENSOR.FK_ID_SENSOR = SENSOR.ID_SENSOR',
        'left'
    )
    ->join(
        'CULTURA',
        'CULTURA.ID_CULTURA = SENSOR.FK_ID_CULTURA'
    )
    ->join(
        'FAZENDA',
        'FAZENDA.ID_FAZENDA = CULTURA.FK_ID_FAZENDA'
    )
    ->join(
        'USUARIOS_FAZENDA',
        'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA'
    )
    ->where(
        'USUARIOS_FAZENDA.ID_CPF_USUARIOS',
        $cpfGestor
    )
    ->findAll();

    $dados['totalAlertas'] = count($dados['alerta']);

    $dados['totalCriticos'] = 0;
    $dados['totalMedios'] = 0;
    $dados['totalBaixos'] = 0;

    foreach ($dados['alerta'] as $a) {

        if ($a['NIVEL_GRAVIDADE'] == 'Alto') {
    $dados['totalCriticos']++;
}

        if ($a['NIVEL_GRAVIDADE'] == 'Médio') {
            $dados['totalMedios']++;
        }

        if ($a['NIVEL_GRAVIDADE'] == 'Baixo') {
            $dados['totalBaixos']++;
        }
    }

    return view('sistema/farmi_adm/alertas', $dados);
}
}