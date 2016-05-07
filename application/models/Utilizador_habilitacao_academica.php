<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizador_habilitacao_academica extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   function delete_entry($id_utilizador, $id_habilitacao_academica)
   {
      $this->db->where(array(
			'id_utilizador'            => $id_utilizador,
			'id_habilitacao_academica' => $id_habilitacao_academica));

      $this->db->delete('Utilizadores_Habilitacoes_Academicas');
   }

   public function insert_entry($id_utilizador, $id_habilitacao_academica)
   {
   	$data = array(
			'id_utilizador'            => $id_utilizador,
			'id_habilitacao_academica' => $id_habilitacao_academica);

      $this->db->insert('Utilizadores_Habilitacoes_Academicas', $data);
   }
}
