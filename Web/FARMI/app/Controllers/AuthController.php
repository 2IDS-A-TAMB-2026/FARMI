<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use League\OAuth2\Client\Provider\Google;

class AuthController extends BaseController
{
    // TELA LOGIN
    public function login()
    {
        return view('sistema/auth/login');
    }

    // AUTENTICA USUÁRIO COM E-MAIL E SENHA
    public function autenticar()
    {
        $model = new UsuariosModel();

        $usuario = $model
            ->where('EMAIL', $this->request->getPost('email'))
            ->first();

        if ($usuario) {
            if (password_verify($this->request->getPost('senha'), $usuario['SENHA'])) {

                session()->set([
                    'usuario_cpf'    => $usuario['CPF'],
                    'usuario_nome'   => $usuario['NOME'],
                    'usuario_perfil' => $usuario['PERFIL'],
                    'logado'         => true
                ]);

                // Redireciona conforme perfil
                if ($usuario['PERFIL'] == 'Admin') {
                    return redirect()->to('/dashboard-admin');
                }

                return redirect()->to('/dashboard-usuario');
            }
        }

        session()->setFlashdata(
            'erro',
            'Usuário ou senha inválidos!'
        );

        return redirect()->to('/login');
    }

    // ==========================================
    // LOGIN COM GOOGLE
    // ==========================================

    // ENVIA O USUÁRIO PARA A TELA DE LOGIN DO GOOGLE
    public function google()
    {
        $provider = new Google([
            'clientId'     => env('GOOGLE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_CLIENT_SECRET'),
            'redirectUri'  => env('GOOGLE_REDIRECT_URI'),
        ]);

        // Gera o estado de segurança do OAuth
        $authorizationUrl = $provider->getAuthorizationUrl([
            'scope' => [
                'openid',
                'email',
                'profile'
            ]
        ]);

        // Guarda o state na sessão para validar no retorno
        session()->set('oauth2state', $provider->getState());

        return redirect()->to($authorizationUrl);
    }

    // RECEBE O RETORNO DO GOOGLE
    public function googleCallback()
    {
        $provider = new Google([
            'clientId'     => env('GOOGLE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_CLIENT_SECRET'),
            'redirectUri'  => env('GOOGLE_REDIRECT_URI'),
        ]);

        // Verifica se o Google retornou um código
        if (!$this->request->getGet('code')) {
            session()->setFlashdata(
                'erro',
                'Não foi possível realizar o login com o Google.'
            );

            return redirect()->to('/login');
        }

        // Verifica o state para evitar requisições falsas
        if (
            !$this->request->getGet('state') ||
            $this->request->getGet('state') !== session()->get('oauth2state')
        ) {
            session()->remove('oauth2state');

            session()->setFlashdata(
                'erro',
                'Falha de segurança ao realizar o login com o Google.'
            );

            return redirect()->to('/login');
        }

        // Remove o state depois de validado
        session()->remove('oauth2state');

        try {

            // Troca o código recebido pelo token do Google
            $token = $provider->getAccessToken(
                'authorization_code',
                [
                    'code' => $this->request->getGet('code')
                ]
            );

            // Busca os dados do usuário no Google
            $googleUser = $provider->getResourceOwner($token);

            $email = $googleUser->getEmail();
            $nome  = $googleUser->getName();

            // Procura o usuário no banco pelo e-mail
            $model = new UsuariosModel();

            $usuario = $model
                ->where('EMAIL', $email)
                ->first();

            // Se não existir no banco
            if (!$usuario) {

                session()->setFlashdata(
                    'erro',
                    'Este e-mail do Google não está cadastrado no FARMI.'
                );

                return redirect()->to('/login');
            }

            // Cria a mesma sessão usada pelo login normal
            session()->set([
                'usuario_cpf'    => $usuario['CPF'],
                'usuario_nome'   => $usuario['NOME'],
                'usuario_perfil' => $usuario['PERFIL'],
                'logado'         => true
            ]);

            // Redireciona conforme o perfil
            if ($usuario['PERFIL'] == 'Admin') {
                return redirect()->to('/dashboard-admin');
            }

            return redirect()->to('/dashboard-usuario');

        } catch (\Exception $e) {

            session()->setFlashdata(
                'erro',
                'Ocorreu um erro ao realizar o login com o Google.'
            );

            return redirect()->to('/login');
        }
    }

    // LOGOUT
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }

    // TELA ESQUECEU SENHA
    public function esqueceu_senha()
    {
        return view('sistema/auth/esqueceu_senha');
    }
}