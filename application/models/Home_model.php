<?php

class Home_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function get_home(){
        $query = $this->db->get_where('fx_home', array('home_id' => base_unid()));
        return $query->row_array();
    }

    public function edit_home( $_post_data )
    {
        $data = array(
            'home_banner' => $_post_data['home_banner'],
            'section_1_title' => $_post_data['section_1_title'],
            'section_1_desc' => $_post_data['section_1_desc'],
            'section_1_img' => $_post_data['section_1_img'],
            'section_2_title' => $_post_data['section_2_title'],
            'section_2_desc' => $_post_data['section_2_desc'],
            'section_2_img' => $_post_data['section_2_img']
        );
        $this->db->where('home_id', base_unid());
        return $this->db->update('fx_home', $data);
    }
}