<?php

namespace App\Models;
use CodeIgniter\Model;

class UsuariosFazendaModel extends Model
{
    protected $table = 'USUARIOS_FAZENDA';
    protected $primaryKey = 'ID_USUARIO_FAZENDA';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'ID_CPF_USUARIOS',
        'ID_FAZENDA'
    ];
}