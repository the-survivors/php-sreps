<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'sales_model'
        ]);
        date_default_timezone_set("Asia/Kuala_Lumpur");

        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')) {
            redirect('users/login/verify_users/');
        }
        $users['user_role'] = $this->session->userdata('user_role');

        // check user role is IT
        if ($users['user_role'] != "Manager") {
            redirect('users/login/verify_users/');
        }

    }

    //loads weekly sales report page
    public function weekly_sales_report($start_date = 0, $end_date = 0)
    {
        //get date of 7days from today by default
        if ($end_date == 40) {
            $end = strtotime("+7 day");
            $end_date = date('Y-m-d', $end);
        }

        $data['title'] = 'PHP-SRePS | Weekly Sales';
        $data['selected'] = 'sales';
        $data['selected_period'] = 'weekly';
        $data['sales_data'] = $this->sales_model->select_weekly_sales($start_date, $end_date);
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['include_js'] = 'sales_weekly_report';

        $this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('sales/sales_weekly_report_view');
        $this->load->view('internal_templates/footer');
    }

    //loads monthly sales report page
    public function monthly_sales_report($month = 0, $year = 0)
    {

        $data['title'] = 'PHP-SRePS | Monthly Sales';
        $data['selected'] = 'sales';
        $data['selected_period'] = 'monthly';
        $data['sales_data'] = $this->sales_model->select_monthly_sales($month, $year);
        $data['month'] = $month;
        $data['year'] = $year;
        $data['include_js'] = 'sales_monthly_report';

        $this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('sales/sales_monthly_report_view');
        $this->load->view('internal_templates/footer');
    }
}
