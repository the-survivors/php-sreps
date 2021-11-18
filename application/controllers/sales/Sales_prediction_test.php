<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_prediction_test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['sales_model', 'items_model']);
        $this->load->library('unit_test');
    }

    public function index()
    {
        $this->test_date_range();
        echo $this->unit->report();
    }

    // --------------------- SELECT AN ITEM TESTING --------------------------//

    // checks whether date range consists of 5 months (-2 and +2 from current month)
    public function test_date_range() {
        $three_months_ago = date("Y-m-01", strtotime('-2 month', strtotime(date('Y-m-d')))); // current date - 3 months (01 - first day of the month)
        $three_months_later = date("Y-m-01", strtotime('+3 month', strtotime(date('Y-m-d')))); // current date + 3 months (01 - first day of the month)

        $period = new DatePeriod(
            new DateTime($three_months_ago), // first date
            new DateInterval('P1M'),
            new DateTime($three_months_later) // end date
        );

        $date_within_range = array(); // store the range from x-3 to x+3 of month x in this array

        foreach ($period as $key => $value) {
            $date_within_range[] = $value->format('Y-m-d');
        }

        $x = 0;

        // test months are set as the result expected to show from the time of testing (november 2021)
        foreach ($date_within_range as $this_date) {

            switch($x){
                case 0:
                    $this->unit->run($this_date, '2021-09-01', 'First month is September 2021');
                    break;
                
                case 1:
                    $this->unit->run($this_date, '2021-10-01', 'Second month is October 2021');
                    break;

                case 2:
                    $this->unit->run($this_date, '2021-11-01', 'This month is November 2021');
                    break;

                case 3:
                    $this->unit->run($this_date, '2021-12-01', 'Next month is December 2021');
                    break;

                case 4:
                    $this->unit->run($this_date, '2022-01-01', 'Next next month is January 2022');
                    break;
            }

            $x++;
        }
        
    }

    // checks whether sales record for an item in a particular month is being returned
    public function test_select_item() {
 //       $this->sales_model->select_item_sale_details_by_month($this->input->post('item_id'));
        
    }
}
