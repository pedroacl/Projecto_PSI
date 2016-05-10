<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oportunidade_voluntariado extends CI_Model {

    function __construct()
    {
      parent::__construct();
      $this->load->model('Periodicidade', 'periodicidade');
    }

    public function insert_entry($id_insituicao, $input)
    {
        $data = $this->get_form_data($id_insituicao, $input);
        $this->db->insert('Oportunidades_Voluntariado', $data);

        return $this->db->insert_id();
    }

    public function update_entry($input)
    {
        $oportunidade_voluntariado = $this->get_form_data($input);

        $this->db->where('id', $oportunidade_voluntariado['id']);
        $this->db->update('Voluntarios', $oportunidade_voluntariado);

        // atualizar periodicidade
        $this->periodicidade->update_entry($input);
    }

    public function delete_entry($id_oportunidade_voluntariado)
    {
        $this->db->where('id', $id_oportunidade_voluntariado);
        $this->db->delete('Oportunidades_Voluntariado');
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
            'ativa'          => 1
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
            'ativa'          => 0
        );

        $this->db->select('*');
        $this->db->from('Oportunidades_Voluntariado');
        $this->db->where($data);

        return $this->db->get();
    }

    public function get_form_data($id_instituicao, $input)
    {
        $data = array(
            'id_instituicao' => $id_instituicao,
            'nome'           => $input->post('nome'),
            'funcao'         => $input->post('funcao'),
            'pais'           => $input->post('pais'),
            'vagas'          => $input->post('vagas'),
            'ativa'          => $input->post('ativa')
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