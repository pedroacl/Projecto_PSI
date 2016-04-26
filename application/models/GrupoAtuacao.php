<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GrupoAtuacao extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   function get_entries()
   {
      $this->db->select('*');
      $this->db->from('Grupos_Atuacao');

      return $this->db->get();
   }

   function insert_entries($id_utilizador, $grupos_atuacao)
   {
      foreach ($grupos_atuacao as $key => $value)
      {
         $this->insert_entry($id_utilizador, $key);
      }
   }

   function insert_entry($id_utilizador, $grupo_atuacao)
   {
      $this->db->insert('Grupos_Atuacao', $grupo_atuacao);
      $id_grupo_atuacao = $this->db->insert_id();

      $data = array(
			'id_utilizador'    => $id_utilizador,
			'id_grupo_atuacao' => $id_grupo_atuacao
      );

      $this->load->model('Utilizador_GrupoAtuacao', 'utilizador_grupo_atuacao');
      $this->utilizador_grupo_atuacao->insert_entry($id_utilizador, $id_grupo_atuacao);
   }

   function get_signup_form_data($input)
   {
      $data = array(
         'nome'      => $input->post('grupos_atuacao'),
         'descricao' => $input->post('grupos_atuacao')
      );

      return $data;
   }
}
