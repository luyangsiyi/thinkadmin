<?php /*a:1:{s:79:"/Library/WebServer/Documents/thinkadmin/application/admin/view/login/index.html";i:1574147951;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>登录页面</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <link rel="stylesheet" href="/layui/css/login.css">
</head>
<body class="beg-login-bg">
<div class="beg-login-box">
    <header>
        <h1>后台登录</h1>
    </header>
    <div class="beg-login-main">
        <form action="" class="layui-form">
            <div class="layui-form-item">
                <label class="beg-login-icon">
                    <i class="layui-icon">&#xe612;</i>
                </label>
                <input type="text" name="username" lay-verify="username" autocomplete="off" placeholder="这里输入登录名" class="layui-input username">
            </div>
            <div class="layui-form-item">
                <label class="beg-login-icon">
                    <i class="layui-icon">&#xe642;</i>
                </label>
                <input type="password" name="password" lay-verify="password" autocomplete="off" placeholder="这里输入密码" class="layui-input">
            </div>
            <div class="layui-form-item">
                <div class="beg-pull-left" style="width: 130px;">
                    <label class="beg-login-icon">
                        <i class="layui-icon">&#xe642;</i>
                    </label>
                    <input type="text" name="captcha" lay-verify="captcha" autocomplete="off" placeholder="输入验证码" class="layui-input">
                </div>
                <div class="beg-pull-right">
                    <img src="/back/captcha" onclick="javascript:this.src='/back/captcha?tm='+Math.random()" title="单击刷新验证码" id="img_rand_code" alt="" style="cursor: pointer;">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="beg-pull-left beg-login-remember">
                    <label>记住帐号？</label>
                    <input type="checkbox" name="rememberMe" value="true" lay-skin="switch" checked title="记住帐号">
                </div>
                <div class="beg-pull-right">
                    <button class="layui-btn layui-btn-primary" lay-submit lay-filter="login">
                        <i class="layui-icon">&#xe650;</i> 登录
                    </button>
                </div>
                <div class="beg-clear"></div>
            </div>
        </form>
        <footer>
            <p> © 陆洋山芋</p>
        </footer>
    </div>
</div>
<script src="/layui/layui.js"></script>
<script src="/static/js/md5.js"></script>
<script src="/dialog.js"></script>
<script>
    layui.use(['form','layer'],function () {
        var layer = layui.layer,
            $ = layui.jquery,
            form = layui.form;
        form.verify({
            username:function (value) {
                if(value.length === 0 || $.trim(value).length === 0){
                    return "登录名不能为空";
                }
            },
            password:[/(.+){6,12}$/, '密码必须6到12位']
        });

        form.on('submit(login)',function (data) {
            var dataTemp = {
                username: data.field.username,
                password:hex_md5(data.field.password +'sing_cms'),
                rememberMe:data.field.rememberMe,
                captcha:data.field.captcha
            };
            var index;
            $.ajax({
                type: 'post',
                url:  '/index.php/admin/login/check',
                data: dataTemp,
                dataType: 'json',
                beforeSend:function () {
                    index = layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });
                },
                success:function (data) {
                    layer.close(index);
                    if(data.status == 1) {
                        dialog.success(data.message,'/admin/index/index')
                    }
                    if(data.status == 0) {
                        dialog.error(data.message);
                    }
                    return false;
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
