<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Items extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
        // $this->load->model([
        //     'user_student_model', 'user_ep_model', 'user_ac_model', 'user_ea_model', 'user_e_model',
        //     'course_applicants_model', 'user_model', 'universities_model', 'employer_projects_model',
        //     'rd_projects_model'
        // ]);
    }

    public function index()
    {
        $data['title'] = 'IT Admin | Items';
        $data['include_js'] = 'items_list';

         $answer = $this->items_model->select_all();
        //  foreach ($answer as $ans)
        //  var_dump($ans);
        //  die;

        $data['items'] = $this->items_model->select_all();

        $this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('items/items_list_view');
        $this->load->view('internal_templates/footer');
    }

    function items_list()
    {
        // Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

        $items = $this->items_model->select_all();

		$data = array();
		$base_url = base_url();

        foreach($items as $item) {
            $edit_link = $base_url."internal/level_2/Employer/Employer_emps/edit_emp/".$item->item_id;
            // echo $item;
            // die;
			$view = '<span><button type="button" onclick="view_emp('.$item->item_id.')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_emp"><span class="fas fa-eye"></span></button></span>';
            $edit_opt = '<span class = "px-1"><a type="button" href = "'.$edit_link.'"class="btn icon-btn btn-xs btn-primary waves-effect waves-light"><span class="fas fa-pencil-alt"></span></a></span>';
            $delete = '<span><button type="button" onclick="delete_emp('.$item->item_id.')" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" ><span class="fas fa-trash"></span></button></span>';
			$function = $view.$edit_opt.$delete;

			$data [] = [ 
				// '',
				$item->item_id,
				$item->item_subcategory_id,
				$item->item_name,
                $item->item_quantity,
                "RM$item->item_price",
                $function,
                $item->item_updated_date
                
            ];

		}

        $output = array(
			"draw" => $draw,
			"recordsTotal" => count($items),
			"recordsFiltered" =>count($items),
			"data" => $data
		);

		echo json_encode($output);
		exit();
    }



}
