<link rel="stylesheet" href="<?php echo base_url('resource/vendor/layui/css/layui.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('resource/css/global.css') ?>">
<script src="<?php echo base_url('resource/js/jquery-3.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('resource/vendor/layui/layui.js') ?>"></script>
<script>
layui.use(['element','form'], function(){

    // submit
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    //监听提交
    var form = layui.form;
    form.on('submit(loginSubmit)', function(data){
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/do_login') ?>',
            data: data.field,
            dataType:'json',
            success: function(ret){
                if(ret.code === '0000') {
                    parent.layer.close(index);
                } else{
                    layer.alert('知道为啥失败么？', {
                        title:'啊~欧~，登录失败了'
                        ,skin: 'layui-layer-molv'
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
    <div class="layui-col-xs12 layui-col-md12">
        <div class="layui-field-box fx-login">
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <input type="text" name="user_name" required lay-verify="required" autocomplete="off" placeholder="用户名" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <input type="password" name="password" required lay-verify="required" autocomplete="off" placeholder="登录密码" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button id="do_login" class="layui-btn" lay-submit lay-filter="loginSubmit">给朕登录</button>
                    <button type="reset" class="layui-btn layui-btn-primary">朕要重填</button>
                </div>
            </div>
        </div>
    </div>
</form>

</div>