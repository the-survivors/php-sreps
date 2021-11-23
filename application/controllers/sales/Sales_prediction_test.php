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
        $this->test_select_item_monthly_sales();
        $this->test_select_group_of_items_monthly_sales();
        $this->test_select_item_past_monthly_sales();
        $this->test_moving_average();
        echo $this->unit->report();
    }

    // --------------------- SELECT AN ITEM TESTING --------------------------//

    // checks whether date range consists of 5 months (-2 and +2 from current month)
    private function test_date_range()
    {
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

            switch ($x) {
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

                default:
                    break;
            }

            $x++;
        }
    }

    // checks whether sales records for an item in a particular month is being returned (throughout the start and end of month x)
    private function test_select_item_monthly_sales()
    {
        // using item with ID #21 and getting its sales details from the start and end of November 2021
        $result = $this->sales_model->select_item_sale_details_by_month(21, '2021-11-01');
        $this->unit->run($result[0]->item_price, 36, 'Price of item #21 is 36');
        $this->unit->run($result[0]->units_sold, 11, 'Units sold for item #21 in November 2021 is 11');
        $this->unit->run($result[0]->total_sales, 396, 'Total sales for item #21 in November 2021 is 396');
    }

    // checks whether sales records for a group of items in a particular month is being returned (throughout the start and end of month x)
    private function test_select_group_of_items_monthly_sales()
    {

        $all_items = $this->items_model->select_all_items_in_subcategory(12);

        foreach ($all_items as $item) {

            switch ($item->item_id) {

                case 7:
                    $result = $this->sales_model->select_item_sale_details_by_month(7, '2021-11-01');
                    $this->unit->run($result[0]->item_price, 41.2, 'Price of item #7 is 41.2');
                    $this->unit->run($result[0]->units_sold, 0, 'Units sold for item #7 in November 2021 is 0');
                    $this->unit->run($result[0]->total_sales, 0, 'Total sales for item #7 in November 2021 is 0');
                    break;

                case 20:
                    $result = $this->sales_model->select_item_sale_details_by_month(20, '2021-11-01');
                    $this->unit->run($result[0]->item_price, 42.5, 'Price of item #20 is 42.5');
                    $this->unit->run($result[0]->units_sold, 3, 'Units sold for item #20 in November 2021 is 3');
                    $this->unit->run($result[0]->total_sales, 127.50, 'Total sales for item #20 in November 2021 is 127.50');
                    break;

                case 21:
                    $result = $this->sales_model->select_item_sale_details_by_month(21, '2021-11-01');
                    $this->unit->run($result[0]->item_price, 36, 'Price of item #21 is 36');
                    $this->unit->run($result[0]->units_sold, 11, 'Units sold for item #21 in November 2021 is 11');
                    $this->unit->run($result[0]->total_sales, 396, 'Total sales for item #21 in November 2021 is 396');
                    break;

                default:
                    break;
            }
        }
    }

    // checks whether sales records for an item in a particular month is being returned (throughout the start and end of month x)
    private function test_select_item_past_monthly_sales()
    {
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

        foreach ($date_within_range as $this_date) {

            // getting the sales values of an item based on the past 2 months up until current month (in this case, Sept 2021 - Nov 2021)
            if ($this_date <= date('Y-m-d')) {
                $value_of_date[] = $this->sales_model->select_item_sale_details_by_month(21, $this_date);
            }
        }

        $x = 0;

        for ($y = 0; $y < count($value_of_date); $y++) {

            switch ($x) {
                case 0:
                    $this->unit->run($value_of_date[$x][0]->units_sold, 12, 'Units sold for item #21 in September 2021 is 12');
                    break;

                case 1:
                    $this->unit->run($value_of_date[$x][0]->units_sold, 1, 'Units sold for item #21 in October 2021 is 1');
                    break;

                case 2:
                    $this->unit->run($value_of_date[$x][0]->units_sold, 11, 'Units sold for item #21 in November 2021 is 11');
                    break;

                default:
                    break;
            }

            $x++;
        }
    }

    // --------------------- PREDICTION FORMULA TESTING --------------------------//

    // checks whether the moving average formula (getting the average from 3 months and projecting it to the future month(s)) is returning the correct results
    private function test_moving_average()
    {
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

        foreach ($date_within_range as $this_date) {

            // getting the sales values of an item based on the past 2 months up until current month (in this case, Sept 2021 - Nov 2021)
            if ($this_date <= date('Y-m-d')) {
                $value_of_date[] = $this->sales_model->select_item_sale_details_by_month(21, $this_date);
            }
        }

        $x = 0;
        $total_units_sold = 0;

        // gets units sold and total sales from each month and adds them together (cumulative values from 3 months, Sept 2021 - Nov 2021)
        for ($y = 0; $y < count($value_of_date); $y++) {
            $total_units_sold += $value_of_date[$x][0]->units_sold;
            $x++;
        }

        $this->unit->run($total_units_sold, 24, 'Total units sold for item #21 from Sept 2021 - Nov 2021 is 24');

        // getting the predicted units to be sold for item #21 in the first future month (December 2021) based on the average units sold of the past 3 months
        $predicted_units_first_month = round($total_units_sold / 3);

        // getting the predicted sales for item #21 in the first future month (December 2021) based on the predicted units to be sold
        $predicted_sales_first_month = number_format($predicted_units_first_month * $value_of_date[0][0]->item_price, 2, '.', '');

        $this->unit->run($predicted_units_first_month, 8, 'First monthly prediction of units sold for item #21 is 8');
        $this->unit->run($predicted_sales_first_month, 288, 'First monthly prediction of sales for item #21 is 288');

        /* to get the predicted units sold for the second future month, the average calculation will move forward.
           the predictions are now based from Oct 2021 - Dec 2021 (first future month), where values from the first month used previously (Sept 2021) will be discarded */
        $predicted_units_second_month = round(($total_units_sold + 8 - $value_of_date[0][0]->units_sold)/3);
        $predicted_sales_second_month = number_format($predicted_units_second_month * $value_of_date[0][0]->item_price, 2, '.', '');

        $this->unit->run($predicted_units_second_month, 7, 'Second monthly prediction of units sold for item #21 is 7');
        $this->unit->run($predicted_sales_second_month, 252, 'Second monthly prediction of sales for item #21 is 252');
    }
}
