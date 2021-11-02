<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prediction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->helper('form');
        $this->load->model('sales_model');
    }

    public function test()
    {
        $Jan = $this->select_popular_item_sold('2021-01-01', '2021-01-31');
        $Feb = $this->select_popular_item_sold('2021-02-01', '2021-02-28');
        $Mar = $this->select_popular_item_sold('2021-03-01', '2021-03-31');
        $Apr = $this->select_popular_item_sold('2021-04-01', '2021-04-30');
        $May = $this->select_popular_item_sold('2021-05-01', '2021-05-31');
        $Jun = $this->select_popular_item_sold('2021-06-01', '2021-06-30');
        $Jul = $this->select_popular_item_sold('2021-07-01', '2021-07-31');
        $Aug = $this->select_popular_item_sold('2021-08-01', '2021-08-31');
        $Sept = $this->select_popular_item_sold('2021-09-01', '2021-09-30');
        $Oct = $this->select_popular_item_sold('2021-10-01', '2021-10-31');
        $Nov = $this->select_popular_item_sold('2021-11-01', '2021-11-30');
        $Dec = $this->select_popular_item_sold('2021-12-01', '2021-12-31');
        $data['monthly_sales'] =
            [
                $Jan,
                $Feb,
                $Mar,
                $Apr,
                $May,
                $Jun,
                $Jul,
                $Aug,
                $Sept,
                $Oct,
                $Nov,
                $Dec
            ];

        var_dump(MAX($data['monthly_sales']));
        //var_dump(count($data['monthly_sales']));
        $this->load->view('internal_templates/header', $data);
       
        $this->load->view('sales/prediction_page1_view');
        $this->load->view('internal_templates/footer');
    }
    public function select_popular_item_sold($date1, $date2)
    {
        //     $date=date('m');
        //     $data['popular_items_by_month'] = $this->sales_model->select_popular_item_sold($date1, $date2);
        //    // echo $date;
        //    var_dump($data['popular_items_by_month']);
        $total_per_month = $this->sales_model->select_popular_item_sold($date1, $date2);
        return $total_per_month;
    }
}
