<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct() {
		parent::__construct();
/*
		if ( ! isset($this->session) {
			redirect('/auth/login', 'refresh');
		}
*/
	}

	// GET /
	public function index()
	{
		$this->load->view('templates/main_template/header');
		$this->load->view('home/index');
		$this->load->view('templates/main_template/footer');
	}

	// GET /signup
	public function signup()
	{
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->tipo_utilizador_selected = null;

		$this->load->model('TipoHabilitacaoAcademica', 'tipo_habilitacao_academica');
		$this->tipos_habilitacoes_academicas = $this->tipo_habilitacao_academica->get_entries();

		$this->load->model('GrupoAtuacao', 'grupo_atuacao');
		$this->grupos_atuacao = $this->grupo_atuacao->get_entries();

		$this->load->model('AreaInteresse', 'area_iteresse');
		$this->areas_interesse = $this->area_iteresse->get_entries();

		$this->title = "Registo de Utilizador";
		$this->load->view('templates/main_template/header');
		$this->load->view('home/register_form');
		$this->load->view('templates/main_template/footer');
	}

	// POST /signup
	public function process_signup()
	{
		$this->title = "Registo de Utilizador";

		// libraries
		$this->load->library('form_validation');
		$this->load->library('session');

		// models
		$this->load->model('Utilizador', 'utilizador');
		$this->load->model('Voluntario', 'voluntario');
		$this->load->model('Instituicao', 'instituicao');
		$this->load->model('AreaGeografica', 'area_geografica');
		$this->load->model('HabilitacaoAcademica', 'habilitacao_academica');
		$this->load->model('TipoHabilitacaoAcademica', 'tipo_habilitacao_academica');
		$this->load->model('GrupoAtuacao', 'grupo_atuacao');
		$this->load->model('AreaInteresse', 'area_iteresse');
		$this->load->model('Utilizador_GrupoAtuacao', 'utilizador_grupo_atuacao');
		$this->load->model('Utilizador_AreaInteresse', 'utilizador_area_iteresse');
		$this->load->model('Disponibilidade', 'disponibilidade');

		$tipo_utilizador  = $this->input->post('tipo_utilizador');

		$this->tipos_habilitacoes_academicas = $this->tipo_habilitacao_academica->get_entries();
		$this->grupos_atuacao                = $this->grupo_atuacao->get_entries();
		$this->areas_interesse               = $this->area_iteresse->get_entries();

		$form_rules = null;

		// obter regras de validacao do formulario
		if ($tipo_utilizador == 'voluntario') {
			$form_rules = $this->voluntario->get_form_validation_rules();
			$voluntario  = $this->voluntario->get_signup_form_data($this->input);

			// prep form values
			$this->select_boxes_data = $this->area_geografica->get_select_boxes_data();
		}
		else // if($tipo_utilizador == 'instituicao')
		{
			$form_rules  = $this->instituicao->get_form_validation_rules();
			$instituicao = $this->instituicao->get_signup_form_data($this->input);
		}

		$this->form_validation->set_rules($form_rules);

		// formulario invalido
		if ($this->form_validation->run() == FALSE)
		{
			// voltar a mostrar formulario
			$this->session->set_flashdata('danger', validation_errors());
			$this->load->view('templates/main_template/header');
			$this->load->view('home/register_form');
			$this->load->view('templates/main_template/footer');
		}
		else
		{
			// inserir utilizador
			$id_utilizador = $this->utilizador->insert_entry($this->input);

			// inserir grupos de actuação
			$this->utilizador_grupo_atuacao->insert_entries($id_utilizador, $this->input);

			// inserir areas de interesse
			$this->utilizador_area_iteresse->insert_entries($id_utilizador, $this->input);

			// inserir area geografica
			$area_geografica_id = $this->area_geografica->insert_entry($input);

			// inserir habilitacoes academicas
			$habilitacao_academicas_id = $this->habilitacao_academica->insert_entry($this->input);

			// inserir disponibilidades
			$this->disponibilidade->insert_entry($this->input);
			print_r($this->input->post());

			// inserir voluntario
			if ($this->input->post('tipo_utilizador') == 'voluntario')
			{
				$voluntario = $this->voluntario->get_signup_form_data($this->input);
				$voluntario['id_utilizador']              = $id_utilizador;
				$voluntario['id_area_geografica']         = $area_geografica_id;
				$voluntario['id_habilitacoes_academicas'] = $habilitacao_academicas_id;

				$id_utilizador = $this->voluntario->insert_entry($voluntario);
			}
			// inserir instituição
			else
			{
				$instituicao = $this->instituicao->get_signup_form_data($this->input);
				$id_utilizador = $this->instituicao->insert_entry($instituicao, $id_utilizador);
			}


			$this->session->set_flashdata('notice', 'Login realizado com sucesso.');
/*			$this->load->view('templates/main_template/header');
			$this->load->view('home/index');
			$this->load->view('templates/main_template/footer');
*/

		}
	}

	// GET /login
	public function show_login()
	{
		if ($this->session->utilizadordata("id") !== null)
		{
			redirect('', 'refresh');
		}

		$this->session->set_flashdata('notice', 'Login realizado com sucesso.');
		$this->title = "Login";
		$this->login_tab = true;

		// load view
		$this->load->view('templates/main_template/header');
		$this->load->view('home/login');
		$this->load->view('templates/main_template/footer');
	}

	// POST /login
	public function process_login()
	{
		$this->load->library('form_validation');
		$this->load->model('Utilizador');

		// obter regras de validacao do formulario
		$tipo_utilizador = $this->input->post('tipo_utilizador');
		$form_rules = $this->Utilizador->get_login_form_validation_rules($tipo_utilizador);
		$this->form_validation->set_rules($form_rules);

		// validar formulario
		if ($this->form_validation->run() == FALSE)
		{
			$this->show_login();
		}
		else
		{
			// obter valores do formulario
			$email    = $this->input->post('email');
			$password = $this->input->post('password');

			// authenticar utilizador
			if (($id = $this->Utilizador->authenticate_utilizador($email, $password)) !== -1) {
				$this->session->set_flashdata('notice', 'Utilizador autenticado');

				$cookie = array(
					'id' => $id,
					'email' => $email
				);

				$this->session->set_utilizadordata($cookie);
	      	redirect('', 'refresh');

			} else {
				$this->session->set_flashdata('danger', 'Combinação de Utilizadorname/Password errada');
				redirect('login', 'refresh');
			}
		}
	}

	// GET /logout
	public function logout()
	{
		$this->session->unset_utilizadordata('id');
		$this->session->unset_utilizadordata('email');
		$this->session->sess_destroy();

		redirect('', 'refresh');
	}
}
