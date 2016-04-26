<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct() {
		parent::__construct();

/*
		if ( ! isset($this->session) {
			redirect('/auth/login', 'refresh');
		}
		*/

	}

	// GET /
	public function index()
	{
		$this->load->view('templates/main_template/header');
		$this->load->view('home/index');
		$this->load->view('templates/main_template/footer');
	}

	// GET /signup
	public function signup()
	{
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->user_type_selected = null;

		$this->load->model('AcademicQualificationType', 'academic_qualification_type');
		$this->academic_qualifications_types = $this->academic_qualification_type->get_entries();

		$this->load->model('ActionGroup', 'action_group');
		$this->action_groups = $this->action_group->get_entries();

		$this->load->model('AreaOfInterest', 'area_of_interest');
		$this->areas_of_interest = $this->area_of_interest->get_entries();

		$this->title = "Registo de Utilizador";
		$this->load->view('templates/main_template/header');
		$this->load->view('home/register_form');
		$this->load->view('templates/main_template/footer');
	}

	// POST /signup
	public function process_signup()
	{
		$this->title = "Registo de Utilizador";

		$this->load->library('form_validation');
		$this->load->library('session');

		$this->load->model('User', 'user');
		$this->load->model('Volunteer', 'volunteer');
		$this->load->model('Institution', 'institution');
		$this->load->model('GeographicArea', 'geographic_area');
		$this->load->model('AcademicQualification', 'academic_qualification');
		$this->load->model('AcademicQualificationType', 'academic_qualification_type');
		$this->load->model('ActionGroup', 'action_group');
		$this->load->model('AreaOfInterest', 'area_of_interest');
		$this->load->model('User_ActionGroup', 'user_action_group');
		$this->load->model('User_AreaOfInterest', 'user_area_of_interest');

		// obter regras de validacao do formulario
		$user_type  = $this->input->post('user_type');
		$form_rules = null;

		if ($user_type == 'volunteer') {
			$form_rules = $this->volunteer->get_form_validation_rules();
			$volunteer  = $this->volunteer->get_signup_form_data($this->input);

			// prep form values
			$this->select_boxes_data = $this->geographic_area->get_select_boxes_data();

			$this->academic_qualifications_types = $this->academic_qualification_type->get_entries();
			$this->action_groups                 = $this->action_group->get_entries();
			$this->areas_of_interest             = $this->area_of_interest->get_entries();

		}
		else if($user_type == 'institution')
		{
			$form_rules  = $this->institution->get_form_validation_rules();
			$institution = $this->institution->get_signup_form_data($this->input);
		}

		$this->form_validation->set_rules($form_rules);

		// formulario invalido
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('danger', validation_errors());
			// $this->session->set_flashdata('notice', print_r($_POST['disponibilidades']));
			$this->load->view('templates/main_template/header');
			$this->load->view('home/register_form');
			$this->load->view('templates/main_template/footer');
		}
		else
		{
			// inserir utilizador
			$user    = $this->user->get_signup_form_data($this->input);
			$user_id = $this->user->insert_entry($user);

			// inserir grupos de actuação
			$action_groups = $this->user_action_group->get_signup_form_data($this->input);
			$this->user_action_group->insert_entries($user_id, $action_groups);

			// inserir areas de interesse
			$areas_of_interest = $this->user_area_of_interest->get_signup_form_data($this->input);
			$this->user_area_of_interest->insert_entries($user_id, $areas_of_interest);

			// inserir area geografica
			$geographic_area = $this->geographic_area->get_signup_form_data($this->input);
			$geographic_area_id = $this->geographic_area->insert_entry($geographic_area);

			// inserir habilitacoes academicas
			$academic_qualifications = $this->academic_qualification->get_signup_form_data($this->input);
			$academic_qualifications_id = $this->academic_qualification->insert_entry($academic_qualifications);

			$user_type = $this->input->post('user_type');

			// inserir voluntario
			if ($user_type == 'volunteer')
			{
				$volunteer = $this->volunteer->get_signup_form_data($this->input);
				$volunteer['id_utilizador']              = $user_id;
				$volunteer['id_area_geografica']         = $geographic_area_id;
				$volunteer['id_habilitacoes_academicas'] = $academic_qualifications_id;

				$user_id = $this->volunteer->insert_entry($volunteer);
			}
			// inserir instituição
			else
			{
				$institution = $this->institution->get_signup_form_data($this->input);
				$user_id = $this->institution->insert_entry($institution, $user_id);
			}

/*
			$this->session->set_flashdata('notice', 'Login realizado com sucesso.');
			$this->load->view('templates/main_template/header');
			$this->load->view('home/index');
			$this->load->view('templates/main_template/footer');
			*/
		}
	}

	// GET /login
	public function show_login()
	{
		if ($this->session->userdata("id") !== null)
		{
			redirect('', 'refresh');
		}

		$this->session->set_flashdata('notice', 'Login realizado com sucesso.');
		$this->title = "Login";
		$this->login_tab = true;

		// load view
		$this->load->view('templates/main_template/header');
		$this->load->view('home/login');
		$this->load->view('templates/main_template/footer');
	}

	// POST /login
	public function process_login()
	{
		$this->load->library('form_validation');
		$this->load->model('User');

		// obter regras de validacao do formulario
		$user_type = $this->input->post('user_type');
		$form_rules = $this->User->get_login_form_validation_rules($user_type);
		$this->form_validation->set_rules($form_rules);

		// validar formulario
		if ($this->form_validation->run() == FALSE)
		{
			$this->show_login();
		}
		else
		{
			// obter valores do formulario
			$email    = $this->input->post('email');
			$password = $this->input->post('password');

			// authenticar utilizador
			if (($id = $this->User->authenticate_user($email, $password)) !== -1) {
				$this->session->set_flashdata('notice', 'Utilizador autenticado');
				$cookie = array(
							'id' => $id,
							'email' => $email
					);
				$this->session->set_userdata($cookie);
	      redirect('', 'refresh');

			} else {
				$this->session->set_flashdata('danger', 'Combinação de Username/Password errada');
				redirect('login', 'refresh');
			}
		}
	}

	// GET /logout
	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('email');
		$this->session->sess_destroy();

		redirect('', 'refresh');
	}
}
