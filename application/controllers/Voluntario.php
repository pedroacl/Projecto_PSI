<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voluntario extends MY_Controller {

	function __construct() {
		parent::__construct();

		// $this->load->model('Voluntario', 'voluntario');
		// $this->load->library('session');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function profile()
	{
		// $id_utilizador = $this->session->userdata('id');
		// $this->voluntario = $this->voluntario->get_voluntario_by_id($id_utilizador);

		$this->load->view('templates/main_template/header');
		$this->load->view('voluntarios/profile');
		$this->load->view('templates/main_template/footer');
	}
}
