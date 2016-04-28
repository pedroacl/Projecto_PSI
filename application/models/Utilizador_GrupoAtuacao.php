<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizador_GrupoAtuacao extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   function get_grupos_atuacao_from_utilizador($user_id)
   {
      $this->db->select('id_grupo_atuacao');
      $this->db->from('Utilizadores_Grupos_Atuacao');
      $this->db->where_in('id_utilizador', $user_id);
      $query = $this->db->get();
      $result;

      $i = 0;
      foreach ($query->result() as $value) {
         $result[$i] = $value->id_grupo_atuacao;
         $i++;
      }

      return $result;
   }

   function insert_entries($user_id, $input)
   {
      $grupos_atuacao = $this->get_signup_form_data($input);
      $grupos_atuacao = $grupos_atuacao['grupos_atuacao'];

      $ids = "";

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
