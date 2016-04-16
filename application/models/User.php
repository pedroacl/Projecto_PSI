<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function authenticate_user($email, $password)
    {
        $user_authenticated = false;
        $query = $this->get_user_by_email($email);

        // utilizador existe
        if ($query->num_rows() > 0) {
            $user = $query->row();

            if (isset($user)) {
                $encrypted_password = hash("sha256", $user->salt . $password);

                if ($user->password == $encrypted_password) {
                    $user_authenticated = true;
                }
            }
        }

        return $user_authenticated;
    }

    function get_all_users()
    {
        $query = $this->db->get('users', 10);
        return $query->result();
    }

    function get_user_by_email($email)
    {
        // $query = $this->db->get('users', 1);
        $this->db->select('email, password, salt');
        $this->db->from('Utilizadores');
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query;
    }

    function insert_entry($user)

        $this->created_at = time();
        $this->updated_at = $this->created_at;
        $this->db->insert('entries', $this);
    }

    function update_entry($user)
    {
        $users->updated_at = time();
        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

    function get_form_data($input)
    {
        $data = array(
            $input->post('email');
            $input->post('password');
        );

        return $data;
    }

    function get_signup_form_validation_rules($user_type) {
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

    function get_login_form_validation_rules() {
        $rules = array(
            array(
                'field'   => 'password',
                'label'   => 'Password',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'password_confirmation',
                'label'   => 'Password Confirmation',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'email',
                'label'   => 'Email',
                'rules'   => 'required|valid_email|min_length[8]'
            )
        );

        return $rules;
    }
}
