<?php /*a:1:{s:78:"/Library/WebServer/Documents/thinkadmin/application/admin/view/menu/index.html";i:1574842119;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>菜单管理 - 后台页面</title>
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
                <li class="layui-nav-item layui-this"><a href="/index.php/admin/menu/index">菜单管理</a></li>
                <li class="layui-nav-item"><a href="/index.php/admin/content/index">文章管理</a></li>
                <li class="layui-nav-item"><a href="/index.php/admin/position/index">推荐位管理</a></li>
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div class="layui-tab" lay-filter="menutab">
            <ul class="layui-tab-title">
                <li class="layui-this" lay-id="showmenu">查看菜单</li>
                <li lay-id="addmenu">添加菜单</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <div class="layui-inline">
                        <label class="layui-form-label">类型</label>
                        <div class="layui-input-block" action="">
                            <select name="searchtype" id="searchReload">
                                <option value=""></option>
                                <option value="1">后台菜单</option>
                                <option value="2">前台栏目</option>
                            </select>
                            <button class="layui-btn layui-btn-xs" data-type="reload" id="searchbyType">搜索</button>
                        </div>
                    </div>
                    <table class="layui-hide" id="menulist" lay-filter="showmenu"></table>
                </div>
                <div class="layui-tab-item">
                    <form class="layui-form" action="">
                        <div class="layui-form-item">
                            <label class="layui-form-label">菜单名：</label>
                            <div class="layui-input-inline">
                                <input type="text" name="menuname" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">菜单类型：</label>
                            <div class="layui-input-block">
                                <input type="radio" name="menutype" value="bank" title="后台菜单">
                                <input type="radio" name="menutype" value="front" title="前端栏目">
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
                                <input type="radio" name="status" value="on" title="开启">
                                <input type="radio" name="status" value="off" title="关闭">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="confirm">确定</button>
                                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © 陆洋山芋
    </div>
</div>
<script src="/layui/layui.js"></script>
<script src="/dialog.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script type="text/html" id="status">
    {{# if(d.status == '1'){}}
    开启
    {{# }else{ }}
    关闭
    {{# } }}
</script>
<script type="text/html" id="type">
    {{# if(d.type == '1'){}}
    后台菜单
    {{# }else{ }}
    前端栏目
    {{# } }}
</script>
<!--id跟table cols里面的toolbar绑定-->
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</a>
</script>
<script>
    layui.use(['element','table','form'],function () {
        /*----------------------------*/
        /*------Tab---查看菜单部分------*/
        /*----------------------------*/
        var table = layui.table;
        //方法渲染。field对应后端传回的json数据的key，可以多传。自动ajax get方法
        table.render({
            elem:'#menulist'
            ,url:'/index.php/admin/menu/index'//传递page和limit参数给后端
            ,cellMinWidth: 100 //全局定义常规单元格的最小宽度
            ,cols:[[
                {field:'menu_id',width:100, title:'ID',sort:true,align:'center'}
                ,{field:'menuname',width:250, title:'菜单名',align:'center'}
                ,{field:'modulename',width:250, title:'模块名',align:'center'}
                ,{field:'type',width:250, title:'类型',align:'center',templet:'#type'}//templet模板渲染可以把数据库查到的数据进行修改
                ,{field:'status',width:200, title:'状态',align:'center',templet:'#status'}
                ,{field:'operation',width:200,title:'操作',align:'center',toolbar:'#barDemo'}//绑定按钮组
            ]]
            ,height:500
            ,page:true //开启分页
        });


        //表格根据搜索选项重载
        var $ = layui.$, active = {
          reload:function () {
              var searchReload = $('#searchReload');
              //执行重载
              table.reload('menulist',{
                  page:{
                      curr : 1 //重新从第1页开始
                  }
                  ,where:{
                      type :searchReload.val() //传递到后端
                  }
              });
          }
        };
        //点击搜索按钮查询
        $('#searchbyType').on('click',
            function(){
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
        });


        //监听工具条
        //tool是工具条事件名，showmenu是lay-filter对应的值
        table.on('tool(showmenu)',function (obj) {
            var data = obj.data //获得当前行数据
                ,layEvent = obj.event; //获得lay-event的值
            if(layEvent == 'edit'){
                layer.open({
                    type: 2,
                    title:'修改菜单信息',
                    area:['300px','400px'],
                    content:'edit.html',
                    //content:$('#editmenu'),
                    maxmin: true,
                    btn:['确定'],
                    yes:function (index) {
                        //提交修改数据
                        var body = layer.getChildFrame('body',index);
                        var dataTemp = {};
                        body.find('input').serializeArray().forEach(function(item){
                            dataTemp[item.name] = item.value;//根据表单元素的name属性来获取数据
                        });
                        dataTemp['menu_id'] = data.menu_id;
                        $.ajax({
                            type:'post',
                            url:'/index.php/admin/menu/edit',
                            data:dataTemp,
                            dataType: 'json',
                            beforeSend:function () {
                                loading = layer.load(1, {
                                    shade: [0.1,'#fff'] //0.1透明度的白色背景
                                });
                            },
                            success:function (data) {
                                layer.close(loading);
                                if(data.status == 1) {
                                    //成功
                                    dialog.success(data.message,'/index.php/admin/menu/index');
                                } else {
                                    dialog.error(data.message);
                                }
                                return false;
                            }
                        });
                        layer.close(index);
                    }
                    ,success:function (layero,index) {
                        //显示数据
                        var body = layer.getChildFrame('body',index);
                        body.find("input[name='menuname']").val(data.menuname);
                        body.find("input[name='menutype'][value='bank']").attr('checked',data.type == '1' ?true:false);
                        body.find("input[name='menutype'][value='front']").attr('checked',data.type == '2' ?true:false);
                        body.find("input[name='modulename']").val(data.modulename);
                        body.find("input[name='controller']").val(data.controller);
                        body.find("input[name='method']").val(data.method);
                        body.find("input[name='status'][value='on']").attr('checked',data.status == '1' ?true:false);
                        body.find("input[name='status'][value='off']").attr('checked',data.status == '-1' ?true:false);
                    }
                });
            } else if(layEvent == 'delete') {
                layer.confirm('确认要删除吗？', function(index){
                    obj.del();
                    layer.close(index);
                    $.ajax({
                        type:'post',
                        url:'/index.php/admin/menu/delete',
                        data:{
                            "menu_id":data.menu_id,
                        },
                        dataType: 'json',
                        beforeSend:function () {
                            loading = layer.load(1, {
                                shade: [0.1,'#fff'] //0.1透明度的白色背景
                            });
                        },
                        success:function (data) {
                            layer.close(loading);
                            if(data.status == 1) {
                                //成功
                                dialog.success(data.message,'/index.php/admin/menu/index');
                            } else {
                                dialog.error(data.message);
                            }
                            return false;
                        }
                    });
                });
            }
        });
        /*----------------------------*/
        /*------Tab---添加菜单部分------*/
        /*----------------------------*/
        var element =layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
        //获取hash来切换选项卡，假设当前地址的hash为lay-id对应的值
        var layid = location.hash.replace(/^#menutab=/, '');
        element.tabChange('menutab', layid);
        //监听Tab切换，以改变地址hash值
        element.on('tab(menutab)', function(){
            location.hash = 'menutab='+ this.getAttribute('lay-id');
        });
        var form = layui.form;
        //提交表单操作
        form.on('submit(confirm)',function (data) {
            var dataTemp = {
                menuname: data.field.menuname,
                menutype:data.field.menutype,
                modulename: data.field.modulename,
                controller: data.field.controller,
                method:data.field.method,
                status:data.field.status,
            };
           $.ajax({
                type: 'post',
                url:  '/index.php/admin/menu/add',
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
                        dialog.success(data.message,'/index.php/admin/menu/index');
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