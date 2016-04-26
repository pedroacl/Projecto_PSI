<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disponibilidade extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert_entry($input)
    {
        $disponibilidades = get_signup_form_data($input);
        $this->db->insert_batch('Disponibilidades', $disponibilidades);

        return $this->db->insert_id();
    }

    function get_signup_form_data($input)
    {
        return $this->input->post('disponibilidades');
    }
}
