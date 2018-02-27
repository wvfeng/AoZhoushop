<?php
namespace Computer\Controller;

class OrderController extends CommonController
{	
    //我的订单,通过筛选 编号，类型，商品名称
    public function myOrder(){
        $userId = url_decode(I('userId'));
        if(I('type')){
            $type = ['type'=>I('type')];
        }
        if(I('id')){
            $type = ['id'=>I('id')];
        }
        if(I('shopname')){
            $shopNameId = M('shop')->where(['tit'=>I('shopname')])->getField('id');
            $type['shop_id'] = array('like',array('%|*|'.$shopNameId.'|*|%',$shopNameId.'|*|%','%|*|'.$shopNameId));
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