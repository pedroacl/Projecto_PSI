<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AcademicQualification extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert_entry($academic_qualifications)
    {
        // verificar se já existe uma area geografica adicionada
        $this->db->select('id, tipo, data_conclusao, curso, instituto_ensino');
        $this->db->from('Habilitacoes_Academicas');
        $this->db->where('tipo', $academic_qualifications['tipo']);
        $this->db->where('data_conclusao', $academic_qualifications['data_conclusao']);
        $this->db->where('curso', $academic_qualifications['curso']);
        $this->db->where('instituto_ensino', $academic_qualifications['instituto_ensino']);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $this->db->insert('Habilitacoes_Academicas', $academic_qualifications);
            return $this->db->insert_id();
        } else {
            return $query->row()->id;
        }
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'tipo'             => $input->post('academic_qualification_type'),
            'data_conclusao'   => $input->post('conclusion_date'),
            'curso'            => $input->post('degree'),
            'instituto_ensino' => $input->post('school')
        );

        return $data;
    }
}
