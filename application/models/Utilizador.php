<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizador extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function authenticate_utilizador($email, $password)
    {
        $this->load->library('session');

        $this->db->select('id, email, nome, tipo_utilizador, password');
        $this->db->from('Utilizadores AS u');
        $this->db->where('email', $email);
        $query = $this->db->get();

        // utilizador existe
        if ($query->num_rows() > 0) {
            $utilizador = $query->row();

            if (password_verify($password, $utilizador->password)) {
                if ($utilizador->tipo_utilizador == 'voluntario') {

                    $this->db->select('u.id AS id_utilizador, v.id AS id_voluntario, u.email, u.tipo_utilizador, u.nome');
                    $this->db->from('Utilizadores AS u');
                    $this->db->join('Voluntarios AS v', 'u.id = v.id_utilizador');
                    $this->db->where('u.id', $utilizador->id);
                    $utilizador = $this->db->get()->row();

                    $user_data = array(
                        'id_utilizador'   => $utilizador->id_utilizador,
                        'id_voluntario'   => $utilizador->id_voluntario,
                        'email'           => $email,
                        'tipo_utilizador' => $utilizador->tipo_utilizador,
                        'nome'            => $utilizador->nome
                    );
                } else {
                    $this->db->select('u.id AS id_utilizador, i.id AS id_instituicao, u.email, u.tipo_utilizador, u.nome');
                    $this->db->from('Utilizadores AS u');
                    $this->db->join('Instituicoes AS i', 'u.id = i.id_utilizador');
                    $this->db->where('u.id', $utilizador->id);
                    $utilizador = $this->db->get()->row();

                    $user_data = array(
                        'id_utilizador'   => $utilizador->id_utilizador,
                        'id_instituicao'  => $utilizador->id_instituicao,
                        'email'           => $email,
                        'tipo_utilizador' => $user->tipo_utilizador,
                        'nome'            => $user->nome
                    );
                }

                $this->session->set_userdata($user_data);
                print_r($utilizador);
                print_r($this->session->userdata());
                return $utilizador;
            }
        }

        return null;
    }

    function get_all_utilizadores()
    {
        $query = $this->db->get('Utilizadores', 10);
        return $query->result();
    }

    function get_by_id($id_utilizador, $user_type)
    {
        if ($user_type == 'voluntario') {
            $this->db->select('u.id AS id_utilizador, v.id AS id_voluntario, u.email, u.tipo_utilizador, u.nome');
            $this->db->from('Utilizadores AS u');
            $this->db->join('Voluntarios AS v', 'u.id = v.id_utilizador');
            $this->db->where('u.id', $utilizador->id);

            return $this->db->get()->row();
        }
        else
        {
            return get_instituicao_by_id($id_utilizador);
        }
    }

    function get_instituicao_by_id($id_utilizador)
    {
        $this->db->select('');
        $this->db->from('Utilizadores as utilizadores');
        $this->db->join('Voluntarios as voluntarios', 'utilizadores.id = voluntarios.id_utilizador');
        $this->db->where('id', $id_utilizador);

        return $this->db->get();
    }

    function insert_entry($input)
    {
        $utilizador = $this->get_signup_form_data($input);
        $utilizador['recovery_token'] = md5( uniqid( mt_rand(), true));

        $this->db->insert('Utilizadores', $utilizador);

        return $this->db->insert_id();
    }

    function update_entry($id_utilizador, $input)
    {
        $utilizadores->updated_at = time();
        $data_utilizador = $this->get_update_form_data($input);

        $this->db->where('id', $id_utilizador);
        $this->db->update('Utilizadores', $data_utilizador);
    }

    function get_signup_form_data($input)
    {
        // $password = hash("sha256", $utilizador->salt . $password);
        $password = $input->post('password');
        $hashAndSalt = password_hash($password, PASSWORD_BCRYPT);

        $data = array(
            'email'           => $input->post('email'),
            'password'        => $hashAndSalt,
            'telefone'        => $input->post('telefone'),
            'nome'            => $input->post('nome_utilizador'),
            'tipo_utilizador' => $input->post('tipo_utilizador'),
            'recovery_token'  => ''
        );

        return $data;
    }

    function get_update_form_data($input)
    {
        $data = array(
            'telefone'        => $input->post('telefone'),
            'nome'            => $input->post('nome_utilizador')
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
                'field' => 'tipo_utilizador',
                'label' => 'Tipo de Utilizador',
                'rules' => 'required|min_length[9]'
            )
        );

        return $rules;
    }
}
