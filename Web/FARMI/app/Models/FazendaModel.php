<?php
namespace App\Models;

use CodeIgniter\Model;

/*Model = representa a tabela no banco */

class FazendaModel extends Model
{
    protected $table = 'FAZENDA'; // nome da tabela
    protected $primaryKey = 'ID_FAZENDA'; // chave primária

    /**
     * Campos permitidos para INSERT/UPDATE
     * Segurança contra inserção indevida
     */
    protected $allowedFields = [
    // colunas na tabela FAZENDA do banco
    'NOME',
    'LATITUDE',
    'LONGITUDE',
    'LOGRADOURO',
    'NUMERO',
    'CEP',
    'AREA_TOTAL'
    ];

    // se a chave primária for auto increment
    protected $useAutoIncrement = true;
}