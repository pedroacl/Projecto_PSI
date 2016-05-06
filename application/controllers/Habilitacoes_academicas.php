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

	public function add()
	{
		$this->load->model('Habilitacao_academica', 'habilitacao_academica');
		$this->habilitacao_academica->insert_entry($this->input);

		redirect('voluntarios/profile');
	}

	public function delete()
	{
		$this->load->model('HabilitacaoAcademica', 'habilitacao_academica');
		$id = $this->input->get('id');

		$this->habilitacao_academica->delete($id);
	}
}
