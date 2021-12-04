<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_report_test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sales_model');
        $this->load->model('sales_report_model');
		$this->load->library('unit_test');
		date_default_timezone_set("Asia/Kuala_Lumpur");
	}

	public function index()
	{
		$this->test_item_total_sales();
		echo $this->unit->report();
	}

	// --------------------- Testing Sales Report--------------------------//

	// checks if the total sales for a specific item matches the one displayed in the report
	public function test_item_total_sales()
	{
        //Get sales data for the selected November 2021 and for the item 'Alpecin Caffeine Hybrid Shampoo' with an item_id of 21
		$sales_data = $this->sales_model->select_monthly_sales_item(11, 2021);

        //Calculate total sales manually for 'Alpecin Caffeine Hybrid Shampoo'
        $item_total_sales = 0;
        foreach($sales_data as $row){
            if($row->item_id == 21){
                $item_total_sales += $row->sale_item_total_price;
            }
        }
        
        //Get total item sales from report for 'Alpecin Caffeine Hybrid Shampoo'
        $report_data = $this->sales_report_model->select_monthly_sales_report(11, 2021);
        foreach($report_data as $row){
            if($row->item_id == 21){
                $report_item_total_sales = $row->item_total_sale;
            }
        }

        //Test if the total item sales that was counted manually is equal to the total item sales display in the report
		$this->unit->run($item_total_sales, $report_item_total_sales, 'Total item sales that was counted manually matches the total item sales display in the report');
	}

	
}
