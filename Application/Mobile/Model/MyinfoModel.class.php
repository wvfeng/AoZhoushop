<?php

namespace Mobile\Model;

/**
 * Class MyinfoModel
 * @package Mobile\Model
 * 用户模型库
 */

class MyinfoModel extends CommonModel
{
    public $Header;
    public $Header_odl;
    public $Header_thumb;
    public $Header_thumb_odl;
    protected $after_sale = ['退货','换货','售后','退款'];

    protected $fields = ['id','username','iphone','email','status','password'/*,'nickname','headimgurl','mood','sex','surplus_int','country','province','city'*/];
    protected $tableName = 'User';
    protected $_link = [
        'User_detail'=> [
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'user_detail',
            'foreign_key'   => 'user_id',
            'as_fields'     => 'nickname,headimgurl,mood,sex,surplus_int,address,birthday'/*country,province,city*/
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
        //查询订单数据
        $Order = array_merge(
            array_count_values(M('Order')->where(['user_id'=>$id])->getField('type',true)),
            array_count_values(M('Credit_order')->where(['u_id'=>$id])->getField('type',true))
        );
        //弹出售后统计
        foreach ($this->after_sale as $item){
            if(isset($Order[$item])){
                $after_sale[$item] = $Order[$item];
                unset($Order[$item]);
            }
        }

        $data['Order'] = [
            'non_payment'   => intval($Order['未付款']),
            'non_shipments' => intval($Order['待发货']),
            'shipments'     => intval($Order['已发货']),
            'non_evaluate'  => intval($Order['待评论']),
            'finish'        => intval($Order['已评价']),
            'after_sale'    => array_sum($after_sale),
        ];
        return $data;
    }

    //修改头像
    public function uploadHead($Header_odl){
        $this->Header = $this->uploadImage($_FILES['head'],C('__PATH_HEADER__'),true,C('__HEADER_W__'), C('__HEADER_H___'));
        if(!$this->Header) {// 上传错误提示错误信息
            return false;
        }else{// 上传成功 获取上传文件信息
            //获取旧的头像信息
            $this->Header_odl = $Header_odl;
            $this->Header_thumb_odl = dirname($this->Header_odl).'/thumb_'.basename($this->Header_odl);
            $this->Header_thumb = $this->ImagePathName_thumb;
            return $this->Header;
        }
    }
}