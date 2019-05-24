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
        return $this->belongsTo("Person");
    }

    public function getIsMarriageAttr($value)
    {
        $is_marriage = [0=>"未婚",1=>"已婚"];
        return $is_marriage[$value];
    }

    public function getIsWeekendAttr($value)
    {
        $is_weekend = [0=>"不",1=>"串"];
        return $is_weekend[$value];
    }
}
