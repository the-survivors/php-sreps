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

    function select_item($item_id)
    {
        $this->db->where('item_id',$item_id);
        return $this->db->get('items')->row();
    }

    function insert_item($data)
    {
        $this->db->insert('items', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update_item($data, $item_id)
    {
        $this->db->where('item_id', $item_id);
        if ($this->db->update('items', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_item($item_id)
    {
        $this->db->where('item_id', $item_id);
        $this->db->delete('items');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // -------- ITEM CATEGORIES -------- //

    function select_all_item_categories()
    {
        return $this->db->get('items_category')->result();
    }

    function select_item_categories_grouping()
    {
        //return $this->db->get('item_categories')->result();

        $this->db->select('*, COUNT(item_subcategory_id) AS item_total_subcategories')
        ->from('items_subcategory')
        ->join('items_category', 'items_category.item_category_id = items_subcategory.item_category_id', 'right')
        ->group_by('items_category.item_category_id');
        return $this->db->get()->result();
    }

    function select_item_category($item_category_id)
    {
        // $this->db->where('item_category_id',$item_category_id);
        // return $this->db->get('items_category')->row();

        $this->db->select('')
        ->from('items_category')
        ->join('items_subcategory', 'items_subcategory.item_category_id = items_category.item_category_id', 'left')
        ->where('items_category.item_category_id', $item_category_id);
        return $this->db->get()->row();
    }

    function insert_item_category($data)
    {
        $this->db->insert('items_category', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update_item_category($data, $item_category_id)
    {
        $this->db->where('item_category_id', $item_category_id);
        if ($this->db->update('items_category', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_item_category($item_category_id)
    {
        $this->db->where('item_category_id', $item_category_id);
        $this->db->delete('items_category');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // function select_condition($condition)
    // {
    //     $this->db->where($condition);
    //     return $this->db->get('universities')->result();
    // }
}
