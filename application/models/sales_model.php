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

    function select_latest_sales()
    {
        $this->db->select_max('sale_date');
        $this->db->select_sum('sale_total_price')
        ->group_by('sale_date');
        $query = $this->db->get('sales'); 
        return $query->result();
        
    }
    

}
