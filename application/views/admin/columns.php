
<script type="text/javascript">
    $(document).ready(function(){
        loadData($('.fx-module-list'),'<?php echo base_url('/') ?>');

        $('#add-module').on('click', function(){
            layer.open({
              type: 2,
              title:'添加一个栏目',
              area: ['690px', '590px'],
              shadeClose: true, //点击遮罩关闭
              content: '<?php echo base_url('module/addModulePage') ?>',
              end:function(){
                loadData($('.fx-module-list'),'<?php echo base_url('/') ?>');
              }
            });
        });
    });

    function subModuleMng(e){
        var baseUrl = '<?php echo base_url('module/subColumnPage/') ?>';
        var id = $(e).parent().attr('id');
        layer.open({
              title: '[' + $(e).children(".name").text()+']的子栏目',
              type: 2,
              area: ['690px', '390px'],
              shadeClose: true, //点击遮罩关闭
              content: baseUrl + id,
              end:function(){
                loadData($('.fx-module-list'),'<?php echo base_url('/') ?>');
              }
        });
    };

    function editModule(e){
        var optId = $(e).parent().attr('id');
        layer.open({
            type: 2,
            title:'编辑栏目信息',
            area: ['690px', '590px'],
            shadeClose: true,
            content: '<?php echo base_url('module/editModulePage/') ?>' + optId,
            end:function(){
                loadData($('.fx-module-list'),'<?php echo base_url('/') ?>');
            }
        });
    }

    function delModel(e){
        var optId = $(e).parent().attr('id');
        layer.confirm('真的非要删除不可吗？<br>我想静静~~~', function(index){
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('module/delModule') ?>',
                data: {
                    'id':optId
                },
                dataType:'json',
                success: function(ret){
                    if(ret.code === '0000') {
                        layer.msg('操作成功');

                        loadData($('.fx-module-list'),'<?php echo base_url('/') ?>');
                    } else{
                        layer.msg('操作失败');
                    }
                    layer.close(index);
                }
            });
        });
    }

    function loadData(e, baseUrl){
        var lodeIdx = layer.msg('加载中', {
        icon: 16
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('module/allmodules') ?>',

            dataType:'json',
            success: function(ret){
                if(ret.code === '0000') {
                    e.empty();
                    for(var idx in ret.data){
                        var iconImage = (ret.data[idx].icon_img == '')? 'resource/images/admin/wenzhang.png' : ret.data[idx].icon_img
                        var elemStr = "<li id='"+ ret.data[idx].module_id +"'>";
                        elemStr += "<button class='layui-btn layui-btn-normal layui-btn-xs fx-float-btn' onclick='editModule(this)'><i class='layui-icon'>&#xe642;</i></button>";
                        elemStr += "<button class='layui-btn layui-btn-danger layui-btn-xs fx-float-btn' onclick='delModel(this)'><i class='layui-icon'>&#xe640;</i></button>";
                        elemStr += "<a href='javascript:void(0);' onClick='subModuleMng(this)'>";
                        elemStr += "<img src='"+ baseUrl + iconImage +"' />";
                        elemStr += "<div class='name'>" + ret.data[idx].show_name;

                        if((parseInt(ret.data[idx].show_where)==0)) {
                            elemStr += "<span class='layui-badge-dot layui-bg-blue'></span>";
                        } else if(parseInt(ret.data[idx].show_where)==2){
                            elemStr += "<span class='layui-badge-dot layui-bg-green'></span>";
                        }else if(parseInt(ret.data[idx].show_where)==3){
                            elemStr += "<span class='layui-badge-dot layui-bg-orange'></span>";
                        }else{
                            elemStr += "<span class='layui-badge-dot layui-bg-red'></span>";
                        }

                        
                        elemStr += "</div>";

                        elemStr += "<div class='sub-name'>"
                        if((parseInt(ret.data[idx].module_type)==0)) {
                            elemStr += "文章模块";
                        } else if(parseInt(ret.data[idx].module_type)==2){
                            elemStr += "招聘模块";
                        }else if(parseInt(ret.data[idx].module_type)==3){
                            elemStr += "简介模块";
                        }else{
                            elemStr += "案例模块";
                        }
                        elemStr += "</div>";
                        elemStr += "</a></li>";

                        e.append(elemStr);
                    }
                    layer.close(lodeIdx);
                } else{
                    layer.alert('数据加载失败', {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 6 //动画类型
                    });
                }
            }
        });
    }
</script>
<div class="layui-body">
    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md12">
            <div class="layui-field-box fx-field-box">
                <fieldset class="layui-elem-field layui-field-title">
                <legend>栏目管理</legend>
                </fieldset>
            </div>
        </div>
    </div>


    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md8">
            <div class="layui-field-box">
                <button id="add-module" class="layui-btn">
                    <i class="layui-icon">&#xe608;</i> 添加新栏目
                </button>

                <ul class="fx-module-list">

                </ul>
            </div>
        </div>

        <div class="layui-col-xs12 layui-col-md4">
            <div class="layui-field-box">
                <fieldset class="layui-elem-field">
                    <legend>符号说明</legend>
                    <div class="layui-field-box fx-manual">
                        <p><span class="layui-badge-dot layui-bg-blue"></span>&nbsp;&nbsp;在头部导航和底部导航都显示</p>
                        <p><span class="layui-badge-dot layui-bg-green"></span>&nbsp;只在头部导航显示</p>
                        <p><span class="layui-badge-dot layui-bg-orange"></span>&nbsp;只在底部导航显示</p>
                        <p><span class="layui-badge-dot layui-bg-red"></span>&nbsp;都不显示</p>
                    </div>
                </fieldset>

                <fieldset class="layui-elem-field">
                    <legend>其他说明</legend>
                    <div class="layui-field-box fx-manual">
                        <p>1. 任何一个栏目至少拥有一个子栏目</p>
                        <p>2. 删除栏目的同时，所以子栏目也会被删除！</p>
                        <p>3. 栏目删除时，所属的文章不会被删除！（数据安全方面考虑）</p>
                    </div>
                </fieldset>
            </div>
        </div>

    </div>
</div>