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

    // 添加修改部门信息的aJax方法
    public function checkDepartmentAjax()
    {
        if (request()->isAjax()) {
            $validate = validate("Department");
            return $validate->check(input('post.'));
        } else {

        }
    }

    // 修改顺序的ajax方法
    public function changeOrderAjax()
    {
        if (request()->isAjax()) {
            $post = input("post.");

            $departmentModel = model("Department");
            foreach ($post as $key => $value) {
                $department = $departmentModel->get($key);
                $department->order = $value;
                $department->save();
            }
            return array("status"=>"1","msg"=>"顺序修改成功");
        } else {
            $this->redirect("admin/department/lst");
        }

    }

    public function upd($id='')
    {
        if (request()->isPost()) {
            $post = input("post.");
            $validate = validate("department");
            if (!$validate->check($post)) {
                $this->error($validate->getError());
            }
            $departmentModel = model("Department");
            $departmentUpdResult = $departmentModel->isUpdate()->save($post);
            if ($departmentUpdResult == 1) {
                $this->success("部门修改成功","department/lst");
            } else {
                $this->error("修改失败或部门已存","department/lst");
            }

            dump($post);
        } else {
            $departmentModel = model("Department");
            $departmentGet = $departmentModel->getDepartmentInfo($id);
            if (!$departmentGet) {
                $this->error("该部门不存在！","department/lst");
            }
            $this->assign("title","修改部门");
            $this->assign("departmentGet",$departmentGet);
            return view();
        }

    }
}
