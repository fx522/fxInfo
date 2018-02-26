<?php
class Webfront extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Module_model','fx_module');
        $this->load->model('Website_model','fx_website');
        $this->load->model('About_model','fx_about');
        $this->load->model('Hr_model','fx_hr');
        $this->load->model('Post_model','fx_post');
        $this->load->model('Home_model','fx_home');
    }
    // 得到文章列表
    public function index()
    {
        $active_sub_list = array();
        $header_module_data = $this->fx_module->get_modules_position('header');
        foreach($header_module_data as $item => $item_value) {
            $sub = $this->fx_module->get_columns($item_value['module_id']);
            if(count($sub) > 0){
                $header_data[$item] = array(
                    'module_id' => $item_value['module_id'],
                    'module_name' => $item_value['show_name'],
                    'module_type' => $item_value['module_type'],
                    'sub' => $sub
                );
            }
        }
        $footer_module_data = $this->fx_module->get_modules_position('footer');
        foreach($footer_module_data as $item => $item_value) {
            $sub = $this->fx_module->get_columns($item_value['module_id']);
            if(count($sub) > 0){
                $footer_data[$item] = array(
                    'module_id' => $item_value['module_id'],
                    'module_name' => $item_value['show_name'],
                    'module_type' => $item_value['module_type'],
                    'sub' => $sub
                );
            }
        }
        $data = array(
            'site_info' => $this->fx_website->get_website(),
            'nav_header' => $header_data,
            'nav_footer' => $footer_data,
            'current_sub' => $this->fx_module->get_columns($header_module_data[0]['module_id']),
            'footer_width' => (count($footer_data) >= 12)? 1:  floor( 12 / count($footer_data))
        );

        $data['type'] = '';
        $data['main_id'] = '';
        $data['sub_id'] = '';
        $data['is_home'] = TRUE;
        $data['user_name'] = $this->fx_session->user_name;
        $data['home_data'] = $this->fx_home->get_home();

        $this->load->view('layout/preview/header', $data);
        $this->load->view('pages/home', $data);
        $this->load->view('layout/preview/footer', $data);
    }

    public function page($type, $main_id, $belong_id='') 
    {
        $active_sub_list = array();
        $header_module_data = $this->fx_module->get_modules_position('header');
        foreach($header_module_data as $item => $item_value) {
            $sub = $this->fx_module->get_columns($item_value['module_id']);
            if(count($sub) > 0){
                if($main_id == $item_value['module_id']) {
                    $active_sub_list = $sub;
                }

                $header_data[$item] = array(
                    'module_id' => $item_value['module_id'],
                    'module_name' => $item_value['show_name'],
                    'module_type' => $item_value['module_type'],
                    'sub' => $sub
                );
            }
        }
        $footer_module_data = $this->fx_module->get_modules_position('footer');
        foreach($footer_module_data as $item => $item_value) {
            $sub = $this->fx_module->get_columns($item_value['module_id']);
            if(count($sub) > 0){
                $footer_data[$item] = array(
                    'module_id' => $item_value['module_id'],
                    'module_name' => $item_value['show_name'],
                    'module_type' => $item_value['module_type'],
                    'sub' => $sub
                );
            }
        }
        $data = array(
            'site_info' => $this->fx_website->get_website(),
            'nav_header' => $header_data,
            'nav_footer' => $footer_data,
            'current_sub' => $this->fx_module->get_columns($main_id),
            'footer_width' => (count($footer_data) >= 12)? 1:  floor( 12 / count($footer_data))
        );


        if(count($active_sub_list)  == 0) {
            return NULL;
        } else {
            $sub_id = empty($belong_id) ? $active_sub_list[0]['column_id'] : $belong_id;
            $data['current_main_detail'] = $this->fx_module->get_modules($main_id);
            $data['current_sub_detail'] = $this->fx_module->get_column($sub_id);
            if($type == 0 or $type == 1){
                if(null != $this->input->get('detail_id')){
                    // 文章案例详细
                    $detaile_id = $this->input->get('detail_id');
                    $result = $this->fx_post->get_post($detaile_id);
                    $data['result'] = $result;
                    $data['detail_id'] = $detaile_id;
                } else {
                    // 文章案例列表
                    $page=(null != $this->input->get('page'))? $this->input->get('page') : 1;
                    $limit= 5;
                    $result = $this->fx_post->get_posts($main_id, $sub_id, $page, $limit);
                    $data['result'] = is_array($result) ? $result : array('count' => 0, 'result' => array());
                    $data['curr'] = $page;
                    $data['limit'] = $limit;
                }
                

            } else if($type == 2) {
                $result = $this->fx_hr->all($sub_id);
                $data['result'] = is_array($result) ? $result : array();
                // 招聘
            } else if($type == 3) {
                $data['result'] = $this->fx_about->get_about($sub_id);
                // 简介
            } else{
                // error
            }
            $data['type'] = $type;
            $data['main_id'] = $main_id;
            $data['sub_id'] = $sub_id;
            $data['is_home'] = FALSE;
            $this->load->view('layout/preview/header', $data);
            $this->load->view('pages/front_detail', $data);
            $this->load->view('layout/preview/footer', $data);
        }
    }
}