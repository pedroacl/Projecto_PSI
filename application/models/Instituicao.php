<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instituicao extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insert_entry($institution, $user_id)
    {
        $institution['id_instituicao'] = $user_id;
        $this->db->insert('Instituicao', $institution);

        return $this->db->insert_id();
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

    function get_signup_form_data($input)
    {
        $data = array(
            'nome'               => $input->post('name'),
            'descricao'          => $input->post('birthdate'),
            'telefone'           => $input->post('cellphone'),
            'descricao'          => $input->post('cellphone'),
            'website'            => $input->post('cellphone'),
            'morada'             => $input->post('cellphone'),
            'id_area_geografica' => $input->post('id_geographic_area'),
            'id_utilizador'      => ''
        );

        return $data;
    }

    function get_form_validation_rules() {
        $rules = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|min_length[8]'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ),
            array(
                'field' => 'password_confirmation',
                'label' => 'Password Confirmation',
                'rules' => 'required'
            ),
            array(
                'field' => 'user_name',
                'label' => 'nome',
                'rules' => 'required'
            ),
            array(
                'field' => 'id_area_geografica',
                'label' => 'Password Confirmation',
                'rules' => 'required'
            ),
            array(

            )
        );

        return $rules;
    }
}