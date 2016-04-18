<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

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
         'telefone'                   => $input->post('cellphone')
         'id_area_geografica'         => $input->post('id_geographic_area')
         'id_habilitacoes_academicas' => $input->post('id_academic_qualifications')
      );

      return $data;
   }

   function get_volunteer_form_data($input)
   {
      $data = array(
         'nome'                       => $input->post('name'),
         'genero'                     => $input->post('gender'),
         'data_nascimento'            => $input->post('birthdate'),
         'telefone'                   => $input->post('cellphone')
         'id_area_geografica'         => $input->post('id_geographic_area')
         'id_habilitacoes_academicas' => $input->post('id_academic_qualifications')
      );

      return $data;
   }

}