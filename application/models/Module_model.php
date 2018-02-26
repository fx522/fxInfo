<?php

class Module_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    // 查询模块 列表 （参数-1 查询所有模块） 并返回数组
    // 阐述为数组时，根据模块type查询
    public function get_modules($id = -1)
    {
        if(is_array($id)) {
            $this->db->where_in('module_type',$id);
            $query = $this->db->get('fx_module');
            return $query->result_array();
        } else if($id == -1){
            $this->db->order_by('module_type');
            $query = $this->db->get('fx_module');
            return $query->result_array();
        } else  {
            $query = $this->db->get_where('fx_module', array('module_id' => $id));
            return $query->row_array();
        }
    }

    // 增加新的模块
    public function set_module($title, $position, $type, $cover_image){
        $icon_img_path = "resource/images/admin/wenzhang.png";
        switch (intval($type))
        {
        case 0:
            $icon_img_path = "resource/images/admin/wenzhang.png";
            break;  
        case 1:
            $icon_img_path = "resource/images/admin/anli.png";
            break;
        case 2:
            $icon_img_path = "resource/images/admin/zhaopin.png";
            break;  
        case 3:
            $icon_img_path = "resource/images/admin/jieshao.png";
            break;
        default:
            break;
        }
        $data = array(
            'module_id' => uniqid(),
            'module_type' => intval($type),
            'show_name' => $title,
            'show_where' => intval($position),
            'icon_img' => $icon_img_path,
            'cover_img' => $cover_image
        );
        return $this->db->insert('fx_module', $data);
    }

    // 编辑某个模块信息
    public function edit_module($id, $_title,$_position, $_cover_img){
        $this->db->set('show_name', $_title);
        $this->db->set('show_where', $_position);
        $this->db->set('cover_img', $_cover_img);
        $this->db->where('module_id', $id);
        return $this->db->update('fx_module');
    }

    // 删除某个模块信息
    // 该模块所属的子栏目一并被删除
    // ***** 文章并未被删除 ********
    public function del_module($id){
        $subDel =  $this->db->delete('fx_module', array('module_id' => $id));
        if($subDel > 0) {
            $subDel +=  $this->db->delete('fx_column', array('module_id' => $id));
        }
        return $subDel;
    }

//////////////////////////////////////////////////////////////////////////

    // 根据模块ID得多所有栏目
    public function get_columns($module_id){
        $this->db->order_by('created_at');
        $query = $this->db->get_where('fx_column', array('module_id' => $module_id));
        return $query->result_array();
    }

    public function get_modules_position($pos = 'header'){
        $this->db->order_by('module_type',"ASC");
        $this->db->select('*');
        
        $this->db->from('fx_module');
        $this->db->where('show_where',0);
        $this->db->or_where('show_where', ($pos == 'header')? 2: 3);
        // $this->db->join('fx_column', 'fx_column.module_id = fx_module.module_id');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_column($self_id){
        $query = $this->db->get_where('fx_column', array('column_id' => $self_id));
        return $query->row_array();
    }

    // 臧家一个子栏目
    public function set_column($name, $module_id){
        // date_default_timezone_set("Asia/Shanghai");
        $data = array(
            'column_id' => uniqid(),
            'column_name' => $name,
            'module_id' => $module_id,
            'created_at' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('fx_column', $data);
    }

    // 删除一个子栏目
    public function del_column($column_id){
        return $this->db->delete('fx_column', array('column_id' => $column_id));
    }

    // 编辑一个子栏目
    public function edit_column($column_id, $new_name){
        $this->db->set('column_name', $new_name);
        $this->db->where('column_id', $column_id);
        return $this->db->update('fx_column');
    }
}