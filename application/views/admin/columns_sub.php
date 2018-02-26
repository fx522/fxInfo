<link rel="stylesheet" href="<?php echo base_url('resource/vendor/layui/css/layui.css') ?>">
<script src="<?php echo base_url('resource/vendor/layui/layui.js') ?>"></script>
<script>
layui.use(['element','form','table'], function(){
    var form = layui.form;
    var table= layui.table;
    var $ = layui.jquery;

    $('#add-sub-column').on('click',function(){
        layer.prompt({title:'子栏目名称'},function(value, index, elem){
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('module/addSubColumn') ?>',
                data: {
                    'sub_name':value,
                    'module_id':'<?=$id?>'
                },
                dataType:'json',
                success: function(ret){
                    if(ret.code === '0000') {
                        layer.msg('添加成功');

                        table.reload('columns_list', {
                            url: $('#reloadUrl').val()
                        });
                        layer.close(index);

                    } else{
                        layer.msg('添加失败');
                    }
                }
            });
        });
    });

    //监听工具条
    table.on('tool(CLIST)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
            layer.confirm('真的非要删除不可吗？</br>我给你唱首歌吧！~', function(index){

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('module/delSubColumn') ?>',
                    data: {
                        'column_id':data.column_id
                    },
                    dataType:'json',
                    success: function(ret){
                        if(ret.code === '0000') {
                            layer.msg('操作成功');

                            table.reload('columns_list', {
                                url: $('#reloadUrl').val()
                            });
                        } else{
                            layer.msg('操作失败');
                        }
                        layer.close(index);
                    }
                });
            });
        } else if(obj.event === 'edit') {
            layer.prompt({
                formType: 0,
                value: data.column_name,
                title: '菜单修改'
                }, function(value, index, elem){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('module/editSubColumn') ?>',
                        data: {
                            'column_id':data.column_id,
                            'new_name':value
                        },
                        dataType:'json',
                        success: function(ret){
                            if(ret.code === '0000') {
                                layer.msg('操作成功');

                                table.reload('columns_list', {
                                    url: $('#reloadUrl').val()
                                });
                            } else{
                                layer.msg('操作失败');
                            }
                            layer.close(index);
                        }
                    });
                    layer.close(index);
                }
            );
        }
    });
});
</script>

<div class="layui-row">
    <input id='reloadUrl' type='hidden' value="<?php echo base_url('module/subColumns/') ?><?=$id?>">
    <div class="layui-col-xs12 layui-col-md8">

        <div class="layui-field-box">
            <button class="layui-btn" id="add-sub-column">
                <i class="layui-icon">&#xe608;</i> 新增一个子栏目
            </button>
            <table id='columns_list' class="layui-table" lay-data="{height:260, cellMinWidth: 80, url:'<?php echo base_url('module/subColumns/') ?><?=$id?>'}" lay-filter="CLIST">
                <thead>
                    <tr>
                    <th lay-data="{field:'column_name'}">子栏目名称</th>
                    <th lay-data="{fixed: 'right', align:'center', toolbar: '#columnOpt'}"></th>
                    </tr>
                </thead>
            </table> 
            <script type="text/html" id="columnOpt">
                <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
            </script>
        </div>
    </div>
</div>