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
		
		// $data['bootstrap_css'] = '<link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
		// 	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
		// 	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		// 	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
		// 	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
		// 	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
		// 	<link rel="stylesheet" type="text/css" href="login/css/util.css">
		// 	<link rel="stylesheet" type="text/css" href="login/css/main.css">';

		// $data['bootstrap_js'] = '<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
		// 	<script src="login/vendor/bootstrap/js/popper.js"></script>
		// 	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
		// 	<script src="login/vendor/select2/select2.min.js"></script>
		// 	<script src="login/vendor/tilt/tilt.jquery.min.js"></script>
		// 	<script src="login/js/main.js"></script>';	

		// $this->load->view('internal_templates/header', $data);
		// $this->load->view('users/login_view');
		// $this->load->view('internal_templates/footer');

		$data['title'] = 'SRePS | Manager Dashboard';
        $this->load->view('external_templates/header', $data);
        $this->load->view('external_templates/topnav');
        	
		$this->load->view('users/manager_dashboard_view');
        $this->load->view('external_templates/footer');
	}
}