<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disponibilidades extends MY_Controller {

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

	public function add($id_utilizador)
	{
		$this->load->model('Disponibilidade', 'disponibilidade');
		$disponibilidade = $this->input->post();

		$this->disponibilidade->add($habilitacao_academica);
	}

	public function edit($id_disponibilidade)
	{
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->helper('form');
		$disponibilidade = $this->input->post();
		$this->disponibilidade = $this->disponibilidade->get_by_id($id_disponibilidade)->row();

		print_r($this->disponibilidade);

		$this->js_file = '';
		$this->load->view('templates/main_template/header');
		$this->load->view('disponibilidades/edit_disponibilidade');
		$this->load->view('templates/main_template/footer');
	}

	public function process_edit()
	{
		// validation

		// update

		// Se for uma disponibilidade de uma oportunidade, não pode ir para o profile
		redirect('voluntarios/profile', 'refresh');
	}

	public function delete($id_disponibilidade)
	{
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->disponibilidade->delete($id);
	}
}
