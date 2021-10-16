<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'sales_model'
        ]);
    }

    public function index()
    {
        $data['title'] = 'Sales';
        $data['include_js'] = 'sales_list';

        //loading views and passing data to view
        $this->load->view('external_templates/header', $data);
        $this->load->view('sales/sales_list_view');
        $this->load->view('external_templates/footer');
    }


}
