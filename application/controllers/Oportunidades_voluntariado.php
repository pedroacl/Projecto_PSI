<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oportunidades_voluntariado extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->authenticate_user();
		$this->validate_is_instituicao();
		$this->load->model('Oportunidade_voluntariado', 'oportunidade_voluntariado');
	}

	public function index()
	{
		$this->load->library('session');

		$this->load->view('templates/main_template/header');
		$this->load->view('/oportunidades_voluntariado/index');
		$this->load->view('templates/main_template/footer');
	}

	public function add()
	{
		$this->load->helper('form');

		$this->load->view('templates/main_template/header');
		$this->load->view('/oportunidades_voluntariado/add');
		$this->load->view('templates/main_template/footer');
	}

	public function show($id_oportunidade_voluntariado)
	{

	}

	public function edit($id_oportunidade_voluntariado)
	{
		$this->oportunidade_voluntariado->get_entry();
		$this->load->view('templates/main_template/header');
		$this->load->view('/oportunidades_voluntariado/profile');
		$this->load->view('templates/main_template/footer');
	}
}
