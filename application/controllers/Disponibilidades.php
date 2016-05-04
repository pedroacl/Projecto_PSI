<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disponibilidades extends MY_Controller {

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
		$this->load->model('Disponibilidade', 'disponibilidade');
		$disponibilidade = $this->input->post();

		$this->disponibilidade->add($habilitacao_academica);
	}

	public function delete()
	{
		$this->load->model('Disponibilidade', 'disponibilidade');
		$id = $this->input->get('id');

		$this->disponibilidade->delete($id);
	}
}
