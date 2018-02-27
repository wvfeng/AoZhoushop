<?php
namespace Computer\Controller;

/**
 * Class User
 * @package Computer\Controller
 */

use Mobile\Controller\MyinfoController;
class UserController extends MyinfoController
{
    const USER_NAME_EXISTING = 601;  //用户名已存在
    const USER_IPHONE_EXISTING = 602;//用户手机号已存在
    const USER_EMAIL_EXISTING = 603; //用户邮箱已存在
    const USER_NONEXISTENT = 605;    //用户不存在

    //用户登陆
    public function LogIn(){

    }

    //前端实现
    public function LogOut(){

    }

    //用户注册
    public function regUser(){
        //创建数据
        $data = $this->Model->create();
//        $data['User_detail'] = M('User_detail')->create();
        $res = $this->Model->checkdata($data);
        if($res !== true) $this->returnAjaxError(['message'=>'CODE_ARGUMENTS_ERROR','status'=>'CODE_ARGUMENTS_ERROR']);
        $res = $this->user_exists($data['username'],$data['iphone'],$data['email']);
        if($res !== true) $this->returnAjaxError(['message'=>$res,'status'=>$res]);
        $res = $this->Model->relation(true)->add($data);
        $this->quickReturn($res !== false,'注册');
    }

    //验证用户是否可注册
    private function user_exists($username =null,$iphone = null,$email = null){
        if(!empty($this->Model->where(['username'=>$username])->find())) return 'USER_NAME_EXISTING';
        if(!empty($this->Model->where(['iphone'=>$iphone])->find())) return 'USER_IPHONE_EXISTING';
        if(!empty($this->Model->where(['email'=>$email])->find())) return 'USER_EMAIL_EXISTING';
        return true;
    }

    public function Test(){
        var_dump($this->Model);
    }
}