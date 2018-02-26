<script src="<?php echo base_url('resource/js/jquery-3.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('resource/vendor/layer-v3.1.0/layer/layer.js') ?>"></script>

<script>
layui.use(['form','element','upload'], function(){
    var form  = layui.form;
    var $ = layui.jquery,upload = layui.upload;

    //普通图片上传
    var uploadInst = upload.render({
        elem: '#test1'
        ,url: '/upload/'
        ,before: function(obj){
        //预读本地文件示例，不支持ie8
        obj.preview(function(index, file, result){
            $('#demo1').attr('src', result); //图片链接（base64）
        });
        }
        ,done: function(res){
        //如果上传失败
        if(res.code > 0){
            return layer.msg('上传失败');
        }
        //上传成功
        }
        ,error: function(){
        //演示失败状态，并实现重传
        var demoText = $('#demoText');
        demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
        demoText.find('.demo-reload').on('click', function(){
            uploadInst.upload();
        });
        }
    });

    // 保存
    form.on('submit(save)', function(data){
        editor.sync();
        if($('#about_content').val() === '') {
            layer.alert('内容还是填一些吧~~！~', {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 6 //动画类型
                    });
            return false;
        } else {
            data.field['about_content'] = $('#about_content').val();
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('about/save') ?>',
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
                    layer.msg('操作失败', {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 6 //动画类型
                        ,title:'重要消息'
                    });
                }
                loadContent();
                return false;
            }
        });
        return false;
    });
});
</script>
<div class="layui-body">

    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md12">
            <div class="layui-field-box fx-field-box">
                <fieldset class="layui-elem-field layui-field-title">
                <legend>媒体文件</legend>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md12">
            <div class="layui-field-box">
                <form class="layui-form layui-form-pane">
                    <input id="about_id" type="hidden" name="about_id">

                    <div class="layui-form-item">
                        <label class="layui-form-label">网站名称</label>
                        <div class="layui-input-inline">
                        <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <hr>

                    <div class="layui-form-item">
                        <label class="layui-form-label">网站logo</label>
                        <div class="layui-input-inline">
                            <div class="layui-upload">
                                <button type="button" class="layui-btn" id="test1">上传图片</button>
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img" id="demo1">
                                    <p id="demoText"></p>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-mid layui-word-aux">建议尺寸 180 * 60 (像素)</div>
                    </div>
                    <hr>

                    <div class="layui-form-item">
                        <label class="layui-form-label">地址栏图标</label>
                        <div class="layui-input-inline">
                            <div class="layui-upload">
                                <button type="button" class="layui-btn" id="test1">上传图片</button>
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img" id="demo1">
                                    <p id="demoText"></p>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-mid layui-word-aux">建议尺寸 32 * 32 (像素)的.ico文件</div>
                    </div>
                    <hr>

                    <div class="layui-form-item">
                        <label class="layui-form-label">底部版权</label>
                        <div class="layui-input-inline">
                        <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">建议尺寸 180 * 60 (像素)</div>
                    </div>

                    <div class="layui-form-item">
                        <button class="layui-btn" lay-submit lay-filter="save">
                        <i class="layui-icon">&#xe608;</i>保存
                        </button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>