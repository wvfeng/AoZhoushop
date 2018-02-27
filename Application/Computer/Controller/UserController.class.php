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
        $res = $this->Model->is_uniqid($data['username'],$data['iphone'],$data['email']);
        if($res !== true) $this->returnAjaxError(['message'=>$res,'status'=>$res]);
        $data['password'] = md5($data['password']);
        $res = $this->Model->add($data);
        $this->quickReturn($res !== false,'注册');
    }

    public function Test(){
        var_dump(A('Mobile/Myorder'));
    }

    public function newUser(){
        A('Mobile/Myorder')->newUser();
    }

    public function login(){
        A('Mobile/Myorder')->login();
    }

    public function upPwd(){
        A('Mobile/Myorder')->upPwd();
    }

    public function ajaxProve(){
        A('Mobile/Myorder')->ajaxProve();
    }
}