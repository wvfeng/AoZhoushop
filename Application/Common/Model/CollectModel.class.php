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
            'as_fields'     => 'tit,tit_en,price,rate'
        ],
    ];

    protected $_map = [
        //'表单' => '字段名'
    ];

    public function getList($id){
        return $this->field(['id','s_id'])->where(['u_id'=>$id])->relation('shop')->limit($this->page())->select();
    }

    public function addCollect($UserID,$ShopID){
        return $this->add(['u_id'=>$UserID,'s_id'=>$ShopID]);
    }

    public function removeCollect($id){
        return $this->limit($this->page())->delete($id);
    }
}