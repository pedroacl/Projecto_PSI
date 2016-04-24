<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_ActionGroup extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   function insert_entries($user_id, $action_groups)
   {
      //$this->db->select('email, password, salt');
      $this->db->from('Grupos_Atuacao grupos_atuacao');
      $this->db->where_in('nome', $action_groups);
      $query = $this->db->get();

      foreach ($query->result() as $key => $value) {
         $data = array(
            'id_utilizador'    => $user_id,
            'id_grupo_atuacao' => $key
         );

         $this->db->insert('Utilizador_Grupo_Atuacao', $data);
      }
   }

   function get_signup_form_data($input)
   {
      $data = array(
         '' => $input->post('action_groups'),
      );

      return $data;
   }
}
