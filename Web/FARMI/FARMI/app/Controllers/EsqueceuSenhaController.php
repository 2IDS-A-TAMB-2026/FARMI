<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class EsqueceuSenhaController extends BaseController
{
    // TELA ESQUECEU SENHA
    public function index()
    {
        return view('sistema/auth/esqueceu_senha');
    }

    // ENVIA RECUPERAÇÃO
    public function enviar()
    {
        // Instancia model
        $model = new UsuariosModel();

        // Recebe email
        $email = $this->request->getPost('email');

        // Busca usuário
        $usuario = $model
            ->where('EMAIL', $email)
            ->first();

        // Verifica se encontrou
        if (!$usuario)
        {
            session()->setFlashdata('erro', 'E-mail não encontrado!');
            return redirect()->to('/esqueceu-senha');
        }

        /*
        |--------------------------------------------------------------------------
        | AQUI VOCÊ VAI ENVIAR O EMAIL
        |--------------------------------------------------------------------------
        |
        | Exemplo futuro:
        | - gerar token
        | - salvar token no banco
        | - enviar link por email
        |
        */

        // Mensagem sucesso
        session()->setFlashdata(
            'sucesso',
            'Link de recuperação enviado para o e-mail!'
        );

        // Retorna página
        return redirect()->to('/esqueceu-senha');
    }
}