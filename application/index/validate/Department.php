<?php
namespace app\index\validate;
use \think\Validate;
/**
 * 品牌验证器
 */
class Department extends Validate
{
    protected $rule = [
        'name'  =>  "require",
    ];

    protected $message = [
        'name.require'   =>  "请输入部门名称",
    ];

}
