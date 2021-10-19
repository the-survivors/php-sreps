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

    function update_quantity_from_item($item_id, $item_quantity)
    {
        $this->db->where('item_id', $item_id);
        $this->db->set('item_quantity', 'item_quantity-'.$item_quantity.'', FALSE);
        $this->db->update('items');
    }

    function select_all_from_sales()
    {
        $this->db->select('*');
        $this->db->from('sales');
        $this->db->join('users', 'users.user_id = sales.user_id');      
        $query = $this->db->get()->result();
        return $query;
    }

    function select_sales_item($sale_id)
    {
        $this->db->select('*');
        $this->db->from('sales_item');
        $this->db->where('sale_id', $sale_id);
        $this->db->join('items', 'items.item_id = sales_item.item_id');    
        $this->db->join('items_subcategory', 'items_subcategory.item_subcategory_id = items.item_subcategory_id');      
        $this->db->join('items_category', 'items_category.item_category_id  = items_subcategory.item_category_id');       
        $query = $this->db->get()->result();
        return $query;
    }

    function select_one_sale($sale_id)
    {
        $this->db->where('sale_id', $sale_id);
        return $this->db->get('sales')->row();
    }

    function get_category_only($sale_id)
    {
        $this->db->select('*');
        $this->db->from('sales_item');
        $this->db->where('sale_id', $sale_id);
        $this->db->join('items', 'items.item_id = sales_item.item_id');    
        $this->db->join('items_subcategory', 'items_subcategory.item_subcategory_id = items.item_subcategory_id');      
        $this->db->join('items_category', 'items_category.item_category_id  = items_subcategory.item_category_id');  
        $this->db->group_by('items_category.item_category_id');                                          
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
        $this->db->where('item_quantity !=', 0);
        $query = $this->db->get('items');
        
        if ($query->num_rows() > 0) {
            $output = '';
            foreach ($query->result() as $row) {
                $output .= '<option data-quantity = "'.$row->item_quantity.'" data-price = "'.$row->item_price.'" data-id="'.$row->item_id.'" value="' . $row->item_name . '">' . $row->item_name . '</option>';
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
