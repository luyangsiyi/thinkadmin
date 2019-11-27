<?php
/**
 *  author    : luyangsiyi
 *  creation  : 2019/11/20 2:12 下午
 *  description :
 */
namespace app\admin\controller;
use app\admin\model\ContentModel;
use think\Controller;
use think\facade\Request;


class Content extends Controller
{
    public function index()
    {
        //从表格获得所有的栏目
        $contentModel = new ContentModel();
        $result = $contentModel->getCatMenu();
        $this->assign('cat',$result);
        $position = $contentModel->getPosition();
        $this->assign('position',$position);
        return $this->fetch();
    }

    public function upload()
    {
        $file = request()->file('file');
        if($file == null) {
            return show(0,'未上传图片!');
        }
        $info = $file->move('upload');
        if($info){
            // 成功上传后 获取上传信息
            $img = '/upload/'.$info->getSaveName();
            //返回路径给前端跟表单一起提交写入表格
            return show(1,$img);
        }else{
            return show(0,$file->getError());
        }
    }

    /*public function editorUpload()
    {
        $file = request()->file('imgFile');
        if($file == null) {
            return show(0,'未上传图片!');
        }
        $info = $file->move('editorupload');
        if($info){
            // 成功上传后 获取上传信息
            $img = '/editorupload/'.$info->getSaveName();
            //返回路径给前端跟表单一起提交写入表格
            return show(1,$img);
        }else{
            return show(0,$file->getError());
        }
    }*/

    public function addIndex()
    {
        //从表格获得所有的栏目
        $contentModel = new ContentModel();
        $result = $contentModel->getCatMenu();
        $copyfrom = array(
            0 => '本站',
            1 => '新浪网',
            2 => '央视网',
            3 => '网易',
            4 => '搜狐',
        );
        $this->assign('cat',$result);
        $this->assign('copyfrom',$copyfrom);
        return $this->fetch('content/add');
    }

    public function add()
    {
        if(Request::isAjax())
        {
            $data['catid'] = Request::post('catid');
            $data['title'] = Request::post('title');
            $data['small_title'] = Request::post('small_title');
            $data['title_font_color'] = Request::post('title_font_color');
            $data['thumb'] = Request::post('thumb');
            $data['keywords'] = Request::post('keywords');
            $data['description'] = Request::post('description');
            $data['copyfrom'] = Request::post('copyfrom');
            $contentModel = new ContentModel();
            $newsId = $contentModel->insert($data);
            if($newsId) {
                $data1['news_id'] = $newsId;
                $data1['content'] = Request::post('content');
                $contentResult = $contentModel->insertContent($data1);
                if($contentResult) {
                    return show(1,'文章添加成功！');
                } else {
                    return show(0,'主表添加成功，副表失败！');
                }
            } else {
                return show(0,'新增失败！');
            }
        } else {
            return show(0,'表单提交失败');
        }
    }

    public function showlist()
    {
        if(Request::isAjax())
        {
            $data = array();
            $catid = Request::get('catid');
            if(!empty($catid)){
               array_push($data,['catid','=',$catid]);
               //注意tp5.1中传递数组查询条件的方式应该为：$data=[['key值','表达式','条件'],[],[],...];
            }
            $title = Request::get('title');
            if(!empty($title)){
                array_push($data,['title','like','%'.$title.'%']);//模糊查询
            }
            $pagesize = Request::get('limit')?Request::get('limit'):10;
            $page = Request::get('page')?Request::get('page'):1;
            $content = new ContentModel();
            $res['count'] = $content->getContentCount($data);
            $res['data'] =  $content->getContent($data,$page,$pagesize);
            $res['code'] = 0;
            $res['msg'] = '';
            echo json_encode($res);
            exit;
        }
        return $this->fetch();
    }

    public function editIndex()
    {
        $news_id = Request::get('id');
        if(!$news_id) {
            return show(0,'id不存在！');
        }
        $contentModel = new ContentModel();
        $news = $contentModel->find($news_id);
        if(!$news) {
            return show(0,'该文章不存在！！');
        }
        $content = $contentModel->findContent($news_id);
        if(!$content) {
            return show(0,'文章内容不存在！');
        } else {
            $news['content'] = $content['content'];
        }

        //从表格获得所有的栏目
        $contentModel = new ContentModel();
        $result = $contentModel->getCatMenu();
        $copyfrom = array(
            0 => '本站',
            1 => '新浪网',
            2 => '央视网',
            3 => '网易',
            4 => '搜狐',
        );
        $this->assign('cat',$result);
        $this->assign('copyfrom',$copyfrom);
        $this->assign('data',$news);
        return $this->fetch('content/edit');
    }

    public function edit()
    {
        if(Request::isAjax())
        {
            $newsId = Request::post('news_id');
            $data['catid'] = Request::post('catid');
            $data['title'] = Request::post('title');
            $data['small_title'] = Request::post('small_title');
            $data['title_font_color'] = Request::post('title_font_color');
            $data['thumb'] = Request::post('thumb');
            $data['keywords'] = Request::post('keywords');
            $data['description'] = Request::post('description');
            $data['copyfrom'] = Request::post('copyfrom');
            $contentModel = new ContentModel();
            $result = $contentModel->edit($newsId,$data);
            if($result) {
                $data1['content'] = Request::post('content');
                $result1 = $contentModel->editContent($newsId,$data1);
                if($result1) {
                    return show(1,'编辑成功！');
                } else {
                    return show(0,'主表编辑成功，副表失败！');
                }
            } else {
                return show(0,'编辑失败！');
            }
        } else {
            return show(0,'表单提交失败');
        }
    }

    public function delete()
    {
        if(Request::isAjax())
        {
            $news_id = Request::post('news_id');
            $content= new ContentModel();
            $result = $content->deleteContent($news_id);
            if($result) {
                return show(1,'删除成功！');
            } else {
                return show(0,'删除失败！');
            }
        }
    }
}