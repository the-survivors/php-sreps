<?php

class template_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert($data)
    {
        $this->db->insert('universities', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('uni_id', $id);
        if ($this->db->update('universities', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('uni_id', $id);
        $this->db->delete('universities');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('universities')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('universities')->result();
    }

    public function valid_email($uni_email)
    {
        return $this->db->get_where('universities', ['uni_email' => $uni_email])->row_array();
    }

    // public function last_uni_id()
    // {
    //  $row = $this->db->select("*")->limit(1)->order_by('uni_id',"DESC")->get("universities")->row();
    //  return $row->uni_id; //it will provide latest or last record id.
    // }

    function select_all_approved_only() //new function 
    {
        $this->db->where('uni_approval', 1);
        return $this->db->get('universities')->result();
    }

    public function uni_details($uni_id)
    {
        return $this->db->get_where('universities', ['uni_id' => $uni_id])->row_array();
    }

    function get_uni_with_id($id)  //new function
    {
        $this->db->where('uni_id', $id);
        return $this->db->get('universities')->result();
    }

    function select_all_sort_list()
    {
        $this->db->where('uni_approval', 1);
        $this->db->order_by('uni_country', 'ASC');
        $this->db->order_by('uni_name', 'ASC');
        return $this->db->get('universities')->result();
    }

    public function uni_max_5()
    {
        $this->db->where('uni_approval', 1);
        $this->db->order_by('uni_submitdate', 'DESC');
        $this->db->limit(5);
        return $this->db->get('universities')->result_array();
    }

    function uni_by_approval($condition)
    {
        $this->db->where('uni_approval', $condition);
        return $this->db->get('universities')->result();
    }
    public function get_uni_detail($uni_id)
    {
       $this->db->where('uni_id',$uni_id);
       return $this->db->get('universities')->row();
    } 

    function fetch_uni_id($uni_name)  //new function
    {
        $this->db->where('uni_name', $uni_name);
        $query= $this->db->get('universities');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $output =$row->uni_id;
            }
        } else {
            $output = '<option value="" selected disabled>No universities available</option>';
        }
        
        return $output;
    }

    function sorted_uni_dropdown()
    {
        $this->db->where('uni_approval', 1);
        $this->db->order_by('uni_name', 'ASC');
        return $this->db->get('universities')->result();
    }

    //select all university order by submitted date
    function all_uni_by_date()
    {
        $this->db->order_by('uni_submitdate', 'DESC');
        return $this->db->get('universities')->result();
    }

    //select all university order by submitted date
    function all_pending_uni_by_date()
    {
        $this->db->where('uni_approval', 0);
        $this->db->order_by('uni_submitdate', 'DESC');
        return $this->db->get('universities')->result();
    }

    function edit_one_approval($uni_id)
    {
        $this->db->where('uni_id ', $uni_id);
        $query = $this->db->get('universities')->row();

        if($query->uni_approval == 0)
        {
            $data = array(
                'uni_approval' => 1
            );

            $this->db->where('uni_id ', $uni_id);
            $this->db->update('universities', $data);
        }
    }


}
