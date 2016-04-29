<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizador_AreaInteresse extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_areas_interesse_from_utilizador($user_id)
    {
      $this->db->select('id_area_interesse');
      $this->db->from('Utilizadores_Areas_Interesse');
      $this->db->where_in('id_utilizador', $user_id);
      $query = $this->db->get();
      $result;

      $i = 0;
      foreach ($query->result() as $value) {
         $result[$i] = $value->id_area_interesse;
         $i++;
      }

      return $result;
    }

    function insert_entries($id_utilizador, $input)
    {
        $areas_interesse = $this->get_signup_form_data($input);
        $areas_interesse = $areas_interesse['areas_interesse'];

        $ids = "";

        foreach ($areas_interesse as $key => $value) {
            $ids = $ids . " " . $value;
        }

        $this->db->select('id');
        $this->db->from('Areas_Interesse');
        $this->db->where_in('id', $ids);
        $query = $this->db->get();

        foreach ($query->result() as $value) {
            $data = array(
                'id_utilizador'     => $id_utilizador,
                'id_area_interesse' => $value->id
            );

            $this->db->insert('Utilizadores_Areas_Interesse', $data);
        }
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'areas_interesse' => $input->post('areas_interesse'),
        );

        return $data;
    }
}
