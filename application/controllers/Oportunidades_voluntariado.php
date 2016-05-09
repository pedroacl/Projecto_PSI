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
		$this->load->library('form_validation');

		$rules = $this->oportunidade_voluntariado->get_form_validation_rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/main_template/header');
			$this->load->view('/oportunidades_voluntariado/add');
			$this->load->view('templates/main_template/footer');

		} else {
			$this->oportunidade_voluntariado->insert_entry($this->input);
		}

		$this->load->view('templates/main_template/header');
		$this->load->view('/oportunidades_voluntariado/add');
		$this->load->view('templates/main_template/footer');
	}

	public function show($id_oportunidade_voluntariado)
	{
		$this->oportunidade_voluntariado =
			$this->oportunidade_voluntariado->get_by_id($id_oportunidade_voluntariado);
	}

	public function edit($id_oportunidade_voluntariado)
	{
		$this->oportunidade_voluntariado = $this->oportunidade_voluntariado->get_entry();

		$rules = $this->oportunidade_voluntariado->get_form_validation_rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/main_template/header');
			$this->load->view('/oportunidades_voluntariado/edit');
			$this->load->view('templates/main_template/footer');

		} else {
			$this->oportunidade_voluntariado->update_entry($this->input);
		}
	}

	public function delete($id_oportunidade_voluntariado)
	{
		$this->oportunidade_voluntariado->delete_entry($id_oportunidade_voluntariado);
	}

	// POST /oportunidades_voluntariado/add_disponibilidade
	public function add_disponibilidade($id_oportunidade_voluntariado)
	{
		$this->load->library('form_validation');
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->model('Oportunidade_voluntariado_disponibilidade', 'oportunidade_voluntariado_disponibilidade');

		$form_rules = $this->disponibilidade->get_form_validation_rules();
		$this->form_validation->set_rules($form_rules);

		if ($this->form_validation->run() == FALSE) {
			// mostrar novamente o formulario
			$this->js_file = 'home.js';
			$this->load->view('templates/main_template/header');
			$this->load->view('oportunidades_voluntariado/edit');
			$this->load->view('templates/main_template/footer');
	 	} else {
	 		// inserir oportunidade
			$id_oportunidade_voluntariado = $this->disponibilidade->insert_entry($id_voluntario, $this->input);

			// criar join table
			$this->oportunidade_voluntariado_disponibilidade->insert_entry($id_disponibilidade, $this->input)

			$this->session->set_flashdata('success', 'Disponibilidade adicionada com sucesso!');
			redirec('oportunidade_voluntariado/show');
	 	}
	}
}
