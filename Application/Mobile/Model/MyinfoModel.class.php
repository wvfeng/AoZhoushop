<?php

namespace Mobile\Model;

/**
 * Class CommonModel
 * @package Home\Model
 * 用户模型库
 */
use Think\Model\RelationModel;
class MyinfoModel extends RelationModel
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

    //获取个人数据
    public function getIndexInfo($id){
        if(empty($id)) return false;
        $data = $this->field('iphone,email,password',true)->relation('User_detail')->find($id);
        print_r(M('Order')->field('count(id) no_pay')->where(['user_id'=>'1'])->getField('type'));die;
        $data['Order'] = array_count_values(M('Order')->field('count(id) no_pay')->where(['user_id'=>$id])->getField('type'));
        return $data;
    }
}