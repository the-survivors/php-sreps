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
        $this->db->set('item_quantity', 'item_quantity-' . $item_quantity . '', FALSE);
        $this->db->update('items');
    }

    function update_sale($data, $sale_id)
    {
        $this->db->where('sale_id', $sale_id);
        if ($this->db->update('sales', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function return_quantity_to_item($item_id, $item_quantity)
    {
        $this->db->where('item_id', $item_id);
        $this->db->set('item_quantity', 'item_quantity+' . $item_quantity . '', FALSE);
        $this->db->update('items');
    }

    function delete_sales_item($sale_id)
    {
        $this->db->where('sale_id', $sale_id);
        $this->db->delete('sales_item');
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
        $this->db->select('*');
        $this->db->from('sales');
        $this->db->where('sale_id', $sale_id);
        $this->db->join('users', 'users.user_id = sales.user_id');
        $query = $this->db->get()->row();
        return $query;
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


    function fetch_item($item_subcategory_id)
    {
        $this->db->where('item_subcategory_id', $item_subcategory_id);
        $this->db->where('item_quantity !=', 0);
        $query = $this->db->get('items');

        if ($query->num_rows() > 0) {
            $output = '';
            foreach ($query->result() as $row) {
                $output .= '<option data-quantity = "' . $row->item_quantity . '" data-price = "' . $row->item_price . '" data-id="' . $row->item_id . '" value="' . $row->item_name . '">' . $row->item_name . '</option>';
            }
        } else {
            $output = '<option value="" selected disabled>No item available</option>';
        }

        return $output;
    }

    function select_daily_sales($date)
    {
        $this->db->select('*');
        $this->db->from('sales');
        $this->db->join('users', 'users.user_id = sales.user_id');
        $this->db->where('sale_date >=', $date.' 00:00:00');
        $this->db->where('sale_date <=', $date.' 23:59:59');
        $query = $this->db->get()->result();

        return $query;
    }

    function select_weekly_sales($start_date, $end_date)
    {
        $this->db->select('*');
        $this->db->from('sales');
        $this->db->join('users', 'users.user_id = sales.user_id');
        $this->db->where('sale_date >=', $start_date);
        $this->db->where('sale_date <=', $end_date);
        $query = $this->db->get()->result();
        return $query;

    }    

    function select_monthly_sales($month, $year)
    {
        $start_date = $year . "-" . $month . "-01";
        $d = new DateTime($start_date);
        $end_date = $d->format('Y-m-t');

        $this->db->select('*');
        $this->db->from('sales');
        $this->db->join('users', 'users.user_id = sales.user_id');
        $this->db->where('sale_date >=', $start_date);
        $this->db->where('sale_date <=', $end_date);
        $query = $this->db->get()->result();
        return $query;

    }    



}
