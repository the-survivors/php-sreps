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
        $this->form_validation->set_rules('user_email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('user_password','Password','trim|required');
        
        if($this->form_validation->run() ==false)
        {
            
           // $this->load->view('users/login_view');
           redirect(Welcome);
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
        
                // check user role is IT-admin
                if($users['user_role']=="IT-admin")
                {
                    //redirect('internal/admin_panel/Admin_dashboard');
                    echo "Hello, IT-admin";
                }

                // check user role is  Manager
                else if ($users['user_role']=="Manager")
                {
                    //redirect('internal/level_2/education_agent/Ea_dashboard');
                    echo "Hello, Manager";
                }

                // check user role is staff
                else 
                {
                    redirect('users/Staff_dashboard');
                }
                    
            }
                // if password is incorrect
                else
                {
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert" id="alert_message">
                    Wrong password!</div>');
                    redirect('users/login/verify_users');
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