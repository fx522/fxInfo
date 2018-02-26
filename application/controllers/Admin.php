<?php
class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profile_model','fx_profile');
    }

    public function toLogin(){
        $this->load->view('admin/login');
    }

    public function do_login()
    {
        $post_data = $this->input->post();
        $user_name = array_key_exists('user_name',$post_data) ? $post_data['user_name'] :'';
        $password = array_key_exists('password',$post_data) ? $post_data['password'] :'';

        $ret = array(
            'code' => '0000',
            'result' => array()
        );

        $login_data = $this->fx_profile->do_login($user_name, $password);
        if( NULL != $login_data ) {
            $ret['result'] = $login_data;
            $this->fx_session->set_userdata('user_name', $user_name);
            $this->fx_session->set_userdata('lasted_login_time', $login_data['last_login_time']);
            $this->fx_session->set_userdata('is_login', TRUE);
        } else {
            $this->fx_session->unset_userdata('user_name');
            $this->fx_session->unset_userdata('lasted_login_time');
            $this->fx_session->unset_userdata('is_login');
            $ret['code'] = '9999';
        }
        cors_header();
        echo json_encode($ret);
    }

    public function do_logout(){
        $logined_name = $this->fx_session->user_name;
        $this->fx_session->unset_userdata('user_name');
        $this->fx_session->unset_userdata('lasted_login_time');
        $this->fx_session->unset_userdata('is_login');
        
        redirect('admin');
        /*
        $ret = array(
            'code' => '0000',
            'logined_name' => $logined_name
        );
        cors_header();
        echo json_encode($ret);
        */
    }

    public function actionLog(){
        $this->fx_profile->logs();

        $page_param = $this->input->get();
        $page = array_key_exists('page',$page_param) ? $page_param['page'] : 0;
        $limit = array_key_exists('limit',$page_param) ? $page_param['limit'] : 0;

        $date_result = $this->fx_profile->logs($page, $limit);

        $ret = array(
            'code' => '0000',
            'count' => $date_result['count'],
            'data' => $date_result['result']
        );

        cors_header();
        echo json_encode($ret);
    }

    public function log(){
        $data['title'] = '操作管理';
        $data['active'] = nav_active('log');

        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/action_log', $data);
        $this->load->view('layout/footer', $data);
    }

    public function webInfo(){
        $serverInfo = array(
            'os' => php_uname(),
            'server' => $_SERVER['SERVER_SOFTWARE'],
            'php' => phpversion(),
            'database' => $this->db->version(),

        );

        $data['title'] = '服务器信息';
        $data['active'] = nav_active('webinfo');
        $data['server_info'] = $serverInfo;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/webserverinfo', $data);
        $this->load->view('layout/footer', $data);
    }
}