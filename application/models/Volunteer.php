<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer extends CI_Model {

    function insert_entry($volunteer, $user_id)
    {
        $this->load->model('AcademicQualification', 'academic_qualification');
        $this->load->model('GeographicArea', 'geographic_area');
        $this->load->model('Interest', 'interest');
        $this->load->model('ActionGroup', 'action_group');

        // insert de qualificações academicas
        $academic_qualification_data = $this->academic_qualification->get_signup_form_data($this->input);
        $this->geographic_area->insert_entry($geographic_area_data);

        // insert de areas geograficas
        $geographic_area_data = $this->geographic_area->get_signup_form_data($this->input);
        $this->geographic_area->insert_entry($geographic_area_data);

        // insert do utilizador
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
            'id_areas_interesse'         => $input->post('interest_areas'),
            'id_action_groups'           => $input->post('action_groups'),
            'id_utilizador'              => ''
        );

        return $data;
    }

    function get_form_validation_rules()
    {
        $rules = array(
            array(
                'field' => 'phone_number',
                'label' => 'Telefone',
                'rules' => 'required|min_length[9]'
            ),
            /*
            array(
                'field' => 'geographic_area_id',
                'label' => 'Areas Geograficas',
                'rules' => 'required'
            ),
            */
            array(
                'field' => 'birthdate',
                'label' => 'Data de Nascimento',
                'rules' => 'required'
            ),
            array(
                'field' => 'academic_qualifications',
                'label' => 'Habilitacoes Academicas',
                'rules' => 'required'
            ),
        );

        return array_merge($rules, $this->user->get_form_validation_rules());
    }
}