<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VoluntariosController extends MY_Controller {

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

		$this->load->model('Voluntario', 'voluntario');
		$this->load->model('GrupoAtuacao', 'grupo_atuacao');
		$this->load->model('AreaInteresse', 'area_interesse');
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->model('HabilitacaoAcademica', 'habilitacao_academica');

		$id_utilizador    = $this->session->userdata('id');

		// voluntario
		$this->voluntario =
			$this->voluntario->get_by_id_utilizador($id_utilizador)->row();

		$this->voluntario->data_nascimento = date("d/m/Y", strtotime($this->voluntario->data_nascimento));

		// grupos de atuacao
		$this->grupos_atuacao = $this->grupo_atuacao->get_by_id_utilizador($id_utilizador)->result();

		// areas de iteresse
		$this->areas_interesse = $this->area_interesse->get_by_id_utilizador($id_utilizador)->result();

		// disponibilidades
		$this->disponibilidades = $this->disponibilidade->get_by_id_utilizador($id_utilizador)->result();

		// habilitacoes academicas
		$this->habilitacoes_academicas = $this->habilitacao_academica->get_by_id_utilizador($id_utilizador)->result();

		$this->load->view('templates/main_template/header');
		$this->load->view('voluntarios/profile');
		$this->load->view('templates/main_template/footer');
	}

	public function edit_profile()
	{
		$this->authenticate_user();
		$this->load->library('form_validation');


		$this->load->model('TipoHabilitacaoAcademica', 'tipo_habilitacao_academica');
		$this->tipos_habilitacoes_academicas = $this->tipo_habilitacao_academica->get_entries();

		$this->load->model('GrupoAtuacao', 'grupo_atuacao');
		$this->load->model('Utilizador_GrupoAtuacao', 'grupos_atuacao_de_utilizador');
		$this->grupos_atuacao = $this->grupo_atuacao->get_entries();
		$this->grupos_atuacao_de_utilizador = $this->grupos_atuacao_de_utilizador->get_grupos_atuacao_from_utilizador($this->session->userdata('id'));

		$this->load->model('AreaInteresse', 'area_iteresse');
		$this->load->model('Utilizador_AreaInteresse', 'areas_interesse_de_utilizador');
		$this->areas_interesse = $this->area_iteresse->get_entries();
		$this->areas_interesse_de_utilizador = $this->areas_interesse_de_utilizador->get_areas_interesse_from_utilizador($this->session->userdata('id'));

		// $this->load->model('Disponibilidades', 'disponibilidade');
		// $this->disponibilidades = $this->disponibilidade->get_disponibilidades_by_user_id($this->session->userdata('id'));

		$this->load->model('Voluntario', 'voluntario');
		$this->voluntario = $this->voluntario->get_by_id_utilizador($this->session->userdata('id'))->row();

		$this->load->model('HabilitacaoAcademica', 'habilitacao_academica_de_utilizador');
		$this->habilitacoes_academicas_de_utilizador = $this->habilitacao_academica_de_utilizador->get_habilitacoes_academicas_from_user_id($this->voluntario->id)[0];

		$this->load->model('AreaGeografica', 'area_geografica_de_utilizador');
		$this->area_geografica_de_utilizador = $this->area_geografica_de_utilizador->get_area_geografica_from_id($this->voluntario->id_area_geografica);

		// $this->load->model('Disponibilidade', 'disponibilidades');
		// $this->disponibilidades = $this->disponibilidades->get_by_id_utilizador($this->voluntario->id);

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
}
