<?php
/**
 *  author    : luyangsiyi
 *  creation  : 2019/11/15 2:52 下午
 *  description :
 */
namespace app\admin\model;

use think\Db;
use think\model;

class MenuModel extends Model
{
    public function insert($data = array()){
        if(!$data || !is_array($data)) {
            return 0;
        }
        $ret = Db::query('alter table cms_menu  AUTO_INCREMENT=1;');//为了使删除后新增的id连续
        $ret = Db::table('cms_menu')->insert($data);
        return $ret;
    }

    public function getMenus($data,$page,$pageSize)
    {
        //用paginate结果返回会有跟分页相关的数据，table自动渲染时会出错
        $offset = ($page - 1) * $pageSize;
        $ret = Db::table('cms_menu')->where($data)
        //$ret = Db::table('cms_menu')->where('status','<>',-1)
            ->limit($offset,$pageSize)->order('menu_id')->select();
        return $ret;
    }

    public function getMenusCount($data)
    {
        //$ret = Db::table('cms_menu')->where('status','<>',-1)->count();
        $ret = Db::table('cms_menu')->where($data)->count();
        return $ret;
    }

    public function deleteMenu($menu_id)
    {
        $ret = Db::table('cms_menu')->where('menu_id',$menu_id)->delete();
        return $ret;
    }

    public function editMenu($menu_id,$data)
    {
        $ret = Db::table('cms_menu')->where('menu_id',$menu_id)->update($data);
        return $ret;
    }
}