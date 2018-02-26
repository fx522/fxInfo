<?php

class Website_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function get_website(){
        $query = $this->db->get_where('fx_website', array('website_id' => base_unid()));
        return $query->row_array();
    }

    public function edit_website( $_post_data )
    {
        $data = array(
            'website_name' => $_post_data['website_name'],
            'website_copyright' => $_post_data['website_copyright'],
            'website_logo' => $_post_data['website_logo'],
            'website_ico' => $_post_data['website_ico'],
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('website_id', base_unid());
        return $this->db->update('fx_website', $data);
    }
}