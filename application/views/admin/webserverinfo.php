<div class="layui-body">
    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md12">
            <div class="layui-field-box fx-field-box">
                <fieldset class="layui-elem-field layui-field-title">
                <legend>服务器信息</legend>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-md12">
            <div class="layui-field-box">
                <div class="layui-form-item">
                    <label class="layui-form-label">操作系统</label>
                    <div class="layui-form-mid layui-word-aux"><?=$server_info['os']?></div>
                </div>
                <hr>

                <div class="layui-form-item">
                    <label class="layui-form-label">Web服务器</label>
                    <div class="layui-form-mid layui-word-aux"><?=$server_info['server']?></div>
                </div>
                <hr>

                <div class="layui-form-item">
                    <label class="layui-form-label">PHP版本</label>
                    <div class="layui-form-mid layui-word-aux"><?=$server_info['php']?></div>
                </div>
                <hr>

                <div class="layui-form-item">
                    <label class="layui-form-label">数据库版本</label>
                    <div class="layui-form-mid layui-word-aux"><?=$server_info['database']?></div>
                </div>
            </div>
        </div>
    </div>
</div>