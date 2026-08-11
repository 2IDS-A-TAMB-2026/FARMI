<?php

namespace App\Controllers;

use App\Models\FazendaModel;
use App\Controllers\BaseController;

class FazendaController extends BaseController
{
    public function index()
    {
        $model = new FazendaModel();
        $cpf = session()->get('usuario_cpf');
        $pesquisa = $this->request->getGet('pesquisar');

        $query = $model
            ->select('FAZENDA.*')
            ->join(
                'USUARIOS_FAZENDA',
                'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA'
            )
            ->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $cpf);

        if (!empty($pesquisa)) {
            $dados['fazenda'] = $query
                ->like('FAZENDA.NOME', $pesquisa)
                ->findAll();

            if (empty($dados['fazenda'])) {
                session()->setFlashdata(
                    'erro',
                    'Não existe nenhuma fazenda cadastrada com esse nome.'
                );
            }
        } else {
            $dados['fazenda'] = $query->findAll();
        }

        return view('sistema/farmi_adm/fazendas', $dados);
    }

    public function novo()
    {
        return view('sistema/farmi_adm/adicionar_fazenda');
    }

    public function inserir()
    {
        $model = new FazendaModel();

        $dados = [
            'NOME'       => $this->request->getPost('NOME'),
            'LATITUDE'   => $this->request->getPost('LATITUDE'),
            'LONGITUDE'  => $this->request->getPost('LONGITUDE'),
            'LOGRADOURO' => $this->request->getPost('LOGRADOURO'),
            'NUMERO'     => $this->request->getPost('NUMERO'),
            'CEP'        => $this->request->getPost('CEP'),
            'AREA_TOTAL' => $this->request->getPost('AREA_TOTAL')
        ];

        // 1. Inserção
        $model->insert($dados);
        $idFazenda = $model->insertID();

        // 2. Vínculo Usuário <-> Fazenda
        $cpfGestor = session()->get('usuario_cpf');
        $db = \Config\Database::connect();

        $db->table('USUARIOS_FAZENDA')->insert([
            'ID_CPF_USUARIOS' => $cpfGestor,
            'ID_FAZENDA'      => $idFazenda
        ]);

        return redirect()->to('/fazendas-admin');
    }

    // CORRIGIDO: Agora busca a FAZENDA correta e abre a tela de editar fazenda
    public function editar($id)
    {
        $model = new FazendaModel();
        $cpfGestor = session()->get('usuario_cpf');

        $dados['fazenda'] = $model
            ->select('FAZENDA.*')
            ->join(
                'USUARIOS_FAZENDA',
                'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA'
            )
            ->where('FAZENDA.ID_FAZENDA', $id)
            ->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $cpfGestor)
            ->first();

        if (!$dados['fazenda']) {
            return redirect()->to('/fazendas-admin');
        }

        return view('sistema/farmi_adm/editar_fazendas', $dados);
    }

    public function atualizar($id)
    {
        $model = new FazendaModel();

        $dados = [
            'NOME'       => $this->request->getPost('NOME'),
            'LATITUDE'   => $this->request->getPost('LATITUDE'),
            'LONGITUDE'  => $this->request->getPost('LONGITUDE'),
            'LOGRADOURO' => $this->request->getPost('LOGRADOURO'),
            'NUMERO'     => $this->request->getPost('NUMERO'),
            'CEP'        => $this->request->getPost('CEP'),
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