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
        $data['Order'] = array_shift(M('Order')->field('count(id) no_pay')->where(['user_id'=>$id,'type'=>'0'])->select());
        $data['Order'] += array_shift(M('Order')->field('count(id) no_shipments')->where(['user_id'=>$id,'type'=>'1'])->select());
        $data['Order'] += array_shift(M('Order')->field('count(id) on_shipments')->where(['user_id'=>$id,'type'=>'2'])->select());
        $data['Order'] += array_shift(M('Order')->field('count(id) no_appraise')->where(['user_id'=>$id,'type'=>'3'])->select());
        $data['Order'] += array_shift(M('Order')->field('count(id) on_after')->where(['user_id'=>$id,'type'=>['GT','4']])->select());
        return $data;
    }
}