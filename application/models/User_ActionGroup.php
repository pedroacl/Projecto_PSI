<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_ActionGroup extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   function insert_entries($user_id, $action_groups)
   {
      $ids = "";
      $action_groups = $action_groups['action_groups'];

      foreach ($action_groups as $key => $value) {
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
         'action_groups' => $input->post('action_groups'),
      );

      return $data;
   }
}
