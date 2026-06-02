<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    )
    {
        // Não logado
        if (!session()->get('logado'))
        {
            return redirect()->to('/login');
        }

        $perfil = session()->get('usuario_perfil');
        $rota = service('uri')->getSegment(1);

        // ADMIN não acessa área de usuário
        if (
            $perfil == 'Gestor'
            &&
            in_array($rota, [
                'dashboard-usuario',
                'usuario',
                'temperatura',
                'umidade',
                'solo',
                'luz',
                'configuracoes-usuario',
                'alterar-senha-usuario'
            ])
        )
        {
            return redirect()->to('/dashboard-admin');
        }

        // USUÁRIO não acessa área admin
        if (
            $perfil == 'Funcionário'
            &&
            in_array($rota, [
                'dashboard-admin',
                'fazendas',
                'adicionar-fazenda',
                'editar-fazenda',
                'sensores',
                'editar-sensor',
                'cultura',
                'usuarios',
                'usuarios-editar',
                'alertas',
                'configuracoes-admin',
                'alterar-senha-admin'
            ])
        )
        {
            return redirect()->to('/dashboard-usuario');
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    )
    {
    }
}