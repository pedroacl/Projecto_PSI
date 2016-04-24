<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_ActionGroup extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   function insert_entry($user_id, $action_group_id)
   {
   	$data = array(
         'id_utilizador'    => $user_id,
         'id_grupo_atuacao' => $action_group_id
   	);

      $this->db->insert('Utilizador_Grupo_Atuacao', $data);
   }
}
