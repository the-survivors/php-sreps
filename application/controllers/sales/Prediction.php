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
        $this->load->model('sales_prediction_model');
    }

    public function montly_prediction_card()
    {
        $data['include_js'] = 'prediction_mainpage';
        date_default_timezone_set("Asia/Kuala_Lumpur");

        $date = date('m');
        $data['most_sold_item'] = MAX($this->sales_prediction_model->select_most_sold_item($date));
        $data['most_sold_item_subcategory'] = MAX($this->sales_prediction_model->select_most_sold_item_subcategory($date));

        var_dump($data['most_sold_item']);
       // var_dump($data['most_sold_item_subcategory']);
        $this->load->view('internal_templates/header', $data);
        $this->load->view('sales/prediction_mainpage_view');
        $this->load->view('internal_templates/footer');
    }

   
}
