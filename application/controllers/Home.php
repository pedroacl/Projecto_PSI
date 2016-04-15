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
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->helper('url');

		$email    = $this->input->post('email');
		$password = $this->input->post('password');
		$encrypted_password = hash ("sha256", $password);

		$this->load->model('User');
		$query = $this->User->get_user_by_username($email);

		// utilizador nao existe
		if ($query->num_rows > 0) {
			$user = $query->row();

			if ($user->password === $encrypted_password) {
				$this->session->set_flashdata('notice', 'Utilizador autenticado');
				redirect('', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'Username/Password errada: ' . $encrypted_password);
			redirect('login', 'refresh');
		}
	}
}
