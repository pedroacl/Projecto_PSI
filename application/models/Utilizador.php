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
                        'tipo_utilizador' => $utilizador->tipo_utilizador,
                        'nome'            => $utilizador->nome
                    );
                }

                $this->session->set_userdata($user_data);

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
            $this->db->select('u.id AS id_utilizador, v.id AS id_voluntario,
                u.email, u.tipo_utilizador, u.nome, u.id_area_geografica, distrito,
                concelho, freguesia');
            $this->db->from('Utilizadores AS u');
            $this->db->join('Voluntarios AS v', 'u.id = v.id_utilizador');
            $this->db->join('Areas_Geograficas as ag', 'u.id_area_geografica = ag.id');
            $this->db->where('u.id', $id_utilizador);

            return $this->db->get()->row();
        }
        else
        {
            return $this->get_instituicao_by_id($id_utilizador);
        }
    }

    function get_instituicao_by_id($id_utilizador)
    {
        $this->db->select('u.id AS id_utilizador, i.id AS id_instituicao, u.email,
            u.tipo_utilizador, u.nome, u.id_area_geografica');
        $this->db->from('Utilizadores AS u');
        $this->db->join('Instituicoes AS i', 'u.id = i.id_utilizador');
        $this->db->where('u.id', $id_utilizador);

        return $this->db->get();
    }

    function insert_entry($input)
    {
        $utilizador = $this->get_signup_form_data($input);
        $utilizador['recovery_token'] = md5( uniqid( mt_rand(), true));

        $this->db->insert('Utilizadores', $utilizador);

        return $this->db->insert_id();
    }

    function update_entry($id_utilizador, $data)
    {
        $this->db->where('id', $id_utilizador);
        $this->db->update('Utilizadores', $data);

        $this->session->set_userdata(array('nome' => $data['nome']));
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
        $this->load->helper('date');
        $data = array(
            'telefone'   => $input['telefone'],
            'nome'       => $input['nome_utilizador'],
            'updated_at' => mdate("%Y/%m/%d")
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
            ),
            array(
                'field' => 'telefone',
                'label' => 'Telefone',
                'rules' => 'min_length[9]'
            )
        );

        return $rules;
    }
}
