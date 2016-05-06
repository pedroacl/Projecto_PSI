<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instituicoes extends MY_Controller {

	function __construct() {
		parent::__construct();

	}

	public function index()
	{
		$this->load->view('index');
	}

	public function profile()
	{
		//$this->authenticate_user();
		$this->load->helper('form');

		$this->load->model('Instituicao', 'instituicao');
		$this->load->model('Disponibilidade', 'disponibilidade');

		$id_utilizador    = $this->session->userdata('id');

		// instituicao
		$this->instituicao =
			$this->instituicao->get_by_id_utilizador($id_utilizador)->row();

		$this->js_file = 'home.js';
		$this->load->view('templates/main_template/header');
		$this->load->view('instituicoes/profile');
		$this->load->view('templates/main_template/footer');
	}

	// GET /voluntarios/edit_main_profile
	public function edit_main_profile()
	{
		$this->load->model('Voluntario', 'voluntario');

		$this->$voluntario = $this->voluntario->get_main_profile();

		$this->load->view('templates/main_template/header');
		$this->load->view('voluntarios/edit_profile');
		$this->load->view('templates/main_template/footer');
	}

	// POST /voluntarios/update_main_profile
	public function update_main_profile()
	{
		$this->load->library('form_validation');
		$this->load->model('Voluntario', 'voluntario');

		$form_rules = $this->voluntario->get_form_validation_rules();
		$this->form_validation->set_rules($form_rules);

		if ($this->form_validation->run() == FALSE) {
			// mostrar novamente formulario
			$this->edit_profile();
		} else {
	 		$this->session->set_flashdata('notice', 'Perfil atualizado com sucesso!');
			redirect('voluntarios/profile');
		}
	}
}
