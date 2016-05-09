<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oportunidades_voluntariado extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->authenticate_user();
		$this->load->model('Oportunidade_voluntariado', 'oportunidade_voluntariado');
	}

	public function index()
	{
		$this->load->library('session');
		$this->validate_is_instituicao();

		$this->load->view('templates/main_template/header');
		$this->load->view('/oportunidades_voluntariado/index');
		$this->load->view('templates/main_template/footer');
	}
}
