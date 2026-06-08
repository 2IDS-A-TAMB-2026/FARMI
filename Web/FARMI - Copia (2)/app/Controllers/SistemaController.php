<?php

namespace App\Controllers;

class SistemaController extends BaseController
{
    // =========================
    // ADMIN
    // =========================

    public function adicionar_fazenda()
    {
        return view('sistema/farmi_adm/adicionar_fazenda');
    }

    public function alertas()
    {
        return view('sistema/farmi_adm/alertas');
    }

    public function alterar_senha_admin()
    {
        return view('sistema/farmi_adm/alterar_senha_admin');
    }

    public function configuracoes_admin()
    {
        return view('sistema/farmi_adm/configuracoes');
    }

    public function cultura()
    {
        return view('sistema/farmi_adm/cultura');
    }

    public function dashboard_admin()
    {
        $sensorModel  = new \App\Models\SensorModel();
        $fazendaModel = new \App\Models\FazendaModel();
        $usuariosModel = new \App\Models\UsuariosModel();

        $dados = [
            'total_sensores' => $sensorModel->countAll(),
            'total_fazendas' => $fazendaModel->countAll(),
            'total_usuarios' => $usuariosModel->countAll(),
        ];

        return view('sistema/farmi_adm/dashboard', $dados);
    }

    public function fazendas()
    {
        return view('sistema/farmi_adm/fazendas');
    }

    public function recuperar_senha_admin()
    {
        return view('sistema/farmi_adm/recuperar_senha_admin');
    }

    public function sensores()
    {
        return view('sistema/farmi_adm/sensores');
    }

    public function usuarios()
    {
        return view('sistema/farmi_adm/usuarios');
    }

    // =========================
    // USUÁRIO
    // =========================

    public function alterar_senha()
    {
        return view('sistema/farmi_usuario/alterar_senha');
    }

    public function configuracoes_usuario()
    {
        return view('sistema/farmi_usuario/configuracoes');
    }

    public function dashboard_usuario()
    {
        return view('sistema/farmi_usuario/dashboard');
    }

    public function luz()
    {
        return view('sistema/farmi_usuario/luz');
    }

    public function recuperar_senha()
    {
        return view('sistema/farmi_usuario/recuperar_senha');
    }

    public function solo()
    {
        return view('sistema/farmi_usuario/solo');
    }

    public function temperatura()
    {
        return view('sistema/farmi_usuario/temperatura');
    }

    public function umidade()
    {
        return view('sistema/farmi_usuario/umidade');
    }

    public function usuario()
    {
        return view('sistema/farmi_usuario/usuario');
    }
}