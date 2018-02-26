<?php
namespace Computer\Controller;

class OrderController extends CommonController
{	
    //我的订单
    public function myOrder(){
        $userId = I('userId');
        $order = M('order')->where(['user_id'=>$userId])->select();
        foreach ($order as $key => &$v) {
            
        }
    } 
}