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
        $departmentGet->person;
        foreach ($departmentGet['person'] as $key => $value) {
            $value->vacation;
        }
        $this->assign("departmentGet",$departmentGet);
        return view();
    }

    // 添加人员方法
    public function add()
    {
        if (request()->isPost()) {
            $post = input("post.");
            // $post['total_vacation'] = (int)$post['total_vacation'];
            // dump($post);die;
            $validate = validate("person");
            if (!$validate->check($post)) {
                $this->error($validate->getError());
            }
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

    public function checkPersonAjax()
    {
        if (request()->isAjax()) {
            $post = input("post.");
            return validate("person")->scene("name")->check($post);
        } else {
            $this->redirect("person/lst");
        }

    }

    public function upd($id='')
    {
        if (request()->isPost()) {
            $post = input("post.");
            if (!$post) {
                $this->error("提交错误","person/lst");
            }
            $personModel = model("person");
            $personUpdResult = $personModel->isUpdate(true)->save($post);
            if ($personUpdResult!==false) {
                $this->success("人员修改成功","person/lst");
            } else {
                $this->error("人员修改失败","person/lst");
            }

        } else {
            $title = "人员修改";
            $this->assign("title",$title);

            $personModel = model("person");
            $personGet = $personModel->get($id);
            if (!$personGet) {
                $this->success("该人员不存在","person/lst");
            }

            $departmentModel = model("department");
            $departmentList = $departmentModel->getDepartmentList()->order("order");
            $this->assign("departmentList",$departmentList);

            $this->assign("personGet",$personGet->getData());
            return view();
        }

    }

    // 删除人员
    public function del($id='')
    {
        $personModel = model("person");
        $personGet = $personModel->get($id,"vacation");
        if (!$personGet) {
            $this->error("该人员不存在");
        }
        $personDelResult = $personGet->together("vacation")->delete();
        if ($personDelResult) {
            $this->success("人员删除成功","person/lst");
        } else {
            $this->error("人员删除失败","person/lst");
        }


    }
}
