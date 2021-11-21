<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sales_model');
		$this->load->library('unit_test');
		date_default_timezone_set("Asia/Kuala_Lumpur");
	}

	public function index()
	{
		//--- Uncomment the following function to run unit test
		// $this->test_sales_in_array();
		// $this->test_count_of_sales();
		// $this->test_insert_sale();
		// $this->test_sales_list();
		// $this->test_select_sale();
		// $this->test_update_sale();
		echo $this->unit->report();
	}

	// --------------------- ADD A SALES TESTING --------------------------//

	// checks whether sales data are in an array
	public function test_sales_in_array()
	{
		$sales_data = $this->sales_model->select_all_from_sales();
		$this->unit->run($sales_data, 'is_array', 'Sales data are in an array');
	}

	// cehcks the total count of items (using select_all)
	public function test_count_of_sales()
	{
		$sales_data = $this->sales_model->select_all_from_sales();
		$total_sales = count($sales_data);
		$this->unit->run($total_sales, 8, 'Counts total number of Sales');   //modfiy
	}

	// cehcks if a sales can be added in the database
	// determines whether records increase by 1 (using insert)
	public function test_insert_sale()
	{

		$before_adding = count($this->sales_model->select_all_from_sales());
		$after_adding = $before_adding + 1;
		$data =
			[
				'sale_total_price' => 20.0,
				'sale_discounted_price' => 15.0,
				'user_id' => 1,
			];

		$returned_id = $this->sales_model->insert($data);
		$this->unit->run(count($this->sales_model->select_all_from_sales()), $after_adding, 'After submitting added sale, database records increase by 1');

		//checks if sales item can be added into the database after a sales is added
		// determines whether records increase by 2 when two sales item are added (using insert)
		$before_adding = count($this->sales_model->select_sales_item($returned_id));
		$after_adding = $before_adding + 2;

		for ($i = 0; $i < 2; $i++) {

			$data =
				[
					'sale_id' => $returned_id,
					'item_id' => 10,
					'sale_item_quantity' => 5,
					'sale_item_discount' => 50,
					'sale_item_total_price' => 250,
				];

			$this->sales_model->insert_sales_item($data);
		}
		$this->unit->run(count($this->sales_model->select_sales_item($returned_id)), $after_adding, 'After submitting added sale item, database records increase by 2');

	}

	// --------------------- DISPLAY A SALE TESTING --------------------------//

	// checks if select_all_from_sales can get more than 1 sale which will be printed out as a list later
	public function test_sales_list()
	{
		$sales_data = $this->sales_model->select_all_from_sales();
		$first_sale_id = $sales_data[0]->sale_id;
		$second_sale_id = $sales_data[1]->sale_id;
		$this->unit->run($first_sale_id, 1, 'Sale 1 in the list');
		$this->unit->run($second_sale_id, 2, 'Sale 2 in the list');
	}

	// --------------------- EDIT AN SALE TESTING --------------------------//

	// checks if a specific sale can be selected for editing
	public function test_select_sale()
	{
		$sale = $this->sales_model->select_one_sale(1);
		$this->unit->run($sale->sale_total_price, '8', 'Sale with ID: 1');
	}

	// checks if a specific sale's values can be edited
	public function test_update_sale()
	{
		$before_editing = $this->sales_model->select_one_sale(1);
		$this->unit->run($before_editing->sale_total_price, '8', 'Sale with ID: 1');

		$data = [
			'sale_total_price' => '20'
		];
		$this->sales_model->update_sale($data, 1);

		$after_editing = $this->sales_model->select_one_sale(1);
		$this->unit->run($after_editing->sale_total_price, '20', 'Sale with ID: 1');
	}
}
