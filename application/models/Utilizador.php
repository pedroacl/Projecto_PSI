<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizador extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function authenticate_utilizador($email, $password)
    {
        $query = $this->get_utilizador_by_email($email);

        // utilizador existe
        if ($query->num_rows() > 0) {
            $utilizador = $query->row();

            if (isset($utilizador)) {
                $encrypted_password = hash("sha256", $utilizador->salt . $password);

                if ($utilizador->password == $encrypted_password) {
                    return $utilizador->id;
                }
            }
        }

        return null;
    }

    function get_all_utilizadores()
    {
        $query = $this->db->get('Utilizadores', 10);
        return $query->result();
    }

    function get_utilizador_by_email($email)
    {
        // $query = $this->db->get('utilizadores', 1);
        $this->db->select('id, email, password, salt');
        $this->db->from('Utilizadores');
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query;
    }

    function insert_entry($input)
    {
        $utlizador = get_signup_form_data($input);
        $this->db->insert('Utilizadores', $utilizador);
        return $this->db->insert_id();
    }

    function update_entry($utilizador)
    {
        $utilizadores->updated_at = time();
        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'email'    => $input->post('email'),
            'password' => $input->post('password'),
            'foto'     => $input->post('foto'),
            'telefone' => $input->post('telefone'),
            'nome'     => $input->post('nome_utilizador')
        );

        return $data;
    }

    function get_login_form_validation_rules()
    {
        $rules = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|min_length[8]'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            )
        );

        return $rules;
    }

    function get_form_validation_rules()
    {
        $rules = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[Utilizadores.email]|min_length[8]'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|matches[confirmacao_password]'
            ),
            array(
                'field' => 'confirmacao_password',
                'label' => 'Confirmação da Password',
                'rules' => 'required'
            ),
            array(
                'field' => 'nome_utilizador',
                'label' => 'Nome',
                'rules' => 'required|is_unique[Utilizadores.nome]'
            ),
            array(
                'field' => 'telefone',
                'label' => 'Telefone',
                'rules' => 'required|min_length[9]'
            ),
            array(
                'field' => 'genero',
                'label' => 'Género',
                'rules' => 'required'
            ),
        );

        return $rules;
    }
/*
    function get_signup_utilizador_data()
    {
        $data = array(
           'habilitacao_academicas' => array(
                '1' => 'Licenciatura',
                '2' => 'Mestrado'
            ),
            'area_geograficas' => array(
                '1' => 'Lisboa',
                '2' => 'Porto'
            )
        );

       return $data;
    }
    */
}
