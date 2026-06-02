<?php

namespace App\Controllers;

use App\Models\AlertaModel;
use App\Models\SensorModel;
use App\Controllers\BaseController;

class AlertaController extends BaseController
{
    public function index()
    {
        $model = new AlertaModel();

        $dados['alerta'] = $model->listarAlertas();

        // print_r($dados);
        // die();

        return view('sistema/farmi_adm/alertas', $dados);
    } 
}