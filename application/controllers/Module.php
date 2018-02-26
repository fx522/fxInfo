<?php
class Module extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Module_model','fx_module');
    }

    public function index()
    {
        $data['title'] = '栏目管理';
        $data['active'] = nav_active('module');

        $this->load->view('layout/header', $data);
        $this->load->view('admin/columns', $data);
        $this->load->view('layout/footer', $data);
    }

    public function addModulePage()
    {
        $data['title'] = '栏目管理';
        $this->load->view('admin/columns_add', $data);
    }

    public function editModulePage($id){
        $data['title'] = '栏目管理';
        $date_result = $this->fx_module->get_modules($id);
        $this->load->view('admin/columns_edit', $date_result);
    }

    public function editModule(){
    
        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_module->edit_module($post_data['id'], $post_data['title'], $post_data['position'], $post_data['cover_img']);
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

    public function delModule(){

        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_module->del_module($post_data['id']);

            $ret = array(
                'code' => ($intRet > 0) ? '0000' : '9999',
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

    public function allModules(){
        $date_result = $this->fx_module->get_modules();
        $ret = array(
            'code' => '0000',
            'count' => count($date_result),
            'data' => $date_result
        );
        cors_header();
        echo json_encode($ret);
    }

    public function addModule(){

        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_module->set_module($post_data['title'], $post_data['position'], $post_data['type'], $post_data['cover_img']);
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

    public function subColumnPage($id){
        // $data['news'] = $this->news_model->get_news();
        $data['title'] = '栏目管理';
        $data['id'] = $id;
        $this->load->view('admin/columns_sub', $data);
    }

    public function subColumns($id){
        $date_result = $this->fx_module->get_columns($id);
        $ret = array(
            'code' => '0000',
            'count' => count($date_result),
            'data' => $date_result
        );
        cors_header();
        echo json_encode($ret);
    }

    public function addSubColumn(){

        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_module->set_column($post_data['sub_name'], $post_data['module_id']);
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

    public function delSubColumn(){

        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_module->del_column($post_data['column_id']);

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

    public function editSubColumn(){

        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_module->edit_column($post_data['column_id'],$post_data['new_name']);
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