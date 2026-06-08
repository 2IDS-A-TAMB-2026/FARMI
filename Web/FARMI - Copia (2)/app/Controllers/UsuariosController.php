<?php

namespace App\Controllers;

use App\Models\UsuariosModel;
use App\Models\FazendaModel;
use App\Models\UsuariosFazendaModel;
use App\Controllers\BaseController;


class UsuariosController extends BaseController
{
    public function index()
{
    $model = new UsuariosModel();

    // CPF do gestor logado
    $cpfGestor = session()->get('usuario_cpf');

    $dados['usuarios'] = $model
        ->select("
            USUARIOS.*,
            GROUP_CONCAT(DISTINCT FAZENDA.NOME SEPARATOR '|') AS FAZENDAS
        ")
        ->join(
            'USUARIOS_FAZENDA UF1',
            'UF1.ID_CPF_USUARIOS = USUARIOS.CPF',
            'left'
        )
        ->join(
            'FAZENDA',
            'FAZENDA.ID_FAZENDA = UF1.ID_FAZENDA',
            'left'
        )
        ->join(
            'USUARIOS_FAZENDA UF2',
            'UF2.ID_FAZENDA = UF1.ID_FAZENDA'
        )
        ->where(
            'UF2.ID_CPF_USUARIOS',
            $cpfGestor
        )
        ->groupBy('USUARIOS.CPF')
        ->findAll();

    $fazendaModel = new \App\Models\FazendaModel();

    // Apenas fazendas do gestor no dropdown
    $dados['fazendas'] = $fazendaModel
        ->select('FAZENDA.*')
        ->join(
            'USUARIOS_FAZENDA',
            'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA'
        )
        ->where(
            'USUARIOS_FAZENDA.ID_CPF_USUARIOS',
            $cpfGestor
        )
        ->findAll();

    return view('sistema/farmi_adm/usuarios', $dados);
}

    public function novo()
    {
        return view('sistema/farmi_adm/usuarios/novo_usuario');
    }

    public function pagina_editar($cpf)
    {
        $model = new UsuariosModel();
        $dados['usuarios'] = $model
            ->select('
                USUARIOS.*,
                GROUP_CONCAT(
                    FAZENDA.NOME
                    SEPARATOR "|"
                ) AS FAZENDAS,

                GROUP_CONCAT(
                    FAZENDA.ID_FAZENDA
                    SEPARATOR "|"
                ) AS IDS_FAZENDAS
            ')
            ->join(
                'USUARIOS_FAZENDA',
                'USUARIOS_FAZENDA.ID_CPF_USUARIOS = USUARIOS.CPF',
                'left'
            )
            ->join(
                'FAZENDA',
                'FAZENDA.ID_FAZENDA = USUARIOS_FAZENDA.ID_FAZENDA',
                'left'
            )
            ->where('USUARIOS.CPF', $cpf)
            ->first();
            

        $fazendaModel = new \App\Models\FazendaModel();
        $dados['fazendas'] = $fazendaModel->findAll();
        $dados['fazendasSelecionadas'] = !empty($dados['usuarios']['IDS_FAZENDAS'])
        ? explode('|', $dados['usuarios']['IDS_FAZENDAS'])
        : [];


        // PRINT_R($dados);
        //     die();
            
        return view('sistema/farmi_adm/usuarios_editar', $dados);
    }

    public function inserir()
    {
        $model = new UsuariosModel();

        $dados = [
            'CPF' => $this->request->getPost('CPF'),
            'NOME' => $this->request->getPost('NOME'),
            'EMAIL' => $this->request->getPost('EMAIL'),
            'SENHA' => password_hash($this->request->getPost('SENHA'), PASSWORD_DEFAULT),
            'PERFIL' => $this->request->getPost('PERFIL'),
            'DATA_CADASTRO' => date('Y-m-d'),
            'STATUS' => $this->request->getPost('STATUS')
        ];

        $model->insert($dados);

        $fazendas = $this->request->getPost('FAZENDAS');
        $modelUF = new UsuariosFazendaModel();

        if($fazendas)
        {
            foreach($fazendas as $idFazenda)
            {
                $modelUF->insert([
                    'ID_CPF_USUARIOS' => $dados['CPF'],
                    'ID_FAZENDA' => $idFazenda
                ]);
            }
        }

        return redirect()->to('/usuarios-admin');
    }

    public function editar($cpf)
    {
        $model = new UsuariosModel();
        $dados['usuarios'] = $model->find($cpf);
        return view('sistema/farmi_adm/usuarios/editar_usuario', $dados);
    }

    public function atualizar($cpf)
    {
        $model = new UsuariosModel();

        // print_r($this->request->getPost('NOME'));
        // die();

        $dados = [
            // 'CPF' => $this->request->getPost('CPF'),
            'NOME' => $this->request->getPost('NOME'),
            'EMAIL' => $this->request->getPost('EMAIL'),
            'PERFIL' => $this->request->getPost('PERFIL'),
            'DATA_CADASTRO' => $this->request->getPost('DATA_CADASTRO'),
            'STATUS' => $this->request->getPost('STATUS')
        ];

        // Verifica se digitou nova senha
        if($this->request->getPost('SENHA') != '')
        {
            // Atualiza senha criptografada
            $dados['SENHA'] = password_hash(
                $this->request->getPost('SENHA'),
                PASSWORD_DEFAULT
            );
        }

        $model->update($cpf, $dados);
        
        // Atualiza fazendas
        $modelUF = new UsuariosFazendaModel();

        // Remove vínculos antigos
        $modelUF
            ->where('ID_CPF_USUARIOS', $cpf)
            ->delete();

        // Insere os novos vínculos
        $fazendas = $this->request->getPost('FAZENDAS');

        if ($fazendas)
        {
            foreach ($fazendas as $idFazenda)
            {
                $modelUF->insert([
                    'ID_CPF_USUARIOS' => $cpf,
                    'ID_FAZENDA'      => $idFazenda
                ]);
            }
        }

        return redirect()->to('/usuarios-admin');
    }

    public function excluir($cpf)
    {
        $model = new UsuariosModel();
        $model->delete($cpf);
        return redirect()->to('/usuarios-admin');
    }

    public function dashboard_usuario()
{
    return view('sistema/farmi_usuario/dashboard');
}

public function usuario()
{
    return view('sistema/farmi_usuario/usuario');
}

public function temperatura()
{
    return view('sistema/farmi_usuario/temperatura');
}

public function umidade()
{
    return view('sistema/farmi_usuario/umidade');
}

public function solo()
{
    return view('sistema/farmi_usuario/solo');
}

public function luz()
{
    return view('sistema/farmi_usuario/luz');
}

public function configuracoes_usuario()
{
    return view('sistema/farmi_usuario/configuracoes');
}

public function alterar_senha()
{
    return view('sistema/farmi_usuario/alterar_senha');
}

public function recuperar_senha()
{
    return view('sistema/farmi_usuario/recuperar_senha');
}
}