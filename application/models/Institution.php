<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institution extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_institution_registry_form_validation_rules($user_type) {
        $rules = array(
            array(
                'field'   => 'email',
                'label'   => 'Email',
                'rules'   => 'required|valid_email|min_length[8]'
            ),
            array(
                'field'   => 'password',
                'label'   => 'Password',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'password_confirmation',
                'label'   => 'Password Confirmation',
                'rules'   => 'required'
            )

        );

        $aux_array = null;

        if ($user_type == 'volunteer') {
            $aux_array = array(
                'field' => '',
                'label' => '',
                'rules' => '',
            );
        }
        else
        {
            $aux_array = array(
                'field' => '',
                'label' => '',
                'rules' => '',
            );
        }
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


    function get_institution_form_data($input)
    {
        $data = array(
            'nome'               => $input->post('name'),
            'descricao'          => $input->post('birthdate'),
            'telefone'           => $input->post('cellphone'),
            'descricao'          => $input->post('cellphone'),
            'website'            => $input->post('cellphone'),
            'morada'             => $input->post('cellphone'),
            'id_area_geografica' => $input->post('id_geographic_area')
        );

        return $data;
    }


    function get_institution_form_validation_rules($user_type) {
        $rules = array(
            array(
                'field'   => 'email',
                'label'   => 'Email',
                'rules'   => 'required|valid_email|min_length[8]'
            ),
            array(
                'field'   => 'password',
                'label'   => 'Password',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'password_confirmation',
                'label'   => 'Password Confirmation',
                'rules'   => 'required'
            )

        );

        $aux_array = null;

        if ($user_type == 'volunteer') {
            $aux_array = array(
                'field' => '',
                'label' => '',
                'rules' => '',
            );
        }
        else
        {
            $aux_array = array(
                'field' => '',
                'label' => '',
                'rules' => '',
            );
        }

        array_push($rules, $aux_array);

        return $rules;
    }
}