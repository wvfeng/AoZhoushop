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
        $data = M('shop')->where($mapClassify)->where($mapId)->select();
        print_r($data);die;
    }
    //是否有这个订单
    protected function isorder($id){
        return M('order')->where(['id'=>$id])->count();
    }
}