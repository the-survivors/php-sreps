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

        // var_dump($this->input->post('item_subcategory_id'));
        // var_dump($this->input->post('item_id'));
        // // die;
        // $item_subcategory_id = $this->input->post('item_subcategory_id');
        // $item_id = $this->input->post('item_id');

        // $data=
		// [
        //     'item_subcategory_id'=>htmlspecialchars($this->input->post('item_subcategory_id')),
        //     'item_id'=>htmlspecialchars($this->input->post('item_id')),
		// ];

        // model to select sales + sales_item

        $this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('sales/sales_prediction_main_view');
        $this->load->view('internal_templates/footer');
    }
}
