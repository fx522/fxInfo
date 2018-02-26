<?php
class About extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('About_model','fx_about');
    }
    // 得到文章列表
    public function index()
    {
        $post_data = $this->input->post();
        $module_id = isset($post_data['module_id'])? $post_data['module_id'] : '';
        $data_result = $this->fx_about->get_about($module_id);

        $ret = array(
            'code' => '0000',
            'data' => $data_result
        );
        cors_header();
        echo json_encode($ret);
    }

    public function save(){
        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_about->save_about( $post_data['data'] );
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

    public function remove(){
        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_about->del_about($post_data['about_id']);
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