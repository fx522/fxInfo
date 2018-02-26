<!--<script src="<?php echo base_url('resource/js/content.js') ?>"></script>
<script src="<?php echo base_url('resource/editor/kindeditor-all-min.js') ?>"></script>
<script src="<?php echo base_url('resource/editor/lang/zh-CN.js') ?>"></script>
-->

<script>

layui.use(['form','laydate','upload','table'], function(){
    if(<?=count($modules)?> ==  0) {
        layer.alert('还没有栏目，还是先添加一个吧~！', {
            icon: 0,
            title:'重要提示'
        });
    };
  var newsTblReload = function(p_id,s_id){
    // 表格处理
    layer.load(2);
    var table = layui.table;
    var targetUrl = '<?php echo base_url('content/posts/') ?>' + p_id+ '/' + s_id;
    table.render({
        elem: '#content_list'
        ,url: targetUrl
        ,cols: [[
        {fixed: 'left', unresize: true, title: '操作', width:100,align:'center', toolbar: '#postOpt'} 
        ,{ unresize:true,checkbox: true}
        ,{field:'post_title', width:'30%',templet:'#titleTpl', title: '标题', unresize: true}
        ,{field:'first_belong', title: '所属模块', unresize: true}
        ,{field:'second_belong', title: '所属栏目', unresize: true}
        ,{field:'created_at', title: '发表于', unresize: true}
        
        ]]
        ,page: true
        ,done: function(res, curr, count){
            layer.closeAll('loading');
        }
        ,error: function(){
            layer.closeAll('loading');
        }
    });

    //监听工具条
    table.on('tool(contentTbl)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
            layer.confirm('真的要删除我么？', function(index){
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('content/delPost') ?>',
                    data: {
                        'post_del_data':data['post_id']
                    },
                    dataType:'json',
                    success: function(ret){
                        if(ret.code === '0000') {
                            layer.msg('操作成功');
                            newsTblReload($("select[name='module']").val(),$("select[name='column']").val());
                        } else{
                            layer.msg('操作失败');
                        }
                    }
                });
                layer.close(index);
            });
        } else if(obj.event === 'edit'){
            var tgtUrl = '<?php echo base_url('content/editPage/') ?>' + data['post_id'];
            layer.open({
                type: 2,
                content: tgtUrl,
                area: ['80%', '80%'],
                end:function(){
                    newsTblReload($("select[name='module']").val(),$("select[name='column']").val());
                }
            });

            // layer.alert('编辑行：<br>'+ JSON.stringify(data))
        }
    });

    $('#delMulti').on('click', function(){
        var checkStatus = table.checkStatus('content_list')
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
                    url: '<?php echo base_url('content/delPost') ?>',
                    data: {
                        'post_del_data':data
                    },
                    dataType:'json',
                    success: function(ret){
                        if(ret.code === '0000') {
                            layer.msg('操作成功');
                            newsTblReload($("select[name='module']").val(),$("select[name='column']").val());
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
  newsTblReload($("select[name='module']").val(),$("select[name='column']").val());

  var form = layui.form;
  // select
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
                newsTblReload($("select[name='module']").val(),$("select[name='column']").val());
                form.render();
            }
        }
    });
  });

  form.on('select(column-filter)', function(data){
    newsTblReload($("select[name='module']").val(), data.value);
  });

  // add post
  form.on('submit(addNews)', function(data){
      if(data.field['column'] == ''){
        layer.alert('额，好像没有子栏目~！</br>先去添加一个再试试哦', {
            skin: 'layui-layer-lan'
            ,closeBtn: 0
            ,anim: 6 //动画类型
        });
      } else {
        var tgtUrl = '<?php echo base_url('content/addPage') ?>' + '?main=' + data.field['module'] +'&sub=' + data.field['column'];
        layer.open({
            type: 2,
            content: tgtUrl,
            area: ['80%', '80%'],
            end:function(){
                newsTblReload($("select[name='module']").val(),$("select[name='column']").val());
            }
        });
        // layer.full(index);
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
                <legend>文章案例</legend>
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

                    <button class="layui-btn" lay-submit lay-filter="addNews">
                    <i class="layui-icon">&#xe608;</i> 添加
                    </button>

                    <button class="layui-btn layui-btn-primary" id="delMulti">
                    <i class="layui-icon">&#xe640;</i>批量删除
                    </button>
                </form>
            </div>

            <div class="layui-field-box">
                <table class="layui-hide" id="content_list" lay-filter="contentTbl"></table>
                <script type="text/html" id="titleTpl">
                {{#  if(d.is_top == '1' && d.is_recommend == '1'){ }}
                    <span class="layui-badge layui-bg-green">顶</span>&nbsp;<span class="layui-badge layui-bg-orange">荐</span>&nbsp;{{ d.post_title}}
                {{#  } else if(d.is_top == '1') { }}
                    <span class="layui-badge layui-bg-green">顶</span>&nbsp;{{ d.post_title}}
                {{#  } else if(d.is_recommend == '1') { }}
                    <span class="layui-badge  layui-bg-orange">荐</span>&nbsp;{{ d.post_title}}
                {{#  } else { }}
                    {{ d.post_title}}
                {{#  } }}
                </script>

                <script type="text/html" id="postOpt">
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