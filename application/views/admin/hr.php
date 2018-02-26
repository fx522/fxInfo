<script>
layui.use(['form','laydate','table'], function(){

    if(<?=count($modules)?> ==  0) {
        layer.alert('还没有栏目，还是先添加一个吧~！', {
            icon: 0,
            title:'重要提示'
        });
    };
    var hrTblReload = function(){
        // 表格处理
        layer.load(2);
        var table = layui.table;
        var targetUrl = '<?php echo base_url('hr/all/') ?>' + $("#subcolumn").val();
        table.render({
            elem: '#hr_list'
            ,url: targetUrl
            ,cols: [[
                {fixed: 'left', unresize: true, title: '操作', width:100,align:'center', toolbar: '#hrOpt'} 
                ,{ unresize:true,checkbox: true}
                ,{field:'hr_name', width:'39%',title: '职位名称', unresize: true}
                ,{field:'hr_number', title: '招聘人数', templet:'#hrNumberTpl', sort: true, unresize: true}
                ,{field:'hr_end', title: '截止日期', templet:'#hrEndTpl',sort: true, unresize: true}
                ,{field:'created_at', title: '发表于', sort: true, unresize: true}
            ]]
            ,page: false
            ,done: function(res, curr, count){
                $('#hr_sum').text(count);
                layer.closeAll('loading');
            }
        });

        //监听工具条
        table.on('tool(hrTbl)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('真的要删除我么？', function(index){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('hr/delHr') ?>',
                        data: {
                            'hr_del_data':data['hr_id']
                        },
                        dataType:'json',
                        success: function(ret){
                            if(ret.code === '0000') {
                                layer.msg('操作成功');
                                hrTblReload();
                            } else{
                                layer.msg('操作失败');
                            }
                        }
                    });
                    layer.close(index);
                });
            } else if(obj.event === 'edit'){
                var tgtUrl = '<?php echo base_url('hr/editPage/') ?>' + data['hr_id'];
                layer.open({
                    type: 2,
                    content: tgtUrl,
                    area: ['40%', '69%'],
                    end:function(){
                        hrTblReload();
                    }
                });
            }
        });

        $('#delMulti').on('click', function(){
            var checkStatus = table.checkStatus('hr_list')
            ,data = checkStatus.data;
            if(data.length == 0) {
                layer.alert('额，你一个也没选啊~！！', {
                    skin: 'layui-layer-lan'
                    ,closeBtn: 0
                    ,anim: 6 //动画类型
                });
            } else {
                layer.confirm('真的要删除我们('+ data.length +')么？', function(index){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('hr/delHr') ?>',
                        data: {
                            'hr_del_data':data
                        },
                        dataType:'json',
                        success: function(ret){
                            if(ret.code === '0000') {
                                layer.msg('操作成功');
                                hrTblReload();
                            } else{
                                layer.msg('操作失败');
                            }
                        }
                    });
                    layer.close(index);
                });
            }
            return false;
        });
    };
    hrTblReload();

    var form = layui.form;
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
                    hrTblReload();
                    form.render();
                }
            }
        });
    });

    form.on('select(column-filter)', function(data){
        hrTblReload();
    });

    // add
    form.on('submit(addHr)', function(data){
        if(data.field['column'] == ''){
            layer.alert('额，好像没有选择子栏目~！</br>没有的话，添加一个再试试看~', {
                skin: 'layui-layer-lan'
                ,closeBtn: 0
                ,anim: 4 //动画类型
            });
        } else {
            layer.open({
                type: 2,
                title:'添加一条招聘信息',
                content: '<?php echo base_url('hr/addPage') ?>'  + '?main=' + data.field['column'],
                area: ['40%', '69%'],
                end:function(){
                    hrTblReload();
                }
            });
        }
        return false;
    });
});
</script>
<div class="layui-body">

    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md12">
            <div class="layui-field-box fx-field-box">
                <fieldset class="layui-elem-field layui-field-title">
                <legend>招聘信息<span id="hr_sum" class="layui-badge layui-bg-green">-</span></legend>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md12">
            <div class="layui-field-box">
                <form class="layui-form layui-form-pane">
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

                    <button class="layui-btn" lay-submit lay-filter="addHr">
                    <i class="layui-icon">&#xe608;</i> 添加
                    </button>

                    <button class="layui-btn layui-btn-primary" id="delMulti">
                    <i class="layui-icon">&#xe640;</i>批量删除
                    </button>
                </form>
            </div>

            <div class="layui-field-box">
                <table class="layui-hide" id="hr_list" lay-filter="hrTbl"></table>
                <script type="text/html" id="hrNumberTpl">
                {{#  if(d.hr_number == 0){ }}
                    若干
                {{#  } else { }}
                    {{ d.hr_number}}
                {{#  } }}
                </script>

                <script type="text/html" id="hrEndTpl">
                {{#  if(d.hr_end == '0000-00-00'){ }}
                    长期有效
                {{#  } else { }}
                    {{ d.hr_end}}
                {{#  } }}
                </script>

                <script type="text/html" id="hrOpt">
                    <button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">
                        <i class="layui-icon">&#xe640;</i>
                    </button>
                    <button class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">
                        <i class="layui-icon">&#xe642;</i>
                    </button>
                </script>
            </div>
        </div>
    </div>
</div>