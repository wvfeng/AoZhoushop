<?php
namespace Mobile\Controller;

/**
 * 订单接口
 */
class OrderController extends CommonController
{	
	//显示订单详情
	/*parm:
	orderid 订单ID
	*/
    public function findorder(){
        $orderid = I('orderid');
        if(empty($this->isorder($orderid))){
                $this->_empty();
        }
        $order = M('order')->where(['id'=>$orderid])->find();
        $ordernum = explode('|*|',$order['num']);
    	foreach (explode('|*|',$order['shop_id']) as $key => $v) {
            $data[$key] = M('shop')->where(['id'=>$v])->field('img,tit,price,rate')->find();
            $data[$key]['ordernum'] = $ordernum[$key];
            $data[$key]['total'] = $order['money'];
            $data[$key]['orderid'] = $order['id'];
            $data[$key]['freight'] = $order['freight'];
            $data[$key]['date'] = $order['date'];
            $data[$key]['type'] = $order['type'];
            $data[$key]['paymoney'] = $order['paymoney'];
            $data[$key]['paytype'] = $order['paytype'];
        }
        if(!empty($data)){
            $this->returnAjaxSuccess(['data'=>$data]);
        }else{
            $this->returnAjaxError(['data'=>['msg'=>'失败']]);
        }
    }
    //猜你喜欢
    public function youlike(){
        $orderid = I('orderid');
        if(empty($this->isorder($orderid))){
            $this->_empty();
        }
        $shop = explode('|*|',M('order')->where(['id'=>$orderid])->getField('shop_id'));
        foreach ($shop as $key => &$v) {
            $classify_id[$key] = M('shop')->where(['id'=>$v])->getField('classify_id');
        }
        $mapClassify['classify_id'] = array('in',array_unique($classify_id));
        $mapId['id'] = array('not in',$shop);
        $data['data'] = M('shop')->where($mapClassify)->where($mapId)->limit(2)->field('img,id,tit,price,rate')->select();
        if(!empty(count($data))){
            $this->returnAjaxSuccess($data);
        }else{
            $this->returnAjaxError(['data'=>['msg'=>'失败']]);
        }
    }
    //其他人也在买
    public function otherbuying(){
        $mapUser['user_id'] = array('not in',array(session('user_id')));
        $order = M('order')->where($mapUser)->order('id desc')->field('shop_id')->select();
        $shopCount = array();
        foreach ($order as $key => $v) {
            $shop = explode('|*|',$v['shop_id']);
            if($shop[0]==$shopCount[0]){
                break;
            }
            $shopCount[$key] = $shop[0];
            if(count($shopCount)>=2){
                break;
            }
        }
        $shopMap['id'] = array('in',$shopCount);
        $data['data'] = M('shop')->where($shopMap)->field('img,id,tit,price,rate')->select();
        if(!empty(count($data))){
            $this->returnAjaxSuccess($data);
        }else{
            $this->returnAjaxError(['data'=>['msg'=>'失败']]);
        }
    }
    //付款成功
    public function paysuccess(){
        $orderid = I('orderid');
        if(empty($this->isorder($orderid))){
            $this->_empty();
        }
        $data['data'] = M('order')->where(['id'=>$orderid])->field('name,iphone,address,paymoney')->find();
        if(!empty(count($data))){
            $this->returnAjaxSuccess($data);
        }else{
            $this->returnAjaxError(['data'=>['msg'=>'失败']]);
        }
    }
    //是否有这个订单
    protected function isorder($id){
        return M('order')->where(['id'=>$id])->count();
    }
}