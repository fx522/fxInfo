<?php
class Website extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Website_model','fx_website');
    }
    // 得到文章列表
    public function index()
    {
        $data['title'] = '站点信息';
        $data['active'] = nav_active('website');
        $data['result'] = $this->fx_website->get_website();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/website', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save(){
        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_website->edit_website( $post_data['data'] );
    
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
        echo json_encode( $ret );
    }
}