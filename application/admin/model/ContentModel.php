<?php
/**
 *  author    : luyangsiyi
 *  creation  : 2019/11/21 2:06 下午
 *  description :
 */
namespace app\admin\model;

use think\Db;
use think\Model;

class ContentModel extends Model
{
    public function insert($data = array()){
        if(!is_array($data) || !$data) {
            return 0;
        }
        $data['create_time'] = time();
        $data['username'] = getLoginUsername();//common.php中的函数
        $ret = Db::query('alter table cms_news  AUTO_INCREMENT=1;');//为了使删除后新增的id连续
        $ret = Db::table('cms_news')->insertGetId($data);
        return $ret;
    }

    public function insertContent($data = array()){
        if(!is_array($data) || !$data) {
            return 0;
        }
        $data['create_time'] = time();
        $ret = Db::table('cms_news_content')->insert($data);
        return $ret;
    }

    public function find($id) {
        $ret = Db::table('cms_news')->where('news_id',$id)->find();
        return $ret;
    }

    public function findContent($id) {
        $ret = Db::table('cms_news_content')->where('news_id',$id)->find();
        return $ret;
    }

    public function edit($news_id,$data = array()) {
        if(!is_array($data) || !$data) {
            return 0;
        }
        $data['update_time'] = time();
        $ret = Db::table('cms_news')->where('news_id',$news_id)->update($data);
        return $ret;
    }

    public function editContent($news_id,$data = array()) {
        if(!is_array($data) || !$data) {
            return 0;
        }
        $data['update_time'] = time();
        $ret = Db::table('cms_news_content')->where('news_id',$news_id)->update($data);
        return $ret;
    }

    public function getCatMenu()
    {
        $data = [
            ['type','=',2]
        ];
        $ret = Db::table('cms_menu')->where($data)->select();
        return $ret;
    }

    public function getContent($data,$page,$pageSize)
    {
        //用paginate结果返回会有跟分页相关的数据，table自动渲染时会出错
        $offset = ($page - 1) * $pageSize;
        $ret = Db::table('cms_news')->where($data)
            ->limit($offset,$pageSize)->order('news_id')->select();
        return $ret;
    }

    public function getContentCount($data)
    {
        $ret = Db::table('cms_news')->where($data)->count();
        return $ret;
    }

    public function deleteContent($news_id)
    {
        $ret = Db::table('cms_news')->where('news_id',$news_id)->delete();
        $ret1 = Db::table('cms_news_content')->where('news_id',$news_id)->delete();
        return $ret && $ret1;
    }

    public function getPosition()
    {
        $ret = Db::table('cms_position')->select();
        return $ret;
    }
}