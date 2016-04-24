<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AreaOfInterest extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert_entry($user_id, $area_of_interest)
    {
        $this->load->model('User_AreaOfInterest', 'user_area_of_interest');

        $this->db->insert('Areas_Interesse', $area_of_interest);
        $area_of_interest_id = $this->db->insert_id();

        $this->user_area_of_interest->insert_entry($user_id, $area_of_interest_id);
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'freguesia' => $input->post('parish'),
            'concelho'  => $input->post('county'),
            'distrito'  => $input->post('district'),
        );

        return $data;
    }
}
