<?php /*a:1:{s:82:"/Library/WebServer/Documents/thinkadmin/application/admin/view/position/index.html";i:1574848560;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>推荐位管理 - 后台页面</title>
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
                <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                    <li class="layui-nav-item"><a href="/index.php/admin/index/index">首页</a></li>
                    <li class="layui-nav-item"><a href="/index.php/admin/menu/index">菜单管理</a></li>
                    <li class="layui-nav-item"><a href="/index.php/admin/content/index">文章管理</a></li>
                    <li class="layui-nav-item layui-this"><a href="/index.php/admin/position/index">推荐位管理</a></li>
                </ul>
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
            <legend>
                <a href="/index.php/admin/index/index">首页</a> /
                <a href="/index.php/admin/position/index">推荐位管理</a> /
                <a><cite>查看推荐位</cite></a>
            </legend>
        </fieldset>
        <div class="layui-inline">
            <label class="layui-form-label">推荐位</label>
            <div class="layui-input-inline" action="">
                <select name="searchbyposition" id="searchbyposition">
                    <option value="">请选择推荐位</option>
                    <?php if(is_array($position) || $position instanceof \think\Collection || $position instanceof \think\Paginator): $i = 0; $__LIST__ = $position;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="layui-input-inline">
                <input type="text" id="searchbytitle" name="searchbytitle" placeholder="请输入搜索标题" class="layui-input">
            </div>
            <button class="layui-btn" data-type="reload" id="searchbyType">搜索</button>
        </div>
        <table class="layui-hide" id="positionlist" lay-filter="showposition"></table>
    </div>
    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © 陆洋山芋
    </div>
</div>
<script src="/layui/layui.js"></script>
<script src="/dialog.js"></script>
<script src="/jutils.min.js"></script>
<!--id跟table cols里面的toolbar绑定-->
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</a>
</script>
<script type="text/html" id="position_id">
    {{#  if(d.position_id == 1){ }}
    首页大图
    {{#  }else if(d.position_id == 2){ }}
    首页小图
    {{#  }else if(d.position_id == 3){ }}
    小图推荐
    {{#  }else if(d.position_id == 4){ }}
    首页后侧广告位
    {{# }else { }}
    右侧广告位
    {{# } }}
</script>
<script>
    layui.use('table',function () {
        var table = layui.table;
        //方法渲染。field对应后端传回的json数据的key，可以多传。自动ajax get方法
        table.render({
            elem: '#positionlist'
            , url: '<?php echo url("Position/showlist"); ?>'//传递page和limit参数给后端
            , cellMinWidth: 100 //全局定义常规单元格的最小宽度
            , cols: [[
                {field: 'id', width: 80, title: 'ID', align: 'center'}
                , {field: 'position_id', width: 150, title: '推荐位位置', align: 'center',templet:'#position_id'}
                , {field: 'title', width: 200, title: '标题', align: 'center'}
                , {field: 'news_id', width: 150, title: '文章ID', align: 'center'}
                , {
                    field: 'create_time', width: 200, title: '创建时间', align: 'center', templet: function (d) {
                        return jutils.formatDate(new Date(d.create_time * 1000), "YYYY-MM-DD HH:ii:ss");
                    }
                } //使用函数库jutils
                , {
                    field: 'update_time', width: 200, title: '修改时间', align: 'center', templet: function (d) {
                        return d.update_time ? jutils.formatDate(new Date(d.update_time * 1000), "YYYY-MM-DD HH:ii:ss") : '/';
                    }
                }
                , {
                    field: 'status', width: 100, title: '状态', align: 'center', templet: function (d) {
                        return d.status == 1 ? '正常' : '异常';
                    }
                }
                , {field: 'operation', width: 150, title: '操作', align: 'center', toolbar: '#barDemo'}//绑定按钮组
            ]]
            , height: 440
            , page: true //开启分页
        });
        //表格根据搜索选项重载
        var $ = layui.$, active = {
            reload:function () {
                var searchbyposition = $('#searchbyposition');
                var searchbytitle = $('#searchbytitle');
                //执行重载
                table.reload('positionlist',{
                    page:{
                        curr : 1 //重新从第1页开始
                    }
                    ,where:{
                         position_id :searchbyposition.val() //传递到后端
                        ,title:searchbytitle.val()
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
        //tool是工具条事件名，showarticle是lay-filter对应的值
        table.on('tool(showposition)',function (obj) {
            var data = obj.data //获得当前行数据
                ,layEvent = obj.event; //获得lay-event的值
            if(layEvent == 'edit'){
                layer.open({
                    type: 2,
                    title:'修改推荐位信息',
                    area:['300px','400px'],
                    content:'edit.html',
                    maxmin: true,
                    btn:['确定'],
                    yes:function (index) {
                        //提交修改数据
                        var body = layer.getChildFrame('body',index);
                        var dataTemp = {};
                        body.find('input').serializeArray().forEach(function(item){
                            dataTemp[item.name] = item.value;//根据表单元素的name属性来获取数据
                        });
                        dataTemp['position_id'] = body.find('select').val();
                        $.ajax({
                            type:'post',
                            url:'/index.php/admin/position/edit',
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
                                    dialog.success(data.message,'/index.php/admin/position/index');
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
                        body.find("input[name='title']").val(data.title);
                        body.find("input[name='id']").val(data.id);
                        body.find("input[name='news_id']").val(data.news_id);
                        body.find("select[name='searchbyposition']").val(data.position_id);
                    }
                });
            } else if(layEvent == 'delete') {
                layer.confirm('确认要删除吗？', function(index){
                    obj.del();
                    layer.close(index);
                    $.ajax({
                        type:'post',
                        url:'<?php echo url("Position/delete"); ?>',
                        data:{
                            "id":data.id,
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
                                dialog.success(data.message,'<?php echo url("Position/index"); ?>');
                            } else {
                                dialog.error(data.message);
                            }
                            return false;
                        }
                    });
                });
            }
        });
    });
</script>
</body>
</html>