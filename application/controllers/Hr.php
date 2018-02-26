<?php
class Hr extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hr_model','fx_hr');
    }

    public function index()
    {
        // $data['news'] = $this->news_model->get_news();
        $data['title'] = '职位管理';

        $this->load->view('layout/header', $data);
        $this->load->view('admin/main', $data);
        $this->load->view('layout/footer', $data);
    }

    // 得到文章列表
    public function all($belong_id = '')
    {
        $date_result = $this->fx_hr->all($belong_id);

        $ret = array(
            'code' => '0000',
            'count' => count($date_result),
            'data' => $date_result
        );

        cors_header();
        echo json_encode($ret);
    }

    public function addPage(){
        $input_data = $this->input->get(array('main'));
        
        $data['hr_belong'] = $input_data['main'];

        $this->load->view('admin/hr_add', $data);
    }

    public function editPage($id){
        $data_result = $this->fx_hr->get_hr($id);
        $data_result['hr_end'] = ($data_result['hr_end'] == '0000-00-00')? '' : $data_result['hr_end'];
        $data_result['hr_number'] = ($data_result['hr_number'] == 0)? '' : $data_result['hr_number'];
        $this->load->view('admin/hr_edit', $data_result);
    }

    public function addHr(){

        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_hr->set_hr( $post_data['data'] );
    
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

    public function editHr(){

        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_hr->edit_hr($post_data['data']);
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

    public function delHr(){

        if(isset($this->fx_session->user_name)) {
            $post_data = $this->input->post();
            $intRet = $this->fx_hr->del_hr($post_data['hr_del_data']);
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