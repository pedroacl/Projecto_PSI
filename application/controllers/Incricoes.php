<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscricoes extends MY_Controller {

  function __construct() {
    parent::__construct();
  }

  // GET
  public function insert_entry($id_voluntario, $id_oportunidade)
  {
    $this->load->model('Inscreve_se', 'inscricao');
    $this->inscricao->insert_entry($id_voluntario, $id_oportunidade);
    redirect_back();
  }

  public function accept($id_oportunidade)
  {

  }

  public function update_entry()
  {

  }

}