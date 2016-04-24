<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActionGroup extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   function insert_entry($user_id, $action_group_id)
   {
   	$this->load->model('User_ActionGroup', 'user_action_group');

      $this->db->insert('Grupo_Atuacao', $action_group);
      $action_group_id = $this->db->insert_id();

      $data = array(
			'id_utilizador'    => $user_id,
			'id_grupo_atuacao' => $action_group_id
      );

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
