<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        $model = new AdminModel();
        $dados['admin'] = $model->findAll();
        return view('sistema/admin/index', $dados);
    }

    public function novo()
    {
        return view('sistema/admin/novo_admin');
    }

    public function inserir()
    {
        $model = new AdminModel();

        $dados = [
            'CPF' => $this->request->getPost('CPF'),
            'NOME' => $this->request->getPost('NOME'),
            'EMAIL' => $this->request->getPost('EMAIL'),
            'SENHA' => password_hash($this->request->getPost('SENHA'), PASSWORD_DEFAULT),
            'DATA_CADASTRO' => $this->request->getPost('DATA_CADASTRO')
        ];

        $model->insert($dados);
        return redirect()->to('/admin');
    }

    public function editar($cpf)
    {
        $model = new AdminModel();
        $dados['admin'] = $model->find($cpf);
        return view('sistema/admin/editar_admin', $dados);
    }

    public function atualizar($cpf)
    {
        $model = new AdminModel();

        $dados = [
            'CPF' => $this->request->getPost('CPF'),
            'NOME' => $this->request->getPost('NOME'),
            'EMAIL' => $this->request->getPost('EMAIL'),
            'DATA_CADASTRO' => $this->request->getPost('DATA_CADASTRO')
        ];

        $model->update($cpf, $dados);
        return redirect()->to('/admin');
    }

    public function excluir($cpf)
    {
        $model = new AdminModel();
        $model->delete($cpf);
        return redirect()->to('/admin');
    }
}