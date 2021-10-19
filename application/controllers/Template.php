<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model([
        //     'user_student_model', 'user_ep_model', 'user_ac_model', 'user_ea_model', 'user_e_model',
        //     'course_applicants_model', 'user_model', 'universities_model', 'employer_projects_model',
        //     'rd_projects_model'
        // ]);

        // // Checks if session is set and if user is signed in as Admin (authorised access). If not, deny his/her access.
        // if (!$this->session->userdata('user_id') || $this->session->userdata('user_role') != "Admin") {
        //     redirect('user/login/Auth/login');
        // }

        // // Checks if session is set and if user signed in is not admin. Direct them back to their own dashboard.
        // if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Admin"  ){  

		// 	$users['user_role'] = $this->session->userdata('user_role');

		// 	if($users['user_role']=="Student")
		// 	{
		// 		redirect('external/homepage');
		// 	}
		// 	// check user role is  EA
		// 	else if ($users['user_role']=="Education Agent")
		// 	{
		// 	   redirect('internal/level_2/education_agent/Ea_dashboard');
		// 	}
		// 	// check user role is AC
		// 	else if ($users['user_role']=="Academic Counsellor")
		// 	{
		// 	   redirect('internal/level_2/academic_counsellor/Ac_dashboard');
		// 	}
		// 	// check user role is E
		// 	else if ($users['user_role']=="Employer")
		// 	{
		// 	   redirect('internal/level_2/employer/Employer_dashboard');
		// 	}
		// 	// check user role is  EP
		// 	else if ($users['user_role']=="Education Partner")
		// 	{
		// 	   redirect('internal/level_2/educational_partner/Ep_dashboard');
		// 	}
		// }
    }

    public function index()
    {
        $data['title'] = 'Admin | Dashboard';
        $data['include_js'] = 'admin_dashboard';

		// Value for bootstrap css and js plugin that is NOT from SB Admin
		// $data['bootstrap_css'] = "";
		// $data['bootstrap_js'] = "";

        $this->load->view('external_templates/header');
        $this->load->view('external_templates/sidenav');
        $this->load->view('external_templates/topbar');
        $this->load->view('template_view');
        $this->load->view('external_templates/footer');
    }


}
