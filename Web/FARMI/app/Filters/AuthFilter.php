<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Ignora requisições para a API (evita redirecionamento HTML em rotas de API/ESP32/Flutter)
        if ($request->getUri()->getSegment(1) === 'api') {
            return;
        }

        // 2. Verifica se o usuário está autenticado no sistema Web
        if (! session()->get('logado')) {
            return redirect()->to('/login')->with('error', 'Sua sessão expirou. Faça login novamente.');
        }

        $perfil = session()->get('usuario_perfil');
        $rota   = $request->getUri()->getSegment(1);

        // 3. GESTOR / ADMIN - Impede acesso às telas exclusivas do usuário comum
        if ($perfil === 'Gestor' && in_array($rota, [
            'dashboard-usuario',
            'usuario',
            'temperatura',
            'umidade',
            'solo',
            'luz',
            'configuracoes-usuario',
            'alterar-senha',
            'alertas-usuario',
        ])) {
            return redirect()->to('/dashboard-admin');
        }

        // 4. FUNCIONÁRIO / USUÁRIO - Impede acesso às telas administrativas
        if ($perfil === 'Funcionário' && in_array($rota, [
            'dashboard-admin',
            'fazenda',
            'fazendas-admin',
            'adicionar-fazenda',
            'cultura-admin',
            'cultura',
            'sensor',
            'usuarios-admin',
            'usuarios',
            'usuarios_editar',
            'leitura_sensor',
            'alertas-admin',
            'configuracoes-admin',
            'alterar-senha-admin',
            'recuperar-senha-admin',
        ])) {
            return redirect()->to('/dashboard-usuario');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Método obrigatório da interface
    }
}