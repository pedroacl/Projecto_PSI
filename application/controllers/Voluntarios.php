<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voluntarios extends MY_Controller {

	function __construct() {
		parent::__construct();

	}

	public function index()
	{
		$this->load->view('index');
	}

	public function profile()
	{
		$this->authenticate_user();

		$this->load->view('templates/main_template/header');
		$this->load->view('voluntarios/profile');
		$this->load->view('templates/main_template/footer');
	}

	public function edit_profile()
	{
		$this->authenticate_user();

		$this->load->library('form_validation');
		$this->load->model('Voluntario', 'voluntario');

		//$this->voluntario = $this->voluntario->get_voluntario_by_id($this->session->userdata('id'));
		//print_r($this->voluntario);

		$this->load->view('templates/main_template/header');
		$this->load->view('voluntarios/edit_profile');
		$this->load->view('templates/main_template/footer');
	}
}
