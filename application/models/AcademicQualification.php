<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AcademicQualification extends MY_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insert_entry($academic_qualifications)
    {
        $this->db->insert('Habilitacoes_Academicas', $academic_qualifications);
        return $this->db->insert_id();
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

    function get_academic_qualifications_data()
    {
        
    }
}
