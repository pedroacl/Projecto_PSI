<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscreve_se extends CI_Model {

    function __construct()
    {
      parent::__construct();
    }

    public function get_inscricoes($id_voluntario)
    {
        $this->db->select('*');
        $this->db->from('Inscreve_Se AS insc');
        $this->db->where('insc.id_voluntario', $id_voluntario);
        return $this->db->get();
    }

    public function insert_entry($id_oportunidade, $id_voluntario)
    {
        $data = array(
              'id_voluntario' => $id_voluntario,
              'id_oportunidade_voluntariado' => $id_oportunidade,
              'data_inscricao' => date("Y-m-d"),
              'aceite' => 0
        );
        $this->db->insert('Inscreve_Se', $data);
        return $this->db->insert_id();
    }
}
