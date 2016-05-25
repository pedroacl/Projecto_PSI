<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voluntarios extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->authenticate_user();
		$this->load->model('Voluntario', 'voluntario');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function profile()
	{
		//$this->authenticate_user();
		$this->load->helper('form');

		$this->load->model('Inscreve_se', 'inscricoes');
		$this->load->model('Grupo_atuacao', 'grupo_atuacao');
		$this->load->model('Area_interesse', 'area_interesse');
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->model('Area_geografica', 'area_geografica');
		$this->load->model('Oportunidade_voluntariado', 'oportunidade_voluntariado');
		$this->load->model('Habilitacao_academica', 'habilitacao_academica');
		$this->load->model('Tipo_habilitacao_academica', 'tipo_habilitacao_academica');

		// voluntario
		$this->voluntario =
			$this->voluntario->get_by_id_utilizador($this->id_utilizador)->row();

		// area geografica
		$this->area_geografica = $this->area_geografica->get_by_id_utilizador($this->id_utilizador);

		// grupos de atuacao
		$this->grupos_atuacao_utilizador = $this->grupo_atuacao->get_by_id_utilizador($this->id_utilizador);

		// tipos de grupos de atuacao (povoar select boxes)
		$this->tipos_grupos_atuacao = $this->grupo_atuacao->get_without_utilizador($this->id_utilizador);

		// areas de iteresse
		$this->tipos_areas_interesse = $this->area_interesse->get_without_utilizador($this->id_utilizador);

		// tipos de areas de interesse (povoar select boxes)
		$this->areas_interesse_utilizador = $this->area_interesse->get_by_id_utilizador($this->id_utilizador);

		// disponibilidades
		$this->disponibilidades = $this->disponibilidade->get_by_id_utilizador($this->id_utilizador);

		// habilitacoes academicas
		$this->habilitacoes_academicas = $this->habilitacao_academica->get_by_id_voluntario($this->id_voluntario);

		// tipos de habilitacoes academicas
		$this->tipos_habilitacoes_academicas = $this->tipo_habilitacao_academica->get_entries();

		// oportunidades de voluntariado
		$this->oportunidades_voluntariado = $this->oportunidade_voluntariado->get_matching_for_voluntario($this->id_utilizador);
		$this->inscricoes = $this->inscricoes->get_inscricoes($this->id_voluntario)->result();

		foreach ($this->oportunidades_voluntariado->result() as $oportunidade) {
			foreach ($this->inscricoes as $inscricao) {

				if ($oportunidade->id_oportunidade_voluntariado == $inscricao->id_oportunidade_voluntariado) {
					$oportunidade->inscrito = $inscricao->aceite;
				}
			}
		}

		$this->active_area = 'profile';
		$this->js_files = array('voluntarios/voluntarios_profile.js');
		$this->load->view('templates/main_template/header');
		$this->load->view('voluntarios/profile');
		$this->load->view('templates/main_template/footer');
	}

	// GET or POST /voluntarios/edit_profile
	public function edit_profile()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Utilizador', 'utilizador');
		$this->load->model('Area_geografica', 'area_geografica');

		$this->voluntario_data = $this->voluntario->get_main_profile($this->id_utilizador)->row();
		$this->utilizador_data = $this->utilizador->get_by_id($this->id_utilizador, 'voluntario')->row();

		if ($this->utilizador_data->id_area_geografica !== null) {
			$this->area_geografica_data = $this->area_geografica->get_by_id($this->utilizador_data->id_area_geografica)->row();
		} else {
			$this->area_geografica_data = '';
		}

		$form_rules = $this->voluntario->get_form_validation_rules();
		$this->form_validation->set_rules($form_rules);

		if ($this->form_validation->run() == FALSE) {
			// mostrar novamente formulario
			$this->js_files = array('areas_geograficas.js');
			$this->load->view('templates/main_template/header');
			$this->load->view('voluntarios/edit_profile');
			$this->load->view('templates/main_template/footer');

		} else {
			// atualizar area geografica
			$area_geografica_data = $this->area_geografica->get_form_data($this->input->post());
			$id_area_geografica   = $this->area_geografica->insert_entry($area_geografica_data);

			// atualizar utilizador
			$data_utilizador = $this->utilizador->get_update_form_data($this->input->post());
        	$data_utilizador['id_area_geografica'] = $id_area_geografica;
			$this->utilizador->update_entry($this->id_utilizador, $data_utilizador);

			// atualizar voluntario
			$data_voluntario = $this->voluntario->get_form_data($this->input->post());
			$this->voluntario->update_entry($this->id_voluntario, $data_voluntario);

			// upload foto
			$this->voluntario->upload_photo($this->id_voluntario);

	 		$this->session->set_flashdata('success', 'Perfil atualizado com sucesso!');
			redirect('voluntarios/profile');
		}
	}

	// POST /voluntarios/add_disponibilidade
	public function add_disponibilidade()
	{
		$this->load->library('form_validation');
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->model('Utilizador_disponibilidade', 'utilizador_disponibilidade');

	 	// disponibilidade
		$disponibilidade_data =
			$this->disponibilidade->get_profile_data($this->input->post());

/*
		$disponibilidade_data['data_inicio'] =
			date("Y-m-d", strtotime($disponibilidade_data['data_inicio']));

		$disponibilidade_data['data_fim'] =
			date("Y-m-d", strtotime($disponibilidade_data['data_fim']));
*/

      // print_r($this->input->post());
		$form_rules = $this->disponibilidade->get_form_validation_rules($this->input);
		$this->form_validation->set_rules($form_rules);

		if ($this->form_validation->run() == FALSE)
		{
			// mostrar novamente formulario
			//$this->js_files = array('areas_geograficas.js');

			$this->profile();
		}
		else
		{
			$id_disponibilidade = $this->disponibilidade->insert_single_entry($disponibilidade_data);

			$utilizador_disponibilidade_data = array(
				'id_utilizador'      => $this->id_utilizador,
				'id_disponibilidade' => $id_disponibilidade
			);

			$this->utilizador_disponibilidade->insert_entry($utilizador_disponibilidade_data);

			$this->session->set_flashdata('success', 'Disponibilidade adicionada com sucesso!');

		 	// voltar a exibir perfil
			redirect("voluntarios/profile", 'location');
		}
	}

	public function validate_disponibilidades_dates($str)
 	{
		$this->load->library('form_validation');

		$data_inicio = $this->input->post('data_inicio');
		$data_fim    = $this->input->post('data_fim');

		if ($data_inicio < $data_fim)
		{
		   return TRUE;
		}
		else
		{
			$this->form_validation->set_message(
				'callback_validate_disponibilidades_dates', 'Error Message');
			$this->session->set_flashdata('danger',
				'Data de ínicio da disponibilidade tem de ser superior à data de fim!');

		   return FALSE;
		}
 }
}
