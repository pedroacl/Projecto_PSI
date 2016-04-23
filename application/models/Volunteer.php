<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer extends CI_Model {

    function insert_entry($volunteer, $user_id)
    {
        $volunteer['id_utilizador'] = $user_id;
        $this->db->insert('Voluntarios', $volunteer);

        return $this->db->insert_id();
    }

    function get_volunteer_by_email($email)
    {
        // $query = $this->db->get('users', 1);
        $this->db->select('email, password, salt');
        $this->db->from('Utilizadores users');
        $this->db->join('Voluntarios volunteers', 'volunteers.id_utilizador = users.id', 'left');
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query;
    }

    function get_signup_form_data($input)
    {
      $data = array(
            'nome'                       => $input->post('name'),
            'genero'                     => $input->post('gender'),
            'data_nascimento'            => $input->post('birthdate'),
            'telefone'                   => $input->post('cellphone'),
            'id_area_geografica'         => $input->post('id_geographic_area'),
            'id_habilitacoes_academicas' => $input->post('id_academic_qualifications'),
            'id_utilizador'              => ''
        );

        return $data;
    }

    function get_form_validation_rules() {
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

        return $rules;
    }
}