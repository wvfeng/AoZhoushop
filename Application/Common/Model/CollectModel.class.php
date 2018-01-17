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
        'shop'=> [
            'mapping_type'  => self::BELONGS_TO,
            'class_name'    => 'shop',
            'foreign_key'   => 's_id',
            'as_fields'     => 'id,tit,tit_en,price,rate'
        ],
    ];

    protected $_map = [
        //'表单' => '字段名'
    ];

    public function getList($id){
        print_r($this->where(['u_id'=>1])->relation('shop')->limit($this->page())->select());
        print_r($this->_sql());die;
    }
}