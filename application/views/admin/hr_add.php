<link rel="stylesheet" href="<?php echo base_url('resource/vendor/layui/css/layui.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('resource/css/global.css') ?>">
<script src="<?php echo base_url('resource/js/jquery-3.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('resource/vendor/layui/layui.js') ?>"></script>

<script src="<?php echo base_url('resource/editor/kindeditor-all-min.js') ?>"></script>
<script src="<?php echo base_url('resource/editor/lang/zh-CN.js') ?>"></script>
<script>

function today(){
   var mydate = new Date();
   var str = "" + mydate.getFullYear() + "-";
   str += (mydate.getMonth()+1) + "-";
   str += mydate.getDate();
   return str;
  }

layui.use(['element','form','laydate'], function(){
    var editor_opts = {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : true,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				}
    var desc_editor = KindEditor.create('#hr_desc',editor_opts);
    var need_editor = KindEditor.create('#hr_need_desc',editor_opts);

    //var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
    var laydate = layui.laydate;
    var $ = layui.jquery;

    laydate.render({ 
        elem: '#hr_end'
        ,min: today()
        ,theme: 'molv'
    });

    // submit
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引

    //监听提交
    var form = layui.form;
    form.on('submit(hrSubmit)', function(data){
        desc_editor.sync();
        need_editor.sync();
        if($('#hr_desc').val() === '') {
            layer.alert('职位还是描述一下吧~~', {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 6 //动画类型
                    });
            return false;
        } else {
            data.field['hr_desc'] = $('#hr_desc').val();
        }

        if($('#hr_need_desc').val() === '') {
            layer.alert('额~~写点任职要求吧，求你了~', {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 6 //动画类型
                    });
            return false;
        } else {
            data.field['hr_need_desc'] = $('#hr_need_desc').val();
        }
        
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('hr/addHr') ?>',
            data: {
                'data': data.field
            },
            dataType:'json',
            success: function(ret){
                if(ret.code === '0000') {
                    parent.layer.close(index);
                    parent.layer.msg('操作成功');
                } else{
                    layer.alert('添加失败', {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 6 //动画类型
                    });
                }
            }
        });
        return false;
    });

    form.verify({
        'fx-date':function(value,item){
            if(value.trim() != '') {
                if(!/^(\d{4})[-\/](\d{1}|0\d{1}|1[0-2])([-\/](\d{1}|0\d{1}|[1-2][0-9]|3[0-1]))*$/.test(value)){
                    return '日期格式有问题！';
                }
            }
        },
        'fx-number':function(value,item){
            if(value.trim() !=''){
                if(!/^[0-9]*$/.test(value)){
                    return '需要填写数字';
                }
            }
        }
    });
});
</script>
<div class="layui-row">
<form class="layui-form layui-form-pane" action="">
    <div class="layui-col-xs12 layui-col-md12">
        <div class="layui-field-box">
            <div class="layui-form-item">
                <input type="hidden" name="hr_belong" value="<?=$hr_belong?>">
                <label class="layui-form-label">职位名称</label>
                <div class="layui-input-block">
                    <input type="text" name="hr_name" required lay-verify="required" placeholder="职位名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">有效期限</label>
                <div class="layui-input-block">
                    <input type="text" name="hr_end" lay-verify="fx-date" id="hr_end" autocomplete="off" placeholder="不填表示长期有效"  class="layui-input">
                </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">招聘人数</label>
                    <div class="layui-input-block">
                        <input type="text" name="hr_number" lay-verify="fx-number" autocomplete="off" placeholder="人数为0表示若干" class="layui-input">
                    </div>
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <div class="layui-row">
                    <div class="layui-col-xs12 layui-col-md6">
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">职位描述</label>
                            <div class="layui-input-block">
                                <textarea name="hr_desc" id="hr_desc" placeholder="职位描述" class="layui-textarea" style="width:100%; height:150px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-xs12 layui-col-md6">
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">任职要求</label>
                            <div class="layui-input-block">
                                <textarea name="hr_need_desc" id="hr_need_desc" placeholder="任职要求" class="layui-textarea" style="width:100%; height:150px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button id="publish_post" class="layui-btn" lay-submit lay-filter="hrSubmit">立即发布</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </div>
    </div>
</form>

</div>