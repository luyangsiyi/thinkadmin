<?php /*a:1:{s:77:"/Library/WebServer/Documents/thinkadmin/application/admin/view/menu/edit.html";i:1574755282;}*/ ?>
<body class="layui-layout-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">菜单名：</label>
            <div class="layui-input-block">
                <input type="text" name="menuname" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">菜单类型：</label>
            <div class="layui-input-block">
                <input type="radio" name="menutype" value="bank">
                <label class="layui-form-label">后台菜单</label>
                <input type="radio" name="menutype" value="front">
                <label class="layui-form-label">前端栏目</label>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">模块名：</label>
            <div class="layui-input-inline">
                <input type="text" name="modulename" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">控制器：</label>
            <div class="layui-input-inline">
                <input type="text" name="controller" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">方法：</label>
            <div class="layui-input-inline">
                <input type="text" name="method" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态：</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="on">
                <label class="layui-form-label">开启</label>
                <input type="radio" name="status" value="off">
                <label class="layui-form-label">关闭</label>
            </div>
        </div>
    </form>
</body>
