<?php

namespace Computer\Model;

use Mobile\Model\MyinfoModel;
class UserModel extends MyinfoModel
{
    private $checkdata = ['username','iphone','email'];
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
        return true;
    }
}