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
     * 1代表未付款、2待发货、3已发货、4已完成、5代表已评价、6代表退货、7代表换货、8代表售后、9代表未评论
     */
    public function orderType(){
     switch (I('get.type')) {
         case 0 : $type = array('in','未付款,待发货,已发货,待评论,已评论,退货,换货,售后,已评论');
             break;
         case 1 : $type = '未付款';
             break;
         case 2 : $type = '待发货';
             break;
         case 3 : $type = '已发货';
             break;
         // case 4 : $type = '已完成';
         //     break;   
         case 5 : $type = '已评论';
             break;
         case 6 : $type = '退货';
             break;  
         case 7 : $type = '换货';
             break;   
         case 8 : $type = '售后';
             break;        
         case 9 : $type = '待评论';
             break;      
         default:
            $this->returnAjaxError();
             break;
     }
     $db = M('order');
     $where['type'] = $type;
     $where['user_id'] = I('get.id');
     $con = $db->where($where)->field('shop_id,num,paymoney,freight')->select();
     foreach ($con as $key => $value) {
         // 把商品id数量炸开
         $shop_id = explode("|*|",$con[$key]['shop_id']);
         $num = explode("|*|",$con[$key]['num']);
         $wheres['id'] = array('in',implode($shop_id,","));
         $data[$key] = M('shop')->where($wheres)->select();
         foreach ($data[$key] as $k => $v) {
                 foreach ($data[$key] as $ke => $va) {
                    // 修改时间格式
                    $data[$key][$ke]['date'] = date("Y-m-d",strtotime($data[$key][$ke]['date']));
                 }
             // 订单数量填充入数组
             $data[$key][$k]['number'] = $num[$k];
             $data[$key][$k]['paymoney'] = $con[$key]['paymoney'];
             $data[$key][$k]['freight'] = $con[$key]['freight'];
         }
     }
     // var_dump($data);die;
     $this->quickReturn($data);
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
            if($data['data'])$this->quickReturn($data);
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
         if($data['data'])$this->quickReturn($data);

    }
    /**
     * 待评价-》删除订单:评价
     */
    public function evaluate(){
    $db = M('order');
    I('get.id')?$where['id']=I('get.id'):$this->returnAjaxError();
    $data['data'] = $db->where(['id'=>I('get.id')])->delete();
    if($data['data'])$this->quickReturn($data);
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
            $this->quickReturn($data);
    }
    public function addSele(){
        $db = M('address');
        if(!empty(session('user_id'))){
            $con = $db->where(['user_id'=>session('user_id')])->order('sdefault desc')->select();
        $this->quickReturn($con);
        }else{
            $this->returnAjaxError();
        }
    }
    /**
     * 地址删除
     * int id
     */
    public function deleAdd(){
        $id = url_decode(I('userId'));
        $id ? $id : $this->returnAjaxError();
        $db = M('address');
        $data['data'] = $db->where(['id'=>$id])->delete();
        $this->quickReturn($data);
    }
    /**
     * 登录
     * 产生session('userInfo') value: $data;
     */
    public function login(){
        $db = M('user');
        $where['password'] = md5(I('post.password'));
        $where['iphone|email'] = I('post.username');
        $data['data'] = $db ->where($where)->find();

        if(!empty($data['data'])){
            // var_dump($data);die;
            unset($data['data']['password']);
            $data['data']['id'] = url_encode($data['data']['id'],72);
            $this->quickReturn($data);
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
        if($data){
            $wher['user_id'] = $data['data'];
            $user_id = M('user_detail');
            $data['data'] = $user_id ->add($wher);
        }
        if(!empty($data['data'])){
             $this->quickReturn($data);
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
    /**
     * 文件上传入口
     * string id
     */
    public function userSay(){
        // 用户评星级
        $where['star'] = I('post.star');
        $where['text'] = I('post.text');
        $where['user_id'] = I('get.user_id');
        $where['shop_id'] = I('post.shop_id');
        $where['type'] = I('post.type');
        // 图片接口
        $file = $_FILES;
        // var_dump($file);die();
        $type = "say";
        $table = "evaluation";
        $tables = 'order';
        $this->picture($type,$file,$where,$table,$tables);
    }
    /**
     * [picture description]
     * @param  string    $type  [保存路径]
     * @param  [array]   $file  [图片]
     * @param  [string]  $where [文字参数]
     * @param  [data]    $table [存入表中]
     * @return [json]    $data  [处理结果]
     */
    public function picture($type="uploads",$file,$where,$table,$tables){
    // 图片上传接口
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     53145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','tmp');// 设置附件上传类型
                $upload->rootPath  =     './Public/'; // 设置附件上传根目录
                $upload->savePath  =     $type."/"; // 设置附件上传（子）目录
                $upload->subName   =     '';
                          //缩略图
                $upload->uploadReplace     = true; //是否存在同名文件是否覆盖  
                $upload->autoSub           = true; //是否使用子目录保存图片  
                $upload->thumbRemoveOrigin = false; //上传图片后删除原图片 
        foreach ($file as $key => $val) {
            if (!empty($file[$key]['tmp_name'])) {
                $info = $upload->uploadOne($file[$key]);
                if ($info) {
                     $w = "/conf/".$info['savename'];
                     $img[$key] = $w;
                }

            }
        }    
        $where['img'] = implode($img, "|*|");
        $db = M($table);
        $data['data'] = $db->add($where);
         if(!empty($data['data'])){
            // 如果评论已提交更改订单状态
             if($tables){
               $dbs = M($tables);
               $con = $dbs->where(['id'=>$where['shop_id']])->save(['type'=>'已评价']);
               $con?$this->quickReturn($data):$this->returnAjaxError($data); 
             }
        }else{
             $this->returnAjaxError($data); 
        }
    }
}