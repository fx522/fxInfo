<script>

var img_upload_common = function(uploder, id, url){
    var obj_img_view = $(id).parent().children("div").children("a").children("img");
    var tmp_val = $(id).parent().children("input[type='hidden']");
    var err_area = $(id).parent().children("div").children("p");
    uploder.render({
        elem: id
        ,url: url
        ,size: 512
        ,before: function(obj){
            obj.preview(function(index, file, result){
                $(obj_img_view).attr('src', result).removeClass("fx-hide"); //图片链接（base64）
                // $('#coverImagePreview').attr('src', result).removeClass("fx-hide"); //图片链接（base64）
            });
        }
        ,done: function(res){
            $(id).addClass('fx-hide');
            if(res.code == '0000'){
                $(obj_img_view).removeClass('fx-img-failed');
                $(tmp_val).val(res.result);
                $(err_area).addClass('fx-hide');
                layer.msg('酷毙了~~上传好了', {icon: 1, time:2000});
            } else {
                $(tmp_val).val("");
                $(obj_img_view).addClass('fx-img-failed');
                $(err_area).removeClass('fx-hide');
                var demoText = $(err_area);
                demoText.html('<span style="color: #FF5722;">'+ res.error +'</span>');
                layer.msg(res.msg, {icon: 5, time:2000});
            }
        }
        ,error: function(res){
            $(tmp_val).val("");
            var demoText = $(err_area).removeClass('fx-hide');
            demoText.html('<span style="color: #FF5722;">上传失败</span>');
        }
    });

    $(id).parent().children("div").children("a").children(".del").on('click', function(){
        $(obj_img_view).attr('src', '').addClass("fx-hide");
        $(id).parent().children("div").children("a").children(".del").addClass('fx-hide');
        $(id).parent().children("div").children("a").children(".select").addClass('fx-hide');
        $(id).removeClass('fx-hide');
        $(err_area).addClass('fx-hide');
        $(tmp_val).val("");
    });

    $(id).parent().children("div").children("a").children(".select").on('click',function(){
        $(id).click();
    });

    $(id).parent().children("div").children("a").mouseover(function(){
        $(obj_img_view).addClass('bk');
        $(id).parent().children("div").children("a").children(".del").removeClass('fx-hide');
        $(id).parent().children("div").children("a").children(".select").removeClass('fx-hide');
    });

    $(id).parent().children("div").children("a").mouseout(function(){
        $(obj_img_view).removeClass('bk');
        $(id).parent().children("div").children("a").children(".del").addClass('fx-hide');
        $(id).parent().children("div").children("a").children(".select").addClass('fx-hide');
    });
}

layui.use(['element','form','upload'], function(){
    var form = layui.form;
    var $ = layui.jquery,upload = layui.upload;

    img_upload_common(upload, '#banner', '<?php echo base_url('common/module_upload') ?>');
    img_upload_common(upload, '#section1-img', '<?php echo base_url('common/post_upload') ?>');
    img_upload_common(upload, '#section2-img', '<?php echo base_url('common/post_upload') ?>');

    // 保存
    form.on('submit(save)', function(data){
        
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('content/home_update') ?>',
            data: {
                'data': data.field
            },
            dataType:'json',
            success: function(ret){
                if(ret.code === '0000') {
                    layer.alert('操作成功', {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 0 //动画类型
                        ,title:'恭喜~！~'
                    });
                } else{
                    layer.msg(ret.msg, {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 6 //动画类型
                        ,title:'重要消息'
                    });
                }
            }
        });
        return false;
    });
});
</script>

