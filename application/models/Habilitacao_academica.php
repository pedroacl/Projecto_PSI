<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Habilitacao_academica extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_by_id_voluntario($id_voluntario)
    {
        $this->db->select('habilitacoes_academicas.id, data_conclusao, curso, instituto_ensino, nome, descricao');
        $this->db->from('Habilitacoes_Academicas as habilitacoes_academicas');
        $this->db->join('Tipos_Habilitacoes_Academicas as tipos_habilitacoes_academicas', 'habilitacoes_academicas.id_tipo = tipos_habilitacoes_academicas.id');
        $this->db->join('Voluntarios as voluntarios', 'voluntarios.id_habilitacoes_academicas = habilitacoes_academicas.id');
        $this->db->where('voluntarios.id', $id_voluntario);

        return $this->db->get();
    }

    function delete_entry($id_habilitacao_academica)
    {
        $this->db->delete('Habilitacoes_Academicas', array('id' => $id_habilitacao_academica));
    }

    function insert_entry($id_voluntario, $input)
    {
        $habilitacoes_academicas = $this->get_form_data($input);
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

    function get_form_data($input)
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

    function get_form_validation_rules()
    {
        return array(
            array(
                'field' => 'curso',
                'label' => 'Curso',
                'rules' => 'required'
            ),
            array(
                'field' => 'instituto_ensino',
                'label' => 'Instituto Ensino',
                'rules' => 'required'
            ),
            array(
                'field' => 'data_conclusao',
                'label' => 'Data de Conclusão',
                'rules' => 'required'
            )
        );
    }
}
