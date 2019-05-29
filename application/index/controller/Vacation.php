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
            // dump($post);
            $validate = validate("Vacation");
            if (!$validate->check($post)) {
                $this->error($validate->getError());
            } else {
                $vacationModel = model("Vacation");
                $vacationAddResult = $vacationModel->save($post);
                if ($vacationAddResult) {
                    $this->success("假期添加成功","person/lst");
                } else {
                    $this->error("假期添加失败","person/lst");
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

    // 更新数据
    public function updAll()
    {
        $current_date = date("Y-m-d");
        $vacationModel = model("Vacation");
        $vacationAll = $vacationModel->all();
        foreach ($vacationAll as $key => $value) {
            if (strtotime($current_date)<strtotime($value['from_date'])) {
                $value->status = '1';
                $value->finished = '0';
                $value->save();
            } else if(strtotime($current_date)>=strtotime($value['from_date'])&&strtotime($current_date)<=strtotime($value['to_date'])){
                $value->status = '2';
                $value->finished_day = (strtotime($current_date)-strtotime($value['from_date']))/86400;
                $value->save();
            } else if(strtotime($current_date)>strtotime($value['to_date'])){
                $value->status = '3';
                $value->finished_day = (strtotime($value['to_date'])-strtotime($value['from_date']))/86400+1;
                $value->save();
            }
        }

        $personModel = model("Person");
        $personAll = $personModel->all();
        // foreach ($personAll as $key => $value) {
            // $value->vacation;
            // $finished_day = 0;
            // foreach ($value['vacation'] as $key1 => $value1) {
            //     $finished_day += $value1['finished_day'];
            // }
            // $value->finished_vacation = $finished_day;
            // $value->save();
        // }
        $list = $personModel::withSum("vacation","finished_day")->select();
        foreach ($list as $key => $value) {
            if ($value->vacation_sum) {
                $value->finished_vacation = $value->vacation_sum;
                $value->save();
            }
        }
        $this->success("数据更新成功","index/index");
    }

    // 假期修改
    public function upd($id)
    {
        if (request()->isPost()) {
            $post = input("post.");
            if (!$post) {
                $this->error("数据错误","person/lst");
            }
            $validate = validate("Vacation");
            if (!$validate->check($post)) {
                $this->error($validate->getError(),"person/lst");
            }
            $vacationModel = model("Vacation");
            $vacationUpdResult = $vacationModel->isUpdate(true)->save($post);
            if ($vacationUpdResult!==false) {
                $this->success("假期修改成功","person/lst");
            } else {
                $this->error("假期修改失败","person/lst");
            }

        } else {
            $vacationModel = model("vacation");
            $vacationGet = $vacationModel->get($id);
            if (!$vacationGet) {
                $this->error("假期数据不存在","person/lst");
            }
            $title = "假期修改";
            $this->assign("title",$title);
            $vacationGet->person;
            $vacationGet['person']->department;
            $this->assign("vacationGet",$vacationGet);

            $currentYear = date("Y");
            $this->assign("currentYear",$currentYear);
            return view();
            // dump($vacationGet);
        }

    }
}
