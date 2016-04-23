<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Availability extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert_entry($geographic_area)
    {
        // verificar se já existe uma area geografica adicionada
        $this->db->select('freguesia, concelho, distrito');
        $this->db->from('Areas_Geograficas');
        $this->db->where('freguesia', $geographic_area['parish']);
        $this->db->where('concelho', $geographic_area['county']);
        $this->db->where('distrito', $geographic_area['district']);
        $query = $this->db->get();

        $count = $query->num_rows();

        // area geografica ainda nao existe
        if ($count == 0) {
            $this->db->insert('Areas_Geograficas', $geographic_area);
            return $this->db->insert_id();
        } else {
            return $query->row()->id;
        }
    }

    function get_signup_form_data($input)
    {
        //TODO
        $data = array(
            'freguesia' => $input->post('parish'),
            'concelho'  => $input->post('county'),
            'distrito'  => $input->post('district'),
        );

        return $data;
    }
}
