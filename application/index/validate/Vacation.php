<?php
namespace app\index\validate;
use \think\Validate;
/**
 * 休假验证器
 */
class Vacation extends Validate
{
    protected $rule = [
        'from_date'  =>  "require|lt:to_date",
        'to_date'   =>  'require|gt:from_date'
    ];

    protected $message = [
        'from_date.require'  =>  "请输入开始时间",
        'from_date.lt'   =>  "开始时间应小于结束时间",
        'to_date.require'   =>  "请输入结束时间",
        'to_date.gt'    =>  "开始时间应小于结束时间"
    ];

}
