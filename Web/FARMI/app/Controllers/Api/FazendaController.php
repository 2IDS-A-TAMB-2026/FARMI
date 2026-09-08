<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\FazendaModel;

class FazendaController extends ResourceController
{
    protected $modelName = 'App\Models\FazendaModel';
    protected $format    = 'json';

    /**
     * Auxiliar para obter o CPF do usuário (Sessão, Header ou Query String)
     */
    /**
     * Auxiliar para obter o CPF do usuário (Sessão, Header ou Query String)
     */
    private function getCpfUsuario()
    {
        // 1. Tenta pegar da Sessão Web
        $sessaoCpf = session()->get('usuario_cpf');
        if (!empty($sessaoCpf)) {
            return $sessaoCpf;
        }

        // 2. Tenta pegar do Header HTTP
        $headerCpf = $this->request->getHeaderLine('X-User-CPF');
        if (!empty($headerCpf)) {
            return $headerCpf;
        }

        // 3. Tenta pegar via Query String (?cpf=12345678900)
        $getCpf = $this->request->getGet('cpf');
        if (!empty($getCpf)) {
            return $getCpf;
        }

        return null;
    }

    /**
     * GET /api/fazendas
     * Listar fazendas do usuário (com opção de busca por nome)
     */
    public function index()
    {
        $cpf = $this->getCpfUsuario();

        // Se nenhum CPF for informado, traz todas as fazendas registradas
        if (!$cpf) {
            $fazendas = $this->model->findAll();
            return $this->respond([
                'status' => 200,
                'data'   => $fazendas
            ]);
        }

        $pesquisa = $this->request->getGet('pesquisar');

        $query = $this->model
            ->select('FAZENDA.*')
            ->join(
                'USUARIOS_FAZENDA',
                'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA'
            )
            ->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $cpf);

        if (!empty($pesquisa)) {
            $query->like('FAZENDA.NOME', $pesquisa);
        }

        $fazendas = $query->findAll();

        return $this->respond([
            'status' => 200,
            'data'   => $fazendas
        ]);
    }

    /**
     * GET /api/fazendas/(:num)
     * Detalhes de uma fazenda específica do usuário
     */
    public function show($id = null)
    {
        $cpfGestor = $this->getCpfUsuario();

        if (!$cpfGestor) {
            return $this->failUnauthorized('CPF do usuário não informado.');
        }

        $fazenda = $this->model
            ->select('FAZENDA.*')
            ->join(
                'USUARIOS_FAZENDA',
                'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA'
            )
            ->where('FAZENDA.ID_FAZENDA', $id)
            ->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $cpfGestor)
            ->first();

        if (!$fazenda) {
            return $this->failNotFound('Fazenda não encontrada ou acesso não permitido.');
        }

        return $this->respond([
            'status' => 200,
            'data'   => $fazenda
        ]);
    }

    /**
     * POST /api/fazendas
     * Cadastrar nova fazenda e vincular ao usuário
     */
    public function create()
    {
        $cpfGestor = $this->getCpfUsuario();

        if (!$cpfGestor) {
            return $this->failUnauthorized('CPF do usuário não informado.');
        }

        // Obtém o corpo em JSON ou formulário tradicional
        $json = $this->request->getJSON(true);
        $dadosInput = !empty($json) ? $json : $this->request->getPost();

        $dadosFazenda = [
            'NOME'       => $dadosInput['NOME'] ?? null,
            'LATITUDE'   => $dadosInput['LATITUDE'] ?? null,
            'LONGITUDE'  => $dadosInput['LONGITUDE'] ?? null,
            'LOGRADOURO' => $dadosInput['LOGRADOURO'] ?? null,
            'NUMERO'     => $dadosInput['NUMERO'] ?? null,
            'CEP'        => $dadosInput['CEP'] ?? null,
            'AREA_TOTAL' => $dadosInput['AREA_TOTAL'] ?? null
        ];

        // Inicia transação no banco de dados
        $db = \Config\Database::connect();
        $db->transStart();

        // 1. Inserção na tabela FAZENDA
        $idFazenda = $this->model->insert($dadosFazenda);

        if (!$idFazenda) {
            $db->transRollback();
            return $this->failValidationErrors($this->model->errors());
        }

        // 2. Vínculo Usuário <-> Fazenda
        $db->table('USUARIOS_FAZENDA')->insert([
            'ID_CPF_USUARIOS' => $cpfGestor,
            'ID_FAZENDA'      => $idFazenda
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->failServerError('Erro ao vincular fazenda ao usuário.');
        }

        $novaFazenda = $this->model->find($idFazenda);

        return $this->respondCreated([
            'status'    => 201,
            'mensagem'  => 'Fazenda cadastrada com sucesso!',
            'data'      => $novaFazenda
        ]);
    }

    /**
     * PUT/PATCH /api/fazendas/(:num)
     * Atualizar dados da fazenda
     */
    public function update($id = null)
    {
        $cpfGestor = $this->getCpfUsuario();

        if (!$cpfGestor) {
            return $this->failUnauthorized('CPF do usuário não informado.');
        }

        // Verifica se a fazenda existe e pertence ao usuário
        $fazenda = $this->model
            ->join('USUARIOS_FAZENDA', 'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA')
            ->where('FAZENDA.ID_FAZENDA', $id)
            ->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $cpfGestor)
            ->first();

        if (!$fazenda) {
            return $this->failNotFound('Fazenda não encontrada ou sem permissão para alteração.');
        }

        $json = $this->request->getJSON(true);
        $dadosInput = !empty($json) ? $json : $this->request->getRawInput();

        $dadosAtualizacao = [
            'NOME'       => $dadosInput['NOME'] ?? $fazenda['NOME'],
            'LATITUDE'   => $dadosInput['LATITUDE'] ?? $fazenda['LATITUDE'],
            'LONGITUDE'  => $dadosInput['LONGITUDE'] ?? $fazenda['LONGITUDE'],
            'LOGRADOURO' => $dadosInput['LOGRADOURO'] ?? $fazenda['LOGRADOURO'],
            'NUMERO'     => $dadosInput['NUMERO'] ?? $fazenda['NUMERO'],
            'CEP'        => $dadosInput['CEP'] ?? $fazenda['CEP'],
            'AREA_TOTAL' => $dadosInput['AREA_TOTAL'] ?? $fazenda['AREA_TOTAL']
        ];

        if ($this->model->update($id, $dadosAtualizacao) === false) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'status'   => 200,
            'mensagem' => 'Fazenda atualizada com sucesso!',
            'data'     => $this->model->find($id)
        ]);
    }

    /**
     * DELETE /api/fazendas/(:num)
     * Excluir fazenda
     */
    public function delete($id = null)
    {
        $cpfGestor = $this->getCpfUsuario();

        if (!$cpfGestor) {
            return $this->failUnauthorized('CPF do usuário não informado.');
        }

        $fazenda = $this->model
            ->join('USUARIOS_FAZENDA', 'USUARIOS_FAZENDA.ID_FAZENDA = FAZENDA.ID_FAZENDA')
            ->where('FAZENDA.ID_FAZENDA', $id)
            ->where('USUARIOS_FAZENDA.ID_CPF_USUARIOS', $cpfGestor)
            ->first();

        if (!$fazenda) {
            return $this->failNotFound('Fazenda não encontrada ou sem permissão para exclusão.');
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            'status'   => 200,
            'mensagem' => 'Fazenda excluída com sucesso!'
        ]);
    }
}