<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Items_test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
        $this->load->library('unit_test');
    }

    public function index()
    {
        $this->test_items_in_array();
        $this->test_count_of_items();
        //$this->test_insert_item();
        $this->test_items_list();
        $this->test_update_item();
        echo $this->unit->report();
        //echo phpinfo();
    }

    // --------------------- ADD AN ITEM TESTING --------------------------//

    // checks whether items objects are in an array (using select_all)
    public function test_items_in_array() {
        $items = $this->items_model->select_all();
        $this->unit->run($items, 'is_array', 'Items are in an array');
    }

    // cehcks the total count of items (using select_all)
    public function test_count_of_items(){
        $items = $this->items_model->select_all();
        $items_total = count($items);
        $this->unit->run($items_total, 25, 'Counts total number of Items');
    }

    // cehcks if an item can be added in the database
    // determines whether records increase by 1 (using insert)
    public function test_insert_item() {

        $before_adding = count($this->items_model->select_all());
        $after_adding = $before_adding + 1;
        $data=[
            'item_pic'=>'unit_test.png',
            'item_subcategory_id'=>'100',
            'item_supplier'=>'unit test supplier',
            'item_name'=>'unit test name',
            'item_expiry_date'=>'2021-10-17',
            'item_description'=>'description for unit test',
            'item_price'=>'RM100.50',
			'item_quantity'=>'99'
        ];
        $this->items_model->insert($data);
        $this->unit->run(count($this->items_model->select_all()), $after_adding, 'After submitting added item, database records increase by 1');
    }

    // --------------------- DISPLAY AN ITEM TESTING --------------------------//

    // checks if select_all can get more than 1 item which will be printed out as a list later
    public function test_items_list(){
        $items = $this->items_model->select_all();
        $first_item_name = $items[0]->item_name;
        $second_item_name = $items[1]->item_name;
        $this->unit->run($first_item_name, 'Diabetmin', 'Item 1 in the list');
        $this->unit->run($second_item_name, 'Glucophage XR 500mg Tablet', 'Item 2 in the list');
    }

    // --------------------- EDIT AN ITEM TESTING --------------------------//

    // checks if a specific item can be selected for editing
    public function test_select_item(){
        $item = $this->items_model->select_item(1);
        $this->unit->run($item->item_name, 'Diabetmin', 'Item with ID: 1');
    }
    
    // checks if a specific item's values can be edited
    public function test_update_item(){
        $before_editing = $this->items_model->select_item(4);
        $this->unit->run($before_editing->item_name, 'item4', 'Before editing Item with ID: 4');

        $data = [
            'item_name'=>'editeditem4'
        ];
        $this->items_model->update($data, 4);

        $after_editing = $this->items_model->select_item(4);
        $this->unit->run($after_editing->item_name, 'editeditem4', 'After editing Item with ID: 4');
    }
}
