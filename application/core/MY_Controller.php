<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
    $this->title = "Title homepage";
		parent::__construct();

/*
		if ( ! $this->dx_auth->is_logged_in()) {
			//redirect('/auth/login', 'refresh');
			$this->dx_auth->deny_access('login');
		}
		*/
	}

	public function validate_user()
	{
		// teste
	}

  public function is_logged_in()
  {
    return TRUE;
  }
}
