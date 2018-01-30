<?php

namespace Mobile\Model;

/**
 * Class MyinfoModel
 * @package Mobile\Model
 * 用户模型库
 */

class MyinfoModel extends CommonModel
{
    protected $tableName = 'User';
    protected $_link = [
        'User_detail'=> [
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'user_detail',
            'foreign_key'   => 'user_id',
            'as_fields'     => 'nickname,headimgurl,mood,sex,surplus_int,country,province,city'
            ],
    ];

    protected $_map = [
        //'表单' => '字段名'
    ];

    //获取个人数据
    public function getUserInfo($id){
        if(empty($id)) return false;
        $data = $this->field('iphone,email,password',true)->relation('User_detail')->find($id);
        $data['id'] = url_encode($data['id'],7,'day');
        $data['Order'] = array_count_values(M('Order')->where(['user_id'=>$id])->getField('type',true));
        return $data;
    }
}