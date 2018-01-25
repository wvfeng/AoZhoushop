<?php

namespace Mobile\Model;

/**
 * Class creditOrderModel
 * @package Mobile\Model
 * 用户模型库
 */

class CreditModel extends CommonModel
{
    protected $tableName = 'Credit_order';

    protected $_link = [
        'shop'=> [
            'mapping_type'  => self::BELONGS_TO,
            'class_name'    => 'shop',
            'foreign_key'   => 's_id',
            'as_fields'     => 'price'
        ],
    ];

    protected $_map = [
        'ShopID' => 's_id',
        'UserID' => 'u_id',
    ];

    public function _before_insert(&$data, $options)
    {
        parent::_before_insert($data, $options); // TODO: Change the autogenerated stub
        $options = I('post.Images');
        if(!empty($options)){
            $path = C('__PATH_TUIHUAN__');
            foreach ($options as $Image){
                $imagename[] = uploadImg($Image,$path);
            }
            $data['images'] = implode(',',$imagename);
        }
        $data['create_time'] = time();
        $data['update_time'] = time();
    }

    public function _before_update(&$data, $options)
    {
        parent::_before_update($data, $options); // TODO: Change the autogenerated stub
        $data['update_time'] = time();
    }
}