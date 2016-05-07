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

    public function delete_entry($id_habilitacao_academica)
    {
        $this->db->where('id', $id_habilitacao_academica);
        $this->db->delete('Habilitacoes_Academicas');
    }

    public function insert_entry($id_voluntario, $input)
    {
        $habilitacoes_academicas = $this->get_form_data($input, $id_voluntario);
        $this->db->insert('Habilitacoes_Academicas', $habilitacoes_academicas);

        return $this->db->insert_id();
    }

    function get_form_data($input, $id_voluntario)
    {
        $end_date = date("Y/m/d", strtotime($input->post('data_conclusao_curso')));

        $data = array(
            'id_tipo'          => $input->post('tipo_habilitacao_academica'),
            'curso'            => $input->post('curso'),
            'instituto_ensino' => $input->post('instituto_ensino'),
            'id_voluntario'    => $id_voluntario,
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
