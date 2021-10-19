<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_dashboard_test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('unit_test');
        $this->load->model([
            'sales_model', 'items_model'
        ]);
    }

    public function index()
    {
        $this->test_items();
        $this->test_item_number();
        $this->test_sales();
        $this->test_sales_number();
        echo $this->unit->report();
    }


    public function test_items()
    {
        $items = $this->items_model->select_all_items();
        echo $this->unit->run($items, 'is_array', 'Items are in an array');
    }

    public function test_item_number()
    {
        $items = $this->items_model->select_all_items();
        $count_items=count($items);
        echo $this->unit->run($count_items, 1, 'Counts total number of Items');
    }

    public function test_sales()
    {
        $sales = $this->sales_model->select_all_sales();
        echo $this->unit->run($sales, 'is_array', 'Sales are in an array');
    }

    public function test_sales_number()
    {
        $sales = $this->sales_model->select_all_sales();
        $count_sales=count($sales);
        echo $this->unit->run($count_sales, 3, 'Counts total number of sales');
    }

   

    
}
