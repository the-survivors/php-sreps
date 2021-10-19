<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('unit_test');
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->test_users();
        $this->test_login_users();

        echo $this->unit->report();
    }


    public function test_users()
    {
        $users = $this->user_model->index();
        echo $this->unit->run($users, 'is_array', 'Users are in an array');
    }

    public function test_login_users()
    {
       $users_email= $this->user_model->valid_email('jane@gmail.com');
      
       echo $this->unit->run($users_email,  'is_array', 'Check the valid email');
    }

    
}
