<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_prediction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['sales_model', 'items_model']);

        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')) {
            redirect('users/login/verify_users/');
        }
        $users['user_role'] = $this->session->userdata('user_role');

        // check if user role is NOT Manager
        if ($users['user_role'] != "Manager") {
            redirect('users/login/verify_users/');
        }
	}

    public function index() {
        $data['title'] = 'PHP-SRePS | Monthly Sales Prediction';
        $data['include_js'] = 'sales_prediction';
        $data['selected'] = 'sales_prediction';

        $data['item_subcategories_data'] = $this->items_model->select_all_item_subcategories();
        //var_dump($this->items_model->select_all_items_in_subcategory(1));

        $this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('sales/sales_prediction_main_view');
        $this->load->view('internal_templates/footer');
    }

    public function fetch_items(){
        echo $this->items_model->fetch_items($this->input->post('item_subcategory_id'));
    }

    public function generate_sales_prediction(){
        $data['title'] = 'PHP-SRePS | Monthly Sales Prediction';
        $data['include_js'] = 'sales_prediction';
        $data['selected'] = 'sales_prediction';

        // var_dump($this->sales_model->select_item_sale_details_by_months(21));
        // die;
        // $three_months_ago = date("Y-m-01", strtotime ('-3 month', strtotime(date('Y-m-d')))); // current date - 3 months (01 - first day of the month)
        // $three_months_later = date("Y-m-01", strtotime ('+3 month', strtotime(date('Y-m-d')))); // current date + 3 months (01 - first day of the month)
        // var_dump($three_months_ago);
        // var_dump($three_months_later);
        // die;

        // var_dump($this->sales_model->select_item_sale_details_by_month(21, date('m')));
        // die;
        // var_dump($this->input->post('item_subcategory_id'));
        // var_dump($this->input->post('item_id'));
        // die;

        $period = new DatePeriod(
            new DateTime('2010-10-01'), // first date
            new DateInterval('P1M'),
            new DateTime('2011-03-10') // end date
       );

       $data['period'] = $period;
    //    foreach ($period as $key => $value) {
    //     var_dump($value->format('m')); // im getting the months ady here
    //     //$value->format('Y-m-d');
    //    }
    //    die;
       //var_dump($period);
        
        $data['item_subcategory_data'] = $this->items_model->select_all_items_in_subcategory($this->input->post('item_subcategory_id'));
        $data['item_data'] = $this->items_model->select_item($this->input->post('item_id'));
        $data['item_id'] = $this->input->post('item_id');
       // $data['item_sale_data'] = $this->sales_model->select_item_sale_details_by_month($this->input->post('item_id'), date('m'));
        $data['item_sale_data'] = $this->sales_model->select_item_sale_details_by_months(($this->input->post('item_id')));

        $this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('sales/sales_generated_prediction_view');
        $this->load->view('internal_templates/footer');
    }
}
