<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		$this->title = "Title homepage";
		parent::__construct();
	}

	public function validate_user()
	{
		// teste
	}
}
