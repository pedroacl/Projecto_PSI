<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_AreaOfInterest extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert_entry($user_id, $area_of_interest_id)
    {
        $data = array(
            'id_utilizador'     => $user_id,
            'id_area_interesse' => $area_of_interest_id
        );

        $this->db->insert('Utilizador_Area_Interesse', $data);
    }
}
