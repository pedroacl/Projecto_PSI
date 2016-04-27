<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function signup()
	{
		$this->load->view('templates/main_template/header');
		$this->load->view('volunteers/signup');
		$this->load->view('templates/main_template/footer');
	}

	public function profile()
	{
		$this->load->view('templates/main_template/header');
		$this->load->view('volunteers/profile');
		$this->load->view('templates/main_template/footer');
	}
}
