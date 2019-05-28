<?php
namespace app\index\model;

use \think\Model;
/**
 *
 */
class Vacation extends Model
{
    // 假期与人员的多对一关系
    public function person()
    {
        return $this->belongsTo("Person");
    }

    // 假期类型的获取器
    public function getTypeAttr($value)
    {
        $type = [1=>"休假",2=>"事假",3=>"婚假",4=>"产假",5=>"其他"];
        return $type[$value];
    }

    // 假期状态的获取器
    public function getStatusAttr($value)
    {
        $status = [1=>"未休",2=>"正在休",3=>"已完成"];
        return $status[$value];
    }
}
