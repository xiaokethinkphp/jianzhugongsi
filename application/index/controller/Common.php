<?php
namespace app\index\controller;
use \think\Controller;
/**
 *
 */
class Common extends Controller
{
    protected function initialize()
    {
        if(!session("?admin")){
            $this->error("请先登录","login/index");
        }
    }

}
