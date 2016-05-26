<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

    	$this->load->library('session');
    	$this->load->helper('url');

    	$this->title = "Title homepage";

		$links = array(
			'voluntario'  => "voluntarios/profile",
			'instituicao' => "instituicoes/profile"
 		);

		$this->nome_utilizador = $this->session->userdata('nome');
		$this->email           = $this->session->userdata('email');
		$this->id_utilizador   = $this->session->userdata('id_utilizador');
		$this->id_voluntario   = $this->session->userdata('id_voluntario');
		$this->id_instituicao  = $this->session->userdata('id_instituicao');
		$this->tipo_utilizador = $this->session->userdata('tipo_utilizador');

    $this->user_profile_link = $this->session->userdata('tipo_utilizador');

    if (isset($this->user_profile_link)) {
      $this->user_profile_link = $links[$this->session->userdata('tipo_utilizador')] . "/" . $this->id_utilizador;
    }

    // Default de active area
    $this->active_area = '';
	}

	public function authenticate_user()
	{
		if (!$this->user_logged_in()) {
	 		$this->session->set_flashdata('warning', 'Utilizador nao registado!');
			redirect('login', 'refresh');
		}
	}

  	public function user_logged_in()
  	{
    	return $this->session->userdata('id_utilizador');
  	}

  	public function validate_is_voluntario()
  	{
  		$id_instituicao = $this->session->userdata('id_voluntario');

 		if (!isset($id_voluntario)) {
	 		$this->session->set_flashdata('warning', 'Utilizador não é um voluntário!');
			redirect('home/index', 'refresh');
 		}
  	}

  	public function validate_is_instituicao()
  	{
  		$id_instituicao = $this->session->userdata('id_instituicao');

  		if (!isset($id_instituicao)) {
	 		$this->session->set_flashdata('warning', 'Utilizador não é uma instituição!');
			redirect('home/index', 'refresh');
  		}
  	}
}
