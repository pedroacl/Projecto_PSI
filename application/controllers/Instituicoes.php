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

		$this->js_file = 'home.js';
		$this->title = "Perfil de " . $this->instituicao->nome;
		$this->load->view('templates/main_template/header');
		$this->load->view('instituicoes/profile');
		$this->load->view('templates/main_template/footer');
	}

	// GET /instituicoes/edit_main_profile
	public function edit_main_profile()
	{
		$this->load->helper('form');
		$this->load->model('Utilizador', 'utilizador');
		$this->instituicao_data = $this->instituicao->get_by_id_utilizador($this->id_utilizador)->row();

		$this->utilizador_data = $this->utilizador->get_by_id($this->id_utilizador, 'instituicao')->row();
		$this->load->model('AreaGeografica', 'area_geografica');
		if ($this->utilizador_data->id_area_geografica !== null) {
			$this->area_geografica = $this->area_geografica->get_by_id($this->utilizador_data->id_area_geografica)->row();
		} else {
			$this->area_geografica = '';
		}

		$this->js_file = 'instituicoes/instituicoes_edit_profile.js';
		$this->title = "Editar perfil de Instituição";
		$this->load->view('templates/main_template/header');
		$this->load->view('instituicoes/edit_profile');
		$this->load->view('templates/main_template/footer');
	}

	// POST /instituicoes/update_main_profile
	public function update_main_profile()
	{
		$this->load->library('form_validation');

		$form_rules = $this->instituicao->get_form_validation_rules();
		$this->form_validation->set_rules($form_rules);

		if ($this->form_validation->run() == FALSE) {
			// mostrar novamente formulario
			$this->edit_main_profile();
		} else {

	 		$this->session->set_flashdata('success', 'Perfil atualizado com sucesso!');
			$this->profile();
		}
	}
}
