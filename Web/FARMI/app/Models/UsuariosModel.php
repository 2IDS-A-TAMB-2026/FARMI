<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{

    protected $table = 'USUARIOS';
    protected $primaryKey = 'CPF';

    // NÃO é auto incremento
    protected $useAutoIncrement = false;

    // Tipo da chave primária
    protected $returnType = 'array';

    // Campos permitidos
    protected $allowedFields = [
        'CPF',
        'NOME',
        'EMAIL',
        'SENHA',
        'PERFIL',
        'STATUS'
    ];

}