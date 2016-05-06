<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizador_habilitacao_academica extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   public function insert_entry($id_utilizador, $id_habilitacao_academica)
   {
      $this->db->insert('Utilizadores_Grupos_Atuacao', );
   }
}
