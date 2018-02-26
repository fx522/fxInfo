<?php
class Content extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Post_model','fx_post');
        $this->load->model('Module_model','fx_module');
        $this->load->model('Home_model','fx_home');
    }

    public function home_config()
    {
        $data['title'] = '首页配置';
        $data['active'] = nav_active('home');
        $data['result'] = $this->fx_home->get_home();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/home_config', $data);
        $this->load->view('layout/footer', $data);
    }

    public function home_update()
    {
        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_home->edit_home( $post_data['data'] );
    
            $ret = array(
                'code' => (($intRet == 1) ? '0000' : '9999'),
                'msg' => 'success',
            );
        } else {
            $ret = array(
                'code' => '1000',
                'msg' => 'need login',
            );
        }
        cors_header();
        echo  json_encode( $ret );
    }

    //
    // $type = post/hr/about
    // default: post
    //
    public function publish($type='post')
    {
        $_type = $type;
        $_type = (empty($_type)) ? 'post' : $_type;

        $data['active'] = nav_active($_type);

        if($type == 'post'){
            $data['title'] = '文章案例';            
            $opt_module_type = array(0, 1);
            
        } else if($type == 'hr') {
            $data['title'] = '招聘信息';
            $opt_module_type = array(2);
        } else if($type == 'about') {
            $data['title'] = '关于我们';
            $opt_module_type = array(3);
        } else {
            $data['title'] = '...';
        }
        
        $modules = $this->fx_module->get_modules($opt_module_type);
        if(count($modules) >0){
            $columns = $this->fx_module->get_columns($modules[0]['module_id']);
        } else {
            $columns = NULL;
        }
        $data['modules'] = $modules;
        $data['columns'] = $columns;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/'.$_type, $data);
        $this->load->view('layout/footer', $data);
    }

    // 得到文章列表
    public function posts($main = -1,$sub = -1)
    {
        $page_param = $this->input->get();
        $page = array_key_exists('page',$page_param) ? $page_param['page'] : 0;
        $limit = array_key_exists('limit',$page_param) ? $page_param['limit'] : 0;

        $date_result = $this->fx_post->get_posts($main, $sub, $page, $limit);

        $ret = array(
            'code' => '0000',
            'count' => $date_result['count'],
            'data' => $date_result['result']
        );

        cors_header();
        echo json_encode($ret);
    }

    public function addPage(){
        $data['title'] = '文章管理';

        $input_data = $this->input->get(array('main', 'sub'));
        $module = $this->fx_module->get_modules($input_data['main']);
        $column = $this->fx_module->get_column($input_data['sub']);
        
        $data['module_id'] = $input_data['main'];
        $data['module_name'] = $module['show_name'];
        $data['column_id'] = $input_data['sub'];
        $data['column_name'] = $column['column_name'];

        $this->load->view('admin/post_add', $data);
    }

    public function editPage($id){
        $data['title'] = '栏目管理';
        $date_result = $this->fx_post->get_post($id);

        $module = $this->fx_module->get_modules($date_result['first_belong']);
        $column = $this->fx_module->get_column($date_result['second_belong']);
        
        $data['module_id'] = $date_result['first_belong'];
        $data['module_name'] = $module['show_name'];
        $data['column_id'] = $date_result['second_belong'];
        $data['column_name'] = $column['column_name'];
        $data['post_detail'] = $date_result;
        $this->load->view('admin/post_edit', $data);
    }

    public function addPost(){

        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_post->set_post( $post_data['data'] );
    
            $ret = array(
                'code' => (($intRet == 1) ? '0000' : '9999'),
                'msg' => 'success',
            );
        } else {
            $ret = array(
                'code' => '1000',
                'msg' => 'need login',
            );
        }
        cors_header();
        echo  json_encode( $ret );
    }

    public function editPost(){

        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_post->edit_post($post_data['data']);
            $ret = array(
                'code' => (($intRet == 1) ? '0000' : '9999'),
                'msg' => 'success',
            );
        } else {
            $ret = array(
                'code' => '1000',
                'msg' => 'need login',
            );
        }

        cors_header();
        echo  json_encode( $ret );
    }

    public function delPost(){

        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_post->del_post($post_data['post_del_data']);

            $ret = array(
                'code' => ($intRet == 1) ? '0000' : '9999',
                'msg' => 'success',
            );
        } else {
            $ret = array(
                'code' => '1000',
                'msg' => 'need login',
            );
        }

        cors_header();
        echo  json_encode( $ret );
    }
}