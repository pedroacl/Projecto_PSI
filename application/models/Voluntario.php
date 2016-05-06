<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voluntario extends CI_Model {

    function insert_entry($input)
    {
        $voluntario = $this->get_signup_form_data($input, $id_utilizador, $id_area_geografica, $id_habilitacoes_academicas);

        $this->db->insert('Voluntarios', $voluntario);

        return $this->db->insert_id();
    }

    function get_main_profile($id_voluntario)
    {
        $this->db->select('nome, genero, foto, telefone, data_nascimento, concelho, distrito, freguesia');
        $this->db->from('Voluntarios as v');
        $this->db->join('Areas_Geograficas as ag', 'v.id_area_geografica = ag.id');

        return $this->db->get();
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
    function get_by_id_utilizador($id_utilizador)
    {
        $this->db->select('utilizadores.id, utilizadores.email, utilizadores.nome, voluntarios.genero, voluntarios.data_nascimento, areas_geograficas.distrito, areas_geograficas.concelho, areas_geograficas.freguesia, utilizadores.telefone, voluntarios.foto, voluntarios.id_area_geografica');

        $this->db->from('Utilizadores as utilizadores');
        $this->db->join('Voluntarios as voluntarios', 'utilizadores.id = ' . $id_utilizador);
        $this->db->join('Areas_Geograficas as areas_geograficas', 'areas_geograficas.id = voluntarios.id_area_geografica');

        return $this->db->get();
    }

    function get_signup_form_data($input, $id_utilizador, $id_area_geografica, $id_habilitacoes_academicas)
    {
        $data_nascimento = date("Y/m/d", strtotime($input->post('data_nascimento')));

        $data = array(
            'genero'                     => $input->post('genero'),
            'data_nascimento'            => $data_nascimento,
            'id_utilizador'              => $id_utilizador,
            'id_area_geografica'         => $id_area_geografica,
            'id_habilitacoes_academicas' => $id_habilitacoes_academicas
        );

        return $data;
    }

    function get_update_form_data($input)
    {
        $data = array(
            'genero'          => $input->post('genero'),
            'data_nascimento' => $input->post('data_nascimento'),
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
                'rules' => 'required|callback_not_default'
            ),
            array(
                'field' => 'distrito',
                'label' => 'Distrito',
                'rules' => 'required|callback_not_default'
            ),
            array(
                'field' => 'freguesia',
                'label' => 'Freguesia',
                'rules' => 'required|callback_not_default'
            ),
            array(
                'field' => 'tipo_habilitacao_academica',
                'label' => 'Habilitacoes Academicas',
                'rules' => 'required'
            )

        );

        $this->load->model('Utilizador', 'utilizador');

        return array_merge($rules, $this->utilizador->get_form_validation_rules());
    }

    function upload_photo($id_voluntario)
    {
        $photo_upload_path       = './uploads/' . $id_voluntario . '/photos';
        $config['upload_path']   = $photo_upload_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '100';
        $config['max_width']     = '1024';
        $config['max_height']    = '768';

        $this->load->library('upload', $config);

        // criar directorio do utilizador
        if (!is_dir($photo_upload_path))
        {
            mkdir($photo_upload_path, 0777, true);
        }

        // erro de upload da foto
        if ( ! $this->upload->do_upload('foto'))
        {
            return $this->upload->display_errors();
        }
        // atualizar path da foto
        else
        {
            $upload_data = $this->upload->data();

            $user_data = array(
                'foto' => $photo_upload_path . '/' . $upload_data['file_name']
            );

            $this->db->where('id', $id_voluntario);
            $this->db->update('Voluntarios', $user_data);
        }
    }
}