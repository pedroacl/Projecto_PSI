<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$this->load->view('templates/main_template/header');
		$this->load->view('home/index');
		$this->load->view('templates/main_template/footer');
	}

	public function signup()
	{
		$this->title = "Sign Up";
		$this->load->view('templates/main_template/header');
		$this->load->view('home/signup');
		$this->load->view('templates/main_template/footer');
	}

	// GET
	public function show_login()
	{
		$this->title = "Login";
		$this->load->view('templates/main_template/header');
		$this->load->view('home/login');
		$this->load->view('templates/main_template/footer');
	}

	// POST
	public function process_login()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');

		$email    = $this->input->post('email');
		$password = $this->input->post('password');

		$this->load->model('User');
		$query = $this->User->getUserByUsername($email);

		// utilizador nao existe
		if ($query->num_rows > 0) {
			$user = $query->row();
			if ($user->password === $password)
				redirect('', 'refresh');

		} else {
			redirect('login', 'refresh');
		}


	}
}
