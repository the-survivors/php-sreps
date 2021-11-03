<?php

class sales_report_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function select_weekly_sales_report($start_date, $end_date)
    {
        $this->db->select('sales_item.item_id, items.item_name, items_subcategory.item_subcategory_name, SUM(sales_item.sale_item_quantity) AS item_total_quantity, SUM(sales_item.sale_item_total_price) AS item_total_sale');
        $this->db->from('sales_item');
        $this->db->join('sales', 'sales.sale_id = sales_item.sale_id');
        $this->db->join('items', 'items.item_id = sales_item.item_id');
        $this->db->join('items_subcategory', 'items_subcategory.item_subcategory_id = items.item_subcategory_id');
        $this->db->where('sales.sale_date >=', $start_date);
        $this->db->where('sales.sale_date <=', $end_date);
        $this->db->group_by("sales_item.item_id");
        $this->db->order_by('SUM(sales_item.sale_item_total_price)', 'DESC');
        $query = $this->db->get()->result();
        return $query;
    }    

    function select_monthly_sales_report($month, $year)
    {
        $start_date = $year . "-" . $month . "-01";
        $d = new DateTime($start_date);
        $end_date = $d->format('Y-m-t');

        $this->db->select('sales_item.item_id, items.item_name, items_subcategory.item_subcategory_name, SUM(sales_item.sale_item_quantity) AS item_total_quantity, SUM(sales_item.sale_item_total_price) AS item_total_sale');
        $this->db->from('sales_item');
        $this->db->join('sales', 'sales.sale_id = sales_item.sale_id');
        $this->db->join('items', 'items.item_id = sales_item.item_id');
        $this->db->join('items_subcategory', 'items_subcategory.item_subcategory_id = items.item_subcategory_id');
        $this->db->where('sales.sale_date >=', $start_date);
        $this->db->where('sales.sale_date <=', $end_date);
        $this->db->group_by("sales_item.item_id");
        $this->db->order_by('SUM(sales_item.sale_item_total_price)', 'DESC');
        $query = $this->db->get()->result();
        return $query;
    }    

    function export_weekly_sales_report($start_date, $end_date)
    {
        $this->db->select('sales_item.item_id, items.item_name, items_subcategory.item_subcategory_name, SUM(sales_item.sale_item_quantity) AS item_total_quantity, SUM(sales_item.sale_item_total_price) AS item_total_sale');
        $this->db->from('sales_item');
        $this->db->join('sales', 'sales.sale_id = sales_item.sale_id');
        $this->db->join('items', 'items.item_id = sales_item.item_id');
        $this->db->join('items_subcategory', 'items_subcategory.item_subcategory_id = items.item_subcategory_id');
        $this->db->where('sales.sale_date >=', $start_date);
        $this->db->where('sales.sale_date <=', $end_date);
        $this->db->group_by("sales_item.item_id");
        $this->db->order_by('SUM(sales_item.sale_item_total_price)', 'DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }    

    function export_monthly_sales_report($month, $year)
    {
        $start_date = $year . "-" . $month . "-01";
        $d = new DateTime($start_date);
        $end_date = $d->format('Y-m-t');

        $this->db->select('sales_item.item_id, items.item_name, items_subcategory.item_subcategory_name, SUM(sales_item.sale_item_quantity) AS item_total_quantity, SUM(sales_item.sale_item_total_price) AS item_total_sale');
        $this->db->from('sales_item');
        $this->db->join('sales', 'sales.sale_id = sales_item.sale_id');
        $this->db->join('items', 'items.item_id = sales_item.item_id');
        $this->db->join('items_subcategory', 'items_subcategory.item_subcategory_id = items.item_subcategory_id');
        $this->db->where('sales.sale_date >=', $start_date);
        $this->db->where('sales.sale_date <=', $end_date);
        $this->db->group_by("sales_item.item_id");
        $this->db->order_by('SUM(sales_item.sale_item_total_price)', 'DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }    



}
