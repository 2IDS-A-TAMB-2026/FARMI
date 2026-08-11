<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\AlertaModel;

class AlertaController extends ResourceController
{
    protected $modelName = 'App\Models\AlertaModel';
    protected $format    = 'json';

    /**
     * Auxiliar para obter o CPF do usuário/gestor (Sessão, Header ou Query String)
     */
    private function getCpfUsuario()
    {
        return session()->get('usuario_cpf') 
            ?? $this->request->getHeaderLine('X-User-CPF') 
            ?? $this->request->getGet('cpf');
    }

    /**
     * GET /api/alertas
     * Lista todos os alertas e retorna contadores por nível de gravidade
     */
    public function index()
    {
        $cpfUsuario = $this->getCpfUsuario();

        $builder = $this->model
            ->select('
                ALERTA.*,
                SENSOR.TIPO_SENSOR,
                SENSOR.UNIDADE_MEDIDA,
                LEITURA_SENSOR.VALOR,
                CULTURA.NOME_CULTURA,
                CULTURA.TIPO_CULTURA,
                FAZENDA.NOME AS NOME_FAZENDA
            ')
            ->join('SENSOR', 'SENSOR.ID_SENSOR = ALERTA.FK_ID_SENSOR')
            ->join('LEITURA_SENSOR', 'LEITURA_SENSOR.FK_ID_SENSOR = SENSOR.ID_SENSOR', 'left')
            ->join('CULTURA', 'CULTURA.ID_CULTURA = SENSOR.FK_ID_CULTURA')
            ->join('FAZENDA', 'FAZENDA.ID_FAZENDA = CULTURA.FK_ID_FAZENDA');

        // Se o CPF for fornecido, filtra apenas os alertas das fazendas vinculadas ao usuário
        if ($cpfUsuario) {
            $builder->join('USUARIOS_FAZENDA', 'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA')
                    ->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $cpfUsuario);
        }

        $alertas = $builder->findAll();

        // Contadores por nível de gravidade
        $totalCriticos = 0;
        $totalMedios   = 0;
        $totalBaixos   = 0;

        foreach ($alertas as $a) {
            $gravidade = $a['NIVEL_GRAVIDADE'] ?? '';

            if ($gravidade === 'Alto') {
                $totalCriticos++;
            } elseif ($gravidade === 'Médio' || $gravidade === 'Medio') {
                $totalMedios++;
            } elseif ($gravidade === 'Baixo') {
                $totalBaixos++;
            }
        }

        return $this->respond([
            'status' => 200,
            'resumo' => [
                'total_alertas'  => count($alertas),
                'total_criticos' => $totalCriticos,
                'total_medios'   => $totalMedios,
                'total_baixos'   => $totalBaixos,
            ],
            'data'   => $alertas
        ]);
    }

    /**
     * GET /api/alertas/(:num)
     * Detalhes de um alerta específico pelo ID
     */
    public function show($id = null)
    {
        $cpfUsuario = $this->getCpfUsuario();

        $builder = $this->model
            ->select('
                ALERTA.*,
                SENSOR.TIPO_SENSOR,
                SENSOR.UNIDADE_MEDIDA,
                LEITURA_SENSOR.VALOR,
                CULTURA.NOME_CULTURA,
                CULTURA.TIPO_CULTURA,
                FAZENDA.NOME AS NOME_FAZENDA
            ')
            ->join('SENSOR', 'SENSOR.ID_SENSOR = ALERTA.FK_ID_SENSOR')
            ->join('LEITURA_SENSOR', 'LEITURA_SENSOR.FK_ID_SENSOR = SENSOR.ID_SENSOR', 'left')
            ->join('CULTURA', 'CULTURA.ID_CULTURA = SENSOR.FK_ID_CULTURA')
            ->join('FAZENDA', 'FAZENDA.ID_FAZENDA = CULTURA.FK_ID_FAZENDA')
            ->where('ALERTA.ID_ALERTA', $id);

        if ($cpfUsuario) {
            $builder->join('USUARIOS_FAZENDA', 'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA')
                    ->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $cpfUsuario);
        }

        $alerta = $builder->first();

        if (!$alerta) {
            return $this->failNotFound('Alerta não encontrado ou sem permissão de acesso.');
        }

        return $this->respond([
            'status' => 200,
            'data'   => $alerta
        ]);
    }
}