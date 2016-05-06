<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas_interesse extends MY_Controller {

	function __construct() {
		parent::__construct();

	}

	public function edit($id_area_interesse)
	{
		$this->load->model('Area_interesse', 'area_interesse');
	}

	// GET /areas_interesse/add/:id_area_interesse
	public function add($id_area_interesse)
	{
		$this->load->model('Area_interesse', 'area_interesse');
		$this->area_interesse->insert_entry($id_utilizador, $area_interesse);

		$this->edit();
	}

	public function delete($id_area_interesse)
	{
		$this->load->model('Area_interesse', 'area_interesse');

		$area_interesse = $this->input->post('area_interesse');
		$this->area_interesse->delete_entry($area_interesse);

		$this->edit();
	}
}
