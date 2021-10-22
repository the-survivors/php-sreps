<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('user_model');
    }

    public function verify_users()
    {

         //Dont allow user to access login page
         if ($this->session->userdata('has_login') ){  

            // check user role is  IT
            if($this->session->userdata('user_role') =="IT")
            {
                redirect('items/Items');
            }
            // check user role is  Manager
            else if ($this->session->userdata('user_role')=="Manager")
            {
                redirect('users/Dashboard/Manager');
            }
            // check user role is Employee
            else
            {
                redirect('users/Dashboard/Employee');
            }
        }

        $this->form_validation->set_rules('user_email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('user_password','Password','trim|required');
        
        if($this->form_validation->run() ==false)
        {
           redirect('Welcome');
        }
        else
        {
            $this->user_login();
        }     
    }

    private function user_login()
    {
        
        $user_email= $this->input->post('user_email');
        $user_password=$this->input->post('user_password');
        $users=$this->user_model->valid_email($user_email);
       
        // if user exists
        if($users)
        {
            // verify the password
            if($user_password==$users['user_password'])
            {
                
                $data=
                [
                    'user_fname'=>$users['user_fname'],
                    'user_lname'=>$users['user_lname'],
                    'user_email'=>$users['user_email'],
                    'user_role'=>$users['user_role'],
                    'user_id'=>$users['user_id'],
                ];
                
                $this->session->set_userdata($data);
        
                // check user role is IT
                if($users['user_role']=="IT-admin")
                {
                    redirect('items/Items');
                }

                // check user role is Manager
                else if ($users['user_role']=="Manager")
                {
                    redirect('users/Dashboard/Manager');
                }
                //check user role is Employee
                else 
                {
                    redirect('users/Dashboard/Employee');
                }
            }
        }

        // if user account does not exist
        else
        {
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert" id="alert_message">
            Account does not exist!</div>');
            redirect('users/login/verify_users');
        }
    }
}