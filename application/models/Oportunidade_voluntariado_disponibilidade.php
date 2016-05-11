<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oportunidade_voluntariado_disponibilidade extends CI_Model {

   public function insert_entry($data)
   {
     	$this->db->insert('Oportunidades_Voluntariado_Disponibilidades', $data);
     	return $this->db->insert_id();
   }

 	public function get_form_data($id_oportunidade_voluntariado, $id_disponibilidade)
   {
     	return array(
         'id_oportunidade_voluntariado' => $id_oportunidade_voluntariado,
         'id_disponibilidade'           => $id_disponibilidade
      );
   }
}