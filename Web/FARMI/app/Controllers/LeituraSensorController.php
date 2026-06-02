<?php

namespace App\Controllers;

use App\Models\LeituraSensorModel;
use App\Controllers\BaseController;

class LeituraSensorController extends BaseController
{
    public function index()
    {
        $model = new LeituraSensorModel();
        $dados['leitura'] = $model->findAll();
        return view('sistema/leitura_sensor/index', $dados);
    }

    public function novo()
    {
        return view('sistema/leitura_sensor/nova_leitura');
    }

    public function inserir()
    {
        $model = new LeituraSensorModel();

        $dados = [
            'VALOR' => $this->request->getPost('VALOR'),
            'DATA_HORA' => $this->request->getPost('DATA_HORA'),
            'FK_ID_SENSOR' => $this->request->getPost('FK_ID_SENSOR')
        ];

        $model->insert($dados);
        return redirect()->to('/leitura_sensor');
    }

    public function editar($id)
    {
        $model = new LeituraSensorModel();
        $dados['leitura'] = $model->find($id);
        return view('sistema/leitura_sensor/editar_leitura', $dados);
    }

    public function atualizar($id)
    {
        $model = new LeituraSensorModel();

        $dados = [
            'VALOR' => $this->request->getPost('VALOR'),
            'DATA_HORA' => $this->request->getPost('DATA_HORA'),
            'FK_ID_SENSOR' => $this->request->getPost('FK_ID_SENSOR')
        ];

        $model->update($id, $dados);
        return redirect()->to('/leitura_sensor');
    }

    public function excluir($id)
    {
        $model = new LeituraSensorModel();
        $model->delete($id);
        return redirect()->to('/leitura_sensor');
    }
}