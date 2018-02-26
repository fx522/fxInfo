<script>
layui.use(['element','table'], function(){
    
    var logTblLoad = function(){
        var table = layui.table;
        var targetUrl = '<?php echo base_url('admin/actionLog') ?>';
        table.render({
            elem: '#actionTbl'
            ,url: targetUrl
            ,cols: [[
                {field:'log_time', title: '动作时间', unresize: true, sort:true}
                ,{field:'log_name', title: '操作内容', unresize: true, sort:true}
                ,{field:'log_ret_status', templet:'#statusTpl',title: '操作结果', unresize: true, sort:true}
                ,{field:'log_ip', title: 'IP', unresize: true, sort:true}
                ,{field:'log_brower', title: '浏览器', unresize: true, sort:true}
            
            ]]
            ,page: true
            ,height: 'full-210'
            , cellMinWidth: 80
        });
    };

    logTblLoad();
});
</script>
<div class="layui-body">

    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md12">
            <div class="layui-field-box fx-field-box">
                <fieldset class="layui-elem-field layui-field-title">
                <legend>操作记录</legend>
                </fieldset>
            </div>
        </div>
        <div class="layui-field-box">
            <table class="layui-hide" id="actionTbl" lay-filter="actionTbl"></table>

            <script type="text/html" id="statusTpl">
                {{#  if(d.log_ret_status == '0'){ }}
                <span style="color:#5FB878;">成功</span>
                {{#  } else { }}
                <span style="color:#FF5722;">失败</span>
                {{#  } }}
            </script>
        </div>
    </div>
</div>