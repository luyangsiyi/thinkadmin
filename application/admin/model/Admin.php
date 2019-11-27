<?php
/**
 *  author    : luyangsiyi
 *  creation  : 2019/11/13 9:45 下午
 *  description :
 */

namespace app\admin\model;

use think\Db;
use think\Model;

class Admin extends Model
{
    public function getAdminByUsername($username)
    {
        $result = Db::table('cms_admin')->where('username',$username)->find();
        return $result;
    }
}