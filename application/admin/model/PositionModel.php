<?php
/**
 *  author    : luyangsiyi
 *  creation  : 2019/11/27 4:17 下午
 *  description :
 */
namespace app\admin\model;

use think\Db;
use think\Model;


class PositionModel extends Model
{
    public function insert($data=array())
    {
        $data['create_time'] = time();
        $ret = Db::query('alter table cms_position_content  AUTO_INCREMENT=1;');//为了使删除后新增的id连续
        $ret = Db::table('cms_position_content')->insert($data);
        return $ret;
    }

    public function findContent($id)
    {
        $ret = Db::table('cms_news')->where('news_id',$id)->find();
        return $ret;
    }

    public function getPosition()
    {
        $ret = Db::table('cms_position')->select();
        return $ret;
    }

    public function getPositionContent($data,$page,$pageSize)
    {
        //用paginate结果返回会有跟分页相关的数据，table自动渲染时会出错
        $offset = ($page - 1) * $pageSize;
        $ret = Db::table('cms_position_content')->where($data)
            ->limit($offset,$pageSize)->order('id')->select();
        return $ret;
    }

    public function getPositionContentCount($data)
    {
        $ret = Db::table('cms_position_content')->where($data)->count();
        return $ret;
    }

    public function deleteContent($id)
    {
        $ret = Db::table('cms_position_content')->where('id',$id)->delete();
        return $ret;
    }

    public function edit($id,$data=array())
    {
        $data['update_time'] = time();
        $ret = Db::table('cms_position_content')->where('id',$id)->update($data);
        return $ret;
    }
}