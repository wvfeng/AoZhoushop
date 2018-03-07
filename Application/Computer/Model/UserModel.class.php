<?php

namespace Computer\Model;

use Mobile\Model\MyinfoModel;
class UserModel extends MyinfoModel
{
    private $username_en = '/^[A-Za-z][A-Za-z0-9_]{4,15}$/';//英文用户名
    private $username_ch = '/^(?:[A-Za-z]|(?:[\x7f-\xff]))[A-Za-z0-9_\x7f-\xff]{4,15}$/';//支持中文的用户名
    private $user_pass = '/^[A-Za-z0-9,@._]{6,20}$/';//用户密码
    private $checkdata = ['username','iphone',/*'email',*/'password','rpassword'];
    private $Message = [
        'username'=>'USER_NAME_ERROR',
        'email'=>'USER_EMAIL_ERROR',
        'password'=>'USER_PASS_ERROR',
        'iphone'=>'USER_IPHONE_ERROR'
    ];
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
        if(is_string($res = $this->checkpaeg($data))) return $res;
        if($data['password'] != $data['rpassword']) return 'USER_PASS_DIVERSE';
        return true;
    }

    public function checkpaeg($data){
        $convert = array_filter([
            'email'    => $data['email'],
            'iphone'   => $data['iphone'],
            'username' => $data['username'],
            'password' => $data['password']
        ]);
        if(isset($convert['username'])){
            if(preg_match($this->username_ch,$convert['username']) != 1) return 'USER_NAME_ERROR';
        }
        if(isset($convert['password'])){
            if(preg_match($this->user_pass,$convert['password']) != 1) return 'USER_PASS_ERROR';
        }
        if(isset($convert['iphone'])){
            if(!is_mobile($convert['iphone'])) return 'USER_IPHONE_ERROR';
        }
        if(isset($convert['email'])){
            if(!is_email($convert['email'])) return 'USER_EMAIL_ERROR';
        }
        if(empty($convert)){
            return false;
        }else{
            return true;
        }
    }

    //验证用户是否可注册
    public function is_uniqid($username =null,$iphone = null,$email = null,$convert = true){
        if($convert){
            $convert = array_filter([
                'email'    => $email,
                'iphone'   => $iphone,
                'username' => $username
            ]);
            if(is_string($res = $this->checkpaeg($convert))) return $res;
        }
        if(!empty($username)){
            if(!empty($this->where(['username'=>$username])->find())) return 'USER_NAME_EXISTING';
        }
        if(!empty($iphone)){
            if(!empty($this->where(['iphone'=>$iphone])->find())) return 'USER_IPHONE_EXISTING';
        }
        if(!empty($email)){
            if(!empty($this->where(['email'=>$email])->find())) return 'USER_EMAIL_EXISTING';
        }
        return true;
    }
}