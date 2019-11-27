<?php /*a:1:{s:80:"/Library/WebServer/Documents/thinkadmin/application/admin/view/content/edit.html";i:1574838923;}*/ ?>
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
                <li class="layui-nav-item"><a href="/index.php/admin/index/index">首页</a></li>
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
            <input type="hidden" name="news_id" value="<?php echo htmlentities($data['news_id']); ?>">
            <div class="layui-form-item">
                <label class="layui-form-label">标题：</label>
                <div class="layui-input-block">
                    <input value="<?php echo htmlentities($data['title']); ?>" type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">短标题：</label>
                <div class="layui-input-block">
                    <input value="<?php echo htmlentities($data['small_title']); ?>" type="text" name="small_title" required  lay-verify="required" placeholder="请输入短标题" autocomplete="off" class="layui-input">
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
                <input id="uploadsrc" name="uploadsrc" value="<?php echo htmlentities($data['thumb']); ?>" type="hidden">
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <img id="pre_img" style="height: 200px;" />
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">标题颜色：</label>
                <div class="layui-input-inline" style="width: 120px;">
                    <input value="<?php echo htmlentities($data['title_font_color']); ?>" name="title_font_color" type="text" required value="" placeholder="请选择颜色" class="layui-input" id="colorpicker-input">
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
                        <option value="<?php echo htmlentities($vo['menu_id']); ?>" {{# if($vo.menu_id == $data.catid){ }} selected="" {{# }}}><?php echo htmlentities($vo['menuname']); ?></option>
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
                        <option value="<?php echo htmlentities($key); ?>" {{# if($vo.menu_id == $data.copyfrom){ }} selected="" {{# }}><?php echo htmlentities($vo); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">关键字：</label>
                <div class="layui-input-inline">
                    <input value="<?php echo htmlentities($data['keywords']); ?>" type="text" name="keywords" placeholder="请输入关键字" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">描述：</label>
                <div class="layui-input-block">
                    <input value="<?php echo htmlentities($data['description']); ?>" type="text" name="description" placeholder="请输入描述" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">内容：</label>
                <div class="layui-input-block">
                    <textarea id="content" name="content" required style="width:700px;height:300px;"><?php echo htmlentities($data['content']); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="confirm">提交编辑</button>
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
<script src="/layui/layui.js"></script>
<script src="/dialog.js"></script>
<script charset="utf-8" src="/kindeditor/kindeditor-all.js"></script>
<script charset="utf-8" src="/kindeditor/lang/zh-CN.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script>
    var thumb = "<?php echo htmlentities($data['thumb']); ?>";
    if(thumb){
        $('#pre_img').attr('src', thumb);
    }
</script>
<script>
    layui.use(['form','colorpicker','upload'],function () {
        var uploadInst = layui.upload;
        uploadInst.render({
            elem: '#upload' //绑定元素
            , url: '<?php echo url("Content/upload"); ?>' //上传接口
            , accept: 'images'
            , before: function (obj) {
                layer.load(); //上传loading
                obj.preview(function (index, file, result) {
                    $('#uploadname').val(file.name); //展示文件名
                    $('#pre_img').attr('src', result);
                });
            }
            , done: function (res) {
                //上传完毕回调
                layer.closeAll('loading'); //关闭loading
                if (res.status == 0) {
                    dialog.error(res.message);
                } else {
                    $('#uploadsrc').val(res.message);
                }
            }
            , error: function () {
                //请求异常回调
                layer.closeAll('loading'); //关闭loading
                dialog.error('上传失败！');
            }
        });

        //kindeditor编辑器
        KindEditor.ready(function (K) {
            //editor的原理是隐藏原有的textarea新建iframe，所以要把iframe的数据同步到textarea
            var editor = K.create('textarea[name="content"]', {
                //uploadJson:'/index.php/admin/content/editorUpload', //上传接口
                afterBlur: function () {
                    this.sync();
                }//同步回去后当做是input进行ajax提交即可
            });
        });

        //表单提交
        var form = layui.form;
        form.on('submit(confirm)', function (data) {
            var dataTemp = {
                news_id:data.field.news_id,
                title: data.field.title,
                small_title: data.field.small_title,
                title_font_color: data.field.title_font_color,
                catid: data.field.catid,
                keywords: data.field.keywords,
                description: data.field.description,
                content: data.field.content,
                thumb: data.field.uploadsrc,
                copyfrom: data.field.copyfrom,
            };
            //console.log(dataTemp);
            $.ajax({
                type: 'post',
                url: '<?php echo url("Content/edit"); ?>',
                data: dataTemp,
                dataType: 'json',
                beforeSend: function () {
                    index = layer.load(1, {
                        shade: [0.1, '#fff'] //0.1透明度的白色背景
                    });
                },
                success: function (data) {
                    layer.close(index);
                    if (data.status == 1) {
                        dialog.success(data.message, '<?php echo url("Content/index"); ?>');
                    }
                    if (data.status == 0) {
                        dialog.error(data.message);
                    }
                    return false;
                }
            });
            return false;
        });

        //颜色选择器
        var $ = layui.$
            , colorpicker = layui.colorpicker;
        //表单赋值
        colorpicker.render({
            elem: '#colorpicker'
            , color: '#1c97f5'
            , done: function (color) {
                $('#colorpicker-input').val(color);//将颜色的值赋给input
            }
        });
    });
</script>
</html>