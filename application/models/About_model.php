<?php

class About_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function get_about($belong_id='') {
        if(empty($belong_id)) {
            $data = array(
                'about_id' => '',
                'belong_id' => '',
                'about_content' => '',
                'created_at' => '',
                'updated_at' => ''
            );
        } else {
            $this->db->order_by('created_at', 'DESC');
            $query = $this->db->get_where('fx_about', array('belong_id' => $belong_id));
            $ret_data = $query->row_array();

            if(empty($ret_data)) {
                $ret_data = array(
                    'about_id' => '',
                    'belong_id' => '',
                    'about_content' => '',
                    'created_at' => '',
                    'updated_at' => ''
                );
            }

            return $ret_data;
        }
    }

    public function save_about($post_data)
    {
        $ret = 0;
        if(empty($post_data['about_id'])) {
            // new
            $data = array(
                'about_id' => uniqid(),
                'belong_id' => $post_data['column'],
                'about_content' => $post_data['about_content'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $ret = $this->db->insert('fx_about', $data);
        } else {
            // save
            $data = array(
                'about_content' => $post_data['about_content'],
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->where('about_id', $post_data['about_id']);
            $ret = $this->db->update('fx_about', $data);
        }
        return $ret;
    }

    public function del_about($about_id) {
        return $this->db->delete('fx_about', array('about_id' => $about_id));
    }
}