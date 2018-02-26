<?php

class Profile_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
        $this->load->library('user_agent');
    }

    private function base_id(){
        return "0f9abd5b96e8dd7a0813ec671055a226";
    }

    public function get_profile(){
        $query = $this->db->get_where('fx_admin', array('admin_id' => $this->base_id()));
        return $query->row_array();
    }

    public function edit_profile_name( $_name )
    {
        $data = array(
            'admin_guest_name' => $_name,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('admin_id', $this->base_id());
        $ret = $this->db->update('fx_admin', $data);
        $log_data = array(
            'log_name' => '修改用户名',
            'log_ret_status' => ($ret == 1) ? 0 : 1
        );
        $this->set_log($log_data);
        return $ret;
    }

    public function edit_profile_password( $_password )
    {
        $data = array(
            'admin_pass' => md5($_password),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('admin_id', $this->base_id());
        $ret = $this->db->update('fx_admin', $data);

        $log_data = array(
            'log_name' => '修改密码',
            'log_ret_status' => ($ret == 1) ? 0 : 1
        );
        $this->set_log($log_data);
        return $ret;
    }

    private function update_login_time(){
        $data = array(
            'last_login_time' => date('Y-m-d H:i:s')
        );
        $this->db->where('admin_id', $this->base_id());
        $ret = $this->db->update('fx_admin', $data);
    }

    public function do_login($login_name, $login_password){
        $user_data = $this->get_profile();
        $check_user_name = empty($user_data['admin_guest_name'])? $user_data['admin_name']:$user_data['admin_guest_name'];
        $log_data = array(
            'log_name' => '用户登录',
            'log_ret_status' => ( ($check_user_name == $login_name) && (md5($login_password) == $user_data['admin_pass']) ) ? 0 : 1
        );
        $this->set_log($log_data);

        if( $log_data['log_ret_status'] == 0 ) {
            $this->update_login_time();
            return $user_data;
        } else {
            return NULL;
        }
        // return ($log_data['log_ret_status'] == 0) ? TRUE : FALSE;
    }

    ///////////////////////////////////////////////////////
    public function set_log($obj){
        $add_data = array(
            'log_id' => uniqid(),
            'log_name' => $obj['log_name'],
            'log_ret_status' => $obj['log_ret_status'],
            'log_ip' => remote_ip(),
            'log_brower' => $this->agent->browser(),
            'log_time' => date('Y-m-d H:i:s'),
        );
        return $this->db->insert('fx_admin_log', $add_data);
    }

    private function log_count(){
        $query = $this->db->get('fx_admin_log');
        return $query->num_rows();
    }
    public function logs($page=0, $limit=0){
        if( ($page != 0) && ($limit != 0) ){
            $this->db->limit($limit, ($page-1) * $limit);
        }
        $this->db->order_by('log_time', 'DESC');
        $query = $this->db->get('fx_admin_log');

        $ret = array(
            'count' => $this->log_count(),
            'result' => $query->result_array()
        );
        return $ret;
    }

    public function log_times($log_name, $staus = -1){
        if($staus != 0 && $staus!=1){
            $query = $this->db->get_where('fx_admin_log', array('log_name' => $log_name));
        } else {
            $query = $this->db->get_where('fx_admin_log', array('log_name' => $log_name, 'log_ret_status' => $staus));
        }
        return $query->num_rows();
    }
}