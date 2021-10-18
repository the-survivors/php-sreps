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

    // Items page
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

        $items = $this->items_model->select_all_items();

		$data = array();
		$base_url = base_url();

        foreach($items as $item) {
            $edit_link = $base_url."items/Items/edit_item/".$item->item_id;
			$view = '<span><button type="button" onclick="view_item('.$item->item_id.')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_item"><span class="fas fa-eye"></span></button></span>';
            $edit_opt = '<span class="px-1"><a type="button" href="'.$edit_link.'"class="btn icon-btn btn-xs btn-primary waves-effect waves-light"><span class="fas fa-pencil-alt"></span></a></span>';
            $delete = '<span><button type="button" onclick="delete_item('.$item->item_id.')" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" ><span class="fas fa-trash"></span></button></span>';
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

    function view_item()
    {
        $item_details = $this->items_model->select_item($this->input->post('item_id'));
        // var_dump($item_details);
        // var_dump('hi');
        // die;

        $output ='
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr style="text-align:center">
                    <td colspan="2"><img src="'.base_url("assets/img/items/").$item_details->item_pic.'" style="width: 250px; height: 150px; object-fit:contain;">
                    </td>  
                </tr>
                <tr>
                    <th scope="row">Item No.</th>
                    <td>'.$item_details->item_id.'</td>
                </tr>
                <tr>
                    <th scope="row">Subcategory</th>
                    <td>'.$item_details->item_subcategory_id.'</td>
                </tr>
                <tr>
                    <th scope="row">Name</th>
                    <td>'.$item_details->item_name.'</td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td style="white-space: pre-wrap; word-break: break-word; text-align: justify;">'.$item_details->item_description.'</td>
                </tr>
                <tr>
                    <th scope="row">Supplier</th>
                    <td>'.$item_details->item_supplier.'</td>
                </tr>
                <tr>
                    <th scope="row">Expiry Date</th>
                    <td>'.$item_details->item_expiry_date.'</td>
                </tr>
                <tr>
                    <th scope="row">Price</th>
                    <td>RM'.$item_details->item_price.'</td>
                </tr>
                <tr>
                    <th scope="row">Quantity At Hand</th>
                    <td>'.$item_details->item_quantity.'</td>
                </tr>
                <tr>
                    <th scope="row">Restock Level</th>
                    <td>'.$item_details->item_restock_level.'</td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }

    function add_item()
    {
        $data['title'] = 'PHP-SRePS | Add New Item';
        $data['item_data'] = $this->items_model->select_all_items(); 

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
            $item_pic_data = $item_pic['file_name'];
		} else {
            $item_pic_data = htmlspecialchars($this->input->post('item_pic'));
        }

        $data=
		[
            'item_pic'=>htmlspecialchars($item_pic_data),
            'item_subcategory_id'=>htmlspecialchars($this->input->post('item_subcategory_id')),
            'item_supplier'=>htmlspecialchars($this->input->post('item_supplier')),
            'item_name'=>htmlspecialchars($this->input->post('item_name')),
            'item_expiry_date'=>htmlspecialchars($this->input->post('item_expiry_date')),
            'item_description'=>htmlspecialchars($this->input->post('item_description')),
            'item_price'=>htmlspecialchars($this->input->post('item_price')),
			'item_quantity'=>htmlspecialchars($this->input->post('item_quantity')),
			'item_restock_level'=>htmlspecialchars($this->input->post('item_restock_level'))
		];

        $this->items_model->insert_item($data);

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
			$this->items_model->update_item($data, $item_id);
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
            'item_restock_level'=>htmlspecialchars($this->input->post('item_restock_level')),
            'item_updated_date'=>date('y-m-d') // current date
		];
      
        $this->items_model->update_item($data, $item_id);

        $this->session->set_flashdata('edit_message', 1); 
        $this->session->set_flashdata('item_name', $this->input->post('item_name')); 

        redirect('items/Items');
    }

    function delete_item()
    {
        $item = $this->items_model->select_item($this->input->post('item_id'));
        unlink('./assets/img/items/'.$item->item_pic);
        $this->items_model->delete_item($this->input->post('item_id'));
    }

    // --------------------- ITEM CATEGORIES --------------------------//
    public function items_categories(){
        $data['title'] = 'PHP-SRePS | Item Categories';
        $data['include_js'] = 'items_list';

        // $item_categories = $this->items_model->select_item_categories_grouping();
        // var_dump($this->items_model->select_all_item_categories());
        // var_dump("ok");
        // var_dump($item_categories);

        // foreach( $item_categories as $a) {
        //     var_dump($a->item_total_subcategories);
        //     var_dump('ok') ;
        // }

        $this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('items/items_categories_list_view');
        $this->load->view('internal_templates/footer');
    }

    function items_categories_list()
    {
        // Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

        $item_categories = $this->items_model->select_item_categories_grouping();
        
		$data = array();
		$base_url = base_url();

        foreach($item_categories as $item_category) {
            $edit_link = $base_url."items/Items/edit_item_category/".$item_category->item_category_id;
            $item_subcategories_page_link = $base_url."items/Items/item_subcategories_list/".$item_category->item_category_id;
            $item_subcategories_page = '<span class="px-1"><a type="button" href="'.$item_subcategories_page_link.'"class="btn" style="background-color: #BAA0CA; color: white;><i class="fas fa-plus pl-2"></i>Add Sub-Category<span class="fas fa-plus pl-2"></span></a></span>';
			$view = '<span><button type="button" onclick="view_item_category('.$item_category->item_category_id.')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_item"><span class="fas fa-eye"></span></button></span>';
            $edit_opt = '<span class="px-1"><a type="button" href="'.$edit_link.'"class="btn icon-btn btn-xs btn-primary waves-effect waves-light"><span class="fas fa-pencil-alt"></span></a></span>';
            $delete = '<span><button type="button" onclick="delete_item_category('.$item_category->item_category_id.')" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" ><span class="fas fa-trash"></span></button></span>';
			$function = $item_subcategories_page.$view.$edit_opt.$delete;

			$data [] = [ 
				'',
				$item_category->item_category_name,
				$item_category->item_total_subcategories,
                $function
            ];

		}

        $output = array(
			"draw" => $draw,
			"recordsTotal" => count($item_categories),
			"recordsFiltered" =>count($item_categories),
			"data" => $data
		);

		echo json_encode($output);
		exit();
    }

    function view_item_category()
    {
        $item_details = $this->items_model->select_item($this->input->post('item_id'));
        // var_dump($item_details);
        // var_dump('hi');
        // die;

        $output ='
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr style="text-align:center">
                    <td colspan="2"><img src="'.base_url("assets/img/items/").$item_details->item_pic.'" style="width: 250px; height: 150px; object-fit:contain;">
                    </td>  
                </tr>
                <tr>
                    <th scope="row">Item No.</th>
                    <td>'.$item_details->item_id.'</td>
                </tr>
                <tr>
                    <th scope="row">Subcategory</th>
                    <td>'.$item_details->item_subcategory_id.'</td>
                </tr>
                <tr>
                    <th scope="row">Name</th>
                    <td>'.$item_details->item_name.'</td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td style="white-space: pre-wrap; word-break: break-word; text-align: justify;">'.$item_details->item_description.'</td>
                </tr>
                <tr>
                    <th scope="row">Supplier</th>
                    <td>'.$item_details->item_supplier.'</td>
                </tr>
                <tr>
                    <th scope="row">Expiry Date</th>
                    <td>'.$item_details->item_expiry_date.'</td>
                </tr>
                <tr>
                    <th scope="row">Price</th>
                    <td>RM'.$item_details->item_price.'</td>
                </tr>
                <tr>
                    <th scope="row">Quantity At Hand</th>
                    <td>'.$item_details->item_quantity.'</td>
                </tr>
                <tr>
                    <th scope="row">Restock Level</th>
                    <td>'.$item_details->item_restock_level.'</td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }

    function add_item_category()
    {
        $data['title'] = 'PHP-SRePS | Add New Item Category';
        $data['item_category_data'] = $this->items_model->select_all_item_categories(); 

		$this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('items/items_categories_add_view');
        $this->load->view('internal_templates/footer');  
    }

    function submit_added_item_category()
    {
        $data=
		[
            'item_category_name'=>htmlspecialchars($this->input->post('item_category_name'))
		];

        $this->items_model->insert_item_category($data);

        $this->session->set_flashdata('insert_message', 1); 
        $this->session->set_flashdata('item_category_name', $this->input->post('item_category_name')); 

        redirect('items/Items/items_categories');
    }

    function edit_item_category($item_category_id)
    {
        $data['title'] = 'PHP-SRePS | Edit an Item Category';
        $data['item_category_data'] = $this->items_model->select_item_category($item_category_id); 

        var_dump($this->items_model->select_item_category($item_category_id));
		$this->load->view('internal_templates/header', $data);
        $this->load->view('internal_templates/sidenav');
        $this->load->view('internal_templates/topbar');
        $this->load->view('items/items_categories_edit_view');
        $this->load->view('internal_templates/footer'); 
    }

    function submit_edited_item_category($item_category_id)
    {
        $data=
		[
            'item_category_name'=>htmlspecialchars($this->input->post('item_category_name'))
		];
      
        $this->items_model->update_item_category($data, $item_category_id);

        $this->session->set_flashdata('edit_message', 1); 
        $this->session->set_flashdata('item_category_name', $this->input->post('item_category_name')); 

        redirect('items/Items/items_categories');
    }

    function delete_item_category()
    {
        $this->items_model->delete_item_category($this->input->post('item_category_id'));
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
