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

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
