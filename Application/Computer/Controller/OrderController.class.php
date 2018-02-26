<?php
namespace Computer\Controller;

class OrderController extends CommonController
{	
    //我的订单
    public function myOrder(){
        /*$userId = url_decode(I('userId'));*/
        $userId = I('userId');
        if(I('type')){
            $type = ['type'=>I('type')];
        }
        $data['data'] = M('order')->where(['user_id'=>$userId,'status'=>1])->where($type)->limit($this->page())
        ->field('shop_id,user_id,num,date,type,money,paymoney,id')->select();
        foreach ($data['data'] as $key => &$v) {
            $shopId = explode('|*|',$v['shop_id']);
            $shopNum = explode('|*|',$v['num']);
            $map['id'] = array('in',$shopId);
            $v['shop'] = M('shop')->where($map)->field('img,tit,tit_en,price')->select();
            foreach ($v['shop'] as $keys => &$vs) {
                $vs['paynum'] = $shopNum[$keys];
            }
        }
        $this->quickReturn($data);
    } 
}