
<script>
layui.use(['form','element','upload'], function(){
    var form  = layui.form;
    var $ = layui.jquery,upload = layui.upload;

    //logo上传
    var logoUpInst = upload.render({
        elem: '#logo-upload'
        ,url: '<?php echo base_url('common/logo_upload') ?>'
        ,before: function(obj){
            obj.preview(function(index, file, result){
                $('#logo-img').attr('src', result); //图片链接（base64）
            });
        }
        ,done: function(res){
            //如果上传失败
            if(res.code == '0000'){
                var newLogoPath = res.result + '?'+Math.random();
                $('#fx-logo').attr('src','<?php echo base_url('/') ?>' + newLogoPath);
                $("#website_logo").val(newLogoPath);
                return layer.msg('logo图片替换成功');
            } else {
                return layer.msg('上传失败');
            }
        }
        ,error: function(){
            var demoText = $('#logo-error-text');
            demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini logo-reload">重试</a>');
            demoText.find('.logo-reload').on('click', function(){
                logoUpInst.upload();
            });
        }
    });

      //ico上传
      var icoUpInst = upload.render({
        elem: '#ico-upload'
        ,url: '<?php echo base_url('common/ico_upload') ?>'
        ,exts:'ico'
        ,before: function(obj){
            obj.preview(function(index, file, result){
                $('#ico-img').attr('src', result); //图片链接（base64）
            });
        }
        ,done: function(res){
            if(res.code == '0000'){
                var newIcoPath = res.result + '?'+Math.random();
                $("#website_ico").val(newIcoPath);
                return layer.msg('ICO图片替换成功');
            } else {
                return layer.msg('上传失败');
            }
        }
        ,error: function(){
            var demoText = $('#ico-error-text');
            demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini ico-reload">重试</a>');
            demoText.find('.ico-reload').on('click', function(){
                icoUpInst.upload();
            });
        }
    });

    // 保存
    form.on('submit(save)', function(data){

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('website/save') ?>',
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
                <legend>信息配置</legend>
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
                        <div class="layui-input-inline fx-input-inline">
                        <input type="text" name="website_name" required  lay-verify="required" value="<?=$result['website_name']?>" placeholder="请输入标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <hr>

                    <div class="layui-form-item">
                        <label class="layui-form-label">网站logo</label>
                        <div class="layui-input-inline">
                            <div class="layui-upload">
                                <input id="website_logo" type="hidden" name="website_logo" value="<?=$result['website_logo']?>">
                                <button type="button" class="layui-btn" id="logo-upload"><i class="layui-icon">&#xe67c;</i>上传LOGO</button>
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img fx-logo" src="<?php echo base_url($result['website_logo']) ?>" id="logo-img">
                                    <p id="logo-error-text"></p>
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
                                <input id="website_ico" type="hidden" name="website_ico" value="<?=$result['website_ico']?>">
                                <button type="button" class="layui-btn" id="ico-upload"><i class="layui-icon">&#xe67c;</i>上传ICO</button>
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img fx-ico" src="<?php echo base_url($result['website_ico']) ?>" id="ico-img">
                                    <p id="ico-error-text"></p>
                                </div>

                            </div>
                        </div>
                        <div class="layui-form-mid layui-word-aux">建议尺寸 32 * 32 (像素)的.ico文件</div>
                    </div>
                    <hr>

                    <div class="layui-form-item">
                        <label class="layui-form-label">底部版权</label>
                        <div class="layui-input-inline fx-input-inline">
                            <input type="text" name="website_copyright" value="<?=$result['website_copyright']?>" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux"></div>
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