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
        $data['title'] = 'PHP-SRePS | Items';
        $data['include_js'] = 'items_list';

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
            $edit_link = $base_url."items/Items/edit_item/".$item->item_id;
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

    function add_item()
    {
        $data['title'] = 'PHP-SRePS | Add New Item';
        $data['item_subcategory_data'] = $this->items_model->select_all(); 

		$this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('items/items_add_view');
        $this->load->view('internal_templates/footer');  
    }

    function submit_added_item()
    {

        if($_FILES['item_pic']['name'] != "") {
			$item_pic= $this->upload_img('./assets/img/items', 'item_pic');
		}
        
        $data=
		[
            'item_pic'=>htmlspecialchars($this->input->post('item_pic')),
            'item_subcategory_id'=>htmlspecialchars($this->input->post('item_subcategory_id')),
            'item_supplier'=>htmlspecialchars($this->input->post('item_supplier')),
            'item_name'=>htmlspecialchars($this->input->post('item_name')),
            'item_expiry_date'=>htmlspecialchars($this->input->post('item_expiry_date')),
            'item_description'=>htmlspecialchars($this->input->post('item_description')),
            'item_price'=>htmlspecialchars($this->input->post('item_price')),
			'item_quantity'=>htmlspecialchars($this->input->post('item_quantity'))
		];

        $this->items_model->insert($data);

        $this->session->set_flashdata('insert_message', 1); 
        $this->session->set_flashdata('item_name', $this->input->post('item_name')); 

        redirect('items/Items');
    }

    function edit_item($item_id)
    {
        $data['title'] = 'PHP-SRePS | Edit an Item';
        $data['include_js'] ='item_edit';
        $data['item_data'] = $this->items_model->select_item($item_id); 

		$this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('items/items_edit_view');
        $this->load->view('internal_templates/footer'); 
    }

    function submit_edited_item($item_id)
    {
        if($_FILES['item_pic']['name'] != "") {
            $original_details = $this->items_model->select_item($item_id);
            unlink('./assets/img/items/'.$original_details->item_pic);
			$item_pic = $this->upload_img('./assets/img/items', 'item_pic');
			$data = [
				'item_pic' => $item_pic['file_name'],
			];
			$this->items_model->update($data, $item_id);
		}

        $data=
		[
            'item_subcategory_id'=>htmlspecialchars($this->input->post('item_subcategory_id')),
            'item_supplier'=>htmlspecialchars($this->input->post('item_supplier')),
            'item_name'=>htmlspecialchars($this->input->post('item_name')),
            'item_expiry_date'=>htmlspecialchars($this->input->post('item_expiry_date')),
            'item_description'=>htmlspecialchars($this->input->post('item_description')),
            'item_price'=>htmlspecialchars($this->input->post('item_price')),
			'item_quantity'=>htmlspecialchars($this->input->post('item_quantity')),
            'item_updated_date'=>date('y-m-d') // current date
		];
      
        $this->items_model->update($data, $item_id);

        $this->session->set_flashdata('edit_message', 1); 
        $this->session->set_flashdata('item_name', $this->input->post('item_name')); 

        redirect('items/Items');
    }

    public function upload_img($path, $file_input_name) 
    {
        if ($_FILES){
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_input_name)) 
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                The file format must be in "png, jpg or jpeg"</div>');
                redirect('items/Item');
            } else {
                $doc_data = $this->upload->data();
                return $doc_data;
            }
        }
    }
}
