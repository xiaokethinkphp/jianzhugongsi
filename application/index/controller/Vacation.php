<?php
namespace app\index\controller;
use \think\Controller;
class Vacation extends Common
{
    public function lst()
    {
        $title = "休假总览";
        $this->assign("title",$title);
        return view();
    }

    // 添加假期
    public function add($id='')
    {
        if (request()->isPost()) {
            $post = input("post.");
            if (!$post) {
                $this->error("数据错误","person/lst");
            }
            dump($post);
            $validate = validate("Vacation");
            if (!$validate->check($post)) {
                $this->error($validate->getError());
            } else {
                $vacationModel = model("Vacation");
                $vacationAddResult = $vacationModel->save($post);
                if ($vacationAddResult) {
                    $this->success("假期添加成功","department/lst");
                } else {
                    $this->error("假期添加失败","department/lst");
                }

            }

        } else {
            $personModel = model("Person");
            $personGet = $personModel->get($id);
            if (!$personGet) {
                $this->error("该人员不存在","person/lst");
            }
            $personGet->department;
            $title = "添加休假";
            $this->assign("title",$title);

            $this->assign("personGet",$personGet);

            $currentYear = date("Y");
            $this->assign("currentYear",$currentYear);
            return view();
        }

    }
}
