<?php
class Media extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('About_model','fx_about');
    }
    // 得到文章列表
    public function index()
    {
        // $data['news'] = $this->news_model->get_news();
        $data['title'] = '站点信息';
        $active = array(
            'post' => '',
            'hr' => '',
            'about' =>'',
            'module' => '',
            'website' => '',
            'media' => '',
        );
        $active['media'] = 'layui-this';
        $data['active'] = $active;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/media', $data);
        $this->load->view('layout/footer', $data);
    }
}