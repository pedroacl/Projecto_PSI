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
			'voluntario'  => site_url("voluntarios/profile"),
			'instituicao' => site_url("instituicoes/profile")
    	);

    	$this->user_profile_link = $links[$this->session->userdata('tipo_utilizador')];
	}

	public function authenticate_user()
	{
		if (!$this->user_logged_in()) {
			redirect('login', 'refresh');
		}
	}

  	public function user_logged_in()
  	{
    	return $this->session->userdata('id');
  	}
}
