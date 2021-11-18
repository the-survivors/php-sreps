<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_prediction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['sales_model', 'items_model']);

        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')) {
            redirect('users/login/verify_users/');
        }
        $users['user_role'] = $this->session->userdata('user_role');

        // check if user role is NOT Manager
        if ($users['user_role'] != "Manager") {
            redirect('users/login/verify_users/');
        }
    }

    public function index()
    {
        $data['title'] = 'PHP-SRePS | Monthly Sales Prediction';
        $data['include_js'] = 'sales_prediction';
        $data['selected'] = 'sales_prediction';

        $data['item_subcategories_data'] = $this->items_model->select_all_item_subcategories();
        //var_dump($this->items_model->select_all_items_in_subcategory(1));

        $this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('sales/sales_prediction_main_view');
        $this->load->view('internal_templates/footer');
    }

    public function fetch_items()
    {
        echo $this->items_model->fetch_items($this->input->post('item_subcategory_id'));
    }

    public function generate_sales_prediction()
    {
        $data['title'] = 'PHP-SRePS | Monthly Sales Prediction';
        $data['include_js'] = 'sales_prediction';
        $data['selected'] = 'sales_prediction';





        // var_dump($this->sales_model->select_item_sale_details_by_months(21));
        // die;
        $three_months_ago = date("Y-m-01", strtotime('-2 month', strtotime(date('Y-m-d')))); // current date - 3 months (01 - first day of the month)
        $three_months_later = date("Y-m-01", strtotime('+3 month', strtotime(date('Y-m-d')))); // current date + 3 months (01 - first day of the month)
        // var_dump($three_months_ago);
        // var_dump($three_months_later);
        // die;

        // var_dump($this->sales_model->select_item_sale_details_by_month(21, date('m')));
        // die;
        // var_dump($this->input->post('item_subcategory_id'));
        // var_dump($this->input->post('item_id'));
        // die;

        $period = new DatePeriod(
            new DateTime($three_months_ago), // first date
            new DateInterval('P1M'),
            new DateTime($three_months_later) // end date
        );

        $data['period'] = $period;

        $date_within_range = array(); // store the range from x-3 to x+3 of month x in this array
        $value_of_date = array();
        foreach ($period as $key => $value) {
            //var_dump($value->format('m')); // im getting the months ady here
            //var_dump($value->format('Y-m-d'));
            $date_within_range[] = $value->format('Y-m-d');
        }
        //var_dump($date_within_range);


        if ($this->input->post('item_id') == "all_items") {

            $all_items = $this->items_model->select_all_items_in_subcategory($this->input->post('item_subcategory_id'));
            $x = 0;
            $items = array();
            $lol = array();

            foreach ($all_items as $item) {
                //         var_dump($item->item_id); 
                var_dump($item->item_name); // 3 copies bc of 3 months.. we are in the months loop

                foreach ($date_within_range as $this_d) { // WILL LOOP 5 TIMES


                    if ($this_d <= date('Y-m-d')) { // WILL LOOP 3 TIMES
                        var_dump($this_d);
                        //   var_dump($item->item_subcategory_id);
                        $one_item = $this->sales_model->select_item_sale_details_by_month($item->item_id, $this_d); // array of sales from 3 months
                        // the thing is INCREASING KDFKGDH 1 -> 2 -> (2+1) 3
                        //   var_dump($one_item);


                        $items[] = $one_item;
                        
                        //die;

                        //   $one = array($one_item);
                        //   foreach($one as $o)
                        //   var_dump($o);
                    }
                }

               // var_dump($items);
                $lol = $items;

                // tie all 3 months to just 1 item (one index of the array)
                //     var_dump($one_item); // ONE ITEM
              //  die;
                //   var_dump( $o);
            }

            var_dump($lol);
            die;
        }


        foreach ($date_within_range as $this_date) {
            // var_dump('this date'); // START OF THIS PARTICULAR MONTH
            //    var_dump($this_date);
            //    var_dump('today is');
            //    var_dump(date('Y-m-d'));
            if ($this_date <= date('Y-m-d')) { // i only want to call the model for the PREVIOUS months. i dont want it to call for the future. 

                if ($this->input->post('item_id') == "all_items") {

                    $all_items = $this->items_model->select_all_items_in_subcategory($this->input->post('item_subcategory_id'));
                    $data['all_items'] = $all_items;
                    $x = 0;

                    //var_dump(count($all_items));
                    foreach ($all_items as $item) {
                        //         var_dump($item->item_id); 
                        var_dump($item->item_name); // 3 copies bc of 3 months.. we are in the months loop
                        $one_item[] = $this->sales_model->select_item_sale_details_by_month($item->item_id, $this_date);
                        $o[$x] = $one_item;
                        $x++;
                        var_dump($one_item);
                        //  die;
                        //        var_dump('END');
                        // $one_item[][] = $value_of_date;
                    }
                    // var_dump($one_item);
                    //die;

                    if ($this->sales_model->select_items_sale_details_by_month($this->input->post('item_subcategory_id'), $this_date) == null) {
                        $value_of_date = null;
                        // var_dump('h');
                        //die;
                        // $value_of_date [][] = (object)
                        // [
                        //     'item_id'=>$item->item_id,
                        //     'item_name'=>$item->item_name,
                        //     'units_sold'=>0,
                        //     'item_price'=>$item->item_price,
                        //     'total_sales'=>0
                        // ];
                    } else {
                        //var_dump($value_of_date);
                        //die;
                        //die;
                        $value_of_date[] = $this->sales_model->select_items_sale_details_by_month($this->input->post('item_subcategory_id'), $this_date);
                        // var_dump($value_of_date);
                        //    die;
                        // var_dump($this->input->post('item_subcategory_id'));
                        // die;

                    }
                } else {
                    $value_of_date[] = $this->sales_model->select_item_sale_details_by_month($this->input->post('item_id'), $this_date);
                }
            }
            //var_dump($this->sales_model->select_item_sale_details_by_month($this->input->post('item_id'), $this_date));
        }
        // var_dump($this->items_model->select_all_items_in_subcategory($this->input->post('item_subcategory_id')));
        // die;
        //      var_dump('AFTER TIME LOOP');
        //     var_dump($o);
        var_dump($one_item);
        //     var_dump('TRYING TO GET 1 ITEM ONLY');
        //     foreach($one_item as $one) {
        //       var_dump($one[0]->units_sold);
        //   }
        //var_dump('value of date');
        //  var_dump($value_of_date); // units sold, item price and total sales of 1 month is grouped into 1 index.
        die;
        // var_dump('for each nowww');
        // var_dump($value_of_date[2][0]->units_sold);
        // foreach($value_of_date as $ok) {
        //var_dump($ok[0]->units_sold);
        // }
        //  die;

        //    $hello =   $this->items_model->select_all_items_in_subcategory($this->input->post('item_subcategory_id'));
        //   var_dump($hello);
        //   die;
        $data['date_within_range'] = $date_within_range;
        $data['value_of_date'] = $value_of_date;
        $data['item_subcategory_data'] = $this->items_model->select_all_items_in_subcategory($this->input->post('item_subcategory_id'));
        $data['item_data'] = $this->items_model->select_item($this->input->post('item_id'));
        $data['item_id'] = $this->input->post('item_id');
        // $data['item_sale_data'] = $this->sales_model->select_item_sale_details_by_month($this->input->post('item_id'), date('m'));
        $data['item_sale_data'] = $this->sales_model->select_item_sale_details_by_months(($this->input->post('item_id')));

        $this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('sales/sales_generated_prediction_view');
        $this->load->view('internal_templates/footer');
    }
}
