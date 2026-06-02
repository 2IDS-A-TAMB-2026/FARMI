<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{

    protected $table = 'ADMIN';
    protected $primaryKey = 'CPF';

    // Não é auto incremento
    protected $useAutoIncrement = false;

    // Campos permitidos
    protected $allowedFields = [
        'CPF',
        'NOME',
        'EMAIL',
        'SENHA',
        'DATA_CADASTRO'
    ];
}