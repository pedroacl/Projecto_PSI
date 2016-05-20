<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voluntario extends CI_Model {

    function insert_entry($id_utilizador)
    {
        $this->db->insert('Voluntarios', array('id_utilizador' => $id_utilizador));
        return $this->db->insert_id();
    }

    function get_main_profile($id_utilizador)
    {
        $this->db->select('nome, genero, foto, telefone, data_nascimento');
        $this->db->from('Voluntarios AS v');
        $this->db->join('Utilizadores AS u', 'u.id = v.id_utilizador');
        $this->db->where('u.id', $id_utilizador);

        return $this->db->get();
    }

    public function update_entry($id_voluntario, $data)
    {
        $this->db->where('id', $id_voluntario);
        $this->db->update('Voluntarios', $data);
    }


    function get_by_id_utilizador($id_utilizador)
    {
        $this->db->select('utilizadores.id, utilizadores.email, utilizadores.nome,
            voluntarios.genero, voluntarios.data_nascimento, utilizadores.telefone,
            voluntarios.foto');

        $this->db->from('Utilizadores as utilizadores');
        $this->db->join('Voluntarios as voluntarios', 'utilizadores.id = voluntarios.id_utilizador');
        $this->db->where('utilizadores.id', $id_utilizador);

        return $this->db->get();
    }

    function get_form_data($input)
    {
        $this->load->helper('date');

        $data = array(
            'genero'          => $input['genero'],
            'data_nascimento' => mdate("%Y/%m/%d",  strtotime($input['data_nascimento']))
        );

        return $data;
    }

    public function get_form_validation_rules()
    {
        $rules = array(
            array(
                'field' => 'telefone',
                'label' => 'Telefone',
                'rules' => 'min_length[9]'
            )
/*
            array(
                'field' => 'concelho',
                'label' => 'Concelho',
                'rules' => 'callback_not_default'
            ),
            array(
                'field' => 'distrito',
                'label' => 'Distrito',
                'rules' => 'callback_not_default'
            ),
            array(
                'field' => 'freguesia',
                'label' => 'Freguesia',
                'rules' => 'callback_not_default'
            )*/
        );

        return $rules;
    }

    function upload_photo($id_voluntario)
    {
        // nao foi enviada foto
        if(!file_exists($_FILES['foto']['tmp_name'])
            || !is_uploaded_file($_FILES['foto']['tmp_name'])) {

            return;
        }

        $photo_upload_path       = './uploads/' . $id_voluntario . '/photos';
        $config['upload_path']   = $photo_upload_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '100';
        $config['max_width']     = '1024';
        $config['max_height']    = '768';
        $config['file_name']     = 'avatar';

        $this->load->library('upload', $config);

        // criar directorio do utilizador
        if (!is_dir($photo_upload_path))
        {
            mkdir($photo_upload_path, 0755, true);
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