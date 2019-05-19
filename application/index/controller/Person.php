<?php
namespace app\index\controller;
use \think\Controller;
/**
 * 人员管理类
 */
class Person extends Common
{
    public function lst()
    {
        $title = "人员管理";
        $this->assign("title",$title);
        return view();
    }
}
