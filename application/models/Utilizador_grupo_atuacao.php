<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizador_grupo_atuacao extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   public function insert_entry($id_utilizador, $id_grupo_atuacao)
   {
      $data = array(
         'id_utilizador'    => $id_utilizador,
         'id_grupo_atuacao' => $id_grupo_atuacao
      );

      $this->db->insert('Utilizadores_Grupos_Atuacao', $data);
   }

   public function delete_entry($id_utilizador, $id_grupo_atuacao)
   {
      $this->db->where(array(
         'id_utilizador' => $id_utilizador,
         'id_grupo_atuacao' => $id_grupo_atuacao));

      $this->db->delete('Utilizadores_Grupos_Atuacao');
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

      foreach ($grupos_atuacao as $key => $value) {
         $data = array(
            'id_utilizador'    => $user_id,
            'id_grupo_atuacao' => $value
         );

         $this->db->insert('Utilizadores_Grupos_Atuacao', $data);
      }
   }
}
