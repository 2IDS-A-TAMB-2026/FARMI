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

        $model = new LeituraSensorModel();

        $dados = [
            'VALOR'        => $json['MEDIDA_SENSOR_DADO'] ?? null,
            'FK_ID_SENSOR' => $json['FK_SENSOR_ID'] ?? null,
        ];

        if ($model->insert($dados)) {
            return $this->respondCreated([
                'status'   => 201,
                'mensagem' => 'Medida gravada com sucesso!'
            ]);
        }

        return $this->fail('Erro ao salvar no banco de dados', 500);
    }
}