<div class="layui-body">

    <form class="layui-form layui-form-pane">
        <div class="layui-row">
            <div class="layui-col-xs12 layui-col-md12">
                <div class="layui-field-box">
                    <fieldset class="layui-elem-field">
                        <legend>首页banner配置<span class="layui-badge">建议尺寸 1920 * 480 (像素)</span></legend>
                        <div class="layui-field-box">
                            <div class="layui-form-item">
                                <input type="hidden" name="home_banner" value="<?=$result['home_banner'] ?>">
                                <button type="button" class="layui-btn <?php if(!empty($result['home_banner'])){echo 'fx-hide';} ?>" id="banner">选择图片</button>
                                <div class="layui-upload-list fx-center">
                                    <a>
                                        <img class="layui-upload-img <?php if(empty($result['home_banner'])){echo 'fx-hide';} ?>" src="<?=base_url('/').$result['home_banner'] ?>" />
                                        <button type="button" class="layui-btn img-opt-btn left fx-hide select">选择封面</button>
                                        <button type="button" class="layui-btn layui-btn-danger img-opt-btn right fx-hide del">删除封面</button>
                                    </a>
                                    <p id="demoText"></p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                </div>
            </div>
        </div>
        <div class="layui-row">
            <div class="layui-col-xs12 layui-col-md6">
                <div class="layui-field-box">
                    <fieldset class="layui-elem-field">
                        <legend>段落一配置</legend>
                        <div class="layui-field-box">
                            <div class="layui-form-item">
                                <label class="layui-form-label">标题</label>
                                <div class="layui-input-block">
                                <input type="text" name="section_1_title" value="<?=$result['section_1_title']?>" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">描述</label>
                                <div class="layui-input-block">
                                    <textarea class="layui-textarea" name="section_1_desc" lay-verify="content"><?=$result['section_1_desc']?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">图片</label>
                                <div class="layui-input-block">
                                    <input type="hidden" name="section_1_img" value="<?=$result['section_1_img']?>">
                                    <button type="button" class="layui-btn <?php if(!empty($result['section_1_img'])){echo 'fx-hide';} ?>" id="section1-img">选择图片</button>
                                    <div class="layui-upload-list fx-center">
                                        <a>
                                            <img class="layui-upload-img <?php if(empty($result['section_1_img'])){echo 'fx-hide';} ?>"  src="<?=base_url('/').$result['section_1_img'] ?>"  />
                                            <button type="button" class="layui-btn img-opt-btn left fx-hide select">选择封面</button>
                                            <button type="button" class="layui-btn layui-btn-danger img-opt-btn right fx-hide del">删除封面</button>
                                        </a>
                                        <p id="demoText"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="layui-col-xs12 layui-col-md6">
                <div class="layui-field-box">
                    <fieldset class="layui-elem-field">
                        <legend>段落二配置</legend>
                        <div class="layui-field-box">
                            <div class="layui-form-item">
                                <label class="layui-form-label">标题</label>
                                <div class="layui-input-block">
                                <input type="text" name="section_2_title" value="<?=$result['section_2_title']?>" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">描述</label>
                                <div class="layui-input-block">
                                <textarea class="layui-textarea" name="section_2_desc" lay-verify="content"><?=$result['section_2_desc']?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">图片</label>
                                <div class="layui-input-block">
                                    <input type="hidden" name="section_2_img" value="<?=$result['section_2_img']?>">
                                    <button type="button" class="layui-btn <?php if(!empty($result['section_2_img'])){echo 'fx-hide';} ?>" id="section2-img">选择图片</button>
                                    <div class="layui-upload-list fx-center">
                                        <a>
                                            <img class="layui-upload-img <?php if(empty($result['section_2_img'])){echo 'fx-hide';} ?>"  src="<?=base_url('/').$result['section_2_img'] ?>"  />
                                            <button type="button" class="layui-btn img-opt-btn left fx-hide select">选择封面</button>
                                            <button type="button" class="layui-btn layui-btn-danger img-opt-btn right fx-hide del">删除封面</button>
                                        </a>
                                        <p id="demoText"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <div class="layui-row">
            <div class="layui-col-xs12 layui-col-md12">
                <div class="layui-field-box">
                    <div class="layui-form-item">
                        <button class="layui-btn" lay-submit lay-filter="save">
                        <i class="layui-icon">&#xe608;</i>保存
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>