<?php
namespace app\index\controller;
/**
 *
 */
class Admin extends Common
{
    public function upd($id='')
    {
        if (request()->isPost) {
            $post = input("post.");
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
