<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?=$title?></title>
  <link href="<?php echo base_url('resource/images/base/favicon.ico') ?>" rel="icon" type="image/x-icon" />
  <link rel="stylesheet" href="<?php echo base_url('resource/vendor/layui/css/layui.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('resource/css/global.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('resource/css/theme/fx-theme.css') ?>">

  <script src="<?php echo base_url('resource/js/jquery-3.2.1.min.js') ?>"></script>
  <script src="<?php echo base_url('resource/vendor/layer-v3.1.0/layer/layer.js') ?>"></script>
  <script src="<?php echo base_url('resource/vendor/layui/layui.js') ?>"></script>
  <script src="<?php echo base_url('resource/js/admin.js') ?>"></script>

  <script>
    ;!function(){
      if(''== '<?=$this->fx_session->user_name?>' ) {
        $('#fx_body').addClass('locked');
        toLogin("<?php echo base_url('admin/toLogin/') ?>");
      }
    }();
  </script>

</head>
<body id="fx_body" class="layui-layout-body fx-theme-winter">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">
      <a href="#">
        <img id="fx-logo" class="fx-logo" src="<?php echo base_url('resource/images/base/fx-logo.png') ?>">
      </a>
    </div>
    <!-- 头部区域（可配合layui已有的水平导航） 
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">商品管理</a></li>
      <li class="layui-nav-item"><a href="">用户</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">邮件管理</a></dd>
          <dd><a href="">消息管理</a></dd>
          <dd><a href="">授权管理</a></dd>
        </dl>
      </li>
    </ul>
    -->
  
      <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item <?=$active['profile']?>">
            <a href="<?php echo base_url('profile') ?>">个人中心<span class="layui-badge-dot"></span></a>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:;"><img src="<?php echo base_url('resource/images/base/my-icon.png') ?>" class="layui-nav-img">
            <?php if (isset($this->fx_session->user_name)): ?>
              <?=$this->fx_session->user_name?>
            <?php endif;?>
            <?php if (!isset($this->fx_session->user_name)): ?>
              未登录
            <?php endif;?>
            </a>
            <dl class="layui-nav-child">
            <dd><a href="<?php echo base_url('profile') ?>">个人信息</a></dd>
            <dd><a  href="<?php echo base_url('admin/do_logout') ?>">退了</a></dd>
            </dl>
        </li>
    </ul>
  </div>
  
  <div class="layui-side">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item layui-nav-itemed">
          <a class="layui-nav-root" href="javascript:;">内容</a>
          <dl class="layui-nav-child">
            <dd class="<?=$active['post']?>"><a href="<?php echo base_url('content/publish/post') ?>"><i class="layui-icon" style="color:#FFFFFF;">&#xe63f;</i>&nbsp;&nbsp;文章案例</a></dd>
            <dd class="<?=$active['hr']?>"><a href="<?php echo base_url('content/publish/hr') ?>"><i class="layui-icon" style="color:#FFB800;">&#xe63f;</i>&nbsp;&nbsp;招聘信息</a></dd>
            <dd class="<?=$active['about']?>"><a href="<?php echo base_url('content/publish/about') ?>"><i class="layui-icon" style="color:#5FB878;">&#xe63f;</i>&nbsp;&nbsp;关于我们</a></dd>
            <dd class="<?=$active['home']?>"><a href="<?php echo base_url('content/home_config') ?>"><i class="layui-icon" style="color:#5FB878;">&#xe63f;</i>&nbsp;&nbsp;配置首页</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item layui-nav-itemed">
          <a class="layui-nav-root" href="javascript:;">管理</a>
          <dl class="layui-nav-child">
            <dd class="<?=$active['module']?>"><a href="<?php echo base_url('module') ?>"><i class="layui-icon" style="color:#FFFFFF;">&#xe63f;</i>&nbsp;&nbsp;栏目模块</a></dd>
            <dd class="<?=$active['website']?>"><a href="<?php echo base_url('website') ?>"><i class="layui-icon" style="color:#FFB800;">&#xe63f;</i>&nbsp;&nbsp;站点信息</a></dd>
            <!--
            <dd class="<?=$active['media']?>"><a href="<?php echo base_url('media') ?>"><i class="layui-icon" style="color:#5FB878;">&#xe63f;</i>&nbsp;&nbsp;媒体文件</a></dd>
            -->
          </dl>
        </li>

        <li class="layui-nav-item layui-nav-itemed">
          <a class="layui-nav-root" href="javascript:;">安全相关</a>
          <dl class="layui-nav-child">
            <dd class="<?=$active['profile']?>"><a href="<?php echo base_url('profile') ?>"><i class="layui-icon" style="color:#FFFFFF;">&#xe63f;</i>&nbsp;&nbsp;个人信息</a></dd>
            <dd class="<?=$active['log']?>"><a href="<?php echo base_url('admin/log') ?>"><i class="layui-icon" style="color:#FFB800;">&#xe63f;</i>&nbsp;&nbsp;动作记录</a></dd>
            <dd class="<?=$active['webinfo']?>"><a href="<?php echo base_url('admin/webinfo') ?>"><i class="layui-icon" style="color:#5FB878;">&#xe63f;</i>&nbsp;&nbsp;服务器信息</a></dd>
          </dl>
        </li>
<!--
        <li class="layui-nav-item layui-nav-itemed">
          <a href="javascript:;">帮助</a>
          <dl class="layui-nav-child">
            <dd><a href="javascript:;"><i class="layui-icon" style="color:#FFFFFF;">&#xe63f;</i>&nbsp;&nbsp;如何使用</a></dd>
            <dd><a href="javascript:;"><i class="layui-icon" style="color:#FFB800;">&#xe63f;</i>&nbsp;&nbsp;版权相关</a></dd>
            <dd><a href="javascript:;"><i class="layui-icon" style="color:#5FB878;">&#xe63f;</i>&nbsp;&nbsp;服务器信息</a></dd>
          </dl>
        </li>
-->
      </ul>
    </div>
  </div>