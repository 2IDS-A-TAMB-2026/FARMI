<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\SensorModel; // Use o Model da tabela SENSOR
use App\Models\LeituraSensorModel;

class MedidasSensoresController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $model = new SensorModel();
        
        // Retorna TODOS os sensores cadastrados no banco
        $sensores = $model->findAll();

        return $this->respond($sensores);
    }


    // MÉTODO POST: Recebe medições do ESP32
    public function create()
    {
        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->fail('Dados JSON inválidos', 400);
        }

        $valor = $json['VALOR'] ?? null;
        $sensorId = $json['FK_ID_SENSOR'] ?? null;

        if ($valor === null || $sensorId === null) {
            return $this->fail('Existem dados obrigatórios não preenchidos!', 400);
        }

        $db = \Config\Database::connect();

        // ==========================================
        // 1. BUSCA O SENSOR E A CULTURA RELACIONADA
        // ==========================================

        $sensor = $db->query("
            SELECT
                s.ID_SENSOR,
                s.NOME_SENSOR,
                s.TIPO_SENSOR,
                s.UNIDADE_MEDIDA,
                s.FK_ID_CULTURA,
                c.ID_CULTURA,
                c.NOME_CULTURA,
                c.SENSOR_LUZ,
                c.SENSOR_CLIMA_TEMPO,
                c.SENSOR_CLIMA_UMIDADE,
                c.SENSOR_SOLO
            FROM SENSOR s
            RIGHT JOIN CULTURA c
                ON c.ID_CULTURA = s.FK_ID_CULTURA
            WHERE s.ID_SENSOR = ?
            LIMIT 1
        ", [$sensorId])->getRowArray();

        if (!$sensor) {
            return $this->fail('Sensor não encontrado ou não está vinculado a uma cultura.', 404);
        }

        // ==========================================
        // 2. SALVA A LEITURA
        // ==========================================

        $model = new LeituraSensorModel();

        $dados = [
            'VALOR' => $valor,
            'FK_ID_SENSOR' => $sensorId
        ];

        if (!$model->insert($dados)) {
            return $this->fail('Erro ao salvar no banco de dados', 500);
        }

        $idLeitura = $model->getInsertID();

        // ==========================================
        // 3. DESCOBRE O VALOR IDEAL DA CULTURA
        // ==========================================

        $valorIdeal = null;

        switch ($sensor['TIPO_SENSOR']) {

            case 'Temperatura':
                $valorIdeal = $sensor['SENSOR_CLIMA_TEMPO'];
                break;

            case 'Umidade':
                $valorIdeal = $sensor['SENSOR_CLIMA_UMIDADE'];
                break;

            case 'Solo':
                $valorIdeal = $sensor['SENSOR_SOLO'];
                break;

            case 'Luz':
                $valorIdeal = $sensor['SENSOR_LUZ'];
                break;
        }

        // ==========================================
        // 4. TRATA E TRATA E CONVERTE O VALOR IDEAL
        // ==========================================

        if ($valorIdeal !== null) {
            // Substitui vírgulas por pontos antes de limpar o texto
            $valorIdealTratado = str_replace(',', '.', $valorIdeal);
            
            $valorIdealNumerico = (float) preg_replace(
                '/[^0-9.-]/',
                '',
                $valorIdealTratado
            );

            // Substitui vírgula da leitura do sensor se houver
            $valorNumerico = (float) str_replace(',', '.', $valor);

            // ==========================================
            // 5. CÁLCULO DE TOLERÂNCIA E GRAVIDADE
            // ==========================================

            $percentualTolerancia = 0.10; // 10% de tolerância para o limite normal

            $limiteMinimo = $valorIdealNumerico * (1 - $percentualTolerancia);
            $limiteMaximo = $valorIdealNumerico * (1 + $percentualTolerancia);

            $foraDoIdeal = ($valorNumerico < $limiteMinimo) || ($valorNumerico > $limiteMaximo);

            if ($foraDoIdeal) {

                // Define a descrição do alerta
                if ($valorNumerico > $limiteMaximo) {
                    $descricao = $sensor['TIPO_SENSOR'] . 
                        ' acima do limite tolerado (' . round($limiteMaximo, 1) . $sensor['UNIDADE_MEDIDA'] . 
                        ') para a cultura ' . $sensor['NOME_CULTURA'] . '.';
                } else {
                    $descricao = $sensor['TIPO_SENSOR'] . 
                        ' abaixo do limite tolerado (' . round($limiteMinimo, 1) . $sensor['UNIDADE_MEDIDA'] . 
                        ') para a cultura ' . $sensor['NOME_CULTURA'] . '.';
                }

                // CÁLCULO DA GRAVIDADE DINÂMICA:
                // Se a variação for maior que 30% em relação ao ideal, considera 'Alto' (Crítico).
                $diferencaAbsoluta = abs($valorNumerico - $valorIdealNumerico);
                $variacaoPercentual = ($valorIdealNumerico > 0) ? ($diferencaAbsoluta / $valorIdealNumerico) : 0;

                if ($variacaoPercentual >= 0.30) {
                    $nivelGravidade = 'Alto';
                } else {
                    $nivelGravidade = 'Médio';
                }

                // ==========================================
                // 6. GRAVAÇÃO OU ATUALIZAÇÃO DO ALERTA
                // ==========================================

                $alertaAtivo = $db->table('ALERTA')
                    ->where('FK_ID_SENSOR', $sensorId)
                    ->where('TIPO_ALERTA', $sensor['TIPO_SENSOR'])
                    ->where('STATUS', 'Ativo')
                    ->get()
                    ->getRowArray();

                if (!$alertaAtivo) {
                    // Cria o alerta com a gravidade calculada
                    $db->table('ALERTA')->insert([
                        'TIPO_ALERTA' => $sensor['TIPO_SENSOR'],
                        'DESCRICAO' => $descricao,
                        'NIVEL_GRAVIDADE' => $nivelGravidade,
                        'DATA_HORA' => date('Y-m-d H:i:s'),
                        'STATUS' => 'Ativo',
                        'FK_ID_SENSOR' => $sensorId
                    ]);
                } else {
                    // Se a gravidade mudou (ex: de Médio para Alto), atualiza o alerta existente
                    if ($alertaAtivo['NIVEL_GRAVIDADE'] !== $nivelGravidade) {
                        $db->table('ALERTA')
                            ->where('ID_ALERTA', $alertaAtivo['ID_ALERTA'])
                            ->update([
                                'NIVEL_GRAVIDADE' => $nivelGravidade,
                                'DESCRICAO' => $descricao
                            ]);
                    }
                }
            }

        // ==========================================
        // 8. RETORNA RESPOSTA
        // ==========================================

        return $this->respondCreated([
            'status' => 201,
            'mensagem' => 'Medida gravada com sucesso!',
            'dados' => [
                'ID_LEITURA' => $idLeitura,
                'VALOR' => $valor,
                'FK_ID_SENSOR' => $sensorId,
                'TIPO_SENSOR' => $sensor['TIPO_SENSOR'],
                'CULTURA' => $sensor['NOME_CULTURA'],
                'VALOR_IDEAL' => $valorIdeal
            ]
        ]);
    }
    }
}