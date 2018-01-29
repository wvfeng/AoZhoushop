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
        $data = $this->field('id,username')->relation('User_detail')->find($id);
        $data['id'] = url_encode($data['id'],7,'day');
        $Order = array_count_values(M('Order')->where(['user_id'=>$id])->getField('type',true));
        $data['Order'] = [
            'non-payment'   => isset($Order['未付款']) ? $Order['未付款']:0,
            'non-shipments' => isset($Order['待发货']) ? $Order['待发货']:0,
            'shipments'     => isset($Order['已发货']) ? $Order['已发货']:0,
            'non-evaluate'  => isset($Order['待评论']) ? $Order['待评论']:0,
            'finish'        => isset($Order['已评价']) ? $Order['已评价']:0,
            'after_sale'    => (isset($Order['退货']) ? $Order['退货']:0) + (isset($Order['换货']) ? $Order['换货']:0) + (isset($Order['售后']) ? $Order['售后']:0),
        ];
        return $data;
    }
}