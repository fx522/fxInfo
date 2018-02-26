<script src="<?php echo base_url('resource/js/jquery-3.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('resource/vendor/layer-v3.1.0/layer/layer.js') ?>"></script>

<script src="<?php echo base_url('resource/editor/kindeditor-all-min.js') ?>"></script>
<script src="<?php echo base_url('resource/editor/lang/zh-CN.js') ?>"></script>

<script>
layui.use(['form','element'], function(){

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
						'insertunorderedlist', '|', 'baidumap','emoticons', 'image', 'link']
                }

    var editor = KindEditor.create('#about_content',editor_opts);
    var form  = layui.form;

    var loadContent = function(){
        var init_load_index = layer.load(2);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('about') ?>',
            data: {
                'module_id':$("#subcolumn").val()
            },
            dataType:'json',
            success: function(ret){
                if(ret.code === '0000') {
                    // layer.msg('0000');
                    if(ret.data['about_id'] == '') {
                        $('#about_status').text('暂无内容，填写内容并保存');
                    } else {
                        $('#about_status').text('').text('上次更新于：'+ ret.data['updated_at']);
                    }
                    $('#about_id').val('').val(ret.data['about_id']);
                    editor.html(ret.data['about_content']);
                } else {
                    $('#about_status').text('数据读入出错');
                    $('#about_id').val('');
                    $('#about_content').val('');
                }
                layer.close(init_load_index);
            }
        });
    };
    if(<?=count($modules)?> ==  0) {
        layer.alert('还没有栏目，还是先添加一个吧~！', {
            icon: 0,
            title:'重要提示'
        });
    } else {
        loadContent();
    };

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

    // 删除
    form.on('submit(delete)', function(data){
        if($('#about_id').val() === '') {
            layer.alert('还没添加内容呢，让我怎么删除~~！~', {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 6 //动画类型
                    });
            return false;
        }

        layer.confirm('真的非要删除不可吗？<br>我想静静~~~', function(index){
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('about/remove') ?>',
                data: {
                    'about_id': $('#about_id').val()
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
                    layer.close(index);
                    loadContent();
                    return false;
                }
            });
        });
        return false;
    });

    // 选择框动作
    form.on('select(module-filter)', function(data){
        var postUrl = '<?php echo base_url('module/subColumns/') ?>' + data.value;
        $.ajax({
            type: 'GET',
            url: postUrl,
            dataType:'json',
            success: function(ret){
                if(ret.code === '0000') {
                    $("#subcolumn").empty();
                    if(ret.count > 0) {
                        for(var idx in ret.data){
                            c_id = ret.data[idx]['column_id'];
                            c_name = ret.data[idx]['column_name'];
                            opt_str = "<option value='"+ c_id +"'>"+ c_name +"</option>";
                            $("#subcolumn").append(opt_str);
                        }
                    }  else {
                        opt_str = "<option value='000' disabled>无子项(请先添加)</option>";
                        $("#subcolumn").append(opt_str);

                        layer.alert('额，该栏目下没有子栏目~！</br>先去添加一个再试哦', {
                            skin: 'layui-layer-lan'
                            ,closeBtn: 0
                            ,anim: 6 //动画类型
                        });
                    }
                    loadContent();
                    form.render();
                }
            }
        });
    });

    form.on('select(column-filter)', function(data){
        loadContent();
    });
    
});
</script>
<div class="layui-body">

    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md12">
            <div class="layui-field-box fx-field-box">
                <fieldset class="layui-elem-field layui-field-title">
                <legend>关于我们</legend>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md12">

            <div class="layui-field-box">
                <form class="layui-form layui-form-pane">
                    <input id="about_id" type="hidden" name="about_id">
                    <div class="layui-input-inline">
                        <select name="module" lay-filter="module-filter">
                            <?php foreach ($modules as $item): ?>
                            <option value="<?php echo $item['module_id']; ?>"><?php echo $item['show_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select id="subcolumn" name="column" lay-filter="column-filter">
                            <?php foreach ($columns as $item): ?>
                            
                            <option value="<?php echo $item['column_id']; ?>"><?php echo $item['column_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="layui-input-inline">
                        <span id="about_status" class="layui-badge layui-bg-gray">
                            <i class="layui-icon">&#xe63e;</i>
                        </span>
                    </div>
                    <hr>
                    <div class="layui-form-item layui-form-text">
                        <div class="layui-input-block">
                            <textarea name="about_content" id="about_content" class="layui-textarea" style="width:100%; height:360px;">
                            </textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <button class="layui-btn" lay-submit lay-filter="save">
                        <i class="layui-icon">&#xe608;</i>保存
                        </button>

                        <button class="layui-btn layui-btn-primary" lay-submit lay-filter="delete">
                        <i class="layui-icon">&#xe640;</i>删除
                        </button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>