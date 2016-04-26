<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AreaInteresse extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_entries()
    {
        $this->db->select('*');
        $this->db->from('Areas_Interesse');

        return $this->db->get();
    }

    function insert_entry($id_utilizador, $area_iteresse)
    {
        $this->load->model('Utilizador_AreaInteresse', 'user_area_iteresse');

        $this->db->insert('Areas_Interesse', $area_iteresse);
        $area_iteresse_id = $this->db->insert_id();

        $this->user_area_iteresse->insert_entry($id_utilizador, $area_iteresse_id);
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'freguesia' => $input->post('freguesia'),
            'concelho'  => $input->post('concelho'),
            'distrito'  => $input->post('distrito'),
        );

        return $data;
    }
}
