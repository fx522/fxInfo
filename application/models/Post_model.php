<?php

class Post_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }


    private function get_post_count($fist_type=-1,$second_type=-1) {
        if($fist_type == -1)
        {
            $query = $this->db->get('fx_post');
        } else if($fist_type != -1 && $second_type == -1) {
            $query = $this->db->get_where('fx_post', array('first_belong' => $fist_type));

        } else {
            $query = $this->db->get_where('fx_post', 
                    array(
                        'first_belong' => $fist_type,
                        'second_belong' => $second_type,
                        )
            );
        }
        return $query->num_rows();
    }
    public function get_posts($fist_type=-1,$second_type=-1, $page = 0, $limit = 0)
    {
        $this->db->order_by('is_top', 'DESC');
        $this->db->order_by('created_at', 'DESC');
        
        if( ($page != 0) && ($limit != 0) ){
            $this->db->limit($limit, ($page-1) * $limit);
        }

        if($fist_type == -1)
        {
            $query = $this->db->get('fx_post');
        } else if($fist_type != -1 && $second_type == -1) {
            $query = $this->db->get_where('fx_post', array('first_belong' => $fist_type));

        } else {
            $query = $this->db->get_where('fx_post', 
                    array(
                        'first_belong' => $fist_type,
                        'second_belong' => $second_type,
                        )
            );
        }

        $ret = array(
            'count' => $this->get_post_count($fist_type, $second_type),
            'result' => $query->result_array()
        );
        return $ret;
    }

    public function get_post($id){
        $query = $this->db->get_where('fx_post', array('post_id' => $id));
        return $query->row_array();
    }

    public function set_post($_postdata)
    {
        $data = array(
            'post_id' => uniqid(),
            'post_title' => $_postdata['title'],
            'post_content' => $_postdata['content'],
            'first_belong' => $_postdata['module'],
            'second_belong' => $_postdata['column'],
            'post_cover_image' => $_postdata['cover'],
            'is_top' => (array_key_exists('is_top',$_postdata) ? 1 : 0),
            'is_recommend' => (array_key_exists('is_recommend',$_postdata) ? 1 : 0),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $_postdata['created_by'],
            'show_publishd_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('fx_post', $data);
    }

    public function edit_post($_postdata)
    {
        $data = array(
            'post_title' => $_postdata['title'],
            'post_content' => $_postdata['content'],
            'post_cover_image' => $_postdata['cover'],
            'is_top' => (array_key_exists('is_top',$_postdata) ? 1 : 0),
            'is_recommend' => (array_key_exists('is_recommend',$_postdata) ? 1 : 0),
            'created_by' => $_postdata['created_by'],
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('post_id', $_postdata['post_id']);
        return $this->db->update('fx_post', $data);
    }

    public function del_post($del_data) {
        if(is_array($del_data)) {

            $num = count($del_data);  
            for($i=0;$i<$num;$i++){  
                $del_ids[$i] =  $del_data[$i]['post_id'];  
            }
            $this->db->where_in('post_id', $del_ids);
            return $this->db->delete('fx_post');
        } else {
            return $this->db->delete('fx_post', array('post_id' => $del_data));
        }
    }
}