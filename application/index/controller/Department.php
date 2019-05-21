<?php
namespace app\index\controller;
use \think\Controller;
// use  app\index\model\Department as DepartmentModel;
/**
 * 单位管理类
 */
class Department extends Common
{
    // 人员列表方法
    public function lst()
    {
        $title = "部门列表";
        $this->assign("title",$title);
        $departmentModel = model("Department");
        $departmentList = $departmentModel->getDepartmentList()->order("order");
        $this->assign("departmentList",$departmentList);
        return view();
    }

    // 添加人员方法
    public function add()
    {
        if (request()->isPost()) {
            $post = input("post.");
            $validate = validate("Department");
            if (!$validate->check($post)) {
                $this->error($validate->getError(),"index/department/lst");
            }
            $departmentModel = model("Department");
            $departmentAddResult = $departmentModel->addDepartmentInfo($post);
            if ($departmentAddResult == 0) {
                $this->success("部门添加成功","index/department/lst");
            } else{
                $this->error("该部门已存在","index/department/lst");
            }
        } else {
            $title = "添加部门";
            $this->assign("title",$title);
            return view();
        }
    }

    // 修改顺序的ajax方法
    public function changeOrderAjax()
    {
        if (request()->isAjax()) {
            $post = input("post.");
            return $post;
        } else {
            $this->redirect("admin/department/lst");
        }

    }
}
