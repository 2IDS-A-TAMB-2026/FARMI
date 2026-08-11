<?php

namespace App\Models;

use CodeIgniter\Model;

class LeituraSensorModel extends Model
{
    protected $table = 'LEITURA_SENSOR';
    protected $primaryKey = 'ID_LEITURA';

    // Libera os campos do seu banco para o insert do ESP32 funcionar
    protected $allowedFields = [
        'VALOR',
        'UNIDADE_MEDIDA', // Opcional: crie este campo no banco se quiser gravar o "ºC" ou "%"
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
}