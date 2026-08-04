<?php

namespace App\Controllers;
use App\Models\LeituraSensorModel;
use App\Models\UsuariosModel;

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
        $model = new \App\Models\UsuariosModel();

        $cpf = session()->get('usuario_cpf'); // ou id, depende do seu login

        $usuario = $model
            ->where('CPF', $cpf)
            ->first();

        return view('sistema/farmi_adm/configuracoes', [
            'usuario' => $usuario
        ]);
    }

    public function cultura()
    {
        return view('sistema/farmi_adm/cultura');
    }






















    




    public function dashboard_admin()
    {
        $cpfUsuario = session()->get('usuario_cpf');
        $db = \Config\Database::connect();

        // 1. BUSCA TODAS AS LEITURAS DOS ÚLTIMOS DIAS PARA MONTAR O HISTÓRICO DOS GRÁFICOS
        $leiturasHistorico = $db->query("
            SELECT 
                s.ID_SENSOR,
                s.NOME_SENSOR,
                s.TIPO_SENSOR,
                ls.VALOR,
                ls.DATA_HORA,
                f.ID_FAZENDA,
                f.NOME AS NOME_FAZENDA
            FROM SENSOR s
            INNER JOIN CULTURA c ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf ON uf.ID_FAZENDA = f.ID_FAZENDA
            INNER JOIN LEITURA_SENSOR ls ON ls.FK_ID_SENSOR = s.ID_SENSOR
            WHERE uf.ID_CPF_USUARIOS = ?
            ORDER BY ls.DATA_HORA ASC
        ", [$cpfUsuario])->getResultArray();

        // 2. BUSCA APENAS A ÚLTIMA LEITURA ATUAL DE CADA SENSOR PARA OS CARDS E MÉDIAS
        $dadosGerais = $db->query("
            SELECT 
                s.ID_SENSOR,
                s.NOME_SENSOR,
                s.TIPO_SENSOR,
                s.STATUS,
                f.ID_FAZENDA,
                f.NOME AS NOME_FAZENDA,
                ls.VALOR
            FROM SENSOR s
            INNER JOIN CULTURA c ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf ON uf.ID_FAZENDA = f.ID_FAZENDA
            LEFT JOIN LEITURA_SENSOR ls ON ls.ID_LEITURA = (
                SELECT l2.ID_LEITURA 
                FROM LEITURA_SENSOR l2 
                WHERE l2.FK_ID_SENSOR = s.ID_SENSOR 
                ORDER BY l2.DATA_HORA DESC 
                LIMIT 1
            )
            WHERE uf.ID_CPF_USUARIOS = ?
        ", [$cpfUsuario])->getResultArray();
        
        $sensores = $db->query("
            SELECT
                s.ID_SENSOR,
                s.NOME_SENSOR,
                s.TIPO_SENSOR,
                s.STATUS,
                c.ID_CULTURA,
                c.NOME_CULTURA,
                f.NOME AS NOME_FAZENDA,
                ls.VALOR,
                ls.DATA_HORA
            FROM SENSOR s

            INNER JOIN CULTURA c
                ON c.ID_CULTURA = s.FK_ID_CULTURA

            INNER JOIN FAZENDA f
                ON f.ID_FAZENDA = c.FK_ID_FAZENDA

            INNER JOIN USUARIOS_FAZENDA uf
                ON uf.ID_FAZENDA = f.ID_FAZENDA

            LEFT JOIN LEITURA_SENSOR ls
                ON ls.ID_LEITURA = (
                    SELECT l2.ID_LEITURA
                    FROM LEITURA_SENSOR l2
                    WHERE l2.FK_ID_SENSOR = s.ID_SENSOR
                    ORDER BY l2.DATA_HORA DESC
                    LIMIT 1
                )

            WHERE uf.ID_CPF_USUARIOS = ?
        ", [$cpfUsuario])->getResultArray();

        // Última temperatura registrada
        $ultimaTemperatura = $db->query("
            SELECT ls.VALOR
            FROM LEITURA_SENSOR ls
            INNER JOIN SENSOR s ON s.ID_SENSOR = ls.FK_ID_SENSOR
            INNER JOIN CULTURA c ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf ON uf.ID_FAZENDA = f.ID_FAZENDA
            WHERE uf.ID_CPF_USUARIOS = ?
            AND s.TIPO_SENSOR = 'Temperatura'
            ORDER BY ls.DATA_HORA DESC
            LIMIT 1
        ", [$cpfUsuario])->getRowArray();

        // Última umidade registrada
        $ultimaUmidade = $db->query("
            SELECT ls.VALOR
            FROM LEITURA_SENSOR ls
            INNER JOIN SENSOR s ON s.ID_SENSOR = ls.FK_ID_SENSOR
            INNER JOIN CULTURA c ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf ON uf.ID_FAZENDA = f.ID_FAZENDA
            WHERE uf.ID_CPF_USUARIOS = ?
            AND s.TIPO_SENSOR = 'Umidade'
            ORDER BY ls.DATA_HORA DESC
            LIMIT 1
        ", [$cpfUsuario])->getRowArray();

        // Última luminosidade registrada
        $ultimaLuz = $db->query("
            SELECT ls.VALOR
            FROM LEITURA_SENSOR ls
            INNER JOIN SENSOR s ON s.ID_SENSOR = ls.FK_ID_SENSOR
            INNER JOIN CULTURA c ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf ON uf.ID_FAZENDA = f.ID_FAZENDA
            WHERE uf.ID_CPF_USUARIOS = ?
            AND s.TIPO_SENSOR = 'Luz'
            ORDER BY ls.DATA_HORA DESC
            LIMIT 1
        ", [$cpfUsuario])->getRowArray();

        $temperatura_atual = $ultimaTemperatura['VALOR'] ?? 0;
        $umidade_atual = $ultimaUmidade['VALOR'] ?? 0;
        $lux = $ultimaLuz['VALOR'] ?? 0;

        // 3. ESTRUTURAÇÃO DOS GRÁFICOS MULTI-SENSORES (Eixo X unificado e Datasets separados)
        $todos_horarios = [];
        $sensoresTemp = [];
        $sensoresUmid = [];
        $sensoresSolo = [];

        // Mapeia os horários únicos ordenados para o Eixo X e separa por sensor
        foreach ($leiturasHistorico as $leitura) {
            $horaFormatada = date('d/m H:i', strtotime($leitura['DATA_HORA']));
            if (!in_array($horaFormatada, $todos_horarios)) {
                $todos_horarios[] = $horaFormatada;
            }

            $idSensor = $leitura['ID_SENSOR'];
            $nomeSensor = $leitura['NOME_SENSOR'] . " (ID: $idSensor)";

            if ($leitura['TIPO_SENSOR'] === 'Temperatura') {
                $sensoresTemp[$idSensor]['label'] = $nomeSensor;
                $sensoresTemp[$idSensor]['dados'][$horaFormatada] = $leitura['VALOR'];
            } 
            elseif ($leitura['TIPO_SENSOR'] === 'Umidade') {
                $sensoresUmid[$idSensor]['label'] = $nomeSensor;
                $sensoresUmid[$idSensor]['dados'][$horaFormatada] = $leitura['VALOR'];
            }
            elseif ($leitura['TIPO_SENSOR'] === 'Solo') {
                $sensoresSolo[$idSensor]['label'] = $nomeSensor;
                $sensoresSolo[$idSensor]['dados'][$horaFormatada] = $leitura['VALOR'];
            }
        }

        // Cores dinâmicas para diferenciar as linhas dos sensores
        $coresDisponiveis = ['#4bc714', '#2196f3', '#ff9800', '#e91e63', '#9c27b0', '#00abc5'];

        // Monta Datasets da Temperatura
        $datasets_temperatura = [];
        $corIdx = 0;
        foreach ($sensoresTemp as $id => $sensor) {
            $valoresAlinhados = [];
            foreach ($todos_horarios as $hora) {
                $valoresAlinhados[] = $sensor['dados'][$hora] ?? null; // null se o sensor não tiver leitura nessa hora
            }
            $cor = $coresDisponiveis[$corIdx % count($coresDisponiveis)];
            $datasets_temperatura[] = [
                'label' => $sensor['label'],
                'data' => $valoresAlinhados,
                'borderColor' => $cor,
                'backgroundColor' => 'transparent',
                'borderWidth' => 3,
                'tension' => 0.3
            ];
            $corIdx++;
        }

        // Monta Datasets da Umidade
        $datasets_umidade = [];
        foreach ($sensoresUmid as $id => $sensor) {
            $valoresAlinhados = [];
            foreach ($todos_horarios as $hora) {
                $valoresAlinhados[] = $sensor['dados'][$hora] ?? null;
            }
            $cor = $coresDisponiveis[$corIdx % count($coresDisponiveis)];
            $datasets_umidade[] = [
                'label' => $sensor['label'],
                'data' => $valoresAlinhados,
                'borderColor' => $cor,
                'backgroundColor' => 'transparent',
                'borderWidth' => 3,
                'tension' => 0.3
            ];
            $corIdx++;
        }

        $coresSolo = ['#6d4c41', 'rgb(198, 99, 64)', 'rgb(220, 187, 105)', '#bf5b5b'];

        $datasets_solo = [];
        $corIdxSolo = 0;

        foreach ($sensoresSolo as $id => $sensor) {

            $valoresAlinhados = [];

            foreach ($todos_horarios as $hora) {
                $valoresAlinhados[] = $sensor['dados'][$hora] ?? null;
            }

            $cor = $coresSolo[$corIdxSolo % count($coresSolo)];

            $datasets_solo[] = [
                'label' => $sensor['label'],
                'data' => $valoresAlinhados,
                'borderColor' => $cor,
                'backgroundColor' => 'transparent',
                'borderWidth' => 3,
                'tension' => 0.3
            ];

            $corIdxSolo++;
        }

        // Outros dados de contagem da View
        $total_fazendas = $db->query("SELECT COUNT(DISTINCT ID_FAZENDA) AS total FROM USUARIOS_FAZENDA WHERE ID_CPF_USUARIOS = ?", [$cpfUsuario])->getRow()->total ?? 0;
        $total_usuarios = $db->query("SELECT COUNT(DISTINCT uf2.ID_CPF_USUARIOS) AS total FROM USUARIOS_FAZENDA uf1 INNER JOIN USUARIOS_FAZENDA uf2 ON uf2.ID_FAZENDA = uf1.ID_FAZENDA WHERE uf1.ID_CPF_USUARIOS = ?", [$cpfUsuario])->getRow()->total ?? 0;
        // Total de sensores 
        $total_sensores = count($dadosGerais); 

        return view('sistema/farmi_adm/dashboard', [
            'dadosGerais' => $dadosGerais,
            'total_sensores' => $total_sensores,
            'umidade_atual' => $umidade_atual,
            'lux' => $lux,
            'temperatura_atual' => $temperatura_atual,
            'total_fazendas' => $total_fazendas,
            'total_usuarios' => $total_usuarios,
            'sensores' => $sensores,
            
            // VARIÁVEIS DO NOVO GRÁFICO MULTI-LINHAS
            'grafico_horarios' => $todos_horarios,
            'datasets_temperatura' => $datasets_temperatura,
            'datasets_umidade' => $datasets_umidade,
            'datasets_solo' => $datasets_solo
        ]);
    }


































    public function dados_grafico_sensor($idSensor)
    {
        $db = \Config::Database::connect();

        // Busca as últimas 15 leituras do sensor para não sobrecarregar o gráfico
        // Convertemos o VALOR para DECIMAL para que o JavaScript o interprete corretamente como número
        $query = $db->query("
            SELECT 
                VALOR, 
                DATE_FORMAT(DATA_HORA, '%d/%m %H:%i') as MOMENTO 
            FROM LEITURA_SENSOR 
            WHERE FK_ID_SENSOR = ?
            ORDER BY DATA_HORA ASC 
            LIMIT 15
        ", [$idSensor]);

        $dados = $query->getResultArray();

        // Retorna os dados em formato JSON para o Javascript ler
        return $this->response->setJSON($dados);
    }













    public function fazendas()
    {
        return view('sistema/farmi_adm/fazendas');
    }

    public function recuperar_senha_admin()
    {
        return view('sistema/farmi_adm/recuperar_senha_admin');
    }
   public function salvar_senha_admin()
    {
        $model = new \App\Models\UsuariosModel();

        $cpf = session()->get('usuario_cpf');

        $senhaAtual = $this->request->getPost('currentPassword');
        $novaSenha  = $this->request->getPost('newPassword');
        $confirmar  = $this->request->getPost('confirmPassword');

        $usuario = $model->where('CPF', $cpf)->first();

        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuário não encontrado');
        }

        if (!password_verify($senhaAtual, $usuario['SENHA'])) {
            return redirect()->back()->with('error', 'Senha atual incorreta');
        }

        if ($novaSenha !== $confirmar) {
            return redirect()->back()->with('error', 'Senhas não coincidem');
        }

        // ATUALIZA USANDO CPF (SEM ERRO)
        $model->set('SENHA', password_hash($novaSenha, PASSWORD_DEFAULT))
            ->where('CPF', $cpf)
            ->update();

    return redirect()->to(base_url('/configuracoes-admin'))
        ->with('success', 'Senha alterada com sucesso');
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
        $cpf = session()->get('usuario_cpf');

        if (!$cpf) {
            return redirect()->to(base_url('/login'))->with('error', 'Sessão expirada. Faça login novamente.');
        }

        $model = new \App\Models\UsuariosModel();
        $usuario = $model->where('CPF', $cpf)->first();

        if (!$usuario) {
            $usuario = [
                'NOME' => 'Não encontrado',
                'CPF' => $cpf,
                'EMAIL' => 'Não informado',
                'PERFIL' => 'Não informado',
                'STATUS' => 'Inativo'
            ];
        }

        return view('sistema/farmi_usuario/configuracoes', [
            'usuario' => $usuario
        ]);
    }












    public function dashboard_usuario()
    {
        $cpfUsuario = session()->get('usuario_cpf');
        $db = \Config\Database::connect();

        // 1. HISTÓRICO COMPLETO (igual admin)
        $leiturasHistorico = $db->query("
            SELECT 
                s.ID_SENSOR,
                s.NOME_SENSOR,
                s.TIPO_SENSOR,
                ls.VALOR,
                ls.DATA_HORA
            FROM SENSOR s
            INNER JOIN CULTURA c ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf ON uf.ID_FAZENDA = f.ID_FAZENDA
            INNER JOIN LEITURA_SENSOR ls ON ls.FK_ID_SENSOR = s.ID_SENSOR
            WHERE uf.ID_CPF_USUARIOS = ?
            ORDER BY ls.DATA_HORA ASC
        ", [$cpfUsuario])->getResultArray();

        // 2. DADOS ATUAIS (cards + tabela)
        $sensores = $db->query("
            SELECT
                s.ID_SENSOR,
                s.NOME_SENSOR,
                s.TIPO_SENSOR,
                s.STATUS,
                c.ID_CULTURA,
                c.NOME_CULTURA,
                f.NOME AS NOME_FAZENDA,
                ls.VALOR,
                ls.DATA_HORA
            FROM SENSOR s
            INNER JOIN CULTURA c ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf ON uf.ID_FAZENDA = f.ID_FAZENDA
            LEFT JOIN LEITURA_SENSOR ls ON ls.ID_LEITURA = (
                SELECT l2.ID_LEITURA
                FROM LEITURA_SENSOR l2
                WHERE l2.FK_ID_SENSOR = s.ID_SENSOR
                ORDER BY l2.DATA_HORA DESC
                LIMIT 1
            )
            WHERE uf.ID_CPF_USUARIOS = ?
        ", [$cpfUsuario])->getResultArray();

        // Última temperatura registrada
        $ultimaTemperatura = $db->query("
            SELECT ls.VALOR
            FROM LEITURA_SENSOR ls
            INNER JOIN SENSOR s ON s.ID_SENSOR = ls.FK_ID_SENSOR
            INNER JOIN CULTURA c ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf ON uf.ID_FAZENDA = f.ID_FAZENDA
            WHERE uf.ID_CPF_USUARIOS = ?
            AND s.TIPO_SENSOR = 'Temperatura'
            ORDER BY ls.DATA_HORA DESC
            LIMIT 1
        ", [$cpfUsuario])->getRowArray();

        // Última umidade registrada
        $ultimaUmidade = $db->query("
            SELECT ls.VALOR
            FROM LEITURA_SENSOR ls
            INNER JOIN SENSOR s ON s.ID_SENSOR = ls.FK_ID_SENSOR
            INNER JOIN CULTURA c ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf ON uf.ID_FAZENDA = f.ID_FAZENDA
            WHERE uf.ID_CPF_USUARIOS = ?
            AND s.TIPO_SENSOR = 'Umidade'
            ORDER BY ls.DATA_HORA DESC
            LIMIT 1
        ", [$cpfUsuario])->getRowArray();

        // Última luminosidade registrada
        $ultimaLuz = $db->query("
            SELECT ls.VALOR
            FROM LEITURA_SENSOR ls
            INNER JOIN SENSOR s ON s.ID_SENSOR = ls.FK_ID_SENSOR
            INNER JOIN CULTURA c ON c.ID_CULTURA = s.FK_ID_CULTURA
            INNER JOIN FAZENDA f ON f.ID_FAZENDA = c.FK_ID_FAZENDA
            INNER JOIN USUARIOS_FAZENDA uf ON uf.ID_FAZENDA = f.ID_FAZENDA
            WHERE uf.ID_CPF_USUARIOS = ?
            AND s.TIPO_SENSOR = 'Luz'
            ORDER BY ls.DATA_HORA DESC
            LIMIT 1
        ", [$cpfUsuario])->getRowArray();

        $temperatura_atual = $ultimaTemperatura['VALOR'] ?? 0;
        $umidade_atual = $ultimaUmidade['VALOR'] ?? 0;
        $lux = $ultimaLuz['VALOR'] ?? 0;

        // 3. EIXO X GLOBAL
        $todos_horarios = [];

        $sensoresTemp = [];
        $sensoresUmid = [];
        $sensoresSolo = [];

        foreach ($leiturasHistorico as $leitura) {

            $hora = date('d/m H:i', strtotime($leitura['DATA_HORA']));

            if (!in_array($hora, $todos_horarios)) {
                $todos_horarios[] = $hora;
            }

            $id = $leitura['ID_SENSOR'];
            $nome = $leitura['NOME_SENSOR'] . " (ID: $id)";

            if ($leitura['TIPO_SENSOR'] === 'Temperatura') {
                $sensoresTemp[$id]['label'] = $nome;
                $sensoresTemp[$id]['dados'][$hora] = $leitura['VALOR'];
            }

            if ($leitura['TIPO_SENSOR'] === 'Umidade') {
                $sensoresUmid[$id]['label'] = $nome;
                $sensoresUmid[$id]['dados'][$hora] = $leitura['VALOR'];
            }

            if ($leitura['TIPO_SENSOR'] === 'Solo') {
                $sensoresSolo[$id]['label'] = $nome;
                $sensoresSolo[$id]['dados'][$hora] = $leitura['VALOR'];
            }
        }

        // 4. CORES
        $cores = ['#4bc714', '#2196f3', '#ff9800', '#e91e63', '#9c27b0', '#00abc5'];

        // 5. TEMPERATURA DATASETS
        $datasets_temperatura = [];
        $i = 0;

        foreach ($sensoresTemp as $sensor) {

            $data = [];

            foreach ($todos_horarios as $hora) {
                $data[] = $sensor['dados'][$hora] ?? null;
            }

            $datasets_temperatura[] = [
                'label' => $sensor['label'],
                'data' => $data,
                'borderColor' => $cores[$i % count($cores)],
                'backgroundColor' => 'transparent',
                'borderWidth' => 3,
                'tension' => 0.3
            ];

            $i++;
        }

        // 6. UMIDADE DATASETS
        $datasets_umidade = [];

        foreach ($sensoresUmid as $sensor) {

            $data = [];

            foreach ($todos_horarios as $hora) {
                $data[] = $sensor['dados'][$hora] ?? null;
            }

            $datasets_umidade[] = [
                'label' => $sensor['label'],
                'data' => $data,
                'borderColor' => $cores[$i % count($cores)],
                'backgroundColor' => 'transparent',
                'borderWidth' => 3,
                'tension' => 0.3
            ];

            $i++;
        }

        // 7. SOLO DATASETS
        $coresSolo = ['#6d4c41', '#c66340', '#dcbf69', '#bf5b5b'];

        $datasets_solo = [];
        $j = 0;

        foreach ($sensoresSolo as $sensor) {

            $data = [];

            foreach ($todos_horarios as $hora) {
                $data[] = $sensor['dados'][$hora] ?? null;
            }

            $datasets_solo[] = [
                'label' => $sensor['label'],
                'data' => $data,
                'borderColor' => $coresSolo[$j % count($coresSolo)],
                'backgroundColor' => 'transparent',
                'borderWidth' => 3,
                'tension' => 0.3
            ];

            $j++;
        }

        // 8. TOTAIS
        $total_sensores = count($sensores);

        $total_fazendas = $db->query("
            SELECT COUNT(DISTINCT ID_FAZENDA) AS total 
            FROM USUARIOS_FAZENDA 
            WHERE ID_CPF_USUARIOS = ?
        ", [$cpfUsuario])->getRow()->total ?? 0;

        $temperatura_labels = array_column($leiturasHistorico, 'DATA_HORA');

        $temperatura_valores = array_map(
            fn($l) => $l['VALOR'],
            array_filter($leiturasHistorico, fn($l) => $l['TIPO_SENSOR'] === 'Temperatura')
        );

        $umidade_labels = array_column($leiturasHistorico, 'DATA_HORA');
        $umidade_valores = array_column($leiturasHistorico, 'VALOR');

        $umidade_atual = $umidade_atual ?? 0;
        $temperatura_atual = $temperatura_atual ?? 0;
        $lux = $lux ?? 0;

        return view('sistema/farmi_usuario/dashboard', [
            'sensores' => $sensores,
            'total_sensores' => $total_sensores,
            'total_fazendas' => $total_fazendas,

            // cards
            'umidade_atual' => $umidade_atual,
            'temperatura_atual' => $temperatura_atual,
            'lux' => $lux,

            // GRÁFICOS NOVO MODELO (igual admin)
            'grafico_horarios' => $todos_horarios,
            'datasets_temperatura' => $datasets_temperatura,
            'datasets_umidade' => $datasets_umidade,
            'datasets_solo' => $datasets_solo
        ]);
    }











    public function luz()
    {
        $cpfUsuario = session()->get('usuario_cpf');
        $db = \Config\Database::connect();

        $sensores = $db->query("
            SELECT
                s.ID_SENSOR,
                s.NOME_SENSOR,
                c.ID_CULTURA,
                c.NOME_CULTURA,
                s.STATUS,
                f.NOME AS NOME_FAZENDA,
                ls.VALOR,
                ls.DATA_HORA
            FROM SENSOR s

            INNER JOIN CULTURA c
                ON c.ID_CULTURA = s.FK_ID_CULTURA

            INNER JOIN FAZENDA f
                ON f.ID_FAZENDA = c.FK_ID_FAZENDA

            INNER JOIN USUARIOS_FAZENDA uf
                ON uf.ID_FAZENDA = f.ID_FAZENDA

            LEFT JOIN LEITURA_SENSOR ls
                ON ls.ID_LEITURA = (
                    SELECT l2.ID_LEITURA
                    FROM LEITURA_SENSOR l2
                    WHERE l2.FK_ID_SENSOR = s.ID_SENSOR
                    ORDER BY l2.DATA_HORA DESC
                    LIMIT 1
                )

            WHERE uf.ID_CPF_USUARIOS = ?
            AND s.TIPO_SENSOR = 'Luz'

            ORDER BY s.NOME_SENSOR
        ", [$cpfUsuario])->getResultArray();

        return view('sistema/farmi_usuario/luz', [
            'sensores' => $sensores
        ]);
    }

    public function recuperar_senha()
    {
        return view('sistema/farmi_usuario/recuperar_senha');
    }
    public function salvar_senha_usuario()
    {
        $model = new \App\Models\UsuariosModel();

        $cpf = session()->get('usuario_cpf');

        $senhaAtual = $this->request->getPost('currentPassword');
        $novaSenha  = $this->request->getPost('newPassword');
        $confirmar  = $this->request->getPost('confirmPassword');

        $usuario = $model->where('CPF', $cpf)->first();

        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuário não encontrado');
        }

        // verifica senha atual
        if (!password_verify($senhaAtual, $usuario['SENHA'])) {
            return redirect()->back()->with('error', 'Senha atual incorreta');
        }

        // confere nova senha
        if ($novaSenha !== $confirmar) {
            return redirect()->back()->with('error', 'Senhas não coincidem');
        }

        // CORREÇÃO AQUI: Atualiza filtrando pelo CPF, evitando o uso da chave ID_USUARIO
        $model->set('SENHA', password_hash($novaSenha, PASSWORD_DEFAULT))
            ->where('CPF', $cpf)
            ->update();

        return redirect()->to(base_url('/dashboard-usuario'))
        ->with('success', 'Senha alterada com sucesso');
    }

    public function solo()
    {
        $cpfUsuario = session()->get('usuario_cpf');
        $db = \Config\Database::connect();

        $sensores = $db->query("
            SELECT
                s.ID_SENSOR,
                s.NOME_SENSOR,
                c.ID_CULTURA,
                c.NOME_CULTURA,
                s.STATUS,
                f.NOME AS NOME_FAZENDA,
                ls.VALOR,
                ls.DATA_HORA
            FROM SENSOR s

            INNER JOIN CULTURA c
                ON c.ID_CULTURA = s.FK_ID_CULTURA

            INNER JOIN FAZENDA f
                ON f.ID_FAZENDA = c.FK_ID_FAZENDA

            INNER JOIN USUARIOS_FAZENDA uf
                ON uf.ID_FAZENDA = f.ID_FAZENDA

            LEFT JOIN LEITURA_SENSOR ls
                ON ls.ID_LEITURA = (
                    SELECT l2.ID_LEITURA
                    FROM LEITURA_SENSOR l2
                    WHERE l2.FK_ID_SENSOR = s.ID_SENSOR
                    ORDER BY l2.DATA_HORA DESC
                    LIMIT 1
                )

            WHERE uf.ID_CPF_USUARIOS = ?
            AND s.TIPO_SENSOR = 'Solo'

            ORDER BY s.NOME_SENSOR
        ", [$cpfUsuario])->getResultArray();

        return view('sistema/farmi_usuario/solo', [
            'sensores' => $sensores
        ]);
    }

    public function temperatura()
    {
        $cpfUsuario = session()->get('usuario_cpf');
        $db = \Config\Database::connect();

        $sensores = $db->query("
            SELECT
                s.ID_SENSOR,
                s.NOME_SENSOR,
                c.ID_CULTURA,
                c.NOME_CULTURA,
                s.STATUS,
                f.NOME AS NOME_FAZENDA,
                ls.VALOR,
                ls.DATA_HORA
            FROM SENSOR s

            INNER JOIN CULTURA c
                ON c.ID_CULTURA = s.FK_ID_CULTURA

            INNER JOIN FAZENDA f
                ON f.ID_FAZENDA = c.FK_ID_FAZENDA

            INNER JOIN USUARIOS_FAZENDA uf
                ON uf.ID_FAZENDA = f.ID_FAZENDA

            LEFT JOIN LEITURA_SENSOR ls
                ON ls.ID_LEITURA = (
                    SELECT l2.ID_LEITURA
                    FROM LEITURA_SENSOR l2
                    WHERE l2.FK_ID_SENSOR = s.ID_SENSOR
                    ORDER BY l2.DATA_HORA DESC
                    LIMIT 1
                )

            WHERE uf.ID_CPF_USUARIOS = ?
            AND s.TIPO_SENSOR = 'Temperatura'

            ORDER BY s.NOME_SENSOR
        ", [$cpfUsuario])->getResultArray();

        return view('sistema/farmi_usuario/temperatura', [
            'sensores' => $sensores
        ]);
    }

    public function umidade()
    {
        $cpfUsuario = session()->get('usuario_cpf');
        $db = \Config\Database::connect();

        $sensores = $db->query("
            SELECT
                s.ID_SENSOR,
                s.NOME_SENSOR,
                c.ID_CULTURA,
                c.NOME_CULTURA,
                s.STATUS,
                f.NOME AS NOME_FAZENDA,
                ls.VALOR,
                ls.DATA_HORA
            FROM SENSOR s

            INNER JOIN CULTURA c
                ON c.ID_CULTURA = s.FK_ID_CULTURA

            INNER JOIN FAZENDA f
                ON f.ID_FAZENDA = c.FK_ID_FAZENDA

            INNER JOIN USUARIOS_FAZENDA uf
                ON uf.ID_FAZENDA = f.ID_FAZENDA

            LEFT JOIN LEITURA_SENSOR ls
                ON ls.ID_LEITURA = (
                    SELECT l2.ID_LEITURA
                    FROM LEITURA_SENSOR l2
                    WHERE l2.FK_ID_SENSOR = s.ID_SENSOR
                    ORDER BY l2.DATA_HORA DESC
                    LIMIT 1
                )

            WHERE uf.ID_CPF_USUARIOS = ?
            AND s.TIPO_SENSOR = 'Umidade'

            ORDER BY s.NOME_SENSOR
        ", [$cpfUsuario])->getResultArray();

        return view('sistema/farmi_usuario/umidade', [
            'sensores' => $sensores
        ]);
    }

    public function usuario()
    {
        return view('sistema/farmi_usuario/usuario');
    }
}