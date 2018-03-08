<?php
namespace Admin\Controller;

use Admin\Service\FundsService;

class FundsController extends CommonController
{
    /**
     * 会员列表
     */
    public function FundsList()
    {
        $data = FundsService::FundsList();
        $this->assign('data',$data['data']);
        $this->assign('page',$data['page']);
        $this->display();
    }

    /**
     * 编辑
     */
    public function Fundsedit()
    {
        $id = I('get.id');
        if(IS_POST){
            $param = I('post.');
            $bool = FundsService::FundsSave($param);
            if($bool){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }
        $data = FundsService::Fundsedit($id);
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * 折扣页面&查询代理等级
     */
    public function discount()
    {
        $data = FundsService::discount();
        $this->assign('data1',$data);
        $this->assign('data2',$data);
        $this->display();
    }

    /**
     * 查询当前折扣
     */
    public function selectRebate()
    {
        $param = I('post.');
        $data = FundsService::selectRebate($param);
        $this->ajaxReturn($data);
    }

    /**
     * 代理折扣设置
     */
    public function SaveRebate()
    {
        $param = I('post.');
        echo FundsService::SaveRebate($param);
    }

    /**
     * 设置代理的生命周期
     */
    public function SaveNum()
    {
        $param = I('post.');
        echo FundsService::SaveNum($param);
    }




}