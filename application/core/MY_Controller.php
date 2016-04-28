<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    	$this->title = "Title homepage";
    	$this->load->library('session');
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
