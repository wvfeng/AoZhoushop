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
        if(preg_match('/^[A-Za-z0-9]{6,20}$/',$data['password'])) return false;
        if($data['password'] != $data['rpassword']) return false;
        return true;
    }

    //验证用户是否可注册
    public function is_uniqid($username =null,$iphone = null,$email = null){
        if(!is_null($username)){
            if(preg_match('/^\d*$/',$username) == 1) return 'USER_NAME_EXISTING';
            if(!empty($this->where(['username'=>$username])->find())) return 'USER_NAME_EXISTING';
        }
        if(!is_null($iphone)){
            if(preg_match('/^\d*$/',$username) == 0) return 'USER_IPHONE_EXISTING';
            if(!empty($this->where(['iphone'=>$iphone])->find())) return 'USER_IPHONE_EXISTING';
        }
        if(!is_null($email)){
            $email1 = '^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$';
            $email2 = '^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$';
            if(preg_match($email1,$username) == 0 && preg_match($email2,$username) == 0) return 'USER_EMAIL_EXISTING';
            if(!empty($this->where(['email'=>$email])->find())) return 'USER_EMAIL_EXISTING';
        }
        return true;
    }
}