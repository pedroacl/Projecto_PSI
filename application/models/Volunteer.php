<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

 function insert_volunteer_entry($user, $volunteer)
 {
  $this->db->insert('utilizadores', $user);
  $this->db->insert('voluntarios', $volunteer);
}

function get_volunteer_by_email($email)
{
  // $query = $this->db->get('users', 1);
  $this->db->select('email, password, salt');
  $this->db->from('Utilizadores users');
  $this->db->join('Voluntarios volunteers', 'volunteers.id_utilizador = users.id', 'left');
  $this->db->where('email', $email);
  $query = $this->db->get();

  return $query;
}

function get_volunteer_form_data($input)
{
  $data = array(
   'nome'                       => $input->post('name'),
   'genero'                     => $input->post('gender'),
   'data_nascimento'            => $input->post('birthdate'),
   'telefone'                   => $input->post('cellphone'),
   'id_area_geografica'         => $input->post('id_geographic_area'),
   'id_habilitacoes_academicas' => $input->post('id_academic_qualifications')
   );

  return $data;
}

function get_volunteer_form_validation_rules($user_type) {
  $rules = array(
    array(
      'field'   => 'email',
      'label'   => 'Email',
      'rules'   => 'required|valid_email|min_length[8]'
      ),
    array(
      'field'   => 'password',
      'label'   => 'Password',
      'rules'   => 'required'
      ),
    array(
      'field'   => 'password_confirmation',
      'label'   => 'Password Confirmation',
      'rules'   => 'required'
      )
    );

  $aux_array = null;

  if ($user_type == 'volunteer') {
    $aux_array = array(
      'field' => '',
      'label' => '',
      'rules' => '',
      );
  }
  else
  {
    $aux_array = array(
      'field' => '',
      'label' => '',
      'rules' => '',
      );
  }

  array_push($rules, $aux_array);

  return $rules;
}

function get_volunteer_form_data($input)
{
  $data = array(
    'nome'                       => $input->post('name'),
    'genero'                     => $input->post('gender'),
    'data_nascimento'            => $input->post('birthdate'),
    'telefone'                   => $input->post('telephone_number'),
    'id_area_geografica'         => $input->post('id_geographic_area'),
    'id_habilitacoes_academicas' => $input->post('id_academic_qualifications')
    );

  return $data;
}
}