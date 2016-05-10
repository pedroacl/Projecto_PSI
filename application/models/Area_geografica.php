<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_geografica extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Area_geografica', 'area_geografica');
    }

    public function get_by_fields($input)
    {
        $data = $this->get_signup_form_data();

        $this->db->select('*');
        $this->db->from('Areas_Geograficas');
        $this->db->where($data);
    }

    public function get_by_id_utilizador($id_utilizador)
    {
        $this->db->select('*');
        $this->db->from('Areas_Geograficas AS ag');
        $this->db->join('Utilizadores AS u', 'u.id_area_geografica = ag.id');
        $this->db->where('u.id', $id_utilizador);

        return $this->db->get();
    }

    function get_by_id($id_area_geografica)
    {
        $this->db->select('id, freguesia, concelho, distrito');
        $this->db->from('Areas_Geograficas');
        $this->db->where('id', $id_area_geografica);

        return $this->db->get();
    }

    function insert_entry($data)
    {
        // verificar se já existe uma area geografica adicionada
        $this->db->select('id');
        $this->db->from('Areas_Geograficas');
        $this->db->where($data);
        $area_geografica_data = $this->db->get();

        if ($area_geografica_data->num_rows() == 0)
        {
            $this->db->insert('Areas_Geograficas', $data);
            return $this->db->insert_id();
        }
        else
        {
            return $area_geografica_data->row()->id;
        }
    }

    function get_form_data($input)
    {
        $data = array(
            'freguesia' => $input['freguesia'],
            'concelho'  => $input['concelho'],
            'distrito'  => $input['distrito']
        );

        return $data;
    }
}
