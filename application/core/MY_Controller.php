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

		$this->user_profile_link = $this->session->userdata('tipo_utilizador');

		if (isset($this->user_profile_link)) {
			$this->user_profile_link = $links[$this->session->userdata('tipo_utilizador')];
		}

		$this->nome_utilizador = $this->session->userdata('nome');
		$this->id_utilizador   = $this->session->userdata('id_utilizador');
		$this->id_voluntario   = $this->session->userdata('id_voluntario');
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

 		if (!isset($id_voluntario))
			redirect('home/index', 'refresh');
  	}

  	public function validate_is_instituicao()
  	{
  		$id_instituicao = $this->session->userdata('id_instituicao');

  		if (!isset($id_instituicao))
			redirect('home/index', 'refresh');
  	}
}
