<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Habilitacoes_academicas extends MY_Controller {

	function __construct() {
		parent::__construct();

	}

	// GET habilitacoes_academicas/delete/:id_voluntario
	public function delete($id_habilitacao_academica)
	{
		$this->load->model('HabilitacaoAcademica', 'habilitacao_academica');

		$id = $this->input->get('id');
		$this->habilitacao_academica->delete_entry($id_utilizador, $id_habilitacao_academica);

		redirect('voluntarios/profile');
	}
}
