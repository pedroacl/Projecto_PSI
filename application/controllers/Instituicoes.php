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

	public function profile($id_utilizador)
	{
		$this->load->helper('form');
		$this->load->model('Grupo_atuacao', 'grupo_atuacao');
		$this->load->model('Area_interesse', 'area_interesse');
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->model('Oportunidade_voluntariado', 'oportunidade_voluntariado');
		$this->load->model('Area_geografica');
		$this->load->model('Utilizador', 'utilizador');

		// instituicao
		$this->instituicao =
			$this->utilizador->get_by_id($id_utilizador, 'instituicao')->row();

		// area geografica
		$this->area_geografica_data = $this->Area_geografica->get_by_id_utilizador($this->id_utilizador);

		// oportunidades ativas
		$this->oportunidades_voluntariado_ativas =
			$this->oportunidade_voluntariado->get_ativas_by_id_instituicao($this->instituicao->id_instituicao);

		// oportunidades inativas
		$this->oportunidades_voluntariado_inativas =
			$this->oportunidade_voluntariado->get_inativas_by_id_instituicao($this->instituicao->id_instituicao);

		// matching de voluntarios
		$this->matching_voluntarios = array();

		foreach ($this->oportunidades_voluntariado_ativas->result() as $oportunidade_ativa) {
			$oportunidade_ativa->matching_nao_inscritos = $this->oportunidade_voluntariado->get_matching_voluntarios_nao_inscritos($oportunidade_ativa->id);
			$oportunidade_ativa->matching_inscritos = $this->oportunidade_voluntariado->get_matching_voluntarios_inscritos($oportunidade_ativa->id);
		}

		// foreach ($this->oportunidades_voluntariado_ativas->result() as $oportunidade_ativa) {
		// 	print_r($oportunidade_ativa->matching_nao_inscritos->result());
		// }

		$this->active_area = $this->instituicao->id_utilizador === $this->id_utilizador ? 'profile' : '';
		$this->js_files = array('home.js');
		$this->title    = "Perfil de " . $this->instituicao->nome;
		$this->load->view('templates/main_template/header');
		$this->load->view('instituicoes/profile');
		$this->load->view('templates/main_template/footer');
	}

	// GET /instituicoes/edit_main_profile
	public function edit_profile()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->load->model('Utilizador', 'utilizador');
		$this->load->model('Area_geografica', 'area_geografica');

		$this->instituicao_data = $this->instituicao->get_by_id_utilizador($this->id_utilizador)->row();
		$this->utilizador_data  = $this->utilizador->get_by_id($this->id_utilizador, 'instituicao')->row();

		if ($this->utilizador_data->id_area_geografica !== null) {
			$this->area_geografica_data = $this->area_geografica->get_by_id($this->utilizador_data->id_area_geografica)->row();
		} else {
			$this->area_geografica_data = '';
		}

		$form_rules = $this->instituicao->get_form_validation_rules();
		$this->form_validation->set_rules($form_rules);

		if ($this->form_validation->run() == FALSE)
		{
			// mostrar novamente formulario
			$this->js_files = array('areas_geograficas.js');
			$this->load->view('templates/main_template/header');
			$this->load->view('instituicoes/edit_profile');
			$this->load->view('templates/main_template/footer');

		} else {
        	// atualizar area geografica
        	$area_geografica_data = $this->area_geografica->get_form_data($this->input->post());
			$id_area_geografica = $this->area_geografica->insert_entry($area_geografica_data);

			// atualizar utilizador
			$data_utilizador = $this->utilizador->get_update_form_data($this->input->post());
        	$data_utilizador['id_area_geografica'] = $id_area_geografica;
        	$this->utilizador->update_entry($this->id_utilizador, $data_utilizador);

			// atualizar instituicao
        	$data_instituicao = $this->instituicao->get_form_data($this->input->post());

			$this->instituicao->update_entry($this->id_instituicao, $data_instituicao);
	 		$this->session->set_flashdata('success', 'Perfil atualizado com sucesso!');

			redirect('instituicoes/profile/' . $this->id_utilizador);
		}
	}
}
