<?php

namespace App\Controllers;
date_default_timezone_set('America/Sao_Paulo'); //Para colocar hora certa

class RelatorioController extends BaseController
{
    public function index()
    {
        $cpfUsuario = session()->get('usuario_cpf');

        if (!$cpfUsuario) {
            return redirect()->to(base_url('/login'))
                ->with('error', 'Sessão expirada. Faça login novamente.');
        }

        $db = \Config\Database::connect();

        $dataInicio = $this->request->getGet('data_inicio');
        $dataFim = $this->request->getGet('data_fim');
        $idFazenda = $this->request->getGet('fazenda');
        $idCultura = $this->request->getGet('cultura');

        if (empty($dataInicio)) {
            $dataInicio = date('Y-m-d', strtotime('-7 days'));
        }

        if (empty($dataFim)) {
            $dataFim = date('Y-m-d');
        }

        $inicio = $dataInicio . ' 00:00:00';
        $fim = $dataFim . ' 23:59:59';

        // ==========================================
        // FAZENDAS DO USUÁRIO
        // ==========================================

        $fazendas = $db->query("
            SELECT DISTINCT
                f.ID_FAZENDA,
                f.NOME
            FROM FAZENDA f
            INNER JOIN USUARIOS_FAZENDA uf
                ON uf.ID_FAZENDA = f.ID_FAZENDA
            WHERE uf.ID_CPF_USUARIOS = ?
            ORDER BY f.NOME
        ", [$cpfUsuario])->getResultArray();

        // ==========================================
        // CULTURAS DO USUÁRIO
        // ==========================================

        $culturas = $db->query("
            SELECT DISTINCT
                c.ID_CULTURA,
                c.NOME_CULTURA,
                c.FK_ID_FAZENDA,
                f.NOME AS NOME_FAZENDA
            FROM CULTURA c
            INNER JOIN FAZENDA f
                ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf
                ON uf.ID_FAZENDA = f.ID_FAZENDA
            WHERE uf.ID_CPF_USUARIOS = ?
            ORDER BY f.NOME, c.NOME_CULTURA
        ", [$cpfUsuario])->getResultArray();

        // ==========================================
        // SENSORES
        // ==========================================

        $sqlSensores = "
            SELECT
                s.ID_SENSOR,
                s.NOME_SENSOR,
                s.TIPO_SENSOR,
                s.UNIDADE_MEDIDA,
                s.STATUS,
                c.ID_CULTURA,
                c.NOME_CULTURA,
                f.ID_FAZENDA,
                f.NOME AS NOME_FAZENDA,
                (
                    SELECT ls2.VALOR
                    FROM LEITURA_SENSOR ls2
                    WHERE ls2.FK_ID_SENSOR = s.ID_SENSOR
                    ORDER BY ls2.DATA_HORA DESC
                    LIMIT 1
                ) AS ULTIMO_VALOR,
                (
                    SELECT ls3.DATA_HORA
                    FROM LEITURA_SENSOR ls3
                    WHERE ls3.FK_ID_SENSOR = s.ID_SENSOR
                    ORDER BY ls3.DATA_HORA DESC
                    LIMIT 1
                ) AS ULTIMA_DATA
            FROM SENSOR s
            INNER JOIN CULTURA c
                ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f
                ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf
                ON uf.ID_FAZENDA = f.ID_FAZENDA
            WHERE uf.ID_CPF_USUARIOS = ?
        ";

        $paramsSensores = [$cpfUsuario];

        if (!empty($idFazenda)) {
            $sqlSensores .= " AND f.ID_FAZENDA = ?";
            $paramsSensores[] = $idFazenda;
        }

        if (!empty($idCultura)) {
            $sqlSensores .= " AND c.ID_CULTURA = ?";
            $paramsSensores[] = $idCultura;
        }

        $sqlSensores .= "
            ORDER BY f.NOME, c.NOME_CULTURA, s.NOME_SENSOR
        ";

        $sensores = $db->query($sqlSensores, $paramsSensores)->getResultArray();

        // ==========================================
        // LEITURAS DO PERÍODO
        // ==========================================

        $sqlLeituras = "
            SELECT
                s.ID_SENSOR,
                s.NOME_SENSOR,
                s.TIPO_SENSOR,
                s.UNIDADE_MEDIDA,
                c.ID_CULTURA,
                c.NOME_CULTURA,
                f.ID_FAZENDA,
                f.NOME AS NOME_FAZENDA,
                ls.VALOR,
                ls.DATA_HORA
            FROM LEITURA_SENSOR ls
            INNER JOIN SENSOR s
                ON s.ID_SENSOR = ls.FK_ID_SENSOR
            INNER JOIN CULTURA c
                ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f
                ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf
                ON uf.ID_FAZENDA = f.ID_FAZENDA
            WHERE uf.ID_CPF_USUARIOS = ?
            AND ls.DATA_HORA BETWEEN ? AND ?
        ";

        $paramsLeituras = [
            $cpfUsuario,
            $inicio,
            $fim
        ];

        if (!empty($idFazenda)) {
            $sqlLeituras .= " AND f.ID_FAZENDA = ?";
            $paramsLeituras[] = $idFazenda;
        }

        if (!empty($idCultura)) {
            $sqlLeituras .= " AND c.ID_CULTURA = ?";
            $paramsLeituras[] = $idCultura;
        }

        $sqlLeituras .= "
            ORDER BY
                f.NOME,
                c.NOME_CULTURA,
                ls.DATA_HORA ASC
        ";

        $leituras = $db->query($sqlLeituras, $paramsLeituras)->getResultArray();

        // ==========================================
        // AGRUPA POR FAZENDA + CULTURA
        // ==========================================

        $grupos = [];

        foreach ($sensores as $sensor) {
            $chave = $sensor['ID_FAZENDA'] . '_' . $sensor['ID_CULTURA'];

            if (!isset($grupos[$chave])) {
                $grupos[$chave] = [
                    'ID_FAZENDA' => $sensor['ID_FAZENDA'],
                    'NOME_FAZENDA' => $sensor['NOME_FAZENDA'],
                    'ID_CULTURA' => $sensor['ID_CULTURA'],
                    'NOME_CULTURA' => $sensor['NOME_CULTURA'],
                    'sensores' => [],
                    'leituras' => []
                ];
            }

            $grupos[$chave]['sensores'][$sensor['ID_SENSOR']] = $sensor;
        }

        // ==========================================
        // ORGANIZA LEITURAS POR MINUTO
        // ==========================================

        foreach ($leituras as $leitura) {
            $chave = $leitura['ID_FAZENDA'] . '_' . $leitura['ID_CULTURA'];

            if (!isset($grupos[$chave])) {
                $grupos[$chave] = [
                    'ID_FAZENDA' => $leitura['ID_FAZENDA'],
                    'NOME_FAZENDA' => $leitura['NOME_FAZENDA'],
                    'ID_CULTURA' => $leitura['ID_CULTURA'],
                    'NOME_CULTURA' => $leitura['NOME_CULTURA'],
                    'sensores' => [],
                    'leituras' => []
                ];
            }

            $minuto = date('Y-m-d H:i', strtotime($leitura['DATA_HORA']));

            if (!isset($grupos[$chave]['leituras'][$minuto])) {
                $grupos[$chave]['leituras'][$minuto] = [];
            }

            $grupos[$chave]['leituras'][$minuto][$leitura['ID_SENSOR']] = [
                'valor' => $leitura['VALOR'],
                'data_hora' => $leitura['DATA_HORA']
            ];
        }

        // ==========================================
        // RESUMO / MÉDIAS
        // ==========================================

        foreach ($grupos as $chave => &$grupo) {
            $somas = [];
            $quantidades = [];

            foreach ($grupo['leituras'] as $momento => $valores) {
                foreach ($valores as $idSensor => $valor) {
                    if (is_numeric($valor['valor'])) {
                        if (!isset($somas[$idSensor])) {
                            $somas[$idSensor] = 0;
                            $quantidades[$idSensor] = 0;
                        }

                        $somas[$idSensor] += (float) $valor['valor'];
                        $quantidades[$idSensor]++;
                    }
                }
            }

            $grupo['medias'] = [];

            foreach ($somas as $idSensor => $soma) {
                $grupo['medias'][$idSensor] =
                    $quantidades[$idSensor] > 0
                    ? $soma / $quantidades[$idSensor]
                    : 0;
            }
        }

        unset($grupo);

        return view('sistema/farmi_adm/relatorio', [
            'fazendas' => $fazendas,
            'culturas' => $culturas,
            'sensores' => $sensores,
            'grupos' => $grupos,
            'dataInicio' => $dataInicio,
            'dataFim' => $dataFim,
            'idFazenda' => $idFazenda,
            'idCultura' => $idCultura
        ]);
    }
}