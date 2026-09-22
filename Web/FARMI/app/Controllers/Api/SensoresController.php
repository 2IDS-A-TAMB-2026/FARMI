<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class SensoresController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        try {
            $db = \Config\Database::connect();

            $sql = "SELECT 
                        s.ID_SENSOR,
                        s.NOME_SENSOR,
                        s.TIPO_SENSOR,
                        s.UNIDADE_MEDIDA,
                        s.STATUS AS STATUS_SENSOR,
                        s.DATA_INSTALACAO,
                        c.ID_CULTURA,
                        c.NOME_CULTURA,
                        f.ID_FAZENDA,
                        f.NOME AS NOME_FAZENDA,
                        ls.VALOR AS ULTIMA_LEITURA,
                        ls.DATA_HORA AS DATA_ULTIMA_LEITURA
                    FROM SENSOR s
                    LEFT JOIN CULTURA c ON s.FK_ID_CULTURA = c.ID_CULTURA
                    LEFT JOIN FAZENDA f ON c.FK_ID_FAZENDA = f.ID_FAZENDA
                    LEFT JOIN LEITURA_SENSOR ls ON ls.ID_LEITURA = (
                        SELECT ls_sub.ID_LEITURA 
                        FROM LEITURA_SENSOR ls_sub 
                        WHERE ls_sub.FK_ID_SENSOR = s.ID_SENSOR 
                        ORDER BY ls_sub.DATA_HORA DESC, ls_sub.ID_LEITURA DESC 
                        LIMIT 1
                    )
                    ORDER BY s.ID_SENSOR ASC";

            $resultados = $db->query($sql)->getResultArray();
            $sensoresFormatados = [];

            foreach ($resultados as $row) {
                $nomeCulturaFormatado = !empty($row['NOME_CULTURA']) 
                    ? $row['NOME_CULTURA'] . " ID: " . $row['ID_CULTURA'] 
                    : "Sem Cultura";

                $dataLeituraFormatada = !empty($row['DATA_ULTIMA_LEITURA']) 
                    ? date('d/m/Y H:i', strtotime($row['DATA_ULTIMA_LEITURA'])) 
                    : '--';

                $sensoresFormatados[] = [
                    "ID_SENSOR" => $row['ID_SENSOR'],
                    "NOME_SENSOR" => $row['NOME_SENSOR'],
                    "TIPO_SENSOR" => $row['TIPO_SENSOR'],
                    "STATUS_SENSOR" => $row['STATUS_SENSOR'],
                    "VALOR" => $row['ULTIMA_LEITURA'],
                    "UNIDADE_MEDIDA" => $row['UNIDADE_MEDIDA'],
                    "LOCALIZACAO" => $row['NOME_FAZENDA'] ?? 'Sem Fazenda',
                    "DATA_ATUALIZACAO" => $dataLeituraFormatada,
                    "DATA_INSTALACAO" => $row['DATA_INSTALACAO'],
                    "FK_ID_CULTURA" => $row['ID_CULTURA'],
                    "NOME_CULTURA" => $nomeCulturaFormatado
                ];
            }

            return $this->respond($sensoresFormatados);

        } catch (\Throwable $e) {
            return $this->failServerError('Erro no banco de dados: ' . $e->getMessage());
        }
    }

    public function historico($id = null)
    {
        try {
            if (!$id) {
                return $this->fail('ID do sensor não informado.', 400);
            }

            $db = \Config\Database::connect();

            $builder = $db->table('LEITURA_SENSOR');
            $builder->select('ID_LEITURA, VALOR, DATA_HORA');
            $builder->where('FK_ID_SENSOR', $id);
            $builder->orderBy('DATA_HORA', 'DESC');
            $builder->orderBy('ID_LEITURA', 'DESC');
            $builder->limit(20);

            $resultados = $builder->get()->getResultArray();
            $historicoFormatado = [];

            foreach ($resultados as $row) {
                $historicoFormatado[] = [
                    'id_leitura' => $row['ID_LEITURA'],
                    'valor'      => $row['VALOR'],
                    'created_at' => !empty($row['DATA_HORA']) 
                        ? date('d/m/Y H:i', strtotime($row['DATA_HORA'])) 
                        : '--'
                ];
            }

            return $this->respond($historicoFormatado);

        } catch (\Throwable $e) {
            return $this->failServerError('Erro ao buscar histórico: ' . $e->getMessage());
        }
    }
}