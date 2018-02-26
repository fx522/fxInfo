<?php

class Hr_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function all($belong_id = '') {
        if(empty($belong_id)) {
            return NULL;
        } else {
            $this->db->order_by('created_at', 'DESC');
            $query = $this->db->get_where('fx_hr', array('hr_belong' => $belong_id));
            return $query->result_array();
        }
    }

    public function get_hr($id){
        $query = $this->db->get_where('fx_hr', array('hr_id' => $id));
        return $query->row_array();
    }

    public function set_hr($_postdata)
    {
        $data = array(
            'hr_id' => uniqid(),
            'hr_name' => $_postdata['hr_name'],
            'hr_belong' => $_postdata['hr_belong'],
            'hr_number' => $_postdata['hr_number'],
            'hr_end' => $_postdata['hr_end'],
            'hr_desc' => $_postdata['hr_desc'],
            'hr_need_desc' => $_postdata['hr_need_desc'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => 'fx'.'-a'.'dmin',
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('fx_hr', $data);
    }


    public function edit_hr($_postdata)
    {
        $data = array(
            'hr_name' => $_postdata['hr_name'],
            'hr_number' => $_postdata['hr_number'],
            'hr_end' => $_postdata['hr_end'],
            'hr_desc' => $_postdata['hr_desc'],
            'hr_need_desc' => $_postdata['hr_need_desc'],
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('hr_id', $_postdata['hr_id']);
        return $this->db->update('fx_hr', $data);
    }

    public function del_hr($hr_data) {
        if(is_array($hr_data)) {

            $num = count($hr_data);  
            for($i=0;$i<$num;$i++){  
                $hr_ids[$i] = $hr_data[$i]['hr_id'];  
            }
            $this->db->where_in('hr_id', $hr_ids);
            return $this->db->delete('fx_hr');
        } else {
            return $this->db->delete('fx_hr', array('hr_id' => $hr_data));
        }
    }
}