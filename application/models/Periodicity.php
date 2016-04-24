<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodicity extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert_entry($periodicity)
    {
        $this->db->insert('Periodicidades', $periodicity);
        return $this->db->insert_id();
    }
}
