<?php
namespace app\index\controller;
use \think\Controller;
/**
 * 人员管理类
 */
class Person extends Common
{
    // 人员列表方法
    public function lst($department_id='')
    {
        $title = "人员管理";
        $this->assign("title",$title);

        $departmentModel = model("Department");
        $departmentAll = $departmentModel->order("order")->all();
        $departmentGet = $departmentModel->get($department_id)?$departmentModel->get($department_id):$departmentAll[0];
        $this->assign("departmentAll",$departmentAll);
        $this->assign("departmentGet",$departmentGet);
        return view();
    }

    // 添加人员方法
    public function add()
    {
        if (request()->isPost()) {
            $post = input("post.");
            $personModel = model("Person");
            $personAddResult = $personModel->save($post);
            if ($personAddResult) {
                $this->success("人员添加成功","person/lst");
            } else {
                $this->error("人员添加失败","person/lst");
            }

        } else {
            $title = "添加人员";
            $this->assign("title",$title);

            $departmentModel = model("department");
            $departmentList = $departmentModel->getDepartmentList()->order("order");
            $this->assign("departmentList",$departmentList);
            return view();
        }
    }
}
