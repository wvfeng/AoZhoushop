<?php

namespace Computer\Model;

/**
 * Class ShopModel
 * @package Computer\Model
 */
class ShopModel extends CommonModel
{
    public function __call($method, $args)
    {
        //return parent::__call($method, $args); // TODO: Change the autogenerated stub
        if(substr($method,0,7) == 'comment') {
            var_dump(get_class($args[0]));
            var_dump($args[0] instanceof Computer\Controller\ShopController);die;
            return D('Comment')->$method($args[0]);
        }
    }
}