<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscricoes extends MY_Controller {

  function __construct() {
    parent::__construct();
  }

  public function add($id_voluntario, $id_oportunidade)
  {
    // add
    redirect_back();
  }

  public function accept($id_oportunidade)
  {

  }

  public function delete()
  {

  }
  
}