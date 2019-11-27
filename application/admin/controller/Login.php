<?php
/**
 *  author    : luyangsiyi
 *  creation  : 2019/11/13 8:12 下午
 *  description :
 */
namespace app\admin\controller;

use app\admin\model\Admin;
use think\Controller;
use think\facade\Request;

class Login extends Controller
{
    public function index()
    {
        $user_info = session('user_info');
        if(isset($user_info)){
            $this->redirect('/index.php/admin/index/index');
        }
        return $this->fetch();
    }

    public function check()
    {
        if($this->request->isPost())
        {
            $username = Request::post('username');
            $password = Request::post('password');
            $remember = Request::post('rememberMe');
            $captcha = Request::post('captcha');
            if(!captcha_check($captcha)) {
                return show(0,'验证码错误！');
            }
            $admin = new Admin();
            $result = $admin->getAdminByUsername($username);
            if($result)
            {
                if($remember){
                    session([
                        'expire' => 86400,
                    ]);
                }
                if($result['password'] != $password) {
                    return show(1,'密码错误');
                }
                session('user_info',$result);
                return show(1,'登录成功！');
            }
            return show(0,'用户名不存在');
        }
    }

    public function logout()
    {
        session('user_info',null);
        $this->redirect('/login');
    }
}