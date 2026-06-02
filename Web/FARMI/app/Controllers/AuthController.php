<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class AuthController extends BaseController
{
    // TELA LOGIN
    public function login()
    {
        return view('sistema/auth/login');
    }

    // AUTENTICA USUÁRIO
    public function autenticar()
    {
        $model = new UsuariosModel();

        $usuario = $model
            ->where('EMAIL', $this->request->getPost('email'))
            ->first();

        if ($usuario)
        {
            if (password_verify($this->request->getPost('senha'), $usuario['SENHA']))
            {
                session()->set([
                    'usuario_cpf'    => $usuario['CPF'],
                    'usuario_nome'   => $usuario['NOME'],
                    'usuario_perfil' => $usuario['PERFIL'], // Administrador ou Usuario
                    'logado'         => true
                ]);

                // Redireciona conforme perfil
                if ($usuario['PERFIL'] == 'Admin')
                {
                    return redirect()->to('/dashboard-admin');
                }

                return redirect()->to('/dashboard-usuario');
            }
        }

        session()->setFlashdata('erro', 'Usuário ou senha inválidos!');

        return redirect()->to('/login');
    }

    // LOGOUT
    public function logout()
    {
        // Destrói sessão
        session()->destroy();

        // Redireciona login
        return redirect()->to('/login');
    }

    // TELA ESQUECEU SENHA
    public function esqueceu_senha()
    {
        return view('sistema/auth/esqueceu_senha');
    }

}