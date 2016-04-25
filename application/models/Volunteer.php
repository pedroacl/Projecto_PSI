<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer extends CI_Model {

    function insert_entry($volunteer)
    {
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
            'id_habilitacoes_academicas' => $input->post('academic_qualifications_type'),
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
                'field' => 'academic_qualification_type',
                'label' => 'Habilitacoes Academicas',
                'rules' => 'required'
            ),
        );

        return array_merge($rules, $this->user->get_form_validation_rules());
    }
}