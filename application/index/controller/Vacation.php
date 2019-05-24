<?php
namespace app\index\controller;
use \think\Controller;
class Vacation extends Common
{
    public function lst()
    {
        $title = "休假总览";
        $this->assign("title",$title);
        return view();
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
