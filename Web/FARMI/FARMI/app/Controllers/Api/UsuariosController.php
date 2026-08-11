<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuariosModel;

class UsuariosController extends ResourceController
{
    protected $modelName = 'App\Models\UsuariosModel';
    protected $format    = 'json';

    /**
     * Auxiliar para obter o CPF do gestor logado (Sessão, Header ou Query String)
     */
    private function getCpfGestor()
    {
        return session()->get('usuario_cpf') 
            ?? $this->request->getHeaderLine('X-User-CPF') 
            ?? $this->request->getGet('cpf');
    }

    /**
 * GET /api/usuarios
 * Lista TODOS os usuários do sistema (ou filtra por gestor se o CPF for informado)
 */
public function index()
{
    $cpfGestor = $this->getCpfGestor();

    $builder = $this->model
        ->select("
            USUARIOS.CPF,
            USUARIOS.NOME,
            USUARIOS.EMAIL,
            USUARIOS.PERFIL,
            USUARIOS.DATA_CADASTRO,
            USUARIOS.STATUS,
            GROUP_CONCAT(DISTINCT FAZENDA.NOME SEPARATOR '|') AS FAZENDAS
        ")
        ->join(
            'USUARIOS_FAZENDA UF1',
            'UF1.ID_CPF_USUARIOS = USUARIOS.CPF',
            'left'
        )
        ->join(
            'FAZENDA',
            'FAZENDA.ID_FAZENDA = UF1.ID_FAZENDA',
            'left'
        );

    // Se o CPF for passado na requisição, filtra apenas os usuários do gestor
    if ($cpfGestor) {
        $builder->join(
            'USUARIOS_FAZENDA UF2',
            'UF2.ID_FAZENDA = UF1.ID_FAZENDA'
        )->where('UF2.ID_CPF_USUARIOS', $cpfGestor);
    }

    $usuarios = $builder->groupBy('USUARIOS.CPF')->findAll();

    // Converte a string de fazendas para Array no JSON
    foreach ($usuarios as &$user) {
        $user['FAZENDAS'] = !empty($user['FAZENDAS']) ? explode('|', $user['FAZENDAS']) : [];
    }

    return $this->respond([
        'status' => 200,
        'total'  => count($usuarios),
        'data'   => $usuarios
    ]);
}

    /**
     * GET /api/usuarios/(:segment)
     * Detalhes de um usuário específico pelo CPF
     */
    public function show($cpf = null)
    {
        $cpfGestor = $this->getCpfGestor();

        if (!$cpfGestor) {
            return $this->failUnauthorized('CPF do gestor não informado.');
        }

        $usuario = $this->model
            ->select('
                USUARIOS.CPF,
                USUARIOS.NOME,
                USUARIOS.EMAIL,
                USUARIOS.PERFIL,
                USUARIOS.DATA_CADASTRO,
                USUARIOS.STATUS,
                GROUP_CONCAT(FAZENDA.NOME SEPARATOR "|") AS FAZENDAS,
                GROUP_CONCAT(FAZENDA.ID_FAZENDA SEPARATOR "|") AS IDS_FAZENDAS
            ')
            ->join(
                'USUARIOS_FAZENDA',
                'USUARIOS_FAZENDA.ID_CPF_USUARIOS = USUARIOS.CPF',
                'left'
            )
            ->join(
                'FAZENDA',
                'FAZENDA.ID_FAZENDA = USUARIOS_FAZENDA.ID_FAZENDA',
                'left'
            )
            ->where('USUARIOS.CPF', $cpf)
            ->groupBy('USUARIOS.CPF')
            ->first();

        if (!$usuario) {
            return $this->failNotFound('Usuário não encontrado.');
        }

        // Formata as fazendas para o JSON
        $usuario['FAZENDAS']     = !empty($usuario['FAZENDAS']) ? explode('|', $usuario['FAZENDAS']) : [];
        $usuario['IDS_FAZENDAS'] = !empty($usuario['IDS_FAZENDAS']) ? explode('|', $usuario['IDS_FAZENDAS']) : [];

        return $this->respond([
            'status' => 200,
            'data'   => $usuario
        ]);
    }

    /**
     * Bloqueio explícito dos métodos de escrita
     */
    public function create()
    {
        return $this->failMethodNotAllowed('Esta API permite apenas consulta (GET).');
    }

    public function update($id = null)
    {
        return $this->failMethodNotAllowed('Esta API permite apenas consulta (GET).');
    }

    public function delete($id = null)
    {
        return $this->failMethodNotAllowed('Esta API permite apenas consulta (GET).');
    }
}