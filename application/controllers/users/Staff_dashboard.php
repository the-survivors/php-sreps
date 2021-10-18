<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'sales_model', 'items_model'

        ]);

        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Staff") {
            $users['user_role'] = $this->session->userdata('user_role');

            if ($users['user_role'] == "IT-admin") {
                //redirect('internal/admin_panel/Admin_dashboard');
                echo "Hello, IT-admin";
            }

            // check user role is  Manager
            else if ($users['user_role'] == "Manager") {
                //redirect('internal/level_2/education_agent/Ea_dashboard');
                echo "Hello, Manager";
            }

            // check user role is staff
            else {
                redirect('users/Staff_dashboard');
            }
        }
    }

    public function index()
    {
        $data['title'] = 'Staff | Dashboard';
        $data['include_js'] = 'staff_dashboard';


        //total sales
        $data['total_sales'] = count($this->sales_model->select_all_sales());
        //total items
        $data['total_items'] = count($this->items_model->select_all_items());

        $this->load->view('internal_templates/header', $data);
        $this->load->view('users/staff_dashboard_view');
        $this->load->view('internal_templates/footer');
    }
}
