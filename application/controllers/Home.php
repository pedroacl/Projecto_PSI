<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('templates/main_template/header');
		$this->load->view('home/index');
		$this->load->view('templates/main_template/footer');
	}

	public function signup()
	{
		$this->load->view('templates/main_template/header');
		$this->load->view('home/signup');
		$this->load->view('templates/main_template/footer');
	}

	public function register_user()
	{
		$this->load->model('User');

		$user = $this->input->post();
		print_r($user);

		//$this->User->register_user($user);
	}

	// GET
	public function show_login() {
		$this->error = $this->session->userdata('error');

		$this->load->view('templates/main_template/header');
		$this->load->view('home/login');
		$this->load->view('templates/main_template/footer');
	}

	// POST
	public function process_login()
	{
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->model('User');

		// form validation
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		// get form values
		$email    = $this->input->post('email');
		$password = $this->input->post('password');

		// authenticate user
		if ($this->User->authenticate_user($email, $password)) {
			$this->session->set_flashdata('notice', 'Utilizador autenticado');
         redirect('', 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Username/Password errada: ');
         redirect('login', 'refresh');
		}
	}

	// GET
	public function logout()
	{
		$this->load->helper('url');

		$this->session->unset_userdata('id');
		$this->session->unset_userdata('email');
		$this->session->sess_destroy();

		redirect('login');
	}
}
