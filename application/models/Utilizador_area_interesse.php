<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizador_area_interesse extends CI_Model {

    function __construct()
    {
      parent::__construct();
    }

    public function insert_entry($id_utilizador, $id_area_interesse)
    {
      $data = array(
         'id_utilizador'     => $id_utilizador,
         'id_area_interesse' => $id_area_interesse
      );

      $this->db->insert('Utilizadores_Areas_Interesse', $data);
    }

    public function delete_entry($id_utilizador, $id_area_interesse)
    {
      $this->db->where(array(
        'id_utilizador'     => $id_utilizador,
        'id_area_interesse' => $id_area_interesse));

      $this->db->delete('Utilizadores_Areas_Interesse');
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'areas_interesse' => $input->post('areas_interesse[]'),
        );

        return $data;
    }
}
