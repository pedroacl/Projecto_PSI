<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disponibilidade extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function delete_by_id_utilizador($id_utilizador)
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
        $this->db->select('disponibilidades.data_inicio, disponibilidades.data_fim,
            periodicidades.tipo as tipo_periodicidade, periodicidades.data_fim as data_fim_periodicidade');
        $this->db->from('Disponibilidades as disponibilidades');

        $this->db->join('Utilizadores_Disponibilidades as utilizadores_disponibilidades',
            'disponibilidades.id = utilizadores_disponibilidades.id_disponibilidade');

        $this->db->join('Utilizadores as utilizadores', 'utilizadores.id = utilizadores_disponibilidades.id_utilizador');
        $this->db->join('Periodicidades as periodicidades', 'periodicidades.id_disponibilidade = disponibilidades.id');
        $this->db->where('utilizadores_disponibilidades.id_utilizador', $id_utilizador);

        return $this->db->get();
    }

    function insert_entry($id_utilizador, $input)
    {
        $this->load->model('Periodicidade', 'periodicidade');

        $disponibilidades = $this->input->post('disponibilidades');

        foreach ($disponibilidades as $index => $disponibilidade) {
            // inserir disponibilidade
            $data_disponibilidade = $this->get_signup_form_data($disponibilidade);
            $this->db->insert('Disponibilidades', $data_disponibilidade);
            $id_disponibilidade = $this->db->insert_id();

            // criar join table
            $data_utilizadores_disponibilidades = array(
                'id_utilizador'      => $id_utilizador,
                'id_disponibilidade' => $id_disponibilidade
            );

            $this->db->insert('Utilizadores_Disponibilidades', $data_utilizadores_disponibilidades);

            // inserir periodicidade associada ah disponibilidade
            $periodicidades = $this->periodicidade->insert_entry($disponibilidade, $id_disponibilidade);
        }

        return $this->db->insert_id();
    }

    function get_signup_form_data($input)
    {
        $data_inicio = date("Y/m/d", strtotime($input['data_inicio']));
        $data_fim    = date("Y/m/d", strtotime($input['data_fim']));

        $data = array(
            'data_inicio' => $data_inicio,
            'data_fim'    => $data_fim,
        );

        return $data;
    }
}
