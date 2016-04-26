<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActionGroup extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   function get_entries()
   {
      $this->db->select('*');
      $this->db->from('Grupos_Atuacao');

      return $this->db->get();
   }

   function insert_entries($user_id, $action_groups)
   {
      foreach ($action_groups as $key => $value)
      {
         $this->insert_entry($user_id, $key);
      }
   }

   function insert_entry($user_id, $action_group)
   {
      $this->db->insert('Grupos_Atuacao', $action_group);
      $action_group_id = $this->db->insert_id();

      $data = array(
			'id_utilizador'    => $user_id,
			'id_grupo_atuacao' => $action_group_id
      );

      $this->load->model('User_ActionGroup', 'user_action_group');
      $this->user_action_group->insert_entry($user_id, $action_group_id);
   }

   function get_signup_form_data($input)
   {
      $data = array(
         'nome'      => $input->post('action_groups'),
         'descricao' => $input->post('action_groups')
      );

      return $data;
   }
}
