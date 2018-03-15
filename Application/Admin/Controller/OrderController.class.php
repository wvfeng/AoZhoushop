<?php
namespace Admin\Controller;

use Admin\Service\OrderService;
use Common\Controller\PaypalController;
use Think\Controller;

class OrderController extends  Controller
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
    public function tests()
    { $arr = [
        'cmd'=>'_xclick', // 标识立即购买
        'business'=>C('PAY_PAL')['AccountTest'], //收款账号
        'title'=>'8核 i7处理器 1T固态硬盘 1080显卡电脑', // 商品名称
        'numbers'=>'77889900', // 物品号
        'amount'=>'10000', // 订单金额
        'currency_code'=>'USD', //货币
        'return'=>'', // 支付成功同步跳转地址
        'notify_url'=>'',//异步通知地址
        'cancel_return'=>'', // 取消交易返回地址
        'invoice'=>uniqid()
    ];
        $this->assign('parameter',$arr);
        $this->display();
    }

    public function test()
    {

    }

    public function huidiao()
    {
        $model = new PaypalController();
        //{"success":"true","paymentId":"PAY-91279135FX8536826LKULRIY","token":"EC-1PJ9367050194410T","PayerID":"7866B4KLVD9WA"}
        $param = [
            'success'=>true,
            'paymentId'=>'PAY-3N68322566660452RLKUOVXI',
            'PayerID'=>'7866B4KLVD9WA'
        ];
        $data = $model->huidiao($param);
        file_put_contents('data.txt',$data);
    }

}