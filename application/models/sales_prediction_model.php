<?php
class sales_prediction_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function select_most_sold_item($date)
    {
        $this->db->select('SUM(sales_item.sale_item_quantity) as total_quantity,items.item_name,items.item_id')
            ->from('items')
            ->join('sales_item', 'sales_item.item_id =items.item_id')
            ->join('sales', 'sales.sale_id =sales_item.sale_id')
            ->group_by('sales_item.item_id')
            ->where('sale_date' . " BETWEEN '" ."2021-". $date."-01" . " 00:00:00 'AND '" . "2021-". $date."-31"  . " 23:59:59'");
        return $this->db->get()->result();
    }

    function select_most_sold_item_subcategory($date)
    {
        $this->db->select('SUM(sales_item.sale_item_quantity) as total_quantity,item_subcategory_name')
            ->from('items')
            ->join('items_subcategory', 'items_subcategory.item_subcategory_id =items.item_subcategory_id')
            ->join('sales_item', 'sales_item.item_id =items.item_id')
            ->join('sales', 'sales.sale_id =sales_item.sale_id')
            ->group_by('items.item_subcategory_id')
            ->where('sale_date' . " BETWEEN '" ."2021-". $date."-01" . " 00:00:00 'AND '" . "2021-". $date."-31"  . " 23:59:59'");
        return $this->db->get()->result();
    }
}
