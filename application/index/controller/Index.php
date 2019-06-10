<?php
namespace app\index\controller;
use \think\Controller;
class Index extends Common
{
    public function index()
    {
        $title = "建筑二公司休假管理系统";
        $this->assign("title",$title);
        return view();
    }

    public function compute()
    {
        if (request()->isAjax()) {
            $post = input("post.");
            if (!is_numeric($post['old'])||!is_numeric($post['new'])) {
                return array("status"=>"0","result"=>"计算错误");
            }
            $final = ($post['old']/12)*$post['month']+($post['new']/12)*(12-$post['month']);
            return array("status"=>"1","result"=>ceil($final));
        } else {
            $title = "辅助计算";
            $this->assign("title",$title);
            return view();
        }
    }
}
