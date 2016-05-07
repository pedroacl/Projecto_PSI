<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Habilitacao_academica extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_by_id_voluntario($id_voluntario)
    {
        $this->db->select('ha.id, data_conclusao, curso, instituto_ensino, nome, descricao');
        $this->db->from('Habilitacoes_Academicas as ha');

        $this->db->join('Tipos_Habilitacoes_Academicas as tha',
            'ha.id_tipo = tha.id');

        $this->db->join('Voluntarios as voluntarios', 'voluntarios.id_habilitacoes_academicas = ha.id');

        $this->db->where('voluntarios.id', $id_voluntario);

        return $this->db->get();
    }

    function insert_entry($id_voluntario, $input)
    {
        $habilitacoes_academicas = $this->get_form_data($input);

        $this->db->insert('Utilizadores_Habilitacoes_Academicas', $habilitacoes_academicas);
        return $this->db->insert_id();
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
