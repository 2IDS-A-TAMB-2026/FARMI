<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\LeituraSensorModel;

class MedidasSensoresController extends ResourceController
{
    protected $format = 'json';

    // MÉTODO GET: Retorna todas as colunas da LEITURA_SENSOR + SENSOR
    public function index()
    {
        $model = new LeituraSensorModel();
        
        $dados = $model->select('
            LEITURA_SENSOR.*, 
            SENSOR.NOME_SENSOR, 
            SENSOR.TIPO_SENSOR, 
            SENSOR.UNIDADE_MEDIDA, 
            SENSOR.STATUS AS STATUS_SENSOR, 
            SENSOR.DATA_INSTALACAO, 
            SENSOR.FK_ID_CULTURA
        ')
        ->join('SENSOR', 'SENSOR.ID_SENSOR = LEITURA_SENSOR.FK_ID_SENSOR', 'inner')
        ->orderBy('LEITURA_SENSOR.ID_LEITURA', 'DESC')
        ->findAll(50);

        return $this->respond($dados);
    }

    // MÉTODO POST: Recebe medições do ESP32
    public function create()
    {
        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->fail('Dados JSON inválidos', 400);
        }

        $valor = $json['VALOR'] ?? null;
        $dataHora = $json['DATA_HORA'] ?? null;
        $sensorId = $json['FK_ID_SENSOR'] ?? null;

        if ($valor === null || $dataHora === null || $sensorId === null) {
            return $this->fail('Existem dados obrigatórios não preenchidos!', 400);
        }

        $model = new LeituraSensorModel();

        $dados = [
            'VALOR' => $valor,
            'DATA_HORA' => $dataHora,
            'FK_ID_SENSOR' => $sensorId
        ];

        if ($model->insert($dados)) {
            return $this->respondCreated([
                'status' => 201,
                'mensagem' => 'Medida gravada com sucesso!',
                'dados' => $dados
            ]);
        }

        return $this->fail('Erro ao salvar no banco de dados', 500);
    }
}