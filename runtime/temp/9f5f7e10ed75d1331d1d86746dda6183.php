<?php /*a:1:{s:81:"/Library/WebServer/Documents/thinkadmin/application/admin/view/position/edit.html";i:1574848933;}*/ ?>
<body class="layui-layout-body">
<form class="layui-form" id="editposition">
    <div class="layui-form-item">
        <label class="layui-form-label">ID：</label>
        <div class="layui-input-block">
            <input type="text" name="id" class="layui-input" disabled>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">推荐位位置：</label>
        <div class="layui-input-inline" action="">
            <select name="searchbyposition" id="searchbyposition">
                <option value="">请选择推荐位</option>
                <?php if(is_array($position) || $position instanceof \think\Collection || $position instanceof \think\Paginator): $i = 0; $__LIST__ = $position;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['name']); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">标题：</label>
        <div class="layui-input-inline">
            <input type="text" name="title" class="layui-input" disabled>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章ID ：</label>
        <div class="layui-input-inline">
            <input type="text" name="news_id" class="layui-input" disabled>
        </div>
    </div>
</form>
</body>
