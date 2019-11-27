<?php
/**
 *  author    : luyangsiyi
 *  creation  : 2019/11/27 3:34 下午
 *  description :
 */
namespace app\admin\controller;

use app\admin\model\PositionModel;
use think\Controller;
use think\facade\Request;

class Position extends Controller
{
    public function index()
    {
        $positionModel = new PositionModel();
        $position = $positionModel->getPosition();
        $this->assign('position',$position);
        return $this->fetch();
    }

    public function add()
    {
        if(Request::isAjax())
        {
            if(empty(Request::post('row'))){
                return show(0,'请选择文章！');
            } else {
                $row = Request::post('row');
            }
            if(empty(Request::post('position_id'))){
                return show(0,'请选择推荐位！');
            } else {
                $position_id = Request::post('position_id');
            }

            $positionModel = new PositionModel();
            foreach ($row as $item){
                $result = $positionModel->findContent($item);
                if($result) {
                    $data['position_id'] = $position_id;
                    $data['title'] = $result['title'];
                    $data['thumb'] = $result['thumb'];
                    $data['news_id'] = $item;
                    $position = $positionModel->insert($data);
                    if(!$position){
                        return show(0,'新增id='+$item+'的推荐位失败！');
                    }
                } else {
                    return show(0,'找不到id='+$item+'的文章失败！');
                }
            }
            return show(1,'新增推荐位成功！');
        }
    }

    public function showlist()
    {
        if(Request::isAjax())
        {
            $data = array();
            $position_id = Request::get('position_id');
            if(!empty($position_id)){
                array_push($data,['position_id','=',$position_id]);
            }
            $title = Request::get('title');
            if(!empty($title)){
                array_push($data,['title','like','%'.$title.'%']);//模糊查询
            }
            $pagesize = Request::get('limit')?Request::get('limit'):10;
            $page = Request::get('page')?Request::get('page'):1;
            $position = new PositionModel();
            $res['count'] = $position->getPositionContentCount($data);
            $res['data'] =  $position->getPositionContent($data,$page,$pagesize);
            $res['code'] = 0;
            $res['msg'] = '';
            echo json_encode($res);
            exit;
        }
    }

    public function delete()
    {
        if(Request::isAjax())
        {
            $id = Request::post('id');
            $positionModel = new PositionModel();
            $result = $positionModel->deleteContent($id);
            if($result) {
                return show(1,'删除成功！');
            } else {
                return show(0,'删除失败！');
            }
        }
    }

    public function edit()
    {
        $positionModel = new PositionModel();
        $position = $positionModel->getPosition();
        $this->assign('position',$position);
        if(Request::isAjax()){
            $position_id = Request::post('position_id');
            $id = Request::post('id');
            $data = [
                'position_id' => $position_id,
            ];
            $result = $positionModel->edit($id,$data);
            if($result){
                return show(1,'编辑成功！');
            } else {
                return show(0,'编辑失败！');
            }
        }
        return $this->fetch();
    }
}