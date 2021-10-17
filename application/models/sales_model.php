<?php

class sales_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function select_all_from_sales()
    {
        return $this->db->get('sales')->result();
    }

    function select_sales_item($sale_id)
    {
        $this->db->select('*');
        $this->db->from('sales_item');
        $this->db->where('sale_id', $sale_id);
        $this->db->join('item', 'item.item_id = sales_item.item_id');         
        $query = $this->db->get()->result();
        return $query;
    }

    function select_all_item_subcategory()
    {
        return $this->db->get('item_subcategory')->result();
    }


    // function select_all()
    // {
    //     $this->db->select('*');
    //     $this->db->from('sales');
    //     $this->db->join('sales_item', 'sales_item.sale_id = sales.sale_id');           
    //     $query = $this->db->get()->result();
    //     return $query;
    // }

}
