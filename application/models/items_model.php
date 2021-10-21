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
        return $this->db->get('items')->result();
    }

    function show_item_quantity()
    {
        $this->db->select('COUNT(items.item_id), item_category_name') 
        -> from ('items')
        -> join ('items_subcategory', 'items_subcategory.item_subcategory_id = items.item_subcategory_id')
        -> join ('items_category', 'items_category.item_category_id = items_subcategory.item_category_id')
        -> group_by ('items_category.item_category_id')
        -> order_by('COUNT(items.item_id)', 'DESC');
        return $this->db->get()->result_array();
    }

    function show_item_low_on_stock()
    {
        $this->db->select('item_quantity','item_restock_level')
        ->from('items')
        ->where('item_quantity<=item_restock_level');
        return $this->db->get()->result_array();

    }
    

}