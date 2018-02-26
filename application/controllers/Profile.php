<?php
class Profile extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profile_model','fx_profile');
    }
    // 得到文章列表
    public function index()
    {
        $data['title'] = '个人信息';
        $data['active'] = nav_active('profile');

        $my_infos = $this->fx_profile->get_profile();
        $data['admin_name'] = ($my_infos['admin_guest_name'] == '') ? $my_infos['admin_name'] : $my_infos['admin_guest_name'] ;
        $data['last_login_time'] = $my_infos['last_login_time'] ;
        $data['login_success_times'] = $this->fx_profile->log_times('用户登录', 0);
        $data['login_fail_times'] = $this->fx_profile->log_times('用户登录', 1) ;
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('layout/footer', $data);
    }

    public function edit($type){

        if(isset($this->fx_session->user_name)) {
            if(empty($type) || ($type != 'name' && $type !='password')) {
                $ret = array(
                    'code' => '9999',
                    'msg' => 'failed',
                );
            } else {
                $post_data = $this->input->post();
                if($type == 'name') {
                    $intRet = $this->fx_profile->edit_profile_name( $post_data['new_data']);
                } else {
                    $intRet = $this->fx_profile->edit_profile_password( $post_data['new_data']);
                }
                $ret = array(
                    'code' => (($intRet == 1) ? '0000' : '9999'),
                    'msg' => 'success',
                );
            }
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