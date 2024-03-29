<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodicidade extends CI_Model {

 	function __construct()
   {
      parent::__construct();
   }

   public function insert_entry($input, $id_disponibilidade)
   {
      $periodicidade = $this->get_signup_form_data($input, $id_disponibilidade);
      $this->db->insert('Periodicidades', $periodicidade);

      return $this->db->insert_id();
   }

   function get_form_data($input, $id_disponibilidade)
   {
      $data_fim = date("Y/m/d", strtotime($input->post('repetir_ate')));

   	$data = array(
         'id_disponibilidade' => $id_disponibilidade,
         'tipo'               => $input->post('periodicidade'),
         'data_fim'           => $input->post('data_fim')
   	);

      return $data;
   }
}
