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

        if (in_array($perfil, ['ADMIN', 'GESTOR', 'ADMINISTRADOR', 'G'])) {
            return 'Gestor';
        }

        return 'Funcionário';
    }

    // MÉTODO POST: Recebe o e-mail e a senha enviados pelo Flutter Web
    public function login()
    {
        // Força os cabeçalhos de resposta JSON
        $this->response->setHeader('Content-Type', 'application/json');

        try {
            // Captura o corpo da requisição JSON enviada pelo Flutter
            $json = $this->request->getJSON(true) ?? $this->request->getPost();

            $email = $json['email'] ?? null;
            $senha = $json['senha'] ?? null;

            if (empty($email) || empty($senha)) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status'  => 400,
                    'message' => 'E-mail e senha são obrigatórios.'
                ]);
            }

            $model = new UsuariosModel();
            
            // Busca o registro do usuário pelo e-mail
            $usuario = $model->where('EMAIL', $email)->first();

            if (!$usuario) {
                return $this->response->setStatusCode(401)->setJSON([
                    'status'  => 401,
                    'message' => 'Usuário não encontrado.'
                ]);
            }

            // Compara a senha informada com a hash Bcrypt gravada na coluna SENHA
            if (!password_verify($senha, $usuario['SENHA'])) {
                return $this->response->setStatusCode(401)->setJSON([
                    'status'  => 401,
                    'message' => 'Senha incorreta.'
                ]);
            }

            // Retorna o sucesso e os dados necessários para o Flutter
            return $this->response->setStatusCode(200)->setJSON([
                'status'  => 200,
                'message' => 'Login realizado com sucesso',
                'user'    => [
                    'cpf'    => $usuario['CPF'] ?? '',
                    'nome'   => $usuario['NOME'] ?? '',
                    'email'  => $usuario['EMAIL'],
                    'perfil' => $this->mapearPerfil($usuario['PERFIL'] ?? '')
                ]
            ]);

        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500)->setJSON([
                'status'  => 500,
                'message' => 'Erro interno do servidor: ' . $th->getMessage()
            ]);
        }
    }

    // MÉTODO GET: Retorna a listagem simples dos usuários registrados
    public function index()
    {
        $model = new UsuariosModel();
        $usuarios = $model->findAll();

        $resultado = array_map(function($usuario) {
            return [
                'email'  => $usuario['EMAIL'],
                'perfil' => $this->mapearPerfil($usuario['PERFIL'])
            ];
        }, $usuarios);

        return $this->respond($resultado);
    }
}