<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disponibilidade extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert_entry($availabilities)
    {
        $this->db->insert('Disponibilidades', $availabilities);
        return $this->db->insert_id();
    }

    function get_signup_form_data($input)
    {
        //TODO
        $data = array(
            'freguesia' => $input->post('parish'),
            'concelho'  => $input->post('county'),
            'distrito'  => $input->post('district'),
        );

        return $data;
    }
}
