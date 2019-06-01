<?php
namespace app\index\controller;
/**
 *
 */
class Admin extends Common
{
    public function upd($id='')
    {
        if (request()->isPost()) {
            $post = input("post.");
            $adminFind = db('admin')->where([
                'id'    =>  $post['id'],
                'name'  =>  $post['name'],
                'password'  =>  md5($post['old_password'])
            ])->find();
            if (!$adminFind) {
                session("admin",null);
                $this->error("密码错误，请重新登录","login/index");
            }
            $data = [
                'password'  => md5($post['password'])
            ];
            $adminUpdResult = db("admin")
            ->where("id",$post['id'])
            ->data($data)->update();
            if ($adminUpdResult!==false) {
                $this->success("密码修改成功","index/index");
            } else {
                $this->error("密码修改失败","index/index");
            }

        } else {
            $adminFind = db("admin")->find($id);
            if (!$adminFind) {
                $this->redirect("index/index");
            }
            $this->assign('adminFind',$adminFind);

            $title = "修改密码";
            $this->assign("title",$title);
            return view();
        }

    }
}
