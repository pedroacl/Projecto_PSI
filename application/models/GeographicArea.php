<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GeographicArea extends CI_Model {

    function __construct()
    {
        parent::__construct();
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


    function insert_entry($geographic_area)
    {
        // verificar se já existe uma area geografica adicionada
        $this->db->select('id, freguesia, concelho, distrito');
        $this->db->from('Areas_Geograficas');
        $this->db->where('freguesia', $geographic_area['freguesia']);
        $this->db->where('concelho', $geographic_area['concelho']);
        $this->db->where('distrito', $geographic_area['distrito']);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $this->db->insert('Areas_Geograficas', $geographic_area);
            return $this->db->insert_id();
        } else {
            $row = $query->row();
            return $row->id;
        }
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'freguesia' => $input->post('parish'),
            'concelho'  => $input->post('county'),
            'distrito'  => $input->post('district'),
        );

        return $data;
    }
}
