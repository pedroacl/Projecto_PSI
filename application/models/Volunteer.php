<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer extends CI_Model {

    function insert_entry($volunteer, $user_id)
    {
        $this->load->model('AcademicQualification', 'academic_qualification');

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
            'genero'                     => $input->post('gender'),
            'data_nascimento'            => $input->post('birthdate'),
            'id_area_geografica'         => $input->post('geographic_area_id'),
            'id_habilitacoes_academicas' => $input->post('academic_qualifications_id'),
            'id_utilizador'              => ''
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
                'label' => 'Nome',
                'rules' => 'required'
            ),
            array(
                'field' => 'phone_number',
                'label' => 'Telefone',
                'rules' => 'required'
            ),
            array(
                'field' => 'geographic_area_id',
                'label' => 'Areas Geograficas',
                'rules' => 'required'
            ),
            array(
                'field' => 'academic_qualifications_id',
                'label' => 'Habilitacoes Academicas',
                'rules' => 'required'
            ),
            array(
                'field' => 'gender',
                'label' => 'Género',
                'rules' => 'required'
            ),
            array(
                'field' => 'birthdate',
                'label' => 'Data de Nascimento',
                'rules' => 'required'
            ),
        );

        return $rules;
    }
}