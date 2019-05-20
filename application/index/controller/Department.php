<?php
namespace app\index\controller;
use \think\Controller;
/**
 * 单位管理类
 */
class Department extends Common
{
    // 人员列表方法
    public function lst()
    {
        $title = "人员管理";
        $this->assign("title",$title);
        return view();
    }

    // 添加人员方法
    public function add()
    {
        if (request()->isPost()) {
            
        } else {
            $title = "添加人员";
            $this->assign("title",$title);
            return view();
        }
    }
}
