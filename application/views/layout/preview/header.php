
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url($site_info['website_ico']) ?>">
<?php if(!$is_home):?>
    <title><?=$current_sub_detail['column_name']?> | <?=$site_info['website_name']?></title>
<?php endif;?>
<?php if($is_home):?>
    <title>首页 | <?=$site_info['website_name']?></title>
<?php endif;?>

    <link href="<?php echo base_url('resource/fx_static/bootstrap/3.3.7/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('resource/fx_static/assets/css/ie10-viewport-bug-workaround.css') ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('resource/fx_static/zb/css/style.css?v=2') ?>" rel="stylesheet">
    <link href="<?php echo base_url('resource/fx_static/zb/css/rebs.css') ?>" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container-fluid">
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src="<?php echo base_url($site_info['website_logo']) ?>"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li class='<?php if($is_home) {echo 'active';}?>'><a href="<?=base_url('/')?>">首页</a></li>
                <?php foreach ($nav_header as $item): ?>
                <li class="hassub <?php if($main_id == $item['module_id']){echo 'active';}?>">
                  <a href="<?php echo base_url('webfront/page/'.$item['module_type'].'/'.$item['module_id']) ?>"><?=$item['module_name']?></a>
                  <ul class="downsub">
                  <?php foreach ($item['sub'] as $sub_item): ?>
                    <li><a href="<?php echo base_url('webfront/page/'.$item['module_type'].'/'.$item['module_id'].'/'.$sub_item['column_id']) ?>"><?=$sub_item['column_name']?></a></li>
                  <?php endforeach; ?>
                  </ul>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <?php if(!$is_home):?>
          <img class="first-slide img-responsive" style="min-width: 100%;" src="<?=base_url($current_main_detail['cover_img']) ?>">
          <?php endif;?>
          <?php if($is_home):?>
          <img class="first-slide img-responsive" style="min-width: 100%;" src="<?=base_url($home_data['home_banner']) ?>">
          <?php endif;?>
        </div>
      </div>
      <?php if(!$is_home):?>
      <div class="submenu">
        <div class="container">
          <ul>
            <?php foreach ($current_sub as $sub_item1): ?>
                <li <?php if($sub_id == $sub_item1['column_id']){echo 'class=active';}?>><a href="<?php echo base_url('webfront/page/'.$type.'/'.$main_id.'/'.$sub_item1['column_id']) ?>"><?=$sub_item1['column_name']?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endif;?>
    </div><!-- /.carousel -->