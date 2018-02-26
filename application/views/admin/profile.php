<script>
layui.use(['element'], function(){
    $("#changeName").on('click',function(){
        layer.confirm('再次登录需使用新用户名进行登录~！',{icon:0,title:'重要提示'}, function(idx0){
                layer.close(idx0);
                layer.prompt({title:'用户名修改'}, function(val, idx1){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('profile/edit/name') ?>',
                        data: {
                            'new_data':val
                        },
                        dataType:'json',
                        success: function(ret){
                            if(ret.code === '0000') {
                                $('.admin-name').html(val);
                                layer.alert('操作成功');
                            } else{
                                layer.alert('操作失败');
                            }
                        }
                    });
                    layer.close(idx1);
                });
        });
    });

    $("#changePassword").on('click',function(){
        layer.confirm('输入的新密码将直接显示，继续吗？',{icon:0,title:'重要提示'}, function(idx0){
            layer.close(idx0);
            layer.prompt({title:'密码修改'}, function(val, idx1){
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('profile/edit/password') ?>',
                    data: {
                        'new_data':val
                    },
                    dataType:'json',
                    success: function(ret){
                        if(ret.code === '0000') {
                            layer.alert('操作成功');
                        } else{
                            layer.alert('操作失败');
                        }
                    }
                });
                layer.close(idx1);
            });
        });
    });
});
</script>
<div class="layui-body">

    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md12">
            <div class="layui-field-box fx-field-box">
                <fieldset class="layui-elem-field layui-field-title">
                <legend>个人信息</legend>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="layui-field-box">
        <button class="layui-btn" id="changeName">
        <i class="layui-icon">&#xe63c;</i>修改用户名
        </button>

        <button class="layui-btn layui-btn-danger" id="changePassword">
        <i class="layui-icon">&#xe6b2;</i>修改密码
        </button>
        <hr>
    </div>
    
    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md3">
            <div class="layui-field-box fx-field-box">
                <fieldset class="layui-elem-field">
                    <legend>用户名</legend>
                    <div class="layui-field-box admin-name">
                        <?=$admin_name?>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="layui-col-xs12 layui-col-md3">
            <div class="layui-field-box fx-field-box">
                <fieldset class="layui-elem-field">
                    <legend>最近登录时间</legend>
                    <div class="layui-field-box">
                        <?=$last_login_time?>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="layui-col-xs12 layui-col-md3">
            <div class="layui-field-box fx-field-box">
                <fieldset class="layui-elem-field">
                    <legend><span style="color:#5FB878;">登录成功</span></legend>
                    <div class="layui-field-box">
                    <span style="color:#5FB878;"><?=$login_success_times?>次</span>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="layui-col-xs12 layui-col-md3">
            <div class="layui-field-box fx-field-box">
                <fieldset class="layui-elem-field">
                    <legend><span style="color:#FF5722;">登录失败</span></legend>
                    <div class="layui-field-box">
                        
                        <span style="color:#FF5722;"><?=$login_fail_times?>次</span>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>