<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prediction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sales_model');

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
        $data['title'] = 'PHP-SRePS | Monthly Prediction';
        //$data['include_js'] = 'items_list';
        $data['selected'] = 'items';

        $this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('sales/prediction_main_view');
        $this->load->view('internal_templates/footer');
    }

    public function generate_prediction($item_subcategory_id, $item_id){
        $item_subcategory_id = $this->input->post('item_subcategory_id');
        $item_id = $this->input->post('item_id');

        $data=
		[
            'item_subcategory_id'=>htmlspecialchars($this->input->post('item_subcategory_id')),
            'item_id'=>htmlspecialchars($this->input->post('item_id')),
		];

        // model to select sales + sales_item
    }
}
