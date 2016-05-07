<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Habilitacoes_academicas extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->authenticate_user();
      $this->load->model('Habilitacao_academica', 'habilitacao_academica');
	}

	public function add()
	{
		$this->habilitacao_academica->insert_entry($this->id_utilizador, $this->input);

 		$this->session->set_flashdata('notice', 'Habilitacao Academica adicionada!');
		redirect('voluntarios/profile');
	}

	// GET habilitacoes_academicas/delete/:id_voluntario
	public function delete($id_habilitacao_academica)
	{
		$this->habilitacao_academica->delete_entry($id_habilitacao_academica);

 		$this->session->set_flashdata('notice', 'Habilitacao Academica eliminada!');
		redirect('voluntarios/profile');
	}
}
