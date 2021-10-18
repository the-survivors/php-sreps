<?php

class items_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function select_all_items()
    {
        return $this->db->get('item')->result();
    }
    

}