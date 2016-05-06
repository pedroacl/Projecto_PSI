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
	public function add($id_area_interesse)
	{
		$this->load->model('Area_interesse', 'area_interesse');

		$this->area_interesse->insert_entry($id_utilizador, $area_interesse);
	}

	// GET /areas_interessa/delete/:id_area_interesse
	public function delete($id_area_interesse)
	{
		$this->load->model('Area_interesse', 'area_interesse');

		$this->area_interesse->delete_entry($id_utilizador, $id_area_interesse);
		$this->edit();
	}
}
