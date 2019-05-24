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
    ];

    protected $message = [
        'name.require'  =>  "请输入人员名称",
        'name.unique'   =>  "该人员已存在，请确认是否有重名情况。"
    ];

}
