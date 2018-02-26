<link rel="stylesheet" href="<?php echo base_url('resource/vendor/layui/css/layui.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('resource/css/global.css') ?>">
<script src="<?php echo base_url('resource/js/jquery-3.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('resource/vendor/layui/layui.js') ?>"></script>
<script>
function imgOver(){
    $('#coverImagePreview').addClass('bk');
    $('.img-opt-btn').removeClass('fx-hide');
};
function imgOut(){
    $('#coverImagePreview').removeClass('bk');
    $('.img-opt-btn').addClass('fx-hide');
};
layui.use(['element','form','upload'], function(){
    var form = layui.form;
    var $ = layui.jquery,upload = layui.upload;

    $('#del-img').on('click', function(){
        $('#coverImagePreview').attr('src', '').addClass("fx-hide");
        $('.img-opt-btn').addClass('fx-hide');
        $('#coverImage').removeClass('fx-hide');
        $('#demoText').addClass('fx-hide');
        $('#img-path').val("");
    });
    // 图片上传接口
    var uploadInst = upload.render({
        elem: '.coverImage'
        ,url: '<?php echo base_url('common/module_upload') ?>'
        ,size: 256
        ,before: function(obj){
            obj.preview(function(index, file, result){
                $('#coverImagePreview').attr('src', result).removeClass("fx-hide"); //图片链接（base64）
            });
        }
        ,done: function(res){
            // console.log(res);
            $('#coverImage').addClass('fx-hide');
            if(res.code == '0000'){
                console.log(res);
                $('#coverImagePreview').removeClass('fx-img-failed');
                $('#img-path').val(res.result);
                $('#demoText').addClass('fx-hide');
                layer.msg('酷毙了~~上传好了', {icon: 1, time:2000});
            } else {
                $('#img-path').val("");
                $('#coverImagePreview').addClass('fx-img-failed');
                $('#demoText').removeClass('fx-hide');
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">'+ res.error +'</span>');
                layer.msg('不开心~~失败了~', {icon: 5, time:2000});
            }
        }
        ,error: function(res){
            $('#img-path').val("");
            var demoText = $('#demoText').removeClass('fx-hide');
            demoText.html('<span style="color: #FF5722;">上传失败</span>');
        }
    });

    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    //监听提交
    form.on('submit(columnModify)', function(data){
        var position ="";     
        $("input[name='position']:checked").each(function(){
            position += $(this).val();
        });

        if(position == '') {
            position = "1";
        } else if(position=='23') {
            position = "0";
        }

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('module/editModule') ?>',
            data: {
                'id':$('#module_id').val(),
                'title':$("input[name='title']").val(),
                'type':$("input[name='type']:checked").val(),
                'position':position,
                'cover_img': $('#img-path').val()
            },
            dataType:'json',
            success: function(ret){
                if(ret.code === '0000') {
                    parent.layer.close(index);
                } else{
                    layer.alert('更新失败', {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 6 //动画类型
                    });
                }
            }
        });
        return false;
    });
});
</script>

<div class="layui-row">
    <form class="layui-form layui-form-pane">
        <div class="layui-col-xs12 layui-col-md12">
            <div class="layui-field-box">
                <div class="layui-form-item">
                    <label class="layui-form-label">栏目名称</label>
                    <div class="layui-input-block">
                    <input type="hidden" id="module_id" value="<?=$module_id?>">
                    <input id="c_title" type="text" value="<?=$show_name?>" name="title" required lay-verify="required" placeholder="栏目名称" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">栏目类型</label>
                    <div class="layui-input-block">
                    <input type="radio" name="type" value="00" title="文章模块" <?php if($module_type == 0){echo 'checked';}?> disabled>
                    <input type="radio" name="type" value="01" title="案例模块" <?php if($module_type == 1){echo 'checked';}?> disabled>
                    <input type="radio" name="type" value="02" title="招聘模块" <?php if($module_type == 2){echo 'checked';}?> disabled>
                    <input type="radio" name="type" value="03" title="简介模块" <?php if($module_type == 3){echo 'checked';}?> disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">显示位置</label>
                    <div class="layui-input-block">
                    
                    <input type="checkbox" value="2" name="position" title="头部导航" <?php if($show_where == 0 or $show_where == 2){echo 'checked';} ?>>
                    <input type="checkbox" value="3" name="position" title="尾部导航" <?php if($show_where == 0 or $show_where == 3){echo 'checked';} ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <fieldset class="layui-elem-field">
                        <legend>栏目封面</legend>
                        <div class="layui-field-box">
                            <input id="img-path" type="hidden" name="cover" value="<?=$cover_img?>">
                            <button type="button" class="layui-btn coverImage" id="coverImage">选择图片</button>
                            <div class="layui-upload-list fx-center">
                                <a onmouseover="imgOver()" onmouseout="imgOut()">
                                <img class="layui-upload-img <?php if($cover_img == ''){echo 'fx-hide';}?>" id="coverImagePreview" src="<?php echo base_url('/'.$cover_img) ?>"/>
                                <button type="button" class="layui-btn coverImage img-opt-btn left fx-hide">选择封面</button>
                                <button type="button" id="del-img" class="layui-btn layui-btn-danger img-opt-btn right fx-hide">删除封面</button>
                                </a>
                                <p id="demoText"></p>
                                
                            </div>
                        </div>
                    </fieldset>
                </div>
                <button class="layui-btn" lay-submit lay-filter="columnModify">确认修改</button>
            </div>
        </div>
    </form>
</div>