<?php
namespace app\index\controller;

use \think\Controller;
/**
 * 登录控制器
 */
class Login extends Controller
{
    public function index()
    {
        if (request()->isPost()) {
            $post = input("post.");
            $adminFind = db("admin")->where([
                "name"=>$post['name'],
                'password'=>md5($post['password'])
            ])->find();
            if ($adminFind) {
                session("admin",$adminFind);
                $this->success("登录成功","index/index");
            } else {
                $this->errir('用户名或密码错误，请重新登录'.'login/index');
            }

        } else {
            if (session("admin")) {
                $this->error("请不要重复登录","index/index");
            }
            $title = "建筑二公司休假管理系统";
            $this->assign("title",$title);
            return view();
        }
    }

    public function logout()
    {
        session("admin",null);
        $this->success("账号已登出","login/index");
    }
}
