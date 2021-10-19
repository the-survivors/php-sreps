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

	//function to load receive data from database and load it into datatable
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
			$view = '<span><button type="button" onclick="view_course()" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_sales"><span class="fas fa-eye"></span></button></span>';
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
				"RM " . $r->sale_total_price,
				$r->user_fname . " " . $r->user_lname,
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
		//initializing arrays
		$item_id = $this->input->post('item_id');
		$sale_item_quantity = $this->input->post('sale_item_quantity');
		$sale_item_discount = $this->input->post('sale_item_discount');
		$sale_item_total_price = $this->input->post('sale_item_price');

		// echo $this->input->post('sale_total_price');
		// die;
		//if there are no item added
		if ($this->input->post('sale_total_price') == 0) {
			$this->session->set_userdata('no_item_message', '<div id = "alert_message" class="alert alert-danger px-4" role="alert">No item selected, please try again</div>');

		} else {
			//initializing sales data and inserting the data into sales table
			$data =
				[
					'sale_total_price' => htmlspecialchars($this->input->post('sale_total_price')),
					'sale_discounted_price' => htmlspecialchars($this->input->post('sale_discounted_price')),
					'user_id' => 1,
				];

			$sale_id = $this->sales_model->insert($data);

			foreach ($item_id as $index => $item_id) {
				//initializing sales_item data and inserting the data into sales_item table row by row
				$data =
					[
						'sale_id' => $sale_id,
						'item_id' => $item_id,
						'sale_item_quantity' => $sale_item_quantity[$index],
						'sale_item_discount' => $sale_item_discount[$index],
						'sale_item_total_price' => $sale_item_total_price[$index],
					];

				$this->sales_model->insert_sales_item($data);
				
				//update item_quantity in items table
				$this->sales_model->update_quantity_from_item($item_id, $sale_item_quantity[$index]);
			}
		}
		
		redirect('sales/sales/');
	}

	function fetch_item()
	{
		echo $this->sales_model->fetch_item($this->input->post('item_subcategory_id'));
	}
}
