<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_interesse extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id_utilizador, $id_area_interesse)
    {
      $this->db->select('*');
      $this->db->from('Areas_Interesse');
      $this->db->where('id', $id_area_interesse);

      return $this->db->get();
    }

    public function get_without_utilizador($id_utilizador)
    {
      $sql = "SELECT DISTINCT ai.nome, ai.id
        FROM Areas_Interesse AS ai
        WHERE ai.id NOT IN (
          SELECT uai.id_area_interesse
          FROM Utilizadores_Areas_Interesse AS uai
          WHERE uai.id_utilizador = ?
        )";

      return $this->db->query($sql, array($id_utilizador));
    }

    function get_by_id_utilizador($id_utilizador)
    {
      $this->db->select('areas_interesse.id, areas_interesse.nome');
      $this->db->from('Areas_Interesse as areas_interesse');
      $this->db->join('Utilizadores_Areas_Interesse as utilizadores_areas_interesse',
         'areas_interesse.id = utilizadores_areas_interesse.id_area_interesse');
      $this->db->join('Utilizadores as utilizadores', 'utilizadores_areas_interesse.id_utilizador = utilizadores.id');
      $this->db->where('utilizadores.id', $id_utilizador);

      return $this->db->get();
    }

    function get_entries()
    {
      $this->db->select('*');
      $this->db->from('Areas_Interesse');

      return $this->db->get();
    }

    function delete_by_id_utilizador($id_utilizador)
    {
      $sql = "DELETE utilizadores_areas_interesse
            FROM Utilizadores utilizadores
            JOIN Utilizadores_Areas_Interesse utilizadores_areas_interesse
               ON utilizadores.id = utilizadores_areas_interesse.id_utilizador
            JOIN Areas_Interesse areas_interesse
               ON areas_interesse.id = utilizadores_areas_interesse.id_area_interesse
            WHERE utilizadores.id = ?";

      $this->db->query($sql, array($id_utilizador));
   }



    function insert_entry($id_utilizador, $input)
    {
        $area_iteresse = $this->get_signup_form_data($input);

        $this->load->model('Utilizador_AreaInteresse', 'user_area_iteresse');

        $this->db->insert('Areas_Interesse', $area_iteresse);
        $area_iteresse_id = $this->db->insert_id();

        $this->user_area_iteresse->insert_entry($id_utilizador, $area_iteresse_id);
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'nome' => $input->post('nome')
        );

        return $data;
    }
}
