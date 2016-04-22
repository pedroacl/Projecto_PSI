<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('templates/main_template/header');
		$this->load->view('home/index');
		$this->load->view('templates/main_template/footer');
	}

	public function signup()
	{
		$this->title = "Sign Up";
		$this->load->model('User');

		// obter dados para preencher selectboxes
		$this->data = $this->User->get_signup_user_data();

		// carregar views
		$this->load->view('templates/main_template/header');
		$this->load->view('home/signup');
		$this->load->view('templates/main_template/footer');
	}

	// POST
	public function register_user()
	{
		$this->load->library('form_validation');
		$this->load->model('User');

		// obter regras de validacao do formulario
		$user_type  = $this->input->post('user_type');

		if ($user_type == 'volunteer') {
			$form_rules = $this->User->get_volunteer_form_validation_rules($user_type);
		}
		else
		{
			$form_rules = $this->User->get_institution_form_validation_rules($user_type);
		}

		$this->form_validation->set_rules($form_rules);

		// validar formulario
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('myform');
	      // redirect('', 'refresh');
		}
		else
		{
			$user      = $this->User->get_user_form_data($this->input);
			$volunteer = $this->User->get_volunteer_form_data($this->input);
			$this->User->register_user($data);
	      // redirect('', 'refresh');
		}
	}

	function validate_confirm_password($password, $confirm_password) {
      return ($password == $confirm_password);
   }

	// GET
	public function show_login()
	{
		if ($this->session->userdata("id") !== null)
		{
			redirect('', 'refresh');
		}

		$this->session->set_flashdata('notice', 'Login feito com sucesso');
		$this->title = "Login";
		$this->login_tab = true;

		// load view
		$this->load->view('templates/main_template/header');
		$this->load->view('home/login');
		$this->load->view('templates/main_template/footer');
	}

	// POST
	public function process_login()
	{
		$this->load->library('form_validation');

		$this->load->model('User');

		// obter regras de validacao do formulario
		$user_type = $this->input->post('user_type');
		$form_rules = $this->User->get_login_form_validation_rules($user_type);
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
			if (($id = $this->User->authenticate_user($email, $password)) !== -1) {
				$this->session->set_flashdata('notice', 'Utilizador autenticado');
				$cookie = array(
							'id' => $id,
							'email' => $email
					);
				$this->session->set_userdata($cookie);
	      redirect('', 'refresh');

			} else {
				$this->session->set_flashdata('error', 'Username/Password errada: ');
				redirect('login', 'refresh');
			}
		}
	}

	// GET
	public function logout()
	{

		$this->session->unset_userdata('id');
		$this->session->unset_userdata('email');
		$this->session->sess_destroy();

		redirect('', 'refresh');
	}
}
