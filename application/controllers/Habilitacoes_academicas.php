<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Habilitacoes_academicas extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->authenticate_user();
      $this->load->model('Habilitacao_academica', 'habilitacao_academica');
	}

	public function add()
	{
		$this->habilitacao_academica->insert_entry($this->id_utilizador, $this->input);

 		$this->session->set_flashdata('success', 'Habilitacao Academica adicionada!');
		redirect('voluntarios/profile');
	}

	// GET habilitacoes_academicas/edit/:id_habilitacao
	public function edit($id_habilitacao)
	{
		$this->load->model('Habilitacao_academica', 'habilitacoes');
		$this->load->model('Tipo_habilitacao_academica', 'tipos_habilitacoes');
		$this->load->helper('form');
		$habilitacoes = $this->input->post();
		$this->habilitacoes = $this->habilitacoes->get_by_id($id_habilitacao)->row();

		$this->tipos_habilitacoes_academicas = $this->tipos_habilitacoes->get_entries()->result();

		$this->js_file = '';
		$this->load->view('templates/main_template/header');
		$this->load->view('habilitacoes_academicas/edit_habilitacao');
		$this->load->view('templates/main_template/footer');
	}

	// POST habilitacoes_academicas/process_edit
	public function process_edit()
	{
		// validation

		// update

		// Se for uma disponibilidade de uma oportunidade, não pode ir para o profile
		redirect('voluntarios/profile', 'refresh');
	}

	// GET habilitacoes_academicas/delete/:id_voluntario
	public function delete($id_habilitacao_academica)
	{
		$this->habilitacao_academica->delete_entry($id_habilitacao_academica);

 		$this->session->set_flashdata('success', 'Habilitacao Academica eliminada!');
		redirect('voluntarios/profile');
	}
}
