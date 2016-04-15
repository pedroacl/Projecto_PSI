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

    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
}
