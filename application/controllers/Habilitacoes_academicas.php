<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Habilitacoes_academicas extends MY_Controller {

	function __construct() {
		parent::__construct();

	}

	// GET /
	public function index()
	{
		$this->js_file = 'home.js';
		$this->load->view('templates/main_template/header');
		$this->load->view('home/index');
		$this->load->view('templates/main_template/footer');
	}

	// GET habilitacoes_academicas/delete/:id_voluntario
	public function delete($id_voluntario)
	{
		$this->load->model('HabilitacaoAcademica', 'habilitacao_academica');
		$id = $this->input->get('id');

		$this->habilitacao_academica->delete_entry($id_habilitacao_academica);

		redirect('voluntarios/profile');
	}
}
