<?php
namespace app\index\validate;
use \think\Validate;
/**
 * 品牌验证器
 */
class Person extends Validate
{
    protected $rule = [
        'name'  =>  "require|unique:person",
        'total_vacation'    =>  "require|number|gt:1"
    ];

    protected $message = [
        'name.require'  =>  "请输入人员名称",
        'name.unique'   =>  "该人员已存在，请确认是否有重名情况。",
        'total_vacation.require'    =>  "请输入假期天数",
        'total_vacation.number'   =>  '请输入大于等于1的整数1',
        'total_vacation.gt' =>  '请输入大于等于1的整数'
    ];

    protected $scene = [
        'name'  =>  ['require','unique']
    ];

}
