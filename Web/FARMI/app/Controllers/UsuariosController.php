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

    $cpfGestor = session()->get('usuario_cpf');

    $fazendaModel = new \App\Models\FazendaModel();

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

    $dados['fazendasSelecionadas'] = !empty($dados['usuarios']['IDS_FAZENDAS'])
        ? explode('|', $dados['usuarios']['IDS_FAZENDAS'])
        : [];

    return view('sistema/farmi_adm/usuarios_editar', $dados);
}
    public function inserir()
    {
        $model = new UsuariosModel();

        $cpf = $this->request->getPost('CPF');
        $email = $this->request->getPost('EMAIL');

        // Verifica se o CPF já existe
        $cpfExistente = $model
            ->where('CPF', $cpf)
            ->first();

        if ($cpfExistente) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Este CPF já está cadastrado no sistema!');
        }

        // Verifica se o e-mail já existe
        $emailExistente = $model
            ->where('EMAIL', $email)
            ->first();

        if ($emailExistente) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Este e-mail já está cadastrado no sistema!');
        }

        $dados = [
            'CPF' => $cpf,
            'NOME' => $this->request->getPost('NOME'),
            'EMAIL' => $email,
            'SENHA' => password_hash(
                $this->request->getPost('SENHA'),
                PASSWORD_DEFAULT
            ),
            'PERFIL' => $this->request->getPost('PERFIL'),
            'DATA_CADASTRO' => date('Y-m-d'),
            'STATUS' => $this->request->getPost('STATUS')
        ];

        $fazendas = $this->request->getPost('FAZENDAS');

        if (empty($fazendas)) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Selecione pelo menos uma fazenda!');
        }

        $model->insert($dados);

        $fazendas = $this->request->getPost('FAZENDAS');
        $modelUF = new UsuariosFazendaModel();

        if ($fazendas) {
            foreach ($fazendas as $idFazenda) {
                $modelUF->insert([
                    'ID_CPF_USUARIOS' => $dados['CPF'],
                    'ID_FAZENDA' => $idFazenda
                ]);
            }
        }

        return redirect()->to('/usuarios-admin')
            ->with('sucesso', 'Usuário cadastrado com sucesso!');
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

        $email = $this->request->getPost('EMAIL');

        // Verifica se o e-mail pertence a outro usuário
        $emailExistente = $model
            ->where('EMAIL', $email)
            ->where('CPF !=', $cpf)
            ->first();

        if ($emailExistente) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Este e-mail já está sendo utilizado por outro usuário!');
        }

        $dados = [
            'NOME' => $this->request->getPost('NOME'),
            'EMAIL' => $email,
            'PERFIL' => $this->request->getPost('PERFIL'),
            'DATA_CADASTRO' => $this->request->getPost('DATA_CADASTRO'),
            'STATUS' => $this->request->getPost('STATUS')
        ];

        if ($this->request->getPost('SENHA') != '') {
            $dados['SENHA'] = password_hash(
                $this->request->getPost('SENHA'),
                PASSWORD_DEFAULT
            );
        }

        $fazendas = $this->request->getPost('FAZENDAS');

        if (empty($fazendas)) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Selecione pelo menos uma fazenda!');
        }

        $model->update($cpf, $dados);

        $modelUF = new UsuariosFazendaModel();

        $modelUF
            ->where('ID_CPF_USUARIOS', $cpf)
            ->delete();

        $fazendas = $this->request->getPost('FAZENDAS');

        if ($fazendas) {
            foreach ($fazendas as $idFazenda) {
                $modelUF->insert([
                    'ID_CPF_USUARIOS' => $cpf,
                    'ID_FAZENDA' => $idFazenda
                ]);
            }
        }

        return redirect()->to('/usuarios-admin')
            ->with('sucesso', 'Usuário atualizado com sucesso!');
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