layui.use(['form','laydate','upload','table'], function(){
  //var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
  var laydate = layui.laydate;
  var $ = layui.jquery, upload = layui.upload;
  
  //常规用法
  laydate.render({
    elem: '#publishtime'
    ,type: 'datetime'
  });

// 图片上传接口
  var uploadInst = upload.render({
    elem: '#coverImage'
    ,url: '/upload/'
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#coverImagePreview').attr('src', result); //图片链接（base64）
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
  
  // 表格处理
  var table = layui.table;
  table.render({
    elem: '#content_list'
    ,url:'/aaa/admin/contents'
    ,cols: [[
      { unresize:true,checkbox: true}
      ,{field:'post_title', width:540, templet:'#titleTpl', title: '标题', unresize: true}
      ,{field:'first_belong', width:150, title: '一级菜单', unresize: true}
      ,{field:'secong_belong', width:150, title: '二级菜单', unresize: true}
      ,{fixed: 'right', width:150, align:'center', toolbar: '#postOpt'} 
    ]]
    ,page: true
  });

  var form = layui.form;
  form.on('select(module-filter)', function(data){
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('module/editModule') ?>',
        data: {
            'id':$('#module_id').val(),
            'title':$("input[name='title']").val(),
            'type':$("input[name='type']:checked").val(),
            'position':position
        },
        dataType:'json',
        success: function(ret){
            if(ret.code === '0000') {
                parent.layer.close(index);
            } else{
                layer.alert('更新失败', {
                    skin: 'layui-layer-molv'
                    ,closeBtn: 0
                    ,anim: 6 //动画类型
                });
            }
        }
    });
  });
});