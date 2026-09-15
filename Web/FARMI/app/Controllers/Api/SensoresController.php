<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class SensoresController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        try {
            $db = \Config\Database::connect();
            
            // Busca a lista completa de sensores sem cortes
            $sensores = $db->table('SENSOR')->get()->getResultArray();

            return $this->respond($sensores);
        } catch (\Throwable $e) {
            return $this->failServerError('Erro banco: ' . $e->getMessage());
        }
    }
}