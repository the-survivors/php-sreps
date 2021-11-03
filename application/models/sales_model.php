<?php

class sales_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // -------- DASHBOARD -------- //

    function select_all_sales()
    {
        return $this->db->get('sales')->result();
    }

    function select_latest_sales($date)
    {
        $this->db->select('SUM(sale_total_price) AS total_sales_today')
            ->from('sales')
            ->where('sale_date' . " BETWEEN '" . $date . " 00:00:00 'AND '" . $date . " 23:59:59'");
        return $this->db->get()->result();
    }

    public function get_monthly_sales_quantity($date1, $date2, $table, $attribute)
    {
        $this->db->select('SUM(sale_total_price) AS total_sales_today');
        $this->db->where($table . "." . $attribute . " BETWEEN '" . $date1 . " 00:00:00' AND '" . $date2 . " 23:59:59' ");
        return $this->db->count_all_results($table);
    }

    public function get_monthly_sales($date1, $date2)
    {
        $this->db->select('SUM(sale_total_price) AS total_sales_month')
            ->from('sales')
            ->where('sale_date' . " BETWEEN '" . $date1 . " 00:00:00' AND '" . $date2 . " 23:59:59' ");
        return $this->db->get()->result();
    }

    // -------- SALES  -------- //

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

    function fetch_item_image($item_subcategory_id)
    {
        $this->db->where('item_subcategory_id', $item_subcategory_id);
        $this->db->where('item_quantity !=', 0);
        $query = $this->db->get('items');

        $counter = 1;
        if ($query->num_rows() > 0) {
            $output = '';

            foreach ($query->result() as $row) {
                $item_pic = '<img id = "' . $row->item_id . '" onclick="add_image(' . $row->item_id . ')" class="img_item" src="' . base_url("assets/img/items/") . $row->item_pic . '" data-quantity = "' . $row->item_quantity . '"  data-price ="' . $row->item_price . '"  data-name ="' . $row->item_name . '" style="width: 100%;  object-fit:contain; border: 1px solid rgba(0, 0, 0, 0.5);">';
                $output .= '<div class="col-xl-2 my-2"><div class="image_container">' . $item_pic . '<div onclick="add_image(' . $row->item_id . ')" class="content"><center>' . $row->item_name . '</center></div></div></div>';
                $counter++;
            }
        } else {
            $output = '<div class="col-xl-12"><center>No item available</center></div>';
        }

        return $output;
    }

    function fetch_item_image_for_edit($item_subcategory_id)
    {
        $this->db->where('item_subcategory_id', $item_subcategory_id);
        $this->db->where('item_quantity !=', 0);
        $query = $this->db->get('items');

        $counter = 1;
        if ($query->num_rows() > 0) {
            $output = '';

            foreach ($query->result() as $row) {
                $item_pic = '<img id = "' . $row->item_id . '" onclick="add_image(' . $row->item_id . ')" class="img_item" src="' . base_url("assets/img/items/") . $row->item_pic . '" data-quantity = "' . $row->item_quantity . '"  data-price ="' . $row->item_price . '"  data-name ="' . $row->item_name . '" style="width: 100%; height:12.0em; object-fit:contain; border: 1px solid rgba(0, 0, 0, 0.5);">';
                $output .= '<div class="col-xl-2 my-2"><div class="image_container">' . $item_pic . '<div onclick="add_image(' . $row->item_id . ')" class="content"><center>' . $row->item_name . '</center></div></div></div>';
                $counter++;
            }
        } else {
            $output = '<div class="col-xl-12"><center>No item available</center></div>';
        }

        return $output;
    }

    function select_daily_sales($date)
    {
        $this->db->select('*');
        $this->db->from('sales');
        $this->db->join('users', 'users.user_id = sales.user_id');
        $this->db->where('sale_date >=', $date . ' 00:00:00');
        $this->db->where('sale_date <=', $date . ' 23:59:59');
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
