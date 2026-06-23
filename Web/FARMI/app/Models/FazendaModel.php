<?php

namespace App\Models;

use CodeIgniter\Model;

class FazendaModel extends Model
{
    protected $table = 'FAZENDA';
    protected $primaryKey = 'ID_FAZENDA';

    protected $allowedFields = [
        'NOME',
        'LATITUDE',
        'LONGITUDE',
        'LOGRADOURO',
        'NUMERO',
        'CEP',
        'AREA_TOTAL'
    ];

    protected $useAutoIncrement = true;
}