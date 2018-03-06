<?php

namespace Computer\Model;

use Mobile\Model\MyinfoModel;
class UserModel extends MyinfoModel
{
    private $checkdata = ['username','iphone',/*'email',*/'password','rpassword'];
    //字段映射
    protected $_map = array(
//        'name' =>'username', // 把表单中name映射到数据表的username字段
//        'mail'  =>'email', // 把表单中的mail映射到数据表的email字段
    );

    //检测数据
    public function checkdata($data){
        foreach ($this->checkdata as $field){
            if(!isset($data[$field])) return false;
        }
        if(preg_match('/^[A-Za-z0-9]{6,20}$/',$data['password']) != 1) return false;
        if($data['password'] != $data['rpassword']) return false;
        return true;
    }

    //验证用户是否可注册
    public function is_uniqid($username =null,$iphone = null,$email = null){
        if(!empty($username)){
            if(preg_match('/^\d*$/',$username) == 1) return 'USER_NAME_ERROR';
            if(!empty($this->where(['username'=>$username])->find())) return 'USER_NAME_EXISTING';
        }
        if(!empty($iphone)){
            if(!is_mobile($iphone)) return 'USER_IPHONE_ERROR';
            if(!empty($this->where(['iphone'=>$iphone])->find())) return 'USER_IPHONE_EXISTING';
        }
        if(!empty($email)){
            if(!is_email($email)) return 'USER_EMAIL_ERROR';
            if(!empty($this->where(['email'=>$email])->find())) return 'USER_EMAIL_EXISTING';
        }
        return true;
    }
}