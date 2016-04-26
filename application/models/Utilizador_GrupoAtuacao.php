<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizador_GrupoAtuacao extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   function insert_entries($user_id, $grupos_atuacao)
   {
      $ids = "";
      $grupos_atuacao = $grupos_atuacao['grupos_atuacao'];

      foreach ($grupos_atuacao as $key => $value) {
         $ids = $ids . " " . $value;
      }

      $this->db->select('id');
      $this->db->from('Grupos_Atuacao');
      $this->db->where_in('id', $ids);
      $query = $this->db->get();

      foreach ($query->result() as $value) {
         $data = array(
            'id_utilizador'    => $user_id,
            'id_grupo_atuacao' => $value->id
         );

         $this->db->insert('Utilizadores_Grupos_Atuacao', $data);
      }
   }

   function get_signup_form_data($input)
   {
      $data = array(
         'grupos_atuacao' => $input->post('grupos_atuacao'),
      );

      return $data;
   }
}
