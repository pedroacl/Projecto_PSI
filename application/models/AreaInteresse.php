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

   function get_by_id_utilizador($id_utilizador)
   {
      $this->db->select('areas_interesse.nome');
      $this->db->from('Areas_Interesse as areas_interesse');
      $this->db->join('Utilizadores_Areas_Interesse as utilizadores_areas_interesse',
         'areas_interesse.id = utilizadores_areas_interesse.id_area_interesse');
      $this->db->join('Utilizadores as utilizadores', 'utilizadores_areas_interesse.id_utilizador = utilizadores.id');
      $this->db->where('utilizadores.id', $id_utilizador);

      return $this->db->get();
   }

    function insert_entry($id_utilizador, $input)
    {
        $area_iteresse = get_signup_form_data($input);

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
