<?php

namespace Common\Model;

/**
 * Class ShopModel
 * @package Common\Model
 * 商品模型
 */

class ShopModel extends CommonModel
{
    public function getShopInfoMin($shopId){
        return $this->field('id,img,tit')->find($shopId);
    }
}