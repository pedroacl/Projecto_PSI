<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AreaGeografica extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_area_geografica_from_id($area_id)
    {
        $this->db->select('id, freguesia, concelho, distrito');
        $this->db->from('Areas_Geograficas');
        $this->db->where_in('id', $area_id);
        $query = $this->db->get();

        return $query->result();
    }


    function get_select_boxes_data()
    {
        $this->select_boxes_data = array(
            'geographic_area_districts' => array(
                '1' => 'Lisboa',
                '2' => 'Leiria'
            ),
            'geographic_area_' => array(
                '1' => 'Lisboa',
                '2' => 'Leiria'
            ),
            'geographic_area_parishes' => array(
                '1' => 'Lisboa',
                '2' => 'Leiria'
            )
        );
    }


    function insert_entry($input)
    {
        $area_geografica = $this->get_signup_form_data($input);

        // verificar se já existe uma area geografica adicionada
        $this->db->select('id, freguesia, concelho, distrito');
        $this->db->from('Areas_Geograficas');
        $this->db->where('freguesia', $area_geografica['freguesia']);
        $this->db->where('concelho', $area_geografica['concelho']);
        $this->db->where('distrito', $area_geografica['distrito']);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $this->db->insert('Areas_Geograficas', $area_geografica);
            return $this->db->insert_id();
        } else {
            $row = $query->row();
            return $row->id;
        }
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'freguesia' => $input->post('freguesia'),
            'concelho'  => $input->post('concelho'),
            'distrito'  => $input->post('distrito'),
        );

        return $data;
    }
}
