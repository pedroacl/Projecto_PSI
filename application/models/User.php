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
        $query = $this->get_user_by_email($email);
        $user = null;

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

        return $user !== null ? $user->id : -1;
    }

    function get_all_users()
    {
        $query = $this->db->get('users', 10);
        return $query->result();
    }

    function get_user_by_email($email)
    {
        // $query = $this->db->get('users', 1);
        $this->db->select('id, email, password, salt');
        $this->db->from('Utilizadores');
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query;
    }

    function update_entry($user)
    {
        $users->updated_at = time();
        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

    function get_user_form_data($input)
    {
        $data = array(
            'email'    => $input->post('email'),
            'password' => $input->post('password'),
            'foto'     => $input->post('photo')
        );

        return $data;
    }

    function get_login_form_validation_rules() {
        $rules = array(
            array(
                'field'   => 'password',
                'label'   => 'Password',
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

    function get_signup_user_data()
    {
        $data = array(
           'academic_qualifications' => array(
                '1' => 'licenciatura',
                '2' => 'mestrado'
            ),
            'geographic_area' => array(
                '1' => 'Lisboa',
                '2' => 'Porto'
            )
        );
    }
}
