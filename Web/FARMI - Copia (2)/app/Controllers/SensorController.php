<?php

namespace App\Controllers;

use App\Models\SensorModel;
use App\Models\CulturaModel;
use App\Controllers\BaseController;

class SensorController extends BaseController
{
   public function index()
{
    $sensorModel = new SensorModel();
    $culturaModel = new CulturaModel();

    $idGestor = session()->get('usuario_cpf');

    // SENSORES DO GESTOR
    $dados['sensor'] = $sensorModel
        ->select('SENSOR.*')
        ->join('CULTURA', 'CULTURA.ID_CULTURA = SENSOR.FK_ID_CULTURA')
        ->join('FAZENDA', 'FAZENDA.ID_FAZENDA = CULTURA.FK_ID_FAZENDA')
        ->join('USUARIOS_FAZENDA', 'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA')
        ->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $idGestor)
        ->findAll();

    // CULTURAS DO GESTOR (IMPORTANTE PARA O SELECT DO FORM)
    $dados['culturas'] = $culturaModel
        ->select('CULTURA.*')
        ->join('FAZENDA', 'FAZENDA.ID_FAZENDA = CULTURA.FK_ID_FAZENDA')
        ->join('USUARIOS_FAZENDA', 'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA')
        ->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $idGestor)
        ->findAll();

    return view('sistema/farmi_adm/sensores', $dados);
}

    public function novo()
    {
        return view('sistema/sensor/novo_sensor');
    }

    public function pagina_editar()
    {
        return view('sistema/farmi_adm/editar_sensores');
    }

    public function inserir()
    {
        $model = new SensorModel();

        $dados = [
            'NOME_SENSOR' => $this->request->getPost('NOME_SENSOR'),
            'TIPO_SENSOR' => $this->request->getPost('TIPO_SENSOR'),
            'UNIDADE_MEDIDA' => $this->request->getPost('UNIDADE_MEDIDA'),
            'STATUS' => $this->request->getPost('STATUS'),
            'DATA_INSTALACAO' => $this->request->getPost('DATA_INSTALACAO'),
            'FK_ID_CULTURA' => $this->request->getPost('FK_ID_CULTURA')
        ];

        $model->insert($dados);
        return redirect()->to('/sensor');
    }

    public function editar($id)
    {   
        $culturaModel = new CulturaModel();
        // Busca culturas do banco
        $dados['culturas'] = $culturaModel->findAll();

        $model = new SensorModel();
        $dados['sensor'] = $model->find($id);
        return view('sistema/farmi_adm/editar_sensores', $dados);
    }

    public function atualizar($id)
    {
        $model = new SensorModel();

        $dados = [
            'NOME_SENSOR' => $this->request->getPost('NOME_SENSOR'),
            'TIPO_SENSOR' => $this->request->getPost('TIPO_SENSOR'),
            'UNIDADE_MEDIDA' => $this->request->getPost('UNIDADE_MEDIDA'),
            'STATUS' => $this->request->getPost('STATUS'),
            'DATA_INSTALACAO' => $this->request->getPost('DATA_INSTALACAO'),
            'FK_ID_CULTURA' => $this->request->getPost('FK_ID_CULTURA')
        ];

        $model->update($id, $dados);
        return redirect()->to('/sensor');
    }

    public function excluir($id)
    {
        $model = new SensorModel();
        $model->delete($id);
        return redirect()->to('/sensor');
    }
}