<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	/*
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will map to /index.php/welcome/<method_name> @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function index()
	{
		// $this->load->view('welcome_message');

		$data['title'] = 'Admin | Dashboard';
        
		// $data['include_js'] = 'admin_dashboard';

		// Value for bootstrap css and js plugin that is NOT from SB Admin
		// $data['bootstrap_css'] = "";
		// $data['bootstrap_js'] = "";

        $this->load->view('external_templates/header');
        $this->load->view('external_templates/topnav');
        
		// $this->load->view('template_view');
		
		$this->load->view('users/employee_dashboard_view');
        $this->load->view('external_templates/footer');
	}
}