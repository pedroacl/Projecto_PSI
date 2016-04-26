<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodicity extends CI_Model {

 	function __construct()
   {
      parent::__construct();
   }

   function insert_entry($periodicity)
   {
      $this->db->insert('Periodicidades', $periodicity);
      return $this->db->insert_id();
   }

   function get_form_data($input)
   {
   	$data = array(
			'tipo'     => $input->post('tipo_periodicidade'),
			'data_fim' => $input->post('periodicity_end_date')
   	);
   }
}
