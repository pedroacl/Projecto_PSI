<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_AreaOfInterest extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert_entries($user_id, $areas_of_interest)
    {
        $ids = "";
        $areas_of_interest = $areas_of_interest['areas_of_interest'];
        print_r($areas_of_interest);

        foreach ($areas_of_interest as $key => $value) {
            $ids = $ids . " " . $value;
        }

        $this->db->select('id');
        $this->db->from('Areas_Interesse');
        $this->db->where_in('id', $ids);
        $query = $this->db->get();

        foreach ($query->result() as $value) {
            $data = array(
                'id_utilizador'     => $user_id,
                'id_area_interesse' => $value->id
            );

            $this->db->insert('Utilizadores_Areas_Interesse', $data);
        }
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'areas_of_interest' => $input->post('areas_of_interest'),
        );

        return $data;
    }
}
