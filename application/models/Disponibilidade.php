<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disponibilidade extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function delete_entry($id_utilizador)
    {
        $sql = "DELETE utilizadores_disponibilidades
            FROM Utilizadores utilizadores
            JOIN Utilizadores_Disponibilidades utilizadores_disponibilidades
               ON utilizadores.id = utilizadores_disponibilidades.id_utilizador
            JOIN Disponibilidades disponibilidades
               ON disponibilidades.id = utilizadores_disponibilidades.id_disponibilidade
            WHERE utilizadores.id = ?";

        $this->db->query($sql, array($id_utilizador));
    }

    function get_by_id_utilizador($id_utilizador)
    {
        $this->db->select('disponibilidades.id, disponibilidades.data_inicio, disponibilidades.data_fim,
            periodicidades.tipo as tipo_periodicidade, periodicidades.data_fim as data_fim_periodicidade');
        $this->db->from('Disponibilidades as disponibilidades');

        $this->db->join('Utilizadores_Disponibilidades as utilizadores_disponibilidades',
            'disponibilidades.id = utilizadores_disponibilidades.id_disponibilidade');

        $this->db->join('Utilizadores as utilizadores', 'utilizadores.id = utilizadores_disponibilidades.id_utilizador');
        $this->db->join('Periodicidades as periodicidades', 'periodicidades.id_disponibilidade = disponibilidades.id');
        $this->db->where('utilizadores_disponibilidades.id_utilizador', $id_utilizador);

        return $this->db->get();
    }

    function get_by_id($id_disponibilidade)
    {
        $this->db->select('disponibilidades.id, disponibilidades.data_inicio, disponibilidades.data_fim,
            periodicidades.tipo as tipo_periodicidade, periodicidades.data_fim as data_fim_periodicidade');
        $this->db->from('Disponibilidades as disponibilidades');

        $this->db->join('Utilizadores_Disponibilidades as utilizadores_disponibilidades',
            'disponibilidades.id = utilizadores_disponibilidades.id_disponibilidade');

        $this->db->join('Utilizadores as utilizadores', 'utilizadores.id = utilizadores_disponibilidades.id_utilizador');
        $this->db->join('Periodicidades as periodicidades', 'periodicidades.id_disponibilidade = disponibilidades.id');
        $this->db->where('disponibilidades.id', $id_disponibilidade);

        return $this->db->get();
    }

    function insert_entry($input, $id_oportunidade)
    {
        $this->load->model('Periodicidade', 'periodicidade');
        $this->load->model('Oportunidade_voluntariado_disponibilidade', 'oportunidade_disponibilidade');
        $disponibilidades = $this->get_form_data($input);

        foreach ($disponibilidades as $disponibilidade) {
            $this->db->insert('Disponibilidades', $disponibilidade['disponibilidade']);
            $id_disponibilidade = $this->db->insert_id();
            $this->oportunidade_disponibilidade->insert_entry($id_oportunidade, $id_disponibilidade);

            // inserir periodicidade associada ah disponibilidade
            $disponibilidade['periodicidade']['id_disponibilidade'] = $id_disponibilidade;
            $this->periodicidade->insert($disponibilidade['periodicidade']);

        }
        return $id_disponibilidade;
    }

    function get_form_data($input)
    {
        $disponibilidades = $input->post('disponibilidades[]');
        $result = array();

        foreach ($disponibilidades as $disp) {
            $inicio = $disp['data_inicio'];
            $fim = $disp['data_fim'];
            $periodicidade = $disp['periodicidade'];
            $repetir_ate = $disp['repetir_ate'];

            $data = array(
                'disponibilidade'   => array(
                                        'data_inicio' => $inicio,
                                        'data_fim' => $fim),
                'periodicidade'     => array(
                                        'tipo' => $periodicidade, 
                                        'data_fim' => $repetir_ate)
            );
            array_push($result, $data);
        }

        return $result;
    }
}
