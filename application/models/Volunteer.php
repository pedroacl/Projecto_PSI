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
        $birthdate = $newDate = date("Y/m/d", strtotime($input->post('birthdate')));

        $data = array(
            'genero'          => $input->post('gender'),
            'data_nascimento' => $birthdate,
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
                'field' => 'action_groups[]',
                'label' => 'Grupos Atuação',
                'rules' => 'required'
            ),
            array(
                'field' => 'academic_qualification_type',
                'label' => 'Habilitacoes Academicas',
                'rules' => 'required'
            ),
            array(
                'field' => 'academic_qualification_degree',
                'label' => 'Curso',
                'rules' => 'required'
            ),
            array(
                'field' => 'academic_qualification_institute',
                'label' => 'Instituto',
                'rules' => 'required'
            ),
            array(
                'field' => 'academic_qualification_end_date',
                'label' => 'Data de Conclusão',
                'rules' => 'required'
            ),

        );

        return array_merge($rules, $this->user->get_form_validation_rules());
    }
}