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

			$edit_link = $base_url . "sales/sales/load_edit_page/" . $r->sale_id;

			$edit_opt = '<span class = "px-1"><a type="button" href = "' . $edit_link . '" class="btn icon-btn btn-lg btn-white waves-effect waves-light"><span style = "color:black;" class="fas fa-pencil-alt"></span></a></span>';
			$view = '<span><button type="button" onclick="view_sale(' . $r->sale_id . ')" class="btn icon-btn btn-lg btn-white waves-effect waves-light" data-toggle="modal" data-target="#view_sales"><span style = "color:black;" class="fas fa-eye"></span></button></span>';
			$function = $view . $edit_opt;

			$category_data = $this->sales_model->get_category_only($r->sale_id);
			$list_html = "";

			foreach ($category_data as $q) {
				$list_html .= '<li>' . $q->item_category_name . '</li>';
			}


			$data[] = array(
				'',
				$r->sale_id,
				$r->sale_date,
				"RM " . number_format($r->sale_total_price, 2, '.', ''),
				"RM " . number_format($r->sale_discounted_price, 2, '.', ''),
				$r->user_fname . " " . $r->user_lname,
				"<ul class = 'category_list'>" . $list_html . "</ul>",
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

	//function for viewing a single sale after user click on the view button
	function view_sale()
	{
		$sale_id = $this->input->post('sale_id');
		$sale_data = $this->sales_model->select_one_sale($sale_id);
		$sale_item_data = $this->sales_model->select_sales_item($sale_id);

		$sale_row_html = '';
		$counter = 0;
		foreach ($sale_item_data as $r) {
			$counter++;
			//implement background color for even number row
			if($counter%2 == 0){$style = 'style = "background:#E4C2C1;"';} else{$style = '';}
			$sale_row_html .= '<tr '.$style.'>
								<td>' . $counter . '</td>
								<td>' . $r->item_id . '</td>
								<td>' . $r->item_subcategory_name . '</td>
								<td>' . $r->item_name . '</td>
								<td>' . $r->sale_item_quantity . '</td>
								<td>' . $r->sale_item_discount . '%</td>
								<td>RM ' . number_format($r->sale_item_total_price, 2, '.', '') . '</td>
							   <tr>';
		}

		$output = '
		<style>
		</style>
		<div class="table-responsive mb-4">
			<table id="table_view_sale" class="table table-striped">
				<thead>
					<tr>
						<th>No.</th>
						<th>Picture of Item</th>
						<th>Subcategories</th>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Discount</th>
						<th>Total Item Price</th>
					</tr>
				</thead>
				<tbody>
					' . $sale_row_html . '
				</tbody>
			</table>
		</div>
		<div class="form-group row">
			<div class="col-xl-6"></div>
			<label for="staticEmail" class="col-xl-2 col-form-label">Total Price</label>
			<div class="col-xl-4">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">RM</span>
					<input type="number"  style="font-weight:600; float:right;" class="form-control" value="' . number_format($sale_data->sale_total_price, 2, '.', '') . '" readonly />
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-xl-6"></div>
			<label for="staticEmail" class="col-xl-2 col-form-label">Discounted Price</label>
			<div class="col-xl-4">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon2">RM</span>
					<input type="number" style="font-weight:600; float:right;" class="form-control" value="' . number_format($sale_data->sale_discounted_price, 2, '.', '') . '" readonly />
				</div>
			</div>
		</div>
        ';

		echo $output;
	}


	function load_edit_page($sale_id)
	{
		$data['title'] = 'Edit Sales';
		$data['include_js'] = 'edit_sales';
		$data['subcategory_data'] = $this->sales_model->select_all_item_subcategory();
		$data['sales_item_data'] = $this->sales_model->select_sales_item($sale_id);
		$data['no_sales_item_data'] = count($this->sales_model->select_sales_item($sale_id));


		//loading views and passing data to view
		$this->load->view('internal_templates/header', $data);
		$this->load->view('sales/sales_edit_view');
		$this->load->view('internal_templates/footer');
	}
}
