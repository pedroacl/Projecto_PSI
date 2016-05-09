<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instituicoes extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->authenticate_user();
		$this->load->model('Instituicao', 'instituicao');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function profile()
	{
		$this->load->model('Area_geografica', 'area_geografica');
		$this->load->model('Grupo_atuacao', 'grupo_atuacao');
		$this->load->model('Area_interesse', 'area_interesse');
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->helper('form');

		// instituicao
		$this->instituicao =
			$this->instituicao->get_by_id_utilizador($this->id_utilizador)->row();

		// area geografica
		$this->area_geografica = $this->area_geografica->get_by_id_utilizador($this->id_utilizador);

		// grupos_atuacao
		$this->grupos_atuacao_utilizador = $this->grupo_atuacao->get_by_id_utilizador($this->id_utilizador);

		// tipos de grupos de atuacao (povoar select boxes)
		$this->tipos_grupos_atuacao = $this->grupo_atuacao->get_without_utilizador($this->id_utilizador);

		// areas de iteresse
		$this->tipos_areas_interesse = $this->area_interesse->get_without_utilizador($this->id_utilizador);

		// tipos de areas de interesse (povoar select boxes)
		$this->areas_interesse_utilizador = $this->area_interesse->get_by_id_utilizador($this->id_utilizador);

		// disponibilidades
		$this->disponibilidades = $this->disponibilidade->get_by_id_utilizador($this->id_utilizador);

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
	 		$this->session->set_flashdata('success', 'Perfil atualizado com sucesso!');
			redirect('voluntarios/profile');
		}
	}
}
