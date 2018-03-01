<?php

namespace Computer\Model;

/**
 * Class CommentModel
 * @package Computer\Model
 */
class CommentModel extends CommonModel
{
    protected $trueTableName = 'mall_shop_comment';
    public function CommentAdd(ShopController $shop){
        var_dump($shop);
    }
}