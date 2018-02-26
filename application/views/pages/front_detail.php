<div class="container">
    <ol class="breadcrumb fx-nav-mbx">
        <li><a href="<?php echo base_url('webfront/page/'.$type.'/'.$main_id) ?>"><?=$current_main_detail['show_name']?></a></li>
        <li><a href="<?php echo base_url('webfront/page/'.$type.'/'.$main_id.'/'.$sub_id) ?>"><?=$current_sub_detail['column_name']?></a></li>
        <?php if(!empty($detail_id)): ?>
            <li class="active"><?=$result['post_title']?></li>
        <?php endif; ?>
    </ol>

    <div class="row about-title">
        <div class="col-md-12">
        <?php if(empty($detail_id)): ?>
            <span><?=$current_sub_detail['column_name']?></span>
        <?php endif; ?>
        <?php if(!empty($detail_id)): ?>
            <span><?=$result['post_title']?></span>
        <?php endif; ?>
        </div>
    </div>
    <?php switch($type): 
    case 0: ?>
    <?php case 1: ?>
    <div class="row about-body">
        <?php if(empty($detail_id)): ?>
        <link rel="stylesheet" href="<?php echo base_url('resource/vendor/layui/css/layui.css') ?>">
        <style>
            a{
                padding-top: 10px;
                font-size: 15px;
                line-height: 2;
                color: #aaa;
            }

            a:hover{
                color: rgba(242,102,7,1);
            }
        </style>
        <div class="col-md-12">
            <?php if ($result['count'] == 0):?>
                <span style="font-size: 16px;letter-spacing: 2px;">暂无内容</span>
            <?php endif;?>

            <?php if ($result['count'] > 0):?>
            <?php foreach ($result['result'] as $item): ?>
            <div class="row news-item"><!-- content 0-->
                <div class="col-md-5 fx-post-thumb">
                    <img style="max-width: 100%;" src="<?=base_url($item['post_cover_image'])?>">
                </div>
                <div class="col-md-7">
                    <span class="title">
                        <?php if($item['is_top'] == 1): ?>
                            <span class="label label-primary">置顶</span>
                        <?php endif;?>
                        <?php if($item['is_recommend'] == 1): ?>
                            <span class="label label-warning">推荐</span>
                        <?php endif;?>
                        <?=$item['post_title']?>
                    </span>
                    <span class="time"><?=$item['created_at']?></span>
                    <span class="body abstract">
                        <?=strip_tags($item['post_content'], '<p><br><ol><ul><li>');?>
                    </span>
                    <span class="more"><a href="<?php echo base_url('Webfront/page/'.$type.'/'.$main_id.'/'.$sub_id.'?detail_id='.$item['post_id']) ?>">更多详细►</a></span>
                </div>
            </div><!-- content 0 End-->
            <?php endforeach; ?>
            <?php endif;?>
        </div>
        <?php if ($result['count'] > 0):?>
        <div id="pagenation" style="text-align: center;"></div>
        <?php endif;?>
        <script src="<?php echo base_url('resource/vendor/layui/layui.js') ?>"></script>
        <script>
            layui.use(['laypage', 'layer'], function(){
                var laypage = layui.laypage
                ,layer = layui.layer;
                //总页数低于页码总数
                laypage.render({
                    elem: 'pagenation'
                    ,theme:'#f0ad4e'
                    ,curr: <?=$curr?>
                    ,limit: <?=$limit?>
                    ,count: <?=$result['count']?>
                    ,jump:function(obj, first){
                        if(!first){
                            window.location='<?php echo base_url('Webfront/page/'.$type.'/'.$main_id.'/'.$sub_id.'/') ?>' + '?page=' + obj.curr;
                        }
                    }
                });
            });
        </script>
        <?php endif; ?>

        <?php if(!empty($detail_id)): ?>
            <?=$result['post_content']?>
        <?php endif; ?>
    </div>
    <?php break;?>

    <?php case 2: ?>
    <div class="row about-body nashi">
        <div class="col-md-12">
        <?php if(count($result) == 0): ?>
            <span style="font-size: 16px;letter-spacing: 2px;">暂无内容</span>
        <?php endif;?>
        <?php foreach ($result as $item): ?>
        <div class="row header">
            <div class="col-md-12">
            <span>· <?=$item['hr_name']?></span>
            </div>
        </div>
        <div class="row content yq">
            <div class="col-md-12">
            <p>职位描述：</p>
            <?=$item['hr_desc']?>

            <p>岗位要求：</p>
            <?=$item['hr_need_desc']?>
            </div>
        </div><!-- content 2 End-->
        <?php endforeach; ?>
        
        </div>
    </div>

    <?php break;?>
    <?php case 3: ?>
    <div class="row about-body">
        <div class="col-md-12">
        <?=$result['about_content']?>
        </div>
    </div>
    <?php break;?>
    <?php endswitch;?>
</div><!-- /.container -->