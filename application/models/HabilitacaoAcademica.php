<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HabilitacaoAcademica extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_by_id_voluntario($id_voluntario)
    {
        $this->db->select('data_conclusao, curso, instituto_ensino, nome, descricao');
        $this->db->from('Habilitacoes_Academicas as habilitacoes_academicas');
        $this->db->join('Tipos_Habilitacoes_Academicas as tipos_habilitacoes_academicas', 'habilitacoes_academicas.id_tipo = tipos_habilitacoes_academicas.id');
        $this->db->join('Voluntarios as voluntarios', 'voluntarios.id_habilitacoes_academicas = habilitacoes_academicas.id');
        $this->db->where('voluntarios.id', $id_voluntario);

        return $this->db->get();
    }

    function get_habilitacoes_academicas_from_user_id($user_id)
    {
      $this->db->select('id, id_tipo, data_conclusao, curso, instituto_ensino');
      $this->db->from('Habilitacoes_Academicas');
      $this->db->join('Utilizadores_Habilitacoes_Academicas as utilizadores_hab', 'utilizadores_hab.id_habilitacao_academica = Habilitacoes_Academicas.id');
      $this->db->where_in('utilizadores_hab.id_utilizador', $user_id);
      $query = $this->db->get();
      // print_r($query->result());
      return $query->row();
    }

    function insert_entry($input)
    {
        $habilitacoes_academicas = $this->get_signup_form_data($input);
        // verificar se já existe uma area geografica adicionada
        $this->db->select('hab.id, data_conclusao, curso, instituto_ensino');
        $this->db->from('Habilitacoes_Academicas as hab');
        $this->db->join('Tipos_Habilitacoes_Academicas as tipo_hab', 'hab.id_tipo = tipo_hab.id');
        $this->db->where('tipo_hab.id', $habilitacoes_academicas['id_tipo']);
        $this->db->where('data_conclusao', $habilitacoes_academicas['data_conclusao']);
        $this->db->where('curso', $habilitacoes_academicas['curso']);
        $this->db->where('instituto_ensino', $habilitacoes_academicas['instituto_ensino']);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $this->db->insert('Habilitacoes_Academicas', $habilitacoes_academicas);
            return $this->db->insert_id();
        } else {
            return $query->row()->id;
        }
    }

    function get_signup_form_data($input)
    {
        $end_date = date("Y/m/d", strtotime($input->post('data_conclusao_curso')));

        $data = array(
            'id_tipo'          => $input->post('tipo_habilitacao_academica'),
            'curso'            => $input->post('curso'),
            'instituto_ensino' => $input->post('instituto_ensino'),
            'data_conclusao'   => $end_date
        );

        return $data;
    }
}
