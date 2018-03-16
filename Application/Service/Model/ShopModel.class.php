<?php

namespace Service\Model;
use Think\Model;

/**
 * Class ShopModel
 * @package Common\Model
 * 商品模型
 */

class ShopModel extends Model
{
    public function getShopInfoMin($shopId){
        return $this->field('id,img,tit')->find($shopId);
    }
}