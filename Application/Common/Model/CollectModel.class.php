<?php

namespace Common\Model;

/**
 * Class Collect
 * @package Common\Model
 * 收藏模型库
 */

class CollectModel extends CommonModel
{
    protected $_link = [
        'User_detail'=> [
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'shop',
            'foreign_key'   => 's_id',
            'as_fields'     => 'id,tit,tit_en,price,rate'
        ],
    ];

    protected $_map = [
        //'表单' => '字段名'
    ];
}