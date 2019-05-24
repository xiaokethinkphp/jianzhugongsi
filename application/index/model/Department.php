<?php
namespace app\index\model;

use \think\Model;
/**
 *
 */
class Department extends Model
{
    // 返回单个数据对象
    public function getDepartmentInfo($id)
    {
        $where['id'] = $id;
        $data = Department::where($where)->find();
        return $data;
    }

    // 添加单个数据对象
    public function addDepartmentInfo($data)
    {
        $where['name'] = $data['name'];
        $result = Department::where($where)->find();
        if ($result == NULL) {
            Department::save($data);
            return 0;
        } else {
            return $result['id'];
        }

    }

    // 返回所有数据
    public function getDepartmentList()
    {
        $data = Department::all();
        return $data;
    }

    // 删除某个数据
    public function delDepartmentInfo($id)
    {
        $where['id'] = $id;
        Department::where($where)->delete();
    }

    // 与人员的一对多关联模型
    public function person()
    {
        return $this->hasMany("Person");
    }
}
