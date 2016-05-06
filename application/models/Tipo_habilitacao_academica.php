<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_habilitacao_academica extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_entries()
    {
        $this->db->select('*');
        $this->db->from('Tipos_Habilitacoes_Academicas');
        return $this->db->get();
    }

    function get_signup_form_data($input)
    {
        $data = array(
            'id_tipo'          => $input->post('tipo_habilitacao_academica'),
            'data_conclusao'   => $input->post('data_conclusao'),
            'curso'            => $input->post('curso'),
            'instituto_ensino' => $input->post('instituto')
        );

        return $data;
    }
}
