<?php

namespace App\Models;

use CodeIgniter\Model;

class LeituraSensorModel extends Model
{

    protected $table = 'LEITURA_SENSOR';
    protected $primaryKey = 'ID_LEITURA';

    // Auto incremento
    protected $useAutoIncrement = true;

    // Campos permitidos
    protected $allowedFields = [
        'VALOR',
        'DATA_HORA',
        'FK_ID_SENSOR'
    ];
}