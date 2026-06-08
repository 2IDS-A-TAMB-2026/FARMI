<?php

namespace App\Models;

use CodeIgniter\Model;

class AlertaModel extends Model
{

    protected $table = 'ALERTA';
    protected $primaryKey = 'ID_ALERTA';

    // Possui auto incremento
    protected $useAutoIncrement = true;

    // Campos permitidos
    protected $allowedFields = [
        'TIPO_ALERTA',
        'DESCRICAO',
        'NIVEL_GRAVIDADE',
        'DATA_HORA',
        'STATUS',
        'FK_ID_SENSOR'
    ];

    public function listarAlertas()
    {
    
        return $this->db->table('ALERTA a')
            ->select("
                a.ID_ALERTA,
                a.TIPO_ALERTA,
                a.DESCRICAO,
                a.NIVEL_GRAVIDADE,
                a.DATA_HORA,
                a.STATUS,

                s.ID_SENSOR,
                s.TIPO_SENSOR,
                s.UNIDADE_MEDIDA,

                ls.ID_LEITURA,
                ls.VALOR,

                c.ID_CULTURA,
                c.NOME_CULTURA,
                c.TIPO_CULTURA,
                CASE 
                    WHEN s.TIPO_SENSOR = 'Umidade' THEN c.SENSOR_CLIMA_UMIDADE
                    WHEN s.TIPO_SENSOR = 'Luz'     THEN c.SENSOR_LUZ
                    WHEN s.TIPO_SENSOR = 'Temperatura' THEN c.SENSOR_CLIMA_TEMPO
                    WHEN s.TIPO_SENSOR = 'Solo' THEN c.SENSOR_SOLO
                END AS LIMITE,

                f.ID_FAZENDA,
                f.NOME AS NOME_FAZENDA
            ")
            ->join('SENSOR s', 's.ID_SENSOR = a.FK_ID_SENSOR')
            ->join('LEITURA_SENSOR ls', 'ls.FK_ID_SENSOR = s.ID_SENSOR')
            ->join('CULTURA c', 'c.ID_CULTURA = s.FK_ID_CULTURA')
            ->join('FAZENDA f', 'f.ID_FAZENDA = c.FK_ID_FAZENDA')

            // NOVOS JOINS
            ->join('USUARIOS_FAZENDA uf', 'uf.ID_FAZENDA = f.ID_FAZENDA')
            ->join('USUARIOS u', 'u.CPF = uf.ID_CPF_USUARIOS')

            // FILTRO PELO USUÁRIO LOGADO
            ->where('u.CPF', session()->get('usuario_cpf'))

            ->get()
            ->getResultArray();
    }
}