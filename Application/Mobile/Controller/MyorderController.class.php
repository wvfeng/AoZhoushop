<?php
namespace Mobile\Controller;
/**
 * 我的订单接口
 */
class MyorderController extends CommonController
{	
    /**
     * int type
     * 订单类型
     * 1代表未付款、2待发货、3已发货、4已完成、5代表已评价、6代表退货、7代表换货、9代表未评论
     */
    public function orderType(){
     switch (I('get.type')) {
         case 1 : $type = '未付款';
             break;
         case 2 : $type = '待发货';
             break;
         case 3 : $type = '已发货';
             break;
         case 4 : $type = '已完成';
             break;    
         case 9 : $type = '未评论';
             break;      
         default:
            $this->returnAjaxError($data);
             break;
     }
     $db = M('order');
     $data['data'] = $db->where(['type'=>$type])->select();
     $this->returnAjaxSuccess($data);
    }
    /**
     * 待付款->取消付款:立即付款
     */
    public function payment($a){
        $db = M('order');
        $where['id']=$a;
        $data['data']=$db->where($where)->select();

      return $data;
    }
    /**
     * 待发货->取消订单:提醒发货
     */
    public function delivery(){
         $db = M('order');
         I('get.id')?$where['id']=I('get.id'):$this->returnAjaxError();
         if(I('get.type')==1){
            // 提醒发货
            $data['data']=$db->where($where)->setInc('warn');
            if($data['data'])$this->returnAjaxSuccess($data);
         }elseif(I('get.type')==2){
            // 取消订单
         }
    }
    /**
     * 待收货->:查看物流:确认收货
     */
    public function take(){
         // 查看物流
         $where['s_id'] = I('get.s_id');
         $where['u_id'] = I('get.u_id');
         $where['_logic'] = 'AND';
         $db = M('credit_order');
         $data['data'] = $db->where($where)->field('LogisticCode')->find();
         if($data['data'])$this->returnAjaxSuccess($data);

    }
    /**
     * 待评价-》删除订单:评价
     */
    public function evaluate(){
    $db = M('order');
    I('get.id')?$where['id']=I('get.id'):$this->returnAjaxError();
    $data['data'] = $db->where(['id'=>I('get.id')])->delete();
    if($data['data'])$this->returnAjaxSuccess($data);
    }
    /**
     * 地址更新与添加
     * int id
     */
    public function upAdd(){
        $db = M('address');
        if(I('post.id')){
           $data['data'] = $db->where(['id'=>I('post.id')])->save($_POST);
        }else{
           $data['data'] = $db->add($_POST);
        }
            $this->returnAjaxSuccess($data);
    }
    /**
     * 地址删除
     * int id
     */
    public function deleAdd(){
        $id = I('get.id');
        $id ? $id : $this->returnAjaxError($con);
        $db = M('address');
        $data['data'] = $db->where(['id'=>$id])->delete();
        $this->returnAjaxSuccess($data);
    }
    /**
     * 登录
     * 产生session('userInfo') value: $data;
     */
    public function login(){
        $db = M('user');
        $where['password'] = md5(I('post.password'));
        $where['iphone|email'] = I('post.username');
        $data['data'] = $db ->where($where)->select();
        if(!empty($data)){
            session('user_id',$data['data'][0]['id']);
             $this->returnAjaxSuccess($data['data'][0]);
        }else{
             $this->returnAjaxError($data); 
        }
    }
    /**
     * 注册
     */
    public function newUser(){
        $db = M('user');
       I('post.password')?$where['password'] = md5(I('post.password')):$this->returnAjaxError();
        if(I('post.password')!==I('post.passwords'))$this->returnAjaxError(array('data'=>'两次密码不同'));
        // die();
       $where['username'] = I('post.username');
       // 判断是手机号还是email
       is_numeric(I('post.emtel'))==1 ? $where['iphone']=I('post.emtel'):$where['email'] = I('post.emtel');
        $data['data'] = $db ->add($where);
        if(!empty($data['data'])){
             $this->returnAjaxSuccess($data);
        }else{
             $this->returnAjaxError($data); 
        }
    }
    /**
     * 忘记密码
     */
    public function upPwd(){
        $db = M('user');
        // 判断输入的是手机号还是邮箱
        $where['iphone|email'] = I('post.username');
        $data = $db ->where($where)->select();
        // 手机号或者邮箱存在
        if(count($data) == 1){
        // 判断是手机还是邮箱 1手机 2email
        is_numeric(I('post.username'))==1 ? $type="1":$type="2";
        
        }
    }
    // 短信验证码ajax
    public  function ajaxProve(){
          $pwd = '';
           $length = 6;
            $pattern = '1234567890abcdefghijklmnopkrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            for($i = 0; $i < $length; $i ++) {
                $pwd .= $pattern {mt_rand ( 0, 50 )}; //生成php随机数验证码
            }
     is_numeric(I('get.type'))==1 ? $type="1":$type="2";
     if($type="1"){
        // 手机号
     }elseif($type="2"){
        // 邮箱
        $this->send_email($pwd);
     }
    }
}