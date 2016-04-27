<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voluntario extends CI_Model {

    function insert_entry($input, $id_utilizador, $id_area_geografica, $id_habilitacoes_academicas)
    {
        $voluntario = $this->get_signup_form_data($input, $id_utilizador, $id_area_geografica, $id_habilitacoes_academicas);

        $this->db->insert('Voluntarios', $voluntario);

        return $this->db->insert_id();
    }
/*
    function get_volunteer_by_email($email)
    {
        // $query = $this->db->get('utilizadores', 1);
        $this->db->select('email, password, salt');
        $this->db->from('Utilizadores utilizadores');
        $this->db->join('Voluntarios voluntarios', 'voluntarios.id_utilizador = utilizadores.id', 'left');
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query;
    }
*/
    function get_voluntario_by_id($id_utilizador)
    {
        $this->db->select('');
        $this->db->from('Utilizadores as utilizadores');
        $this->db->join('Voluntarios as voluntarios', 'utilizadores.id = voluntarios.id_utilizador');
        $this->db->where('id', $id_utilizador);

        return $this->db->get();
    }

    function get_signup_form_data($input, $id_utilizador, $id_area_geografica, $id_habilitacoes_academicas)
    {
        $data_nascimento = $newDate = date("Y/m/d", strtotime($input->post('data_nascimento')));

        $data = array(
            'genero'                     => $input->post('genero'),
            'data_nascimento'            => $data_nascimento,
            'id_utilizador'              => $id_utilizador,
            'id_area_geografica'         => $id_area_geografica,
            'id_habilitacoes_academicas' => $id_habilitacoes_academicas
        );

        return $data;
    }

    function get_form_validation_rules()
    {
        $rules = array(
            array(
                'field' => 'telefone',
                'label' => 'Telefone',
                'rules' => 'required|min_length[9]'
            ),
            /*
            array(
                'field' => 'area_geografica_id',
                'label' => 'Areas Geograficas',
                'rules' => 'required'
            ),
            */
            array(
                'field' => 'data_nascimento',
                'label' => 'Data de Nascimento',
                'rules' => 'required'
            ),
            array(
                'field' => 'grupos_atuacao[]',
                'label' => 'Grupos Atuação',
                'rules' => 'required'
            ),
            array(
                'field' => 'areas_interesse[]',
                'label' => 'Areas Interesse',
                'rules' => 'required'
            ),
            array(
                'field' => 'concelho',
                'label' => 'Concelho',
                'rules' => 'required'
            ),
            array(
                'field' => 'distrito',
                'label' => 'Distrito',
                'rules' => 'required'
            ),
            array(
                'field' => 'freguesia',
                'label' => 'Freguesia',
                'rules' => 'required'
            ),
            array(
                'field' => 'tipo_habilitacao_academica',
                'label' => 'Habilitacoes Academicas',
                'rules' => 'required'
            ),
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
                'field' => 'data_conclusao_curso',
                'label' => 'Data de Conclusão',
                'rules' => 'required'
            ),
            array(
                'field' => 'disponibilidades[]',
                'label' => 'Disponibilidade',
                'rules' => 'required'
            )
        );

        return array_merge($rules, $this->utilizador->get_form_validation_rules());
    }

}