<?php

namespace App\Controllers;

use App\Models\CulturaModel;
use App\Controllers\BaseController;
use App\Models\FazendaModel;

class CulturaController extends BaseController
{
   public function index()
{
    $culturaModel = new CulturaModel();
    $fazendaModel = new FazendaModel();

    $cpf = session()->get('usuario_cpf');

    $dados['culturas'] = $culturaModel
        ->select('CULTURA.*, FAZENDA.NOME AS NOME_FAZENDA')
        ->join('FAZENDA', 'FAZENDA.ID_FAZENDA = CULTURA.FK_ID_FAZENDA')
        ->join(
            'USUARIOS_FAZENDA',
            'USUARIOS_FAZENDA.ID_FAZENDA = CULTURA.FK_ID_FAZENDA'
        )
        ->where(
            'USUARIOS_FAZENDA.ID_CPF_USUARIOS',
            $cpf
        )
        ->findAll();

    $dados['fazendas'] = $fazendaModel
        ->select('FAZENDA.*')
        ->join(
            'USUARIOS_FAZENDA',
            'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA'
        )
        ->where(
            'USUARIOS_FAZENDA.ID_CPF_USUARIOS',
            $cpf
        )
        ->findAll();

    return view('sistema/farmi_adm/cultura', $dados);
}

    public function novo()
    {
        return view('sistema/farmi_adm/cultura/nova_cultura');
    }
    public function pagina_editar()
    {
        return view('sistema/farmi_adm/editar_culturas');
    }

    public function inserir()
    {
        $model = new CulturaModel();

        $dados = [
            'NOME_CULTURA' => $this->request->getPost('NOME_CULTURA'),
            'DATA_PLANTIO' => $this->request->getPost('DATA_PLANTIO'),
            'CICLO_PRODUTIVO' => $this->request->getPost('CICLO_PRODUTIVO'),
            'AREA_CULTIVADA' => $this->request->getPost('AREA_CULTIVADA'),
            'TIPO_CULTURA' => $this->request->getPost('TIPO_CULTURA'),
            'SENSOR_LUZ' => $this->request->getPost('SENSOR_LUZ'),
            'SENSOR_CLIMA_TEMPO' => $this->request->getPost('SENSOR_CLIMA_TEMPO'),
            'SENSOR_CLIMA_UMIDADE' => $this->request->getPost('SENSOR_CLIMA_UMIDADE'),
            'SENSOR_SOLO' => $this->request->getPost('SENSOR_SOLO'),
            'STATUS' => $this->request->getPost('STATUS'),
            'FK_ID_FAZENDA' => $this->request->getPost('FK_ID_FAZENDA')
        ];
        
        $model->insert($dados);
        return redirect()->to('/cultura-admin');
    }

    public function editar($id)
    {
        $model = new CulturaModel();
        $dados['cultura'] = $model->find($id);

        $fazendaModel = new \App\Models\FazendaModel();
        $dados['fazendas'] = $fazendaModel->findAll();
        $dados['fazendasSelecionadas'] = !empty($dados['cultura']['FK_ID_FAZENDA'])
        ? explode('|', $dados['cultura']['FK_ID_FAZENDA'])
        : [];
        
        // print_r($dados);
        // die();

        return view('sistema/farmi_adm/editar_culturas', $dados);
    }

    public function atualizar($id)
    {
        $model = new CulturaModel();

        $dados = [
            'NOME_CULTURA' => $this->request->getPost('NOME_CULTURA'),
            'DATA_PLANTIO' => $this->request->getPost('DATA_PLANTIO'),
            'CICLO_PRODUTIVO' => $this->request->getPost('CICLO_PRODUTIVO'),
            'AREA_CULTIVADA' => $this->request->getPost('AREA_CULTIVADA'),
            'TIPO_CULTURA' => $this->request->getPost('TIPO_CULTURA'),
            'SENSOR_LUZ' => $this->request->getPost('SENSOR_LUZ'),
            'SENSOR_CLIMA_TEMPO' => $this->request->getPost('SENSOR_CLIMA_TEMPO'),
            'SENSOR_CLIMA_UMIDADE' => $this->request->getPost('SENSOR_CLIMA_UMIDADE'),
            'SENSOR_SOLO' => $this->request->getPost('SENSOR_SOLO'),
            'STATUS' => $this->request->getPost('STATUS'),
            'FK_ID_FAZENDA' => $this->request->getPost('FK_ID_FAZENDA')
        ];

        $model->update($id, $dados);
        return redirect()->to('/cultura-admin');
    }

    public function excluir($id)
    {
        $model = new CulturaModel();
        $model->delete($id);
        return redirect()->to('/cultura-admin');
    }
}