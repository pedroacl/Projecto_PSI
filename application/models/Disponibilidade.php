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

    function delete_entry_oportunidade($id_disponibilidade)
    {
        $this->db->delete('Disponibilidades', array('id' => $id_disponibilidade)); 
        $this->db->delete('Oportunidades_Voluntariado_Disponibilidades', array('id_disponibilidade' => $id_disponibilidade)); 
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

    function get_by_id_oportunidade($id_oportunidade)
    {
        $this->db->select('disponibilidades.id, disponibilidades.data_inicio, disponibilidades.data_fim,
            periodicidades.tipo as tipo_periodicidade, periodicidades.data_fim as data_fim_periodicidade');
        $this->db->from('Disponibilidades as disponibilidades');

        $this->db->join('Oportunidades_Voluntariado_Disponibilidades as oportunidades_voluntariado_disponibilidades',
            'disponibilidades.id = oportunidades_voluntariado_disponibilidades.id_disponibilidade');

        $this->db->join('Oportunidades_Voluntariado as oportunidades', 'oportunidades.id = oportunidades_voluntariado_disponibilidades.id_oportunidade_voluntariado');
        $this->db->join('Periodicidades as periodicidades', 'periodicidades.id_disponibilidade = disponibilidades.id');
        $this->db->where('oportunidades_voluntariado_disponibilidades.id_oportunidade_voluntariado', $id_oportunidade);

        return $this->db->get();
    }

    function get_by_id($id_disponibilidade)
    {
        $this->db->select('disponibilidades.id, disponibilidades.data_inicio, disponibilidades.data_fim,
            periodicidades.tipo as tipo_periodicidade, periodicidades.data_fim as data_fim_periodicidade');
        $this->db->from('Disponibilidades as disponibilidades');
        $this->db->join('Periodicidades as periodicidades', 'periodicidades.id_disponibilidade = disponibilidades.id');
        $this->db->where('disponibilidades.id', $id_disponibilidade);

        return $this->db->get();
    }

    // inserir individual
    function insert_single_entry($data)
    {
        $this->load->model('Periodicidade', 'periodicidade');
        $this->db->insert('Disponibilidades', $data);

        return $this->db->insert_id();
    }

    function update($id_disponibilidade, $data)
    {
        $this->load->model('Periodicidade', 'periodicidade');
        $this->db->where('id', $id_disponibilidade);
        $this->db->update('Disponibilidades', $data['disponibilidade']);

        $id_periodicidade = $this->periodicidade->get_by_disponibilidade_id($id_disponibilidade)->row()->id;
        $this->periodicidade->update_entry($id_periodicidade, $data['periodicidade']);
    }

    function insert_entries($id_oportunidade_voluntariado, $input)
    {
        $this->load->model('Periodicidade', 'periodicidade');
        $this->load->model('Oportunidade_voluntariado_disponibilidade', 'oportunidade_disponibilidade');

        foreach ($input as $disponibilidade) {
            // adicionar disponibilidade
            $this->db->insert('Disponibilidades', $disponibilidade['disponibilidade']);
            $id_disponibilidade = $this->db->insert_id();

            // adicionar join table
            $oportunidade_disponibilidade_data = $this->oportunidade_disponibilidade->get_form_data($id_oportunidade_voluntariado, $id_disponibilidade);
            $this->oportunidade_disponibilidade->insert_entry($oportunidade_disponibilidade_data);

            // inserir periodicidade associada ah disponibilidade
            $disponibilidade['periodicidade']['id_disponibilidade'] = $id_disponibilidade;
            $this->periodicidade->insert_entry($disponibilidade['periodicidade']);
        }

        return $id_disponibilidade;
    }

    public function get_profile_data($input)
    {
        return array(
            'data_inicio'   => date("Y-m-d", strtotime($input['data_inicio'])),
            'data_fim'      => date("Y-m-d", strtotime($input['data_fim']))
        );
    }

    function get_form_data($input)
    {
        $disponibilidades = $input['disponibilidades'];
        $result = array();

        foreach ($disponibilidades as $disp) {
            $inicio        = date("Y-m-d", strtotime($disp['data_inicio']));
            $fim           = date("Y-m-d", strtotime($disp['data_fim']));
            $periodicidade = $disp['periodicidade'];
            $repetir_ate   = date("Y-m-d", strtotime($disp['repetir_ate']));

            $data = array(
                'disponibilidade' => array(
                    'data_inicio' => $inicio,
                    'data_fim'    => $fim
                ),
                'periodicidade' => array(
                    'tipo'     => $periodicidade,
                    'data_fim' => $repetir_ate
                )
            );

            array_push($result, $data);
        }

        return $result;
    }

}
