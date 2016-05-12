<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disponibilidades extends MY_Controller {

	function __construct() {
		parent::__construct();

	}

	// GET /
	public function index()
	{
		$this->js_files = array('home.js');
		$this->load->view('templates/main_template/header');
		$this->load->view('home/index');
		$this->load->view('templates/main_template/footer');
	}

	// POST disponibilidades/add
	public function add($id_utilizador)
	{
		$this->load->model('Disponibilidade', 'disponibilidade');
		$disponibilidade = $this->input->post();

		$this->disponibilidade->add($habilitacao_academica);
	}

	// GET disponibilidades/edit/:id_disponibilidade
	public function edit($id_disponibilidade)
	{
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->model('Periodicidade', 'periodicidade');
		$this->load->helper('form');

		$disponibilidade = $this->input->post();
		$this->disponibilidade = $this->disponibilidade->get_by_id($id_disponibilidade)->row();

		$this->tipos_periodicidade = $this->periodicidade->get_periodicidades();

		$this->js_files = array('');
		$this->load->view('templates/main_template/header');
		$this->load->view('disponibilidades/edit_disponibilidade');
		$this->load->view('templates/main_template/footer');
	}

	// POST disponibilidades/process_edit
	public function process_edit()
	{
		$this->load->model('Disponibilidade', 'disponibilidade');
		$disponibilidade_e_periodicidade_data = $this->disponibilidade->get_form_data($this->input->post());

		$this->disponibilidade->update($this->input->post('id_disponibilidade'), $disponibilidade_e_periodicidade_data[0]);

		$this->session->set_flashdata('success', 'Disponibilidade actualizada com sucesso');
		redirect_back();
	}

	public function delete($id_disponibilidade)
	{
		$this->load->helper('url');
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->disponibilidade->delete_entry_oportunidade($id_disponibilidade);

		$this->session->set_flashdata('success', 'Disponibilidade eliminada com sucesso');
		redirect_back();
	}
}
