<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizador_disponibilidade extends CI_Model {

    function __construct()
    {
      parent::__construct();
    }

    public function insert_entry($data)
    {
      $this->db->insert('Utilizadores_Disponibilidades', $data);
    }
}
