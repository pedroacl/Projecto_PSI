<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodicidade extends CI_Model {

 	function __construct()
   {
      parent::__construct();
   }

   public function insert_entry($data)
   {
      $this->db->insert('Periodicidades', $data);
      return $this->db->insert_id();
   }

   public function insert_single_entry($data)
   {
      $this->db->insert('Periodicidades', $data);
      return $this->db->insert_id();
   }

   public function update_entry($id_periodicidade)
   {

   }

   function get_form_data($input)
   {
      $data_fim = date("Y/m/d", strtotime($input['repetir_ate']));

   	$data = array(
         'tipo'     => $input['periodicidade'],
         'data_fim' => $data_fim
   	);

      return $data;
   }
}
