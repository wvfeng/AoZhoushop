<?php
namespace Computer\Controller;
use Common\Controller\CommonController as Controller;
/**
 * 订单多种状态
 */
class MyOrderController extends Controller
{
	/**
	 * [type] [订单的各种状态]
	 */
   public function orderType(){
     $db = M('order');
     $where['id'] = I('get.id');
     $con = $db->where($where)->field('shop_id')->select();
         $shop_id = explode("|*|",$con[0]['shop_id']);
         $wheres['id'] = array('in',implode($shop_id,","));
         $data['data'] = M('shop')->where($wheres)->select();
     if($data['data']){
     	     $this->quickReturn($data);
     	 }else{
     	 	$this->returnAjaxError($data);
     	 }     
    }
}