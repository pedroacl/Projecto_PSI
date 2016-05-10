<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oportunidade_voluntariado extends CI_Model {

    function __construct()
    {
      parent::__construct();
      $this->load->model('Periodicidade', 'periodicidade');
    }

    public function insert_entry($data)
    {
        $this->db->insert('Oportunidades_Voluntariado', $data);

        return $this->db->insert_id();
    }

    public function update_entry($id_instituicao, $id_oportunidade_voluntariado, $input)
    {
        $oportunidade_voluntariado = $this->get_form_data($id_instituicao, $input);

        $this->db->where('id', $id_oportunidade_voluntariado);
        $this->db->update('Oportunidades_Voluntariado', $oportunidade_voluntariado);
    }

    public function delete_entry($id_oportunidade_voluntariado)
    {
        $this->db->where('id', $id_oportunidade_voluntariado);
        $this->db->delete('Oportunidades_Voluntariado');
    }

    public function get_entry($id_oportunidade_voluntariado)
    {
        $this->db->select('*');
        $this->db->from('Oportunidades_Voluntariado');
        $this->db->where('id', $id_oportunidade_voluntariado);

        return $this->db->get();
    }

    public function get_by_id($id_oportunidade_voluntariado)
    {
        $this->db->select('*');
        $this->db->from('Oportunidades_Voluntariado as ov');
        $this->db->where('id', $id_oportunidade_voluntariado);

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

    public function get_form_data($id_instituicao, $input)
    {
        $ativa = $input->post('ativa');
        $is_ativa = isset($ativa) ? 'y' : 'n';

        $data = array(
            'id_instituicao' => $id_instituicao,
            'nome'           => $input->post('nome'),
            'funcao'         => $input->post('funcao'),
            'pais'           => $input->post('pais'),
            'vagas'          => $input->post('vagas'),
            'ativa'          => $is_ativa
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
            )
        );

        return $rules;
    }
}