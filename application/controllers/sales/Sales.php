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
		$data['subcategory_data'] = $this->sales_model->select_all_item_subcategory();

		//loading views and passing data to view
		$this->load->view('internal_templates/header', $data);
		$this->load->view('sales/sales_list_view');
		$this->load->view('internal_templates/footer');
	}

	public function sales_list()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$sales_data = $this->sales_model->select_all_from_sales();

		$data = array();
		$base_url = base_url();

		foreach ($sales_data as $r) {

			$edit_opt = '<span class = "px-1"><a type="button" href = "" class="btn icon-btn btn-xs btn-primary waves-effect waves-light"><span class="fas fa-pencil-alt"></span></a></span>';
			$view = '<span><button type="button" onclick="view_course()" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_course"><span class="fas fa-eye"></span></button></span>';
			$function = $view . $edit_opt;

			$sales_item_data = $this->sales_model->select_sales_item($r->sale_id);
			$list_html = "";
			foreach ($sales_item_data as $q) {
				$list_html .= '<li>' . $q->item_name . " x " . $q->sale_item_quantity . ' - RM' . $q->sale_item_total_price . '</li>';
			}

			$data[] = array(
				'',
				$r->sale_id,
				$r->sale_date,
				$r->sale_total_price,
				"<ul>" . $list_html . "</ul>",
				$function,
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => count($sales_data),
			"recordsFiltered" => count($sales_data),
			"data" => $data
		);

		echo json_encode($output);
		exit();
	}

	function add_sales()
	{
		// print_r($this->input->post('addmore'));
		// die;
		$data =
			[
				'sale_total_price' => htmlspecialchars($this->input->post('sale_total_price')),
				'sale_discounted_price' => htmlspecialchars($this->input->post('sale_discounted_price')),
			];

		$sale_id = $this->sales_model->insert($data);

		foreach ($this->input->post('addmore') as $key => $r) {

			$data =
				[
					'sale_id' => $sale_id,
					'item_id' => $key['item_id']->$r,
					'sale_item_quantity' => $r['sale_item_quantity'],
					'sale_item_discount' => $r['sale_item_discount'],
					'sale_item_total_price' => $r['sale_item_price'],
				];

			$this->sales_model->insert_sales_item($data);
		}

		redirect('sales/sales/');
	}

	function fetch_item()
	{
		echo $this->sales_model->fetch_item($this->input->post('item_subcategory_id'));
	}
}
