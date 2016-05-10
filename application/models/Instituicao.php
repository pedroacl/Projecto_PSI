<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instituicao extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insert_entry($id_utilizador)
    {
        $this->db->insert('Instituicoes', array('id_utilizador' => $id_utilizador));
        return $this->db->insert_id();
    }

    function get_by_id_utilizador($id_utilizador)
    {
        $this->db->select('u.id, u.email, u.nome, i.descricao, i.morada, i.email_instituicao, u.telefone, i.website');
        $this->db->from('Utilizadores as u');
        $this->db->join('Instituicoes as i', 'u.id = i.id_utilizador');
        $this->db->where('u.id', $id_utilizador);

        return $this->db->get();
    }

    public function update_entry($id_instituicao, $input)
    {
        $data_instituicao = $this->get_form_data($input);
        print_r($data_instituicao);
        $this->db->where('id', $id_instituicao);
        $this->db->update('Instituicoes', $data_instituicao);
    }

    function get_institution_by_email($email)
    {
        // $query = $this->db->get('users', 1);
        $this->db->select('email, password, salt');
        $this->db->from('Utilizadores users');
        $this->db->join('Instituicoes institutions', 'institutions.id_utilizador = users.id', 'left');
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query;
    }

    function get_form_data($input)
    {
        $data = array(
            'email_instituicao'  => $input->post('email_instituicao'),
            'descricao'          => $input->post('descricao'),
            'website'            => $input->post('website'),
            'morada'             => $input->post('morada')
        );

        return $data;
    }

    function get_form_validation_rules() {
        $rules = array(
            array(
                'field' => 'telefone',
                'label' => 'Telefone',
                'rules' => 'min_length[9]'
            ),
            array(
                'field' => 'email_instituicao',
                'label' => 'Email de Instituição',
                'rules' => 'valid_email'
            )
        );

        return $rules;
    }
}