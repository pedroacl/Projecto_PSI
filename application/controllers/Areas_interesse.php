<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas_interesse extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	public function edit($id_area_interesse)
	{
		$this->load->model('Area_interesse');
		$this->area_interesse = $this->Area_interesse->get_by_id($this->id_utilizador, $id_area_interesse);
	}

	// GET /areas_interesse/add/:id_area_interesse
	public function add()
	{
		$this->load->model('Utilizador_area_interesse', 'utilizador_area_interesse');
		$id_area_interesse = $this->input->post('id_area_interesse');

		$this->utilizador_area_interesse->insert_entry($this->id_utilizador, $id_area_interesse);

 		$this->session->set_flashdata('notice', 'Adicionada Área de Interesse!');
		redirect('voluntarios/profile');
	}

	// GET /areas_interessa/delete/:id_area_interesse
	public function delete($id_area_interesse)
	{
		$this->load->model('Utilizador_area_interesse', 'utilizador_area_interesse');

		$this->utilizador_area_interesse->delete_entry($this->id_utilizador, $id_area_interesse);

 		$this->session->set_flashdata('notice', 'Removida Área de Interesse!');
		redirect('voluntarios/profile');
	}
}
