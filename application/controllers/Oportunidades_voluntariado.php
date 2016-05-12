<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oportunidades_voluntariado extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->authenticate_user();
		$this->validate_is_instituicao();
		$this->load->model('Oportunidade_voluntariado', 'oportunidade_voluntariado');
	}

	public function index()
	{
		$this->load->library('session');

		$this->load->view('templates/main_template/header');
		$this->load->view('/oportunidades_voluntariado/index');
		$this->load->view('templates/main_template/footer');
	}

	public function add()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->model('Area_geografica', 'area_geografica');
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->model('Grupo_atuacao', 'grupo_atuacao');
		$this->load->model('Area_interesse', 'area_interesse');

		$rules = $this->oportunidade_voluntariado->get_form_validation_rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {

			if (validation_errors() != null) {
				$this->session->set_flashdata('danger', validation_errors());
			}

			// grupos de atuação
			$this->grupos_atuacao_data = $this->grupo_atuacao->get_grupos_atuacao_data();

			// areas de interesse
			$this->areas_interesse_data = $this->area_interesse->get_areas_interesse_data();

			$this->title = "Adicionar nova Oportunidade de Voluntariado";
			$this->js_files = array('disponibilidades.js', 'areas_geograficas.js');
			$this->load->view('templates/main_template/header');
			$this->load->view('/oportunidades_voluntariado/add');
			$this->load->view('templates/main_template/footer');

		} else {
			// adicionar area geografica
			$area_geografica_data = $this->area_geografica->get_form_data($this->input->post());
			$id_area_geografica   = $this->area_geografica->insert_entry($area_geografica_data);

			// adicionar oportunidade de voluntariado
			$oportunidade_voluntariado_data = $this->oportunidade_voluntariado->get_form_data($this->input->post());

			$oportunidade_voluntariado_data['id_instituicao']     = $this->id_instituicao;
			$oportunidade_voluntariado_data['id_area_geografica'] = $id_area_geografica;
			$id_oportunidade = $this->oportunidade_voluntariado->insert_entry($oportunidade_voluntariado_data);

        	// adicionar disponibilidades
        	$disponibilidades_data = 
        		$this->disponibilidade->get_form_data($this->input->post());
        	$disponibilidade_data[]

        	$this->disponibilidade->insert_entries($id_oportunidade, $disponibilidades_data);

			$this->session->set_flashdata('success', 'Oportunidade de Voluntariado adicionada com sucesso!');
			redirect('instituicoes/profile');
		}
	}

	public function show($id_oportunidade_voluntariado)
	{
		$this->load->helper('form');
		$this->load->model('Grupo_atuacao', 'grupo_atuacao');
		$this->load->model('Area_interesse', 'area_interesse');
		$this->load->model('Disponibilidade', 'disponibilidade');
		
		$this->oportunidade_voluntariado =
			$this->oportunidade_voluntariado->get_by_id($id_oportunidade_voluntariado)->row();

		$this->disponibilidades = $this->disponibilidade->get_by_id_oportunidade($id_oportunidade_voluntariado);

		$this->js_files = array('oportunidades/oportunidade_profile.js');
		$this->load->view('templates/main_template/header');
		$this->load->view('/oportunidades_voluntariado/show');
		$this->load->view('templates/main_template/footer');
	}

	public function edit($id_oportunidade_voluntariado)
	{
		$this->load->library('form_validation');
		$this->load->model('Area_geografica', 'area_geografica');
		$this->load->model('Area_interesse', 'area_interesse');
		$this->load->model('Grupo_atuacao', 'grupo_atuacao');

		$this->oportunidade_voluntariado_data = $this->oportunidade_voluntariado->get_by_id($id_oportunidade_voluntariado);

		if ($this->oportunidade_voluntariado_data->num_rows() == 0
			|| $this->oportunidade_voluntariado_data->row()->id_instituicao != $this->id_instituicao) {

			$this->session->set_flashdata('warning', 'Acesso não atorizado!');
			redirect('');
		}

		$this->oportunidade_voluntariado_data = $this->oportunidade_voluntariado_data->row();

		$rules = $this->oportunidade_voluntariado->get_form_validation_rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			// grupos de atuação
			$this->grupos_atuacao_data = $this->grupo_atuacao->get_grupos_atuacao_data();

			// areas de interesse
			$this->areas_interesse_data = $this->area_interesse->get_areas_interesse_data();

			$this->js_files = array('disponibilidades.js', 'areas_geograficas.js');
			$this->load->view('templates/main_template/header');
			$this->load->view('/oportunidades_voluntariado/edit');
			$this->load->view('templates/main_template/footer');

		} else {
        	// atualizar area geografica
        	$area_geografica_data = $this->area_geografica->get_form_data($this->input->post());
			$id_area_geografica = $this->area_geografica->insert_entry($area_geografica_data);

			// atualizar oportunidade
			$form_data = $this->oportunidade_voluntariado->get_form_data($this->input->post());
			$form_data['id_area_geografica'] = $id_area_geografica;
			$form_data['id_instituicao']     = $this->id_instituicao;

			$this->oportunidade_voluntariado->update_entry($form_data, $id_oportunidade_voluntariado);
			$this->session->set_flashdata('success', 'Oportunidade de Voluntariado actualizada com sucesso!');

			redirect('instituicoes/profile');
		}
	}

	public function delete($id_oportunidade_voluntariado)
	{
		$this->oportunidade_voluntariado->delete_entry($id_oportunidade_voluntariado);
	}

	public function add_disponibilidade($id_oportunidade_voluntariado)
	{
		$this->load->library('form_validation');
		$this->load->model('Disponibilidade', 'disponibilidade');
		$this->load->model('Periodicidade', 'periodicidade');
		$this->load->model('Oportunidade_voluntariado_disponibilidade', 'oportunidade_voluntariado_disponibilidade');

	 	// disponibilidade
		$disponibilidade_data = $this->disponibilidade->get_profile_data($this->input->post());
		$id_disponibilidade    = $this->disponibilidade->insert_single_entry($disponibilidade_data);

		// periodicidade
		$periodicidade_data = $this->periodicidade->get_form_data($this->input->post());
		$periodicidade_data['id_disponibilidade'] = $id_disponibilidade;
		$this->periodicidade->insert_single_entry($periodicidade_data);

		$oportunidade_voluntariado_disponibilidade_data = array(
			'id_oportunidade_voluntariado' => $id_oportunidade_voluntariado,
			'id_disponibilidade'           => $id_disponibilidade
		);

		$this->oportunidade_voluntariado_disponibilidade->insert_entry($oportunidade_voluntariado_disponibilidade_data);

	 	// voltar a exibir perfil
		$this->session->set_flashdata('success', 'Disponibilidade adicionada com sucesso!');
		redirect('oportunidades_voluntariado/show/' . $id_oportunidade_voluntariado, 'location');
	}
}
