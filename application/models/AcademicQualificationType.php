<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AcademicQualificationType extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_entries()
    {
        $this->db->select('*');
        $this->db->from('Tipos_Habilitacoes_Academicas');
        return $this->db->get();
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'id_tipo'          => $input->post('academic_qualification_type'),
            'data_conclusao'   => $input->post('conclusion_date'),
            'curso'            => $input->post('degree'),
            'instituto_ensino' => $input->post('school')
        );

        return $data;
    }
}
