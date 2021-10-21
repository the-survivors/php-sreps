<?php

class sales_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

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

    // public function get_monthly_sales($date1, $date2, $table, $attribute)
    // {
    //     $this->db->select('SUM(sale_total_price) AS total_sales_today')
    //     // $this->db->join('sales', 'sales.sales_id = ' . $table . '.sales_id');
    //     ->from($table);
    //     $this->db->where( $attribute. " BETWEEN '" . $date1 . " 00:00:00' AND '" . $date2 . " 23:59:59' ");
    //     return $this->db->get()->result();
    //    // return $this->db->get()->result($table);

    // }

    public function get_monthly_sales($date1, $date2)
    {
        $this->db->select('SUM(sale_total_price) AS total_sales_month')
            ->from('sales')
            ->where('sale_date' . " BETWEEN '" . $date1 . " 00:00:00' AND '" . $date2 . " 23:59:59' ");
        return $this->db->get()->result();
    }
}
