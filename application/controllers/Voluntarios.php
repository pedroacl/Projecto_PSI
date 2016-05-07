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

		$this->load->model('Grupo_atuacao', 'grupo_atuacao');
		$this->load->model('Area_interesse', 'area_interesse');
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->model('Area_geografica', 'area_geografica');
		$this->load->model('Habilitacao_academica', 'habilitacao_academica');
		$this->load->model('Tipo_habilitacao_academica', 'tipo_habilitacao_academica');

		// voluntario
		$this->voluntario =
			$this->voluntario->get_by_id_utilizador($this->id_utilizador)->row();
		$this->voluntario->data_nascimento = date("d/m/Y", strtotime($this->voluntario->data_nascimento));

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

		$this->js_file = 'voluntarios/edit_profile.js';
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

		$this->voluntario_data = $this->voluntario->get_main_profile($this->session->userdata('id_utilizador'))->row();

		$form_rules = $this->voluntario->get_form_validation_rules();
		$this->form_validation->set_rules($form_rules);

		if ($this->form_validation->run() == FALSE) {
			// mostrar novamente formulario
			$this->load->view('templates/main_template/header');
			$this->load->view('voluntarios/edit_profile');
			$this->load->view('templates/main_template/footer');

		} else {
			$this->voluntario->update_entry($this->id_voluntario, $this->input);
			$this->utilizador->update_entry($this->id_utilizador, $this->input);

	 		$this->session->set_flashdata('notice', 'Perfil atualizado com sucesso!');
			redirect('voluntarios/profile');
		}
	}

	public function add_habilitacao_academica($id_voluntario)
	{
		$this->load->library('form_validation');
		$this->load->model('Habilitacao_academica', 'habilitacao_academica');

		$form_rules = $this->habilitacao_academica->get_form_validation_rules();
		$this->form_validation->set_rules($form_rules);

		if ($this->form_validation->run() == FALSE) {
			echo "Erro!";
			echo validation_errors();
			print_r($this->input->post());
	 	} else {
			$this->habilitacao_academica->insert_entry($id_voluntario, $this->input);
	 		$this->session->set_flashdata('notice', 'Hablitacao Academica adicionada com sucesso!');
			print_r($this->input->post());
	 	}

	 	// voltar a exibir perfil
		$this->profile();
	}

	// POST /voluntarios/add_disponibilidade
	public function add_disponibilidade($id_voluntario)
	{
		$this->load->library('form_validation');
		$this->load->model('Disponibilidade', 'disponibilidade');

		$form_rules = $this->disponibilidade->get_form_validation_rules();
		$this->form_validation->set_rules($form_rules);

		if ($this->form_validation->run() == FALSE) {

	 	} else {
			$this->disponibilidade->insert_entry($id_voluntario, $this->input);
			$this->session->set_flashdata('notice', 'Disponibilidade adicionada com sucesso!');
	 	}

	 	// voltar a exibir perfil
		$this->profile();
	}

	public function edit($id)
	{
		$this->authenticate_user();
		$this->load->library('form_validation');

		$this->load->model('TipoHabilitacaoAcademica', 'tipo_habilitacao_academica');
		$this->tipos_habilitacoes_academicas = $this->tipo_habilitacao_academica->get_entries();

		$this->load->model('GrupoAtuacao', 'grupo_atuacao');
		$this->load->model('Utilizador_GrupoAtuacao', 'grupos_atuacao_de_utilizador');
		$this->grupos_atuacao = $this->grupo_atuacao->get_entries();

		$this->load->model('AreaInteresse', 'area_iteresse');
		$this->load->model('Utilizador_AreaInteresse', 'areas_interesse_de_utilizador');
		$this->areas_interesse = $this->area_iteresse->get_entries();

		// $this->load->model('Disponibilidades', 'disponibilidade');
		// $this->disponibilidades = $this->disponibilidade->get_disponibilidades_by_user_id($this->session->userdata('id'));

		$this->load->model('Voluntario', 'voluntario');
		$this->voluntario = $this->voluntario->get_by_id_utilizador($this->session->userdata('id'))->row();
		$this->voluntario->data_nascimento = date("d/m/Y", strtotime($this->voluntario->data_nascimento));

		$this->load->model('HabilitacaoAcademica', 'habilitacao_academica');
		$this->habilitacoes_academicas = $this->habilitacao_academica->get_habilitacoes_academicas_from_user_id($this->voluntario->id);
		// $this->habilitacoes_academicas->data_conclusao = date("d/m/Y", strtotime($this->habilitacoes_academicas['data_conclusao']));

		$this->load->model('AreaGeografica', 'area_geografica');
		$this->area_geografica_de_utilizador = $this->area_geografica->get_area_geografica_from_id($this->voluntario->id_area_geografica);

		$this->grupos_atuacao_de_utilizador = $this->grupos_atuacao_de_utilizador->get_grupos_atuacao_from_utilizador($this->voluntario->id);
		$this->areas_interesse_de_utilizador = $this->areas_interesse_de_utilizador->get_areas_interesse_from_utilizador($this->voluntario->id);


		$this->load->model('Disponibilidade', 'disponibilidades');
		$this->disponibilidades = $this->disponibilidades->get_by_id_utilizador($this->voluntario->id);
		$this->disponibilidades = $this->disponibilidades->result();
		// print_r($this->disponibilidades);


		$this->js_file = 'edit_profile_voluntarios.js';
		$this->load->view('templates/main_template/header');
		$this->load->view('voluntarios/edit_profile');
		$this->load->view('templates/main_template/footer');
	}

	function update_profile()
	{
		$this->authenticate_user();
		$this->load->library('form_validation');

		$this->load->model('Voluntario', 'voluntario');
		$form_rules = $this->voluntario->get_form_validation_rules();
		$this->form_validation->set_rules($form_rules);

		$this->load->model('Utilizador', 'utilizador');
		$this->load->model('GrupoAtuacao', 'grupo_atuacao');
		$this->load->model('AreaInteresse', 'area_interesse');
		$this->load->model('AreaGeografica', 'area_geografica');
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->model('HabilitacaoAcademica', 'habilitacao_academica');
		$this->load->model('Utilizador_AreaInteresse', 'utilizador_area_iteresse');

		// formulario invalido
		if ($this->form_validation->run() == FALSE)
		{

			$this->load->model('TipoHabilitacaoAcademica', 'tipo_habilitacao_academica');
			$this->tipos_habilitacoes_academicas = $this->tipo_habilitacao_academica->get_entries();

			$this->load->model('GrupoAtuacao', 'grupo_atuacao');
			$this->load->model('Utilizador_GrupoAtuacao', 'grupos_atuacao_de_utilizador');
			$this->grupos_atuacao = $this->grupo_atuacao->get_entries();

			$this->load->model('AreaInteresse', 'area_iteresse');
			$this->load->model('Utilizador_AreaInteresse', 'areas_interesse_de_utilizador');
			$this->areas_interesse = $this->area_iteresse->get_entries();

			// $this->load->model('Disponibilidades', 'disponibilidade');
			// $this->disponibilidades = $this->disponibilidade->get_disponibilidades_by_user_id($this->session->userdata('id'));

			$this->load->model('Voluntario', 'voluntario');
			$this->voluntario = $this->voluntario->get_by_id_utilizador($this->session->userdata('id'))->row();
			$this->voluntario->data_nascimento = date("d/m/Y", strtotime($this->voluntario->data_nascimento));

			$this->load->model('HabilitacaoAcademica', 'habilitacao_academica');
			$this->habilitacoes_academicas = $this->habilitacao_academica->get_by_id_voluntario($this->voluntario->id)->row();
			$this->habilitacoes_academicas->data_conclusao = date("d/m/Y", strtotime($this->habilitacoes_academicas->data_conclusao));

			$this->load->model('AreaGeografica', 'area_geografica');
			$this->area_geografica = $this->area_geografica->get_by_id($this->voluntario->id_area_geografica);

			$this->load->model('Disponibilidade', 'disponibilidades');
			$this->disponibilidades = $this->disponibilidades->get_by_id_utilizador($this->voluntario->id);
			$this->disponibilidades = $this->disponibilidades->result();
			// print_r($this->disponibilidades);

			$this->data['foto'] = $this->voluntario->foto;
			$this->data['nome'] = $this->voluntario->nome;
			$this->data['genero'] = $this->voluntario->genero;
			$this->data['data_nascimento'] = $this->voluntario->data_nascimento;
			$this->data['telefone'] = $this->voluntario->telefone;

			$this->js_file = 'edit_profile_voluntarios.js';
			$this->load->view('templates/main_template/header');
			$this->load->view('voluntarios/edit_profile');
			$this->load->view('templates/main_template/footer');
		}
		else
		{
			$data_voluntario              = $this->voluntario->get_update_form_data($this->input);
			$data_utilizador              = $this->utilizador->get_update_form_data($this->input);
			$data_habilitacoes_academicas = $this->habilitacao_academica->get_signup_form_data($this->input);

			$id_utilizador = $this->session->userdata('id');
			$this->grupo_atuacao->delete_by_id_utilizador($id_utilizador);
			$this->area_interesse->delete_by_id_utilizador($id_utilizador);
			//$this->disponibilidade->delete_by_id_utilizador($id_utilizador);

			$this->db->update('Voluntarios', $data_voluntario);
			$this->db->update('Utilizadores', $data_utilizador);
			$this->db->update('Habilitacoes_Academicas', $data_habilitacoes_academicas);
			$this->grupo_atuacao->insert_entries($id_utilizador, $this->input);
			$this->utilizador_area_iteresse->insert_entries($id_utilizador, $this->input);
			//$this->disponibilidade->insert_entry($this->input);

			$this->session->set_flashdata('notice', 'Utilizador atualizado com sucesso.');
			//redirect('profile', 'refresh');

		}
	}
}
