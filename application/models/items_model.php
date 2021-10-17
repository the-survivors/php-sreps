<?php

class items_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function select_all()
    {
        return $this->db->get('items')->result();
    }

    function select_item($item_id)
    {
        $this->db->where('item_id',$item_id);
        return $this->db->get('items')->row();
    }

    function insert($data)
    {
        $this->db->insert('items', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $item_id)
    {
        $this->db->where('item_id', $item_id);
        if ($this->db->update('items', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($item_id)
    {
        $this->db->where('item_id', $item_id);
        $this->db->delete('items');
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
