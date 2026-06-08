<?php

namespace App\Models;

use CodeIgniter\Model;

class CulturaModel extends Model
{

    protected $table = 'CULTURA'; // Nome da tabela
    protected $primaryKey = 'ID_CULTURA'; // Chave primária

    // Auto incremento
    protected $useAutoIncrement = true;

    // Campos permitidos
    protected $allowedFields = [
        'NOME_CULTURA',
        'DATA_PLANTIO',
        'CICLO_PRODUTIVO',
        'AREA_CULTIVADA',
        'TIPO_CULTURA',
        'SENSOR_LUZ',
        'SENSOR_CLIMA_TEMPO',
        'SENSOR_CLIMA_UMIDADE',
        'SENSOR_SOLO',
        'STATUS',
        'FK_ID_FAZENDA'
    ];
}