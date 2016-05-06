<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos_atuacao extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Grupo_atuacao', 'grupo_atuacao');
	}

	public function edit($id_area_interesse)
	{
		$this->area_interesse = $this->Area_interesse->get_by_id($this->id_utilizador, $id_area_interesse);
	}

	// GET /areas_interesse/add/:id_area_interesse
	public function add()
	{
		$id_grupo_atuacao = $this->input->post('id_grupo_atuacao');
		$this->grupo_atuacao->insert_entry($this->id_utilizador, $id_grupo_atuacao);
		redirect('voluntarios/profile');
	}

	// GET /areas_interessa/delete/:id_area_interesse
	public function delete($id_grupo_atuacao)
	{
		$this->grupo_atuacao->delete_entry($this->id_utilizador, $id_grupo_atuacao);
		$this->edit();
	}
}
