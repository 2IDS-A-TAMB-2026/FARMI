<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class DashboardController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        return $this->respond([
            'status' => true,
            'message' => 'API do dashboard funcionando!'
        ]);
    }
}