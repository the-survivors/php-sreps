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
        // $this->db->select_max('sale_date');
        // $this->db->select_sum('sale_total_price')
        // ->group_by('sale_date');
        // $query = $this->db->get('sales'); 
        // return $query->result();

       
             
            //$this->db->select('number_format(SUM(sale_total_price),2, '.', '') AS total_sales_today')
            //$this->db->select('SUM(sale_total_price)')
            $this->db->select('SUM(sale_total_price) AS total_sales_today')
           // $this->db->select('SUM(COALESCE(sale_total_price,0.00)) AS total_sales_today')
            ->from('sales')
            ->where('sale_date'." BETWEEN '". $date." 00:00:00 'AND '".$date." 23:59:59'");
            return $this->db->get()->result();

            

    //     $data1='2021-10-21 00:27:10';
    //    // date("H:i:s",strtotime($data));
    //     $data= date("Y-m-d",strtotime($data1));
    //     //echo $data;
    //     $this->db->select('SUM(sale_total_price) AS total_sales_today')
    //     ->from('sales')
    //     //->group_by('sale_date BETWEEN ""')
    //     //
    //     //->where('sale_date','sale_date BETWEEN "'. date('Y-m-d'). '" and "'. date("Y-m-d H:i:s").'"' )
    //    // ->where('sale_date', 'sale_date = date(Y-m-d) OR sale_date = date("Y-m-d H:i:s")')
    //      ->where('sale_date' ,$data)
    //     //->$this->db->where('sell_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"')
    //     ->group_by('sale_date');
    //     //$this->db->where('sell_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
    //     return $this->db->get()->result();
    }

    // public function get_monthly_sales($date1, $date2, $table, $attribute)
    // {
    //     $this->db->select('SUM(sale_total_price) AS total_sales_today');
    //     // $this->db->join('sales', 'sales.sales_id = ' . $table . '.sales_id');
    //     $this->db->where($table . "." . $attribute . " BETWEEN '" . $date1 . " 00:00:00' AND '" . $date2 . " 23:59:59' ");
    //     return $this->db->count_all_results($table);
    //    // return $this->db->get()->result($table);
      
    // }
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
        ->from('sales');
        // $this->db->join('sales', 'sales.sales_id = ' . $table . '.sales_id');
        $this->db->where( 'sale_date'. " BETWEEN '" . $date1 . " 00:00:00' AND '" . $date2 . " 23:59:59' ");
       // return $this->db->count_all_results($table);
        return $this->db->get()->result();
      
    }

    
    

}
