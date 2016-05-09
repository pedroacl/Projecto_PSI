<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct() {
		parent::__construct();

	}

	// GET /
	public function index()
	{
		$this->js_file = 'home.js';
		$this->load->view('templates/main_template/header');
		$this->load->view('home/index');
		$this->load->view('templates/main_template/footer');
	}

	// GET /signup
	public function signup()
	{
		$this->load->library('form_validation');

		$this->title = "Registo de Utilizador";
		$this->js_file = 'home.js';
		$this->load->view('templates/main_template/header');
		$this->load->view('home/register_form');
		$this->load->view('templates/main_template/footer');
	}

	// POST /signup
	public function process_signup()
	{
		$this->title = "Registo de Utilizador";
		$this->js_file = 'home.js';

		// libraries
		$this->load->library('form_validation');

		// models
		$this->load->model('Utilizador', 'utilizador');

		$tipo_utilizador  = $this->input->post('tipo_utilizador');

		$form_rules = $this->utilizador->get_form_validation_rules();
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
			// criar utilizador e voluntario
			$id_utilizador = $this->utilizador->insert_entry($this->input);
			$session_data = null;

			if ($this->input->post('tipo_utilizador') == 'voluntario') {
				$this->load->model('Voluntario', 'voluntario');
				$id_voluntario = $this->voluntario->insert_entry($id_utilizador);

				$session_data = array(
					'id_utilizador'   => $id_utilizador,
					'id_voluntario'   => $id_voluntario,
					'email'				=> $this->input->post('email'),
					'tipo_utilizador' => $this->input->post('tipo_utilizador')
				);
			} else if($this->input->post('tipo_utilizador') == 'instituicao') {
				$this->load->model('Instituicao', 'instituicao');
				$id_instituicao = $this->instituicao->insert_entry($id_utilizador);

				$session_data = array(
					'id_utilizador'   => $id_utilizador,
					'id_instituicao'  => $id_instituicao,
					'email'				=> $this->input->post('email'),
					'tipo_utilizador' => $this->input->post('tipo_utilizador')
				);
			}

			$this->session->set_userdata($session_data);

			$this->session->set_flashdata('success',
				'Utilizador registado com sucesso.');
			redirect('', 'location');
		}
	}

	// callback de validacao do valor default das select boxes
	function not_default($str)
	{
		if ($str == 'default') {
			$this->form_validation->set_message('not_default',
				'The %s field can not be empty');
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
			$this->session->set_flashdata('success', 'Utilizador já se encontra registado.');
			redirect('', 'refresh');
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
				$this->session->set_flashdata('success', 'Utilizador autenticado com sucesso!');
		      redirect('', 'refresh');

			} else {
				$this->session->set_flashdata('danger', 'Combinação de Email/Password errada.');

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
		$this->session->unset_userdata('id_utilizador');
		$this->session->unset_userdata('id_voluntario');
		$this->session->unset_userdata('id_instituicao');
		$this->session->unset_userdata('tipo_utilizador');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('nome');
		$this->session->sess_destroy();

		redirect('', 'refresh');
	}
}
