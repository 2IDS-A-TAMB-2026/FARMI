<?php

namespace App\Models;
use CodeIgniter\Model;

class SensorModel extends Model
{
    protected $table = 'SENSOR';
    protected $primaryKey = 'ID_SENSOR';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'NOME_SENSOR',
        'TIPO_SENSOR',
        'UNIDADE_MEDIDA',
        'STATUS',
        'DATA_INSTALACAO',
        'FK_ID_CULTURA'
    ];
}