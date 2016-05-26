<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oportunidade_voluntariado extends CI_Model {

    function __construct()
    {
      parent::__construct();

      $this->load->model('Disponibilidade', 'disponibilidade');
    }

    public function get_matching_for_voluntario($id_utilizador)
    {
        $this->load->model('Utilizador', 'utilizador');
        $this->load->model('Grupo_Atuacao', 'grupo_atuacao');
        $this->load->model('Area_interesse', 'area_interesse');

        $voluntario = $this->utilizador->get_by_id($id_utilizador,
            'voluntario')->row();

        // areas de interesse do utilizador
        $areas_interesse_utilizador = $this->area_interesse->get_by_id_utilizador(
            $this->id_utilizador);

        $num_rows = $areas_interesse_utilizador->num_rows();
        $areas_interesse_utilizador = $areas_interesse_utilizador->result();
        $areas_interesse_utilizador_array = array('');

        for ($i = 0; $i < $num_rows; $i++) {
            $areas_interesse_utilizador_array[$i] = $areas_interesse_utilizador[$i]->id;
        }

        // grupos de atuacao do utilizador
        $grupos_atuacao_utilizador = $this->grupo_atuacao->get_by_id_utilizador(
            $this->id_utilizador);

        $num_rows = $grupos_atuacao_utilizador->num_rows();
        $grupos_atuacao_utilizador = $grupos_atuacao_utilizador->result();
        $grupos_atuacao_utilizador_array = array('');

        for ($i = 0; $i < $num_rows; $i++) {
            $grupos_atuacao_utilizador_array[$i] = $grupos_atuacao_utilizador[$i]->id;
        }

        /*
        /* Query
        */
        $this->db->distinct();
        $this->db->select('ov.id AS id_oportunidade_voluntariado, distrito,
            concelho, freguesia, ov.nome AS nome, funcao, pais, ga.nome AS grupo_atuacao,
            ai.nome AS area_interesse, u.nome AS instituicao, disp_o.data_inicio, u.id AS id_utilizador');
        $this->db->from('Oportunidades_Voluntariado AS ov');
        $this->db->join('Areas_Geograficas AS ag', 'ov.id_area_geografica = ag.id');
        $this->db->join('Grupos_Atuacao AS ga', 'ov.id_grupo_atuacao = ga.id');
        $this->db->join('Areas_Interesse AS ai', 'ov.id_area_interesse = ai.id');
        $this->db->join('Instituicoes AS i', 'ov.id_instituicao = i.id');
        $this->db->join('Utilizadores AS u', 'u.id = ' . $id_utilizador);
        $this->db->join('Voluntarios AS v', 'v.id_utilizador = u.id');

        // inscricoes
        //$this->db->join('Inscreve_Se as insc', 'insc.id_voluntario = v.id');

        // disponibilidades utilizadores
        $this->db->join('Utilizadores_Disponibilidades AS ud',
            'ud.id_utilizador = u.id', 'left');
        $this->db->join('Disponibilidades AS disp_u', 'ud.id_disponibilidade = disp_u.id', 'left');

        // disponibilidades oportunidade
        $this->db->join('Oportunidades_Voluntariado_Disponibilidades AS ovd',
            'ovd.id_oportunidade_voluntariado = ov.id', 'left');
        $this->db->join('Disponibilidades AS disp_o', 'ovd.id_disponibilidade = disp_o.id', 'left');

        $this->db->where("disp_o.data_inicio >= disp_u.data_inicio");
        $this->db->where("disp_o.data_inicio <= disp_u.data_fim");

        // nao estah inscrito na oportunidade
        $this->db->where('NOT EXISTS (SELECT 1 FROM Inscreve_Se AS insc WHERE insc.id_oportunidade_voluntariado = ov.id)',
            NULL, FALSE);

        $this->db->where("disp_o.data_fim >= disp_u.data_inicio");
        $this->db->where("disp_o.data_fim <= disp_u.data_fim");

        $this->db->where('ov.vagas >', '0');
        $this->db->where('ativa', 'y');
        $this->db->where('distrito', $voluntario->distrito);
        $this->db->where('concelho', $voluntario->concelho);
        $this->db->where('freguesia', $voluntario->freguesia);
        $this->db->where_in('id_grupo_atuacao', $grupos_atuacao_utilizador_array);
        $this->db->where_in('id_area_interesse', $areas_interesse_utilizador_array);

        return $this->db->get();
    }

    public function get_matching_voluntarios_nao_inscritos($id_oportunidade)
    {
        $oportunidade = $this->get_by_id($id_oportunidade)->row();

        $this->db->distinct();
        $this->db->select('vol.id as id_voluntario, vol.id_utilizador, u.nome,
            vol.foto, u.id as id_utilizador, insc.aceite');
        // $this->db->select('*');
        $this->db->from('Voluntarios AS vol');
        $this->db->join('Utilizadores AS u', 'u.id = vol.id_utilizador');

        $this->db->join('Inscreve_Se AS insc', 'insc.id_voluntario = vol.id', 'left');
        $this->db->join('Oportunidades_Voluntariado AS ov', 'ov.id = insc.id_oportunidade_voluntariado', 'left');
        $this->db->join('Areas_Geograficas AS ag', 'u.id_area_geografica = ag.id');

        // grupos de atuacao
        $this->db->join('Utilizadores_Grupos_Atuacao AS u_ga', 'u_ga.id_utilizador = u.id');
        $this->db->join('Grupos_Atuacao AS ga', 'u_ga.id_utilizador = u.id');

        // areas de interesse
        $this->db->join('Utilizadores_Areas_Interesse AS u_ai', 'u_ai.id_utilizador = u.id');
        $this->db->join('Areas_Interesse AS ai', 'u_ai.id_utilizador = u.id');

        // disponibilidades utilizadores
        $this->db->join('Utilizadores_Disponibilidades AS ud',
            'ud.id_utilizador = u.id', 'left');
        $this->db->join('Disponibilidades AS disp_u', 'ud.id_disponibilidade = disp_u.id', 'left');

        // disponibilidades voluntario
        $this->db->join('Oportunidades_Voluntariado_Disponibilidades AS ovd',
            'ovd.id_oportunidade_voluntariado = ov.id', 'left');
        $this->db->join('Disponibilidades AS disp_o', 'ovd.id_disponibilidade = disp_o.id', 'left');

        // matching disponibilidades
        $this->db->where('disp_u.data_inicio >=', 'disp_o.data_inicio');
        $this->db->where('disp_u.data_inicio <=', 'disp_o.data_fim');

        $this->db->where('disp_u.data_fim >=', 'disp_o.data_inicio');
        $this->db->where('disp_u.data_fim <=', 'disp_o.data_fim');

        $this->db->where('distrito', $oportunidade->distrito);
        $this->db->where('concelho', $oportunidade->concelho);
        $this->db->where('freguesia', $oportunidade->freguesia);
        $this->db->where('ov.id', $id_oportunidade);

        //    $this->db->where_in('id_grupo_atuacao', $grupos_atuacao_utilizador_array);
        //    $this->db->where_in('id_area_interesse', $areas_interesse_utilizador_array);

        // Falta relacionar com as disponibilidades e o numero de vagas tem de ser calculado ((vagas - inscricoes) > 0)

        return $this->db->get();
    }

    public function get_matching_voluntarios_inscritos($id_oportunidade)
    {
        $oportunidade = $this->get_by_id($id_oportunidade)->row();

        $this->db->distinct();
        $this->db->select('vol.id as id_voluntario, vol.id_utilizador, u.nome,
            vol.foto, u.id as id_utilizador, insc.aceite');
        // $this->db->select('*');
        $this->db->from('Voluntarios AS vol');
        $this->db->join('Utilizadores AS u', 'u.id = vol.id_utilizador');

        $this->db->join('Inscreve_Se AS insc', 'insc.id_voluntario = vol.id');
        $this->db->join('Oportunidades_Voluntariado AS ov', 'ov.id = insc.id_oportunidade_voluntariado');
        $this->db->join('Areas_Geograficas AS ag', 'u.id_area_geografica = ag.id');

        // grupos de atuacao
        $this->db->join('Utilizadores_Grupos_Atuacao AS u_ga',
            'u_ga.id_utilizador = u.id');
        $this->db->join('Grupos_Atuacao AS ga', 'u_ga.id_utilizador = u.id');

        // areas de interesse
        $this->db->join('Utilizadores_Areas_Interesse AS u_ai',
            'u_ai.id_utilizador = u.id');
        $this->db->join('Areas_Interesse AS ai', 'u_ai.id_utilizador = u.id');

        // disponibilidades utilizadores
        $this->db->join('Utilizadores_Disponibilidades AS ud','ud.id_utilizador = u.id', 'left');
        $this->db->join('Disponibilidades AS disp_u', 'ud.id_disponibilidade = disp_u.id', 'left');

        // disponibilidades voluntario
        $this->db->join('Oportunidades_Voluntariado_Disponibilidades AS ovd',
            'ovd.id_oportunidade_voluntariado = ov.id', 'left');
        $this->db->join('Disponibilidades AS disp_o', 'ovd.id_disponibilidade = disp_o.id', 'left');

        // matching disponibilidades
        $this->db->where('disp_u.data_inicio >=', 'disp_o.data_inicio');
        $this->db->where('disp_u.data_inicio <=', 'disp_o.data_fim');

        $this->db->where('disp_u.data_fim >=', 'disp_o.data_inicio');
        $this->db->where('disp_u.data_fim <=', 'disp_o.data_fim');

        $this->db->where('insc.aceite =', '0');
        $this->db->where('distrito', $oportunidade->distrito);
        $this->db->where('concelho', $oportunidade->concelho);
        $this->db->where('freguesia', $oportunidade->freguesia);
        $this->db->where('ov.id', $id_oportunidade);

        return $this->db->get();
    }

    public function get_matching_voluntarios_aceites($id_oportunidade)
    {
        $oportunidade = $this->get_by_id($id_oportunidade)->row();

        $this->db->distinct();
        $this->db->select('vol.id as id_voluntario, vol.id_utilizador, u.nome,
            vol.foto, u.id as id_utilizador, insc.aceite');
        $this->db->from('Voluntarios AS vol');
        $this->db->join('Utilizadores AS u', 'u.id = vol.id_utilizador');
        $this->db->join('Inscreve_Se AS insc', 'insc.id_voluntario = vol.id');
        $this->db->join('Oportunidades_Voluntariado AS ov', 'ov.id = insc.id_oportunidade_voluntariado');
        $this->db->join('Areas_Geograficas AS ag', 'u.id_area_geografica = ag.id');

        // grupos de atuacao
        $this->db->join('Utilizadores_Grupos_Atuacao AS u_ga','u_ga.id_utilizador = u.id');
        $this->db->join('Grupos_Atuacao AS ga', 'u_ga.id_utilizador = u.id');

        // areas de interesse
        $this->db->join('Utilizadores_Areas_Interesse AS u_ai', 'u_ai.id_utilizador = u.id');
        $this->db->join('Areas_Interesse AS ai', 'u_ai.id_utilizador = u.id');

        // disponibilidades utilizadores
        $this->db->join('Utilizadores_Disponibilidades AS ud','ud.id_utilizador = u.id', 'left');
        $this->db->join('Disponibilidades AS disp_u', 'ud.id_disponibilidade = disp_u.id', 'left');

        // disponibilidades voluntario
        $this->db->join('Oportunidades_Voluntariado_Disponibilidades AS ovd',
            'ovd.id_oportunidade_voluntariado = ov.id', 'left');
        $this->db->join('Disponibilidades AS disp_o', 'ovd.id_disponibilidade = disp_o.id', 'left');

        // matching disponibilidades
        $this->db->where('disp_u.data_inicio >=', 'disp_o.data_inicio');
        $this->db->where('disp_u.data_inicio <=', 'disp_o.data_fim');

        $this->db->where('disp_u.data_fim >=', 'disp_o.data_inicio');
        $this->db->where('disp_u.data_fim <=', 'disp_o.data_fim');

        $this->db->where('insc.aceite =', '1');
        $this->db->where('distrito', $oportunidade->distrito);
        $this->db->where('concelho', $oportunidade->concelho);
        $this->db->where('freguesia', $oportunidade->freguesia);
        $this->db->where('ov.id', $id_oportunidade);

        // Falta relacionar com as disponibilidades e o numero de vagas tem de ser calculado ((vagas - inscricoes) > 0)

        return $this->db->get();
    }

    public function insert_entry($data)
    {
        // adicionar oportunidade
        $this->db->insert('Oportunidades_Voluntariado', $data);
        $id_oportunidade = $this->db->insert_id();

        return $id_oportunidade;
    }

    public function update_entry($data, $id_oportunidade_voluntariado)
    {
        $this->db->where('id', $id_oportunidade_voluntariado);
        $this->db->update('Oportunidades_Voluntariado', $data);
    }

    public function delete_entry($id_oportunidade_voluntariado)
    {
        $this->db->where('id', $id_oportunidade_voluntariado);
        $this->db->delete('Oportunidades_Voluntariado');
    }

    public function get_by_id($id_oportunidade_voluntariado)
    {
        $this->db->select('ov.nome AS nome_oportunidade, ov.funcao, ov.id, ov.pais,
            ov.vagas, ov.ativa, ga.nome AS nome_grupo_atuacao, ga.descricao, ov.id_instituicao,
            ai.nome AS nome_area_interesse, ga.id AS id_grupo_atuacao,
            ai.id AS id_area_interesse, ov.id_area_geografica, ag.distrito, ag.concelho, ag.freguesia');

        $this->db->from('Oportunidades_Voluntariado AS ov');
        $this->db->join('Grupos_Atuacao AS ga', 'ga.id = ov.id_grupo_atuacao');
        $this->db->join('Areas_Interesse AS ai', 'ai.id = ov.id_area_interesse');
        $this->db->join('Areas_Geograficas AS ag', 'ag.id = ov.id_area_geografica');
        $this->db->where('ov.id', $id_oportunidade_voluntariado);

        return $this->db->get();
    }

    public function get_ativas_by_id_instituicao($id_instituicao)
    {
        $data = array(
            'id_instituicao' => $id_instituicao,
            'ativa'          => 'y'
        );

        $this->db->select('ov.id, ov.nome, ov.funcao, ov.pais,
            ov.vagas, ov.ativa, ov.id_instituicao, ov.id_area_geografica,
            ag.distrito, ag.concelho, ag.freguesia');
        $this->db->from('Oportunidades_Voluntariado AS ov');
        $this->db->join('Areas_Geograficas AS ag', 'ag.id = ov.id_area_geografica');
        $this->db->where($data);

        return $this->db->get();
    }

    public function get_inativas_by_id_instituicao($id_instituicao)
    {
        $data = array(
            'id_instituicao' => $id_instituicao,
            'ativa'          => 'n'
        );

        $this->db->select('ov.id, ov.nome, ov.funcao, ov.pais,
            ov.vagas, ov.ativa, ov.id_instituicao, ov.id_area_geografica, ag.distrito, ag.concelho, ag.freguesia');
        $this->db->from('Oportunidades_Voluntariado AS ov');
        $this->db->join('Areas_Geograficas AS ag', 'ag.id = ov.id_area_geografica');
        $this->db->where($data);

        return $this->db->get();
    }

    public function get_form_data($input)
    {
        $is_ativa = isset($input['ativa']) ? 'y' : 'n';

        $data = array(
            'nome'              => $input['nome'],
            'funcao'            => $input['funcao'],
            'pais'              => $input['pais'],
            'vagas'             => $input['vagas'],
            'id_area_interesse' => $input['id_area_interesse'],
            'id_grupo_atuacao'  => $input['id_grupo_atuacao'],
            'ativa'             => $is_ativa
        );

        return $data;
    }

    public function get_form_validation_rules()
    {
        $rules = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required'
            ),
            array(
                'field' => 'funcao',
                'label' => 'Função',
                'rules' => 'required'
            ),
            array(
                'field' => 'pais',
                'label' => 'País',
                'rules' => 'required'
            ),
            array(
                'field' => 'vagas',
                'label' => 'Vagas',
                'rules' => 'required'
            ),
            array(
                'field' => 'distrito',
                'label' => 'Distrito',
                'rules' => 'required'
            ),
            array(
                'field' => 'concelho',
                'label' => 'Concelho',
                'rules' => 'required'
            ),
            array(
                'field' => 'freguesia',
                'label' => 'Freguesia',
                'rules' => 'required'
            ),
            array(
                'field' => 'id_grupo_atuacao',
                'label' => 'Grupo de Atuação',
                'rules' => 'required'
            ),
            array(
                'field' => 'id_area_interesse',
                'label' => 'Grupo de Atuação',
                'rules' => 'required'
            )
        );

        return $rules;
    }
}
