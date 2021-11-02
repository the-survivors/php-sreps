<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sales_model');
        $this->load->library('unit_test');
		date_default_timezone_set("Asia/Kuala_Lumpur");

	}


}
