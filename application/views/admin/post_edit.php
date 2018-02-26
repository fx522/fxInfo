<link rel="stylesheet" href="<?php echo base_url('resource/vendor/layui/css/layui.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('resource/css/global.css') ?>">
<script src="<?php echo base_url('resource/js/jquery-3.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('resource/vendor/layui/layui.js') ?>"></script>

<script src="<?php echo base_url('resource/editor/kindeditor-all-min.js') ?>"></script>
<script src="<?php echo base_url('resource/editor/lang/zh-CN.js') ?>"></script>
<script>

function imgOver(){
    $('#coverImagePreview').addClass('bk');
    $('.img-opt-btn').removeClass('fx-hide');
};
function imgOut(){
    $('#coverImagePreview').removeClass('bk');
    $('.img-opt-btn').addClass('fx-hide');
};

layui.use(['element','form','laydate','upload',], function(){

    var editor_opts = {
            resizeType : 1,
            allowPreviewEmoticons : false,
            allowImageUpload : true,
            uploadJson : '<?php echo base_url('common/post_attache_upload') ?>',
            fileManagerJson : 'ttt-no-service',
            allowFileManager : true,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'baidumap', 'emoticons', 'image', 'link']
    };

    var editor = KindEditor.create('#editor_id', editor_opts);

    var laydate = layui.laydate;
    var $ = layui.jquery, upload = layui.upload;
    
    $('#del-img').on('click', function(){
        $('#coverImagePreview').attr('src', '').addClass("fx-hide");
        $('.img-opt-btn').addClass('fx-hide');
        $('#coverImage').removeClass('fx-hide');
        $('#img-path').val("");
    });

    // 图片上传接口
    var uploadInst = upload.render({
        elem: '.coverImage'
        ,url: '<?php echo base_url('common/post_upload') ?>'
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
                $('#coverImagePreview').removeClass('fx-img-failed');
                $('#img-path').val(res.result);
                layer.msg('酷毙了~~上传好了', {icon: 1, time:2000});
            } else {
                $('#img-path').val("");
                $('#coverImagePreview').addClass('fx-img-failed');
                layer.msg('不开心~~失败了~', {icon: 5, time:2000});
            }
        }
        ,error: function(){
            $('#img-path').val("");
            var demoText = $('#demoText');
            demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
            demoText.find('.demo-reload').on('click', function(){
                uploadInst.upload();
            });
        }
    });

    // submit
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    //监听提交
    var form = layui.form;
    form.on('submit(postSubmit)', function(data){
        editor.sync();
        if($('#editor_id').val() === '') {
            layer.alert('啥也没写啊，你让我修改什么啊~~~', {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 6 //动画类型
                    });
            return false;
        } else {
            data.field['content'] = $('#editor_id').val();
        }
        
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('content/editPost') ?>',
            data: {
                'data': data.field
            },
            dataType:'json',
            success: function(ret){
                if(ret.code === '0000') {
                    parent.layer.close(index);
                    parent.layer.msg('操作成功');
                } else{
                    layer.alert('操作失败', {
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
<form class="layui-form layui-form-pane" action="">
    <input type="hidden" name="post_id" value="<?=$post_detail['post_id']?>">
    <div class="layui-col-xs12 layui-col-md8">
        <div class="layui-field-box">
            <div class="layui-form-item">
                <label class="layui-form-label">所属栏目</label>
                <div class="layui-input-inline">
                    <select name="module" disabled>
                        <option value="<?=$module_id?>"><?=$module_name?></option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="column" disabled>
                        <option value="<?=$column_id?>"><?=$column_name?></option>
                    </select>
                </div>
                
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文章标题</label>
                <div class="layui-input-block">
                <input type="text" name="title" value="<?=$post_detail['post_title']?>" required lay-verify="required" placeholder="文章标题" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <div class="layui-input-block">
                <textarea name="content" id="editor_id" class="layui-textarea" style="width:100%; height:360px;">
                    <?=$post_detail['post_content']?>
                </textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button id="publish_post" class="layui-btn" lay-submit lay-filter="postSubmit">确认修改</button>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-col-xs12 layui-col-md4">
        <div class="layui-row">
            <div class="layui-col-xs12 layui-col-md12">
                <fieldset class="layui-elem-field">
                    <legend>内容配置</legend>
                    <div class="layui-field-box">
                        <div class="layui-form-item">
                            <label class="layui-form-label">显示</label>
                            <div class="layui-input-block">
                                <input type="checkbox" value='1' name="is_top" title="置顶显示" <?php if($post_detail['is_top'] == 1){echo 'checked';}?>>
                                <input type="checkbox" value='1' name="is_recommend" title="推荐文章" <?php if($post_detail['is_recommend'] == 1){echo 'checked';}?>>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">发布者</label>
                            <div class="layui-input-block">
                            <input type="text" name="created_by" value="<?=$post_detail['created_by']?>" required lay-verify="required" placeholder="发布者" class="layui-input">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="layui-elem-field">
                    <legend>文章封面</legend>
                    <div class="layui-field-box">
                        <input id="img-path" type="hidden" name="cover" value="<?=$post_detail['post_cover_image']?>">
                        <button type="button" class="layui-btn coverImage <?php if($post_detail['post_cover_image'] != ''){echo 'fx-hide';}?>" id="coverImage">选择图片</button>
                        <div class="layui-upload-list fx-center">
                            <a onmouseover="imgOver()" onmouseout="imgOut()">
                            <img class="layui-upload-img <?php if($post_detail['post_cover_image'] == ''){echo 'fx-hide';}?>" id="coverImagePreview" src="<?php echo base_url('/') ?><?=$post_detail['post_cover_image']?>" />
                            <button type="button" class="layui-btn coverImage img-opt-btn left fx-hide">选择封面</button>
                            <button type="button" id="del-img" class="layui-btn layui-btn-danger img-opt-btn right fx-hide">删除封面</button>
                            </a>
                            <p id="demoText"></p>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        
    </div>
</form>

</div>