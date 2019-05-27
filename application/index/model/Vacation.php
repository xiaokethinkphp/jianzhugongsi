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
}
