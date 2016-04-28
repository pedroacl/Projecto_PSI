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
		// if ($this->user_logged_in())
		// {
		// 	$this->session->set_flashdata('notice', 'Utilizador ja se encontra registado.');
		// 	redirect('', 'refresh');
		// }

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
		$this->disponibilidades					 = $this->input->post('disponibilidades[]');

		$form_rules = null;

		// obter regras de validacao do formulario
		if ($tipo_utilizador == 'voluntario') {
			$form_rules = $this->voluntario->get_form_validation_rules();

			// prep form values
			$this->select_boxes_data = $this->area_geografica->get_select_boxes_data();
		}
		else
		{
			$form_rules  = $this->instituicao->get_form_validation_rules();
			$instituicao = $this->instituicao->get_signup_form_data($this->input);
		}

		$this->form_validation->set_rules($form_rules);

		// formulario invalido
		if ($this->form_validation->run() == FALSE)
		{
			// voltar a mostrar formulario com erros assinalados
			$this->session->set_flashdata('danger', validation_errors());
			$this->load->view('templates/main_template/header');
			$this->load->view('home/register_form');
			$this->load->view('templates/main_template/footer');
		}
		else
		{
			// Inserts
			// utilizador
			$id_utilizador = $this->utilizador->insert_entry($this->input);	

			// grupo atuacao
			$this->utilizador_grupo_atuacao->insert_entries($id_utilizador, $this->input);

			// area de interesse
			$this->utilizador_area_iteresse->insert_entries($id_utilizador, $this->input);

			// area geografica
			$id_area_geografica = $this->area_geografica->insert_entry($this->input);

			// habilitacoes academicas
			$id_habilitacoes_academicas = $this->habilitacao_academica->insert_entry($this->input);

			// disponibilidades
			$this->disponibilidade->insert_entry($this->input);

			print_r($this->input->post());

			// voluntario
			if ($this->input->post('tipo_utilizador') == 'voluntario')
			{
				$id_voluntario = $this->voluntario->insert_entry($this->input, $id_utilizador,
					$id_area_geografica, $id_habilitacoes_academicas);

				// foto do voluntario
				$photo_upload_error = $this->voluntario->upload_photo($id_voluntario);

				// erro de upload da foto
				if (isset($photo_upload_error)) {
					$this->form_validation->set_message('foto', $photo_upload_error);
					echo $photo_upload_error;
				}
			}
			// instituição
			else
			{
				$instituicao    = $this->instituicao->get_signup_form_data($this->input);
				$id_instituicao = $this->instituicao->insert_entry($instituicao, $id_utilizador);
			}

			// success page
			$this->session->set_flashdata('notice', 'Utilizador registado com sucesso.');
			$this->load->view('templates/main_template/header');
			$this->load->view('home/index');
			$this->load->view('templates/main_template/footer');
		}
	}

	// callback de validacao do valor default das select boxes
	function not_default($str)
	{
		if ($str == 'default') {
			$this->form_validation->set_message('not_default', 'The %s field can not be empty');
			return FALSE;
		}

		return TRUE;
	}

   function data_fim($data_fim)
   {
   	$disponibilidades = $this->input->post('disponibilidades[]');

   	foreach ($disponibilidades as $key => $value) {

   	}

      $data_fim = date("Y/m/d", strtotime($input->post('')));

      if (intval($data_fim) > 24) {
   	   $this->form_validation->set_message('numcheck', 'Larger than 24');
      	return FALSE;
      } else {
       	return TRUE;
      }
   }

	// GET /login
	public function show_login()
	{
		// utilizador ja esta autenticado
		if ($this->user_logged_in())
		{
			$this->session->set_flashdata('notice', 'Utilizador já se encontra registado.');
			redirect('home', 'refresh');
		}

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
		$this->load->model('Utilizador', 'utilizador');

		// obter regras de validacao do formulario
		$form_rules = $this->utilizador->get_login_form_validation_rules();
		$this->form_validation->set_rules($form_rules);

		// validar formulario
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('danger', validation_errors());
			$this->show_login();
		}
		else
		{
			// obter valores do formulario
			$email    = $this->input->post('email');
			$password = $this->input->post('password');

			// authenticar utilizador
			if (($user = $this->utilizador->authenticate_utilizador($email, $password)) !== null) {
				$this->session->set_flashdata('notice', 'Utilizador autenticado');

				$cookie = array(
					'id' => $user->$id,
					'email' => $email,
					'tipo_utilizador' => $user->$tipo_utilizador,
					'nome' => $user->$nome
				);

				$this->session->set_userdata($cookie);
		      redirect('', 'refresh');

			} else {
				$this->session->set_flashdata('danger', 'Combinação de Email/Password errada');

				// load view
				$this->load->view('templates/main_template/header');
				$this->load->view('home/login');
				$this->load->view('templates/main_template/footer');
			}
		}
	}

	// GET /logout
	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('nome');
		$this->session->unset_userdata('tipo_utilizador');
		$this->session->sess_destroy();

		redirect('', 'refresh');
	}
}
