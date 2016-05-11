<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oportunidade_voluntariado extends CI_Model {

    function __construct()
    {
      parent::__construct();

      $this->load->model('Periodicidade', 'periodicidade');
      $this->load->model('Disponibilidade', 'disponibilidade');
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
/*
    public function get_entry($id_oportunidade_voluntariado)
    {
        $this->db->select('*');
        $this->db->from('Oportunidades_Voluntariado');
        $this->db->where('id', $id_oportunidade_voluntariado);

        return $this->db->get();
    }
*/
    public function get_by_id($id_oportunidade_voluntariado)
    {
        $this->db->select('ov.nome AS nome_oportunidade, ov.funcao, ov.pais,
            ov.vagas, ov.ativa, ga.nome AS nome_grupo_atuacao, ga.descricao, 
            ai.nome AS nome_area_interesse, ov.id_instituicao, ga.id AS id_grupo_atuacao,
            ai.id AS id_area_interesse');

        $this->db->from('Oportunidades_Voluntariado as ov');
        $this->db->join('Grupos_Atuacao AS ga', 'ga.id = ov.id_grupo_atuacao');
        $this->db->join('Areas_Interesse AS ai', 'ai.id = ov.id_area_interesse');
        $this->db->where('ov.id', $id_oportunidade_voluntariado);

        return $this->db->get();
    }

    public function get_ativas_by_id_instituicao($id_instituicao)
    {
        $data = array(
            'id_instituicao' => $id_instituicao,
            'ativa'          => 'y'
        );

        $this->db->select('*');
        $this->db->from('Oportunidades_Voluntariado');
        $this->db->where($data);

        return $this->db->get();
    }

    public function get_inativas_by_id_instituicao($id_instituicao)
    {
        $data = array(
            'id_instituicao' => $id_instituicao,
            'ativa'          => 'n'
        );

        $this->db->select('*');
        $this->db->from('Oportunidades_Voluntariado');
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