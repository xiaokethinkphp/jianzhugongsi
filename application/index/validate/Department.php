<?php
namespace app\index\validate;
use \think\Validate;
/**
 * 品牌验证器
 */
class Department extends Validate
{
    protected $rule = [
        'name'  =>  "require|unique:department",
    ];

    protected $message = [
        'name.require'  =>  "请输入部门名称",
        'name.unique'   =>  "该部门已存在"
    ];

}
