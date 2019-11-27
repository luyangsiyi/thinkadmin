<?php /*a:1:{s:81:"/Library/WebServer/Documents/thinkadmin/application/admin/view/content/edit1.html";i:1574758370;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台页面</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">后台页面</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    user
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">修改密码</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="/index.php/admin/login/logout">退出</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item"><a href="/index.php/admin/menu/index">菜单管理</a></li>
                <li class="layui-nav-item layui-this"><a href="/index.php/admin/content/index">文章管理</a></li>
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
            <legend>
                <a href="/index.php/admin/index/index">首页</a> /
                <a href="/index.php/admin/content/index">文章管理</a> /
                <a><cite>编辑文章</cite></a>
            </legend>
        </fieldset>
        <form class="layui-form" action="">
            <input type="hidden" name="news_id">
            <div class="layui-form-item">
                <label class="layui-form-label">标题：</label>
                <div class="layui-input-block">
                    <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">短标题：</label>
                <div class="layui-input-block">
                    <input type="text" name="small_title" required  lay-verify="required" placeholder="请输入短标题" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">缩略图：</label>
                <div class="layui-input-inline">
                    <input id="uploadname" required type="text" autocomplete="off" class="layui-input" disabled>
                </div>
                <button type="button" class="layui-btn" id="upload">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                </button>
                <input id="uploadsrc" name="uploadsrc" type="hidden">
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <img id="pre_img" style="height: 200px;" />
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">标题颜色：</label>
                <div class="layui-input-inline" style="width: 120px;">
                    <input name="title_font_color" type="text" required value="" placeholder="请选择颜色" class="layui-input" id="colorpicker-input">
                </div>
                <div class="layui-inline" style="left: -11px;">
                    <div id="colorpicker"></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">所属栏目：</label>
                <div class="layui-input-inline">
                    <select name="catid" required lay-filter="catid">
                        <option value="">请选择栏目</option>
                        <?php if(is_array($cat) || $cat instanceof \think\Collection || $cat instanceof \think\Paginator): $i = 0; $__LIST__ = $cat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!--模板输出。cat是assign的变量名，vo是自定义的表示每一个item-->
                        <option value="<?php echo htmlentities($vo['menu_id']); ?>"><?php echo htmlentities($vo['menuname']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">来源：</label>
                <div class="layui-input-inline">
                    <select name="copyfrom" required lay-filter="copyfrom">
                        <option value="">请选择来源</option>
                        <?php if(is_array($copyfrom) || $copyfrom instanceof \think\Collection || $copyfrom instanceof \think\Paginator): $i = 0; $__LIST__ = $copyfrom;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!--模板输出。没有key和value具体名称的情况-->
                        <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($vo); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">关键字：</label>
                <div class="layui-input-inline">
                    <input type="text" name="keywords" placeholder="请输入关键字" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">描述：</label>
                <div class="layui-input-block">
                    <input type="text" name="description" placeholder="请输入描述" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">内容：</label>
                <div class="layui-input-block">
                    <textarea id="content" name="content" required style="width:700px;height:300px;"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="confirm">确定提交</button>
                </div>
            </div>
        </form>
    </div>
    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © 陆洋山芋
    </div>
</div>
</body>
</html>