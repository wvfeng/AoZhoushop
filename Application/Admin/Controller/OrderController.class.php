<?php
namespace Admin\Controller;

use Admin\Service\OrderService;
use Think\Controller;

class OrderController extends CommonController
{
    /**
     * 购买记录首页的
     */
    public function index()
    {
    	$table = M('order');
        if(I('clsea')==1){
            $map = null;
            $map = "nickname='".I('clvar')."' OR name='".I('clvar')."' OR iphone='".I('clvar')."'";
        }
        if(I('clvar_date')){
            $map = null;
            $map['date'] = array(array('EGT',I('clvar_date')),array('ELT',I('clvar_date_er')),'AND');
        }
		$count = $table->where($map)->count();
		$Page = new \Think\Page($count,25);
		foreach($map as $key=>$val) {
		    $Page->parameter[$key]   =   urlencode($val);
		}
		$show = $Page->show();
		$list = $table->where($map)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        /*foreach ($list as $key => &$v) {
            $v['nickname'] = M('user')->where(['id'=>$v['user_id']])->getField('nickname');
            $v['headimgurl'] = M('user')->where(['id'=>$v['user_id']])->getField('headimgurl');
        }*/
        $count_user['yi'] = $table->where(['classify'=>1])->sum('money');
        $count_user['er'] = $table->where(['classify'=>2])->sum('money');
        $count_user['san'] = $table->where(['classify'=>3])->sum('money');
        $count_user['si'] = $table->sum('money');
		$this->assign('list',$list);
		$this->assign('page',$show);
        $this->assign('count_user',$count_user);
        $this->assign('clvar',I('clvar'));
        $this->assign('clvar_date',I('clvar_date'));
        $this->assign('clvar_date_er',I('clvar_date_er'));
		$this->display();
    }

    /**
     * 订单列表
     */
    public function orderList()
    {
        $data = OrderService::orderList();
        $this->assign('data',$data['data']);
        $this->assign('page',$data['page']);
        $this->display();
    }

    /**
     * 订单详情
     */
    public function orderDetails()
    {
        $oid = I('get.id');
        $data = OrderService::orderDetails();

    }

}