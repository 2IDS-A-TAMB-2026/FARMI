<?php

namespace App\Controllers;

use App\Models\FazendaModel;
use App\Controllers\BaseController;

class FazendaController extends BaseController
{
    public function index()
    {
        $model = new FazendaModel();
        $dados['fazenda'] = $model->findAll();
        return view('sistema/farmi_adm/fazendas', $dados);
    }

    public function novo()
    {
        return view('sistema/farmi_adm/adicionar_fazenda');
    }
    public function pagina_editar()
    {
        return view('sistema/farmi_adm/editar_fazendas');
    }

    public function inserir()
    {
        $model = new FazendaModel();

        $dados = [
            'NOME' => $this->request->getPost('NOME'),
            'LATITUDE' => $this->request->getPost('LATITUDE'),
            'LONGITUDE' => $this->request->getPost('LONGITUDE'),
            'LOGRADOURO' => $this->request->getPost('LOGRADOURO'),
            'NUMERO' => $this->request->getPost('NUMERO'),
            'CEP' => $this->request->getPost('CEP'),
            'AREA_TOTAL' => $this->request->getPost('AREA_TOTAL')
        ];

        $model->insert($dados);
        return redirect()->to('/fazendas-admin');
    }
    public function editar($id)
    {
        $model = new FazendaModel();
        $dados['fazenda'] = $model->find($id);
        return view('sistema/farmi_adm/editar_fazendas', $dados);
    }

    public function atualizar($id)
    {
        $model = new FazendaModel();

        $dados = [
            'NOME' => $this->request->getPost('NOME'),
            'LATITUDE' => $this->request->getPost('LATITUDE'),
            'LONGITUDE' => $this->request->getPost('LONGITUDE'),
            'LOGRADOURO' => $this->request->getPost('LOGRADOURO'),
            'NUMERO' => $this->request->getPost('NUMERO'),
            'CEP' => $this->request->getPost('CEP'),
            'AREA_TOTAL' => $this->request->getPost('AREA_TOTAL')
        ];

        $model->update($id, $dados);
        return redirect()->to('/fazendas-admin');
    }

    public function excluir($id)
    {
        $model = new FazendaModel();
        $model->delete($id);
        return redirect()->to('/fazendas-admin');
    }
}