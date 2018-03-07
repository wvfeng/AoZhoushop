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
//        xiugai
     switch (I('type')) {
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
     $userId = url_decode(I('userId'));
     $data['data'] = M('order')->where(['user_id'=>$userId,'status'=>1,'type'=>$type])->limit($this->page())
        ->field('shop_id,user_id,num,date,type,money,paymoney,id,freight')->select();
        foreach ($data['data'] as $key => &$v) {
            $shopId = explode('|*|',$v['shop_id']);
            $shopNum = explode('|*|',$v['num']);
            $v['sum'] = array_sum($shopNum);
            $map['id'] = array('in',$shopId);
            $v['shop'] = M('shop')->where($map)->field('img,tit,tit_en,price')->select();
            foreach ($v['shop'] as $keys => &$vs) {
                $vs['paynum'] = $shopNum[$keys];
            }
        }
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
     * 测试
     */
    public function a(){
        $User = D("order"); // 实例化User对象
        if ($User->create($_POST)){
            $con = $User->add();
            var_dump($con);die();
        }else{
            var_dump($User->getError());
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
        $userId = url_decode(I('userId'));
        if(!empty($userId)){
            $con = $db->where(['user_id'=>$userId])->order('sdefault desc')->select();
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
        $db = D('Computer/User');
        $is_mobile = $db->checkpaeg(['iphone' => I('post.username')]) === true;
        $is_username = $db->checkpaeg(['username' => I('post.username')]) === true;
        $is_pass = $db->checkpaeg(['password' => I('post.password')]) === true;
        if(($is_mobile || $is_username) && $is_pass){
            $where['password'] = md5(I('post.password'));
            $where['username|iphone'] = I('post.username');
            $data['data'] = $db->where($where)->find();
        }else{
            $this->returnAjaxError(['message'=>'用户名或密码错误！']);
        }
        if(!empty($data['data'])){
            if($data['data']['status'] != '正常') $this->returnAjaxError(['message'=>$data['data']['status']]);
            unset($data['data']['password']);
            $data['data']['id'] = url_encode($data['data']['id'],C('LandExpirationTime.number'),C('LandExpirationTime.nuit'));
            $this->quickReturn($data);
        }else{
            $this->returnAjaxError(['message'=>'用户名或密码错误！']);
        }
    }
    /**
     * 注册
     */
    public function newUser(){
        A('Computer/User')->regUser();
//        $db = M('user');
//        I('post.password')?$where['password'] = md5(I('post.password')):$this->returnAjaxError();
//        if(I('post.password')!==I('post.rpassword'))$this->returnAjaxError(array('data'=>'两次密码不同'));
//        // die();
//       $where['username'] = I('post.username');
//       // 判断是手机号还是email
//       is_numeric(I('post.emtel'))==1 ? $where['iphone']=I('post.emtel'):$where['email'] = I('post.emtel');
//       if(is_numeric($where['username'])) $this->returnAjaxError(['message'=>'用户名错误！']);
//        $data['data'] = $db ->add($where);
//        if($data){
//            $wher['user_id'] = $data['data'];
//            $user_id = M('user_detail');
//            $data['data'] = $user_id ->add($wher);
//        }
//        if(!empty($data['data'])){
//             $this->quickReturn($data);
//        }else{
//             $this->returnAjaxError($data);
//        }
    }

    public function is_uniqid($username = null,$iphone = null,$email = null){
        A('Computer/User')->is_uniqid($username,$iphone,$email);
    }

    /**
     * 忘记密码
     */
    public function upPwd(){
        //收集数据
        $mobile = I('post.iphone',null);
        $code = I('post.code',null);
        $new_password = I('post.new_password',null);
        if(empty($mobile) || empty($code) || empty($new_password)) $this->returnAjaxError(['message'=>'缺少必要的参数！']);
        //验证数据c
        if(is_mobile($mobile)  && D("Computer/User")->is_uniqid(null,$mobile) === 'USER_IPHONE_EXISTING'){
            $Redis = S(['type'=>'Redis']);
            if($odl_code = S(md5($mobile.__function__))){
                $info = explode(',',$odl_code);
                $odl_code = array_shift($info);
                $startTime = array_shift($info);
                $sumTime = (time()-$startTime);
                if($code == $odl_code && $sumTime < C('SECURITY_CODE.MAX_TIME')){
                    if(preg_match('/^[A-Za-z0-9]{6,20}$/',$new_password) != 1) $this->returnAjaxError(['message'=>'密码不符合规则！']);
                    $res = M('User')->where(['iphone'=>$mobile])->save(['password'=>md5($new_password)]);
                    if($res !== false) S(md5($mobile.__function__),null);
                    $this->quickReturn($res !== false,'密码修改');
                }else{
                    $this->returnAjaxError(['message'=>'验证码错误！']);
                }
            }else{
                $this->returnAjaxError(['message'=>'验证码已过期！']);
            }
        }else{
            $this->returnAjaxError(['message'=>'未注册的手机号！']);
        }
    }
    // 短信验证码ajax
    public  function ajaxProve(){
        $type = I('post.type',null);
        $mobile = I('post.iphone',null);
        if(empty($type) || empty($mobile)) $this->returnAjaxError(['message'=>'缺少必要的参数!']);
        if(is_mobile($mobile)){
          $res = D("Computer/User")->is_uniqid(null,$mobile);
          if($res === true) $this->returnAjaxError(['message'=>'未注册的手机号！']);
          $Redis = S(['type'=>'Redis']);
          $key = md5($mobile.$type);
          $info = S($key);
          //检测验证码是否存在
          if($info === false){
              //不存在，重新创建验证码
              $code = $this->getProv();
          }else{
              //存在
              $info = explode(',',$info);
              $code = array_shift($info);
              $startTime = array_shift($info);
              //判断是否需要重新发送验证码
              if((time()-$startTime)<C('SECURITY_CODE.MIN_TIME')) $this->returnAjaxError(['message'=>'操作太频繁!']);
              //需要重新发送
              if((time()-$startTime)<C('SECURITY_CODE.MAX_TIME')){
                  //验证码未超时，发送原来的验证码
                  $code =  $code.','.$startTime;
              }else{
                  //验证码已超时，重新创建验证码
                  $code =  $this->getProv();
              }
          }

          $Redis->set($key,$code);
          $Redis->expire($key,C('SECURITY_CODE.MAX_TIME'));
          $info = explode(',',$code);
          $code = array_shift($info);
          $res = A('Common/Send','Sms')->SendSms($mobile,$code);

          $this->quickReturn($res,'获取验证码');
        }else{
            $this->returnAjaxError(['message'=>'手机号码错误！']);
        }
    }

    //获取验证码
    public function getProv(){
        return mt_rand(100000,999999).','.time();
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
                     $w = "/pinglun/".$info['savename'];
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