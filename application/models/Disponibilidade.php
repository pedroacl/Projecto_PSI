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
        $this->db->select('disponibilidades.id, disponibilidades.data_inicio, disponibilidades.data_fim');
        $this->db->from('Disponibilidades as disponibilidades');

        $this->db->join('Utilizadores_Disponibilidades as utilizadores_disponibilidades',
            'disponibilidades.id = utilizadores_disponibilidades.id_disponibilidade');

        $this->db->join('Utilizadores as utilizadores', 'utilizadores.id = utilizadores_disponibilidades.id_utilizador');
        $this->db->where('utilizadores_disponibilidades.id_utilizador', $id_utilizador);

        return $this->db->get();
    }

    function get_by_id_oportunidade($id_oportunidade)
    {
        $this->db->select('disponibilidades.id, disponibilidades.data_inicio, disponibilidades.data_fim');
        $this->db->from('Disponibilidades as disponibilidades');

        $this->db->join('Oportunidades_Voluntariado_Disponibilidades as oportunidades_voluntariado_disponibilidades',
            'disponibilidades.id = oportunidades_voluntariado_disponibilidades.id_disponibilidade');

        $this->db->join('Oportunidades_Voluntariado as oportunidades', 'oportunidades.id = oportunidades_voluntariado_disponibilidades.id_oportunidade_voluntariado');
        $this->db->where('oportunidades_voluntariado_disponibilidades.id_oportunidade_voluntariado', $id_oportunidade);

        return $this->db->get();
    }

    function get_by_id($id_disponibilidade)
    {
        $this->db->select('disponibilidades.id, disponibilidades.data_inicio, disponibilidades.data_fim');
        $this->db->from('Disponibilidades as disponibilidades');
        $this->db->where('disponibilidades.id', $id_disponibilidade);

        return $this->db->get();
    }

    // inserir individual
    function insert_single_entry($data)
    {
        $this->db->insert('Disponibilidades', $data);

        return $this->db->insert_id();
    }

    function update($id_disponibilidade, $data)
    {
        $this->db->where('id', $id_disponibilidade);
        $this->db->update('Disponibilidades', $data['disponibilidade']);
    }

    function insert_entries($id_oportunidade_voluntariado, $input)
    {
        $this->load->model('Oportunidade_voluntariado_disponibilidade', 'oportunidade_disponibilidade');

        foreach ($input as $disponibilidade) {
            // adicionar disponibilidade
            $this->db->insert('Disponibilidades', $disponibilidade['disponibilidade']);
            $id_disponibilidade = $this->db->insert_id();

            // adicionar join table
            $oportunidade_disponibilidade_data = $this->oportunidade_disponibilidade->get_form_data($id_oportunidade_voluntariado, $id_disponibilidade);
            $this->oportunidade_disponibilidade->insert_entry($oportunidade_disponibilidade_data);
        }

        return $id_disponibilidade;
    }

    public function get_profile_data($input)
    {
        $this->load->helper('date');

        return array(
            'data_inicio' => mdate("%Y/%m/%d",  strtotime($input['data_inicio'])),
            'data_fim'    => mdate("%Y/%m/%d",  strtotime($input['data_fim']))
        );
    }

    function get_form_data($input)
    {
        $this->load->helper('date');

        $disponibilidades = $input['disponibilidades'];
        $result = array();

        foreach ($disponibilidades as $disp) {
            $data = array(
                'disponibilidade' => array(
                    'data_inicio' => mdate("%Y/%m/%d",  strtotime($disp['data_inicio'])),
                    'data_fim'    => mdate("%Y/%m/%d",  strtotime($disp['data_fim']))
                )
            );

            array_push($result, $data);
        }

        return $result;
    }

}
