<?php
/**
 *  author    : luyangsiyi
 *  creation  : 2019/11/14 11:20 上午
 *  description :
 */
namespace app\admin\controller;

use app\admin\model\MenuModel;
use think\Controller;
use think\facade\Request;


class Menu extends Controller
{
    public function index()
    {
        if(Request::isAjax())
        {
            $data = array();
            $type = Request::get('type');
            if(!empty($type) && in_array($type,array('1','2'))){
                $data = [
                    ['type','=',$type]
                ];
            }
            $pagesize = Request::get('limit')?Request::get('limit'):10;
            $page = Request::get('page')?Request::get('page'):1;
            $menu = new MenuModel();
            $res['count'] = $menu->getMenusCount($data);
            $res['data'] =  $menu->getMenus($data,$page,$pagesize);
            $res['code'] = 0;
            $res['msg'] = '';
            echo json_encode($res);
            exit;
        }
        return $this->fetch();
    }

    public function add()
    {
        if($this->request->isPost()) {
            $menuname = Request::post('menuname');
            $menutype = Request::post('menutype');
            $modulename = Request::post('modulename');
            $controller = Request::post('controller');
            $method = Request::post('method');
            $status = Request::post('status');
            $data = [
                'menuname' => $menuname,
                'type' => ($menutype == 'bank'? 1:0),
                'modulename' => $modulename,
                'controller' => $controller,
                'method' => $method,
                'status' => ($status == 'on'? 1:-1),
            ];
            if (!trim($menuname) || !$menuname) {
                return show(0, '菜单名不能为空');
            }
            if(!$menutype){
                return show(0,'请选择菜单类型');
            }
            if (!trim($modulename) || !$modulename) {
                return show(0, '模块名不能为空');
            }
            if (!trim($controller) || !$controller) {
                return show(0, '控制器不能为空');
            }
            if (!trim($method) || !$method) {
                return show(0, '方法不能为空');
            }
            if(!$status){
                return show(0,'请选择状态');
            }
            $menu = new MenuModel();
            $result = $menu->insert($data);
            if($result){
                return show(1,'新增成功！');
            } else {
                return show(0,'新增失败!');
            }
        }
    }

    public function edit()
    {
        if(Request::isAjax())
        {
            $menu_id = Request::post('menu_id');
            $menuname = Request::post('menuname');
            $menutype = Request::post('menutype');
            $modulename = Request::post('modulename');
            $controller = Request::post('controller');
            $method = Request::post('method');
            $status = Request::post('status');
            $data = [
                'menuname' => $menuname,
                'type' => ($menutype == 'bank'? 1:2),
                'modulename' => $modulename,
                'controller' => $controller,
                'method' => $method,
                'status' => ($status == 'on'? 1:-1),
            ];
            if (!trim($menuname) || !$menuname) {
                return show(0, '菜单名不能为空');
            }
            if(!$menutype){
                return show(0,'请选择菜单类型');
            }
            if (!trim($modulename) || !$modulename) {
                return show(0, '模块名不能为空');
            }
            if (!trim($controller) || !$controller) {
                return show(0, '控制器不能为空');
            }
            if (!trim($method) || !$method) {
                return show(0, '方法不能为空');
            }
            if(!$status){
                return show(0,'请选择状态');
            }
            $menu = new MenuModel();
            $result = $menu->editMenu($menu_id,$data);
            if($result){
                return show(1,'更新成功！');
            } else {
                return show(0,'更新失败!');
            }
        }
        return $this->fetch('menu/edit');
    }

    public function delete()
    {
        if(Request::isAjax())
        {
            $menu_id = Request::post('menu_id');
            $menu = new MenuModel();
            $result = $menu->deleteMenu($menu_id);
            if($result) {
                return show(1,'删除成功！');
            } else {
                return show(0,'删除失败！');
            }
        }
    }
}