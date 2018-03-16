<?php
namespace Computer\Controller;
use Common\Controller\CommonController as Controller;
/**
 * 订单多种状态
 */
class MyorderController extends Controller
{
	/**
	 * [type] [订单的各种状态]
	 */
   public function orderType(){
     $db = M('order');
      I('get.id')?$where['id'] = I('get.id'):"";
      $where['user_id'] = I('get.user_id');
     $con = $db->where($where)->field('shop_id,num,type,iphone,name,address,no,paymoney,date')->select();
     foreach ($con as $key => $value) {
         // 把商品id数量炸开
         $shop_id = explode("|*|",$con[$key]['shop_id']);
         $num = explode("|*|",$con[$key]['num']);
         $wheres['id'] = array('in',implode($shop_id,","));
         $data[$key] = M('shop')->where($wheres)->select();
         foreach ($data[$key] as $k => $v) {
             // 订单信息填充入数组 收货地址 订单号 下单时间 消费总金额
             $data[$key][$k]['type'] = $con[$key]['type'];
             $data[$key][$k]['iphone'] = $con[$key]['iphone'];
             $data[$key][$k]['name'] = $con[$key]['name'];
             $data[$key][$k]['address'] = $con[$key]['address'];
             $data[$key][$k]['no'] = $con[$key]['no'];
             $data[$key][$k]['paymoney'] = $con[$key]['paymoney'];
             $data[$key][$k]['freight'] = $con[$key]['freight'];
             $data[$key][$k]['date'] = $con[$key]['date'];
             $data[$key][$k]['number'] = $num[$k];
         }
     }
     if($data){
     	 $this->quickReturn($data);
     }else{
     	 $this->returnAjaxError($data);
     }     
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
            unset($data['data']['password']);
            $data['data']['id'] = url_encode($data['data']['id'],C('LandExpirationTime.number'),C('LandExpirationTime.nuit'));
            $this->quickReturn($data);
        }else{
             $this->returnAjaxError($data); 
        }
    }
    /**
     * 注册
     */
    public function newUser(){print_r(I(''));die;
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
        $where['user_id'] = I('post.id');
        $where['shop_id'] = I('post.shop_id');
        // 图片接口
        $file = $_FILES;
        // var_dump($file);die();
        $type = "say";
        $table = "evaluation";
        $tables = 'order';
        $this->picture($type,$file,$where,$table,$tables);
    }
    /**
     * 账号管理
     */
    public function upInfo(){
    	// 昵称 性别 所在城市 生日 个性签名
    	I('post.user_id')?$wheres['user_id'] = I('post.user_id'):$this->returnAjaxError(array('data'=>'用户id必须'));
    	$where['nickname'] = I('post.nickname');
    	$where['address'] = I('post.address');
    	$where['birthday'] = I('post.birthday');
    	$where['mood'] = I('post.mood');
    	$where['user_id'] = I('post.user_id');
    	switch (I('post.sex')) {
    		case '1':
    			$where['sex'] = "男";
    			break;
    			case '2':
    			$where['sex'] = "女";
    			break;
    		
    		default:
    			# code...
    			break;
    	}
    	$db = M('user_detail');
    	$con = $db->where($wheres)->select();
    	if($con){
    		$data = $db->where($wheres)->save($where);
    	}else{
    		$data = $db->where($wheres)->add($where);
    	}
     	     $this->quickReturn($data);
    }
    /**
     * [newUser description]
     * @return [type] [description]
     */
    public function newUser(){
	   	// 用户名 邮箱 手机号 密码 验证码
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
     *
     */
    public function lookRoad(){

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
        $data = $db->add($where);
         if(!empty($data)){
            // 如果评论已提交更改订单状态
             if($tables){
               $dbs = M($tables);
               $con = $dbs->where(['id'=>$where['shop_id']])->save(['type'=>'已评价']);
               // var_dump($con);die;
               $con?$this->quickReturn($data):$this->returnAjaxError($data); 
             }
        }else{
             $this->returnAjaxError(); 
        }
    }
}