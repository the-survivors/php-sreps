<?php

class sales_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function select_all_sales()
    {
        return $this->db->get('sales')->result();
    }
    

}
