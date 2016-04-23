<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AcademicQualification extends MY_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insert_entry($academic_qualification)
    {
        $this->db->insert('Habilitacoes_Academicas', $academic_qualification);
        return $this->db->insert_id();
    }

    function get_signup_form_data($input)
    {
        
    }
}
