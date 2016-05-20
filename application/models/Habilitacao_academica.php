<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Habilitacao_academica extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_id_voluntario($id_voluntario)
    {
        $this->db->select('ha.id, data_conclusao, curso, instituto_ensino, nome, descricao');
        $this->db->from('Habilitacoes_Academicas as ha');
        $this->db->join('Tipos_Habilitacoes_Academicas as tha',
            'ha.id_tipo = tha.id');
        $this->db->where('ha.id_voluntario', $id_voluntario);

        return $this->db->get();
    }

    public function get_by_id($id_habilitacao)
    {
        $this->db->select('habilitacoes_academicas.id, data_conclusao, curso, instituto_ensino, nome, descricao, habilitacoes_academicas.id_tipo');
        $this->db->from('Habilitacoes_Academicas as habilitacoes_academicas');
        $this->db->join('Tipos_Habilitacoes_Academicas as tipos_habilitacoes_academicas', 'habilitacoes_academicas.id_tipo = tipos_habilitacoes_academicas.id');
        $this->db->where('habilitacoes_academicas.id', $id_habilitacao);

        return $this->db->get();
    }

    public function delete_entry($id_habilitacao_academica)
    {
        $this->db->where('id', $id_habilitacao_academica);
        $this->db->delete('Habilitacoes_Academicas');
    }

    public function insert_entry($data)
    {
        $this->db->insert('Habilitacoes_Academicas', $data);
        return $this->db->insert_id();
    }

    function get_form_data($input)
    {
        $this->load->helper('date');

        $data = array(
            'id_tipo'          => $input['tipo_habilitacao_academica'],
            'curso'            => $input['curso'],
            'instituto_ensino' => $input['instituto_ensino'],
            'data_conclusao'   => mdate("%Y/%m/%d", strtotime($input['data_conclusao']))
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
