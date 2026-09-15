<?php

namespace App\Models;

use CodeIgniter\Model;

class LeituraSensorModel extends Model
{
    protected $table = 'LEITURA_SENSOR';
    protected $primaryKey = 'ID_LEITURA';

    protected $allowedFields = [
        'VALOR',
        'DATA_HORA',
        'FK_ID_SENSOR'
    ];

    public function getTemperaturas()
    {
        return $this->db->query("
            SELECT
                DATE(ls.DATA_HORA) AS data,
                AVG(CAST(ls.VALOR AS DECIMAL(10,2))) AS temperatura
            FROM LEITURA_SENSOR ls
            INNER JOIN SENSOR s
                ON s.ID_SENSOR = ls.FK_ID_SENSOR
            WHERE s.TIPO_SENSOR = 'Temperatura'
            GROUP BY DATE(ls.DATA_HORA)
            ORDER BY DATE(ls.DATA_HORA)
        ")->getResultArray();
    }

    public function getUmidade()
    {
        return $this->db->query("
            SELECT
                DATE(ls.DATA_HORA) AS data,
                AVG(CAST(ls.VALOR AS DECIMAL(10,2))) AS umidade
            FROM LEITURA_SENSOR ls
            INNER JOIN SENSOR s
                ON s.ID_SENSOR = ls.FK_ID_SENSOR
            WHERE s.TIPO_SENSOR = 'Umidade'
            GROUP BY DATE(ls.DATA_HORA)
            ORDER BY DATE(ls.DATA_HORA)
        ")->getResultArray();
    }

    public function getLux()
    {
        return $this->db->query("
            SELECT
                CAST(ls.VALOR AS DECIMAL(10,2)) AS lux
            FROM LEITURA_SENSOR ls
            INNER JOIN SENSOR s
                ON s.ID_SENSOR = ls.FK_ID_SENSOR
            WHERE s.TIPO_SENSOR = 'Luz'
            ORDER BY ls.DATA_HORA DESC
            LIMIT 1
        ")->getRowArray();
    }
    public function statusAtual()
{
    $linhas = $this->db->query("
        SELECT s.ID_SENSOR, s.NOME_SENSOR, s.TIPO_SENSOR, u.DATA_HORA
        FROM SENSOR s
        INNER JOIN (
            SELECT FK_ID_SENSOR, MAX(DATA_HORA) AS DATA_HORA
            FROM LEITURA_SENSOR
            GROUP BY FK_ID_SENSOR
        ) u ON u.FK_ID_SENSOR = s.ID_SENSOR
        ORDER BY s.ID_SENSOR
    ")->getResultArray();

    $icones = [
        'Temperatura' => 'fa-temperature-high',
        'Umidade'     => 'fa-droplet',
        'Luz'         => 'fa-sun',
        'Solo'        => 'fa-seedling',
    ];

    $resultado = [];
    foreach ($linhas as $s) {
        $minutos = (time() - strtotime($s['DATA_HORA'])) / 60;

        $resultado[] = [
            'nome'          => $s['NOME_SENSOR'],
            'tipo'          => $s['TIPO_SENSOR'],
            'icone'         => $icones[$s['TIPO_SENSOR']] ?? 'fa-microchip',
            'minutos_atras' => round($minutos),
            'tempo_texto'   => $this->formatarTempo($minutos),
        ];
    }
    return $resultado;
}

private function formatarTempo($minutos)
{
    if ($minutos < 1)  return 'leitura agora';
    if ($minutos < 60) return 'leitura há ' . round($minutos) . ' min';
    return 'leitura há ' . round($minutos / 60) . 'h';
}
}
