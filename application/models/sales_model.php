<?php

class sales_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function insert($data)
    {
        $this->db->insert('sales', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    function insert_sales_item($data)
    {
        $this->db->insert('sales_item', $data);
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
        $this->db->join('items', 'items.item_id = sales_item.item_id');         
        $query = $this->db->get()->result();
        return $query;
    }

    function select_all_item_subcategory()
    {
        return $this->db->get('items_subcategory')->result();
    }


    function fetch_item($item_subcategory_id)  //new function
    {
        $this->db->where('item_subcategory_id', $item_subcategory_id);
        $query = $this->db->get('items');
        
        if ($query->num_rows() > 0) {
            $output = '';
            foreach ($query->result() as $row) {
                $output .= '<option data-price = "'.$row->item_price.'" data-id="'.$row->item_id.'" value="' . $row->item_name . '">' . $row->item_name . '</option>';
            }
        } else {
            $output = '<option value="" selected disabled>No item available</option>';
        }

        return $output;
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
