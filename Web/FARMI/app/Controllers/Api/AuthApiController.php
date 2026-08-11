<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuariosModel;

class AuthApiController extends ResourceController
{
    protected $format = 'json';

    // Normaliza o perfil garantindo apenas "Gestor" ou "Funcionário"
    private function mapearPerfil($perfilDb)
    {
        $perfil = strtoupper(trim($perfilDb ?? ''));

        // Qualquer variação de administrador/gestor vira "Gestor"
        if (in_array($perfil, ['ADMIN', 'GESTOR', 'ADMINISTRADOR', 'G'])) {
            return 'Gestor';
        }

        // O restante é classificado como "Funcionário"
        return 'Funcionário';
    }

    // MÉTODO GET: Retorna e-mail, senha e se é Gestor ou Funcionário
    public function index()
    {
        $model = new UsuariosModel();
        $usuarios = $model->findAll();

        $resultado = array_map(function($usuario) {
            return [
                'email'  => $usuario['EMAIL'],
                'senha'  => $usuario['SENHA'],
                'perfil' => $this->mapearPerfil($usuario['PERFIL'])
            ];
        }, $usuarios);

        return $this->respond($resultado);
    }
}