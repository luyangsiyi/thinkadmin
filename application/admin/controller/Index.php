<?php
/**
 *  author    : luyangsiyi
 *  creation  : 2019/11/13 9:15 下午
 *  description :
 */

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}