<?php
class Common extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    private function base_upload($save_path='', $name_type='', $overwrite = FALSE, $localUrl = 'file'){
        $config['upload_path']      = $save_path;
        $config['allowed_types']    = 'gif|jpg|png|jpeg|ico';
        $config['max_size']     = 512;

        $config['overwrite']       = $overwrite;
        if($name_type == 'time'){
            $date = new DateTime();
            $config['file_name']        = $date->format('YmdHis').(string)rand(10000,99999);
        } else if ($name_type == 'random'){
            $config['encrypt_name']     = TRUE;
        } else {
            $config['file_name'] = $name_type;
        }
        $ret = array(
            'code' => '0000',
            'msg' => 'success',
            'result' =>''
        );

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($localUrl)) {
            $ret['code'] = '9999';
            $ret['msg'] = $this->upload->display_errors();
        } else {
            $ret['result'] = $config['upload_path'].$this->upload->data('file_name');;
        }
        return $ret;
    }
    // 文章封面上传
    public function post_upload(){
        if(isset($this->fx_session->user_name)) {
            $ret = $this->base_upload('uploads/','time');
        } else {
            $ret = array(
                'code' => '1000',
                'msg' => 'need login',
            );
        }
        cors_header();
        echo json_encode($ret);
    }

    // 文章内容图片上传
    public function post_attache_upload(){
        if(isset($this->fx_session->user_name)) {
            $ret = $this->base_upload('uploads/attach/','time', FALSE, 'imgFile');
        } else {
            $ret = array(
                'code' => '1000',
                'msg' => 'need login',
            );
        }
        $attach_ret = array(
            'error' => ($ret['code'] == '0000')? 0 : 1,
            'message' => $ret['msg'],
            'url' => base_url('/').$ret['result']
        );
        cors_header();
        echo json_encode($attach_ret);
    }

    // 栏目封面
    public function module_upload(){
        if(isset($this->fx_session->user_name)) {
            $ret = $this->base_upload('uploads/banner/','random');
        } else {
            $ret = array(
                'code' => '1000',
                'msg' => 'need login',
            );
        }
        cors_header();
        echo json_encode($ret);
    }

    // logo上传
    public function logo_upload(){

        if(isset($this->fx_session->user_name)) {
            $ret = $this->base_upload('resource/images/base/', 'fx-logo.png', TRUE);
        } else {
            $ret = array(
                'code' => '1000',
                'msg' => 'need login',
            );
        }
        cors_header();
        echo json_encode($ret);
    }

    // ico上传
    public function ico_upload(){

        if(isset($this->fx_session->user_name)) {
            $ret = $this->base_upload('resource/images/base/', 'fx-ico.ico', TRUE);
        } else {
            $ret = array(
                'code' => '1000',
                'msg' => 'need login',
            );
        }
        cors_header();
        echo json_encode($ret);
    }
}