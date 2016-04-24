<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_AreaOfInterest extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert_entries($user_id, $areas_of_interest)
    {
        //$this->db->select('email, password, salt');
        $this->db->from('Areas_Interesse areas_of_interest');
        $this->db->where_in('nome', $areas_of_interest);
        $query = $this->db->get();

        foreach ($query->result() as $key => $value) {
            $data = array(
                'id_utilizador'     => $user_id,
                'id_area_interesse' => $key
            );

            $this->db->insert('Utilizador_Area_Interesse', $data);
        }
    }

    function get_signup_form_data($input)
    {
        $data = array(
            '' => $input->post('areas_of_interest'),
        );

        return $data;
    }
}
