<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CulturaModel;

class CulturaController extends ResourceController
{
    protected $modelName = 'App\Models\CulturaModel';
    protected $format    = 'json';

    /**
     * Auxiliar para obter o CPF do gestor (Sessão, Header ou Query String)
     */
    private function getCpfGestor()
    {
        return session()->get('usuario_cpf') 
            ?? $this->request->getHeaderLine('X-User-CPF') 
            ?? $this->request->getGet('cpf');
    }

    /**
     * GET /api/culturas
     * Lista todas as culturas (ou filtra pelas fazendas do gestor se o CPF for informado)
     */
    public function index()
    {
        $cpfGestor = $this->getCpfGestor();

        $builder = $this->model
            ->select('CULTURA.*, FAZENDA.NOME AS NOME_FAZENDA')
            ->join('FAZENDA', 'FAZENDA.ID_FAZENDA = CULTURA.FK_ID_FAZENDA', 'left');

        if ($cpfGestor) {
            $builder->join(
                'USUARIOS_FAZENDA',
                'USUARIOS_FAZENDA.ID_FAZENDA = CULTURA.FK_ID_FAZENDA'
            )->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $cpfGestor);
        }

        $culturas = $builder->findAll();

        return $this->respond([
            'status' => 200,
            'total'  => count($culturas),
            'data'   => $culturas
        ]);
    }

    /**
     * GET /api/culturas/(:num)
     * Detalhes de uma cultura específica pelo ID
     */
    public function show($id = null)
    {
        $cpfGestor = $this->getCpfGestor();

        $builder = $this->model
            ->select('CULTURA.*, FAZENDA.NOME AS NOME_FAZENDA')
            ->join('FAZENDA', 'FAZENDA.ID_FAZENDA = CULTURA.FK_ID_FAZENDA', 'left')
            ->where('CULTURA.ID_CULTURA', $id);

        if ($cpfGestor) {
            $builder->join(
                'USUARIOS_FAZENDA',
                'USUARIOS_FAZENDA.ID_FAZENDA = CULTURA.FK_ID_FAZENDA'
            )->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $cpfGestor);
        }

        $cultura = $builder->first();

        if (!$cultura) {
            return $this->failNotFound('Cultura não encontrada ou sem permissão de acesso.');
        }

        return $this->respond([
            'status' => 200,
            'data'   => $cultura
        ]);
    }

    /**
     * POST /api/culturas
     * Cadastra uma nova cultura
     */
    public function create()
    {
        $json = $this->request->getJSON(true);
        $dadosInput = !empty($json) ? $json : $this->request->getPost();

        $dados = [
            'NOME_CULTURA'         => $dadosInput['NOME_CULTURA'] ?? null,
            'DATA_PLANTIO'         => $dadosInput['DATA_PLANTIO'] ?? null,
            'CICLO_PRODUTIVO'      => $dadosInput['CICLO_PRODUTIVO'] ?? null,
            'AREA_CULTIVADA'       => $dadosInput['AREA_CULTIVADA'] ?? null,
            'TIPO_CULTURA'         => $dadosInput['TIPO_CULTURA'] ?? null,
            'SENSOR_LUZ'           => $dadosInput['SENSOR_LUZ'] ?? null,
            'SENSOR_CLIMA_TEMPO'   => $dadosInput['SENSOR_CLIMA_TEMPO'] ?? null,
            'SENSOR_CLIMA_UMIDADE' => $dadosInput['SENSOR_CLIMA_UMIDADE'] ?? null,
            'SENSOR_SOLO'          => $dadosInput['SENSOR_SOLO'] ?? null,
            'STATUS'               => $dadosInput['STATUS'] ?? 'Ativo',
            'FK_ID_FAZENDA'        => $dadosInput['FK_ID_FAZENDA'] ?? null
        ];

        $idCultura = $this->model->insert($dados);

        if ($idCultura === false) {
            return $this->failValidationErrors($this->model->errors());
        }

        $novaCultura = $this->model->find($idCultura);

        return $this->respondCreated([
            'status'   => 201,
            'mensagem' => 'Cultura cadastrada com sucesso!',
            'data'     => $novaCultura
        ]);
    }

    /**
     * PUT/PATCH /api/culturas/(:num)
     * Atualiza os dados de uma cultura existente
     */
    public function update($id = null)
    {
        $cultura = $this->model->find($id);

        if (!$cultura) {
            return $this->failNotFound('Cultura não encontrada.');
        }

        $json = $this->request->getJSON(true);
        $dadosInput = !empty($json) ? $json : $this->request->getRawInput();

        $dadosAtualizacao = [
            'NOME_CULTURA'         => $dadosInput['NOME_CULTURA'] ?? $cultura['NOME_CULTURA'],
            'DATA_PLANTIO'         => $dadosInput['DATA_PLANTIO'] ?? $cultura['DATA_PLANTIO'],
            'CICLO_PRODUTIVO'      => $dadosInput['CICLO_PRODUTIVO'] ?? $cultura['CICLO_PRODUTIVO'],
            'AREA_CULTIVADA'       => $dadosInput['AREA_CULTIVADA'] ?? $cultura['AREA_CULTIVADA'],
            'TIPO_CULTURA'         => $dadosInput['TIPO_CULTURA'] ?? $cultura['TIPO_CULTURA'],
            'SENSOR_LUZ'           => $dadosInput['SENSOR_LUZ'] ?? $cultura['SENSOR_LUZ'],
            'SENSOR_CLIMA_TEMPO'   => $dadosInput['SENSOR_CLIMA_TEMPO'] ?? $cultura['SENSOR_CLIMA_TEMPO'],
            'SENSOR_CLIMA_UMIDADE' => $dadosInput['SENSOR_CLIMA_UMIDADE'] ?? $cultura['SENSOR_CLIMA_UMIDADE'],
            'SENSOR_SOLO'          => $dadosInput['SENSOR_SOLO'] ?? $cultura['SENSOR_SOLO'],
            'STATUS'               => $dadosInput['STATUS'] ?? $cultura['STATUS'],
            'FK_ID_FAZENDA'        => $dadosInput['FK_ID_FAZENDA'] ?? $cultura['FK_ID_FAZENDA']
        ];

        if ($this->model->update($id, $dadosAtualizacao) === false) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'status'   => 200,
            'mensagem' => 'Cultura atualizada com sucesso!',
            'data'     => $this->model->find($id)
        ]);
    }

    /**
     * DELETE /api/culturas/(:num)
     * Remove uma cultura do banco de dados
     */
    public function delete($id = null)
    {
        $cultura = $this->model->find($id);

        if (!$cultura) {
            return $this->failNotFound('Cultura não encontrada.');
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            'status'   => 200,
            'mensagem' => 'Cultura excluída com sucesso!'
        ]);
    }
}