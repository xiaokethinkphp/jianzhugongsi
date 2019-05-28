<?php
namespace app\index\model;

use \think\Model;
/**
 *
 */
class Person extends Model
{
    public function department()
    {
        return $this->belongsTo("Department");
    }

    // 是否结婚的获取器
    public function getIsMarriageAttr($value)
    {
        $is_marriage = [0=>"未婚",1=>"已婚"];
        return $is_marriage[$value];
    }
    // 是否串的获取器
    public function getIsWeekendAttr($value)
    {
        $is_weekend = [0=>"不",1=>"串"];
        return $is_weekend[$value];
    }

    // 人员与假期的一对多关系
    public function vacation()
    {
        return $this->hasMany("Vacation");
    }
}
