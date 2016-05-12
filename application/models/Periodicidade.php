<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodicidade extends CI_Model {

 	function __construct()
   {
      parent::__construct();
   }

   public function get_by_disponibilidade_id($id_disponibilidade)
   {
      $this->db->select('*');
      $this->db->from('Periodicidades as periodicidades');
      $this->db->where('periodicidades.id_disponibilidade', $id_disponibilidade);

      return $this->db->get();
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

   public function update_entry($id_periodicidade, $data)
   {
      $this->db->where('id', $id_periodicidade);
      $this->db->update('Periodicidades', $data);
   }

   function get_form_data($input)
   {
      $this->load->helper('date');

   	$data = array(
         'tipo'     => $input['periodicidade'],
         'data_fim' => mdate("%Y/%m/%d",  strtotime($disp['repetir_ate']))
   	);

      return $data;
   }

   public function get_periodicidades()
    {
        return array(
            'uma_vez'       => 'Uma única vez',
            'semanalmente ' => 'Semanalmente',
            'mensalmente'   => 'Mensalmente',
            'anualmente'    => 'Anualmente'
        );
    }
}
