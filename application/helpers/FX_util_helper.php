<?php

function remote_ip(){
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $res =  preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
    return $res;
}

function nav_active($name){
    $active = array(
        'post' => '',
        'hr' => '',
        'about' =>'',
        'module' => '',
        'website' => '',
        'media' => '',
        'profile' => '',
        'log' => '',
        'webinfo' => '',
        'home' => '',
    );
    $active[$name] = 'layui-this';
    return $active;
}

function base_unid(){
    return "91abd8042b4f3b864757c3acbf10c09a";
}

function cors_header(){
    header('content-type:application:json;charset=utf8');  
    header('Access-Control-Allow-Origin:*');  
    header('Access-Control-Allow-Methods:POST');  
    header('Access-Control-Allow-Headers:x-requested-with,content-type');
    return null;
}

/*
function fx_session_set($user_name){
    $this->fx_session->set_userdata('user_name', $user_name);
    $this->fx_session->set_userdata('is_login', TRUE);
}

function fx_session_clear(){
    $this->fx_session->unset_userdata('user_name');
    $this->fx_session->unset_userdata('is_login');
}
*/