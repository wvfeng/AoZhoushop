<?php

namespace Mobile\Model;

/**
 * Class MyinfoModel
 * @package Mobile\Model
 * 用户模型库
 */

class MyinfoModel extends CommonModel
{
    public $Error = null;
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
            'non_payment'   => isset($Order['未付款']) ? $Order['未付款']:0,
            'non_shipments' => isset($Order['待发货']) ? $Order['待发货']:0,
            'shipments'     => isset($Order['已发货']) ? $Order['已发货']:0,
            'non_evaluate'  => isset($Order['待评论']) ? $Order['待评论']:0,
            'finish'        => isset($Order['已评价']) ? $Order['已评价']:0,
            'after_sale'    => (isset($Order['退货']) ? $Order['退货']:0) + (isset($Order['换货']) ? $Order['换货']:0) + (isset($Order['售后']) ? $Order['售后']:0),
        ];
        return $data;
    }

    //修改头像
    public function uploadHead(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './'; // 设置附件上传根目录
        $upload->savePath  =      C('__PATH_HEADER__'); // 设置附件上传目录    // 上传单个文件
        $upload->subName   =    array('date','Ymd');
        $info   =   $upload->uploadOne($_FILES['head']);
        if(!$info) {// 上传错误提示错误信息
            $this->Error = $upload->getError();
            return false;
        }else{// 上传成功 获取上传文件信息
            return $info['savepath'].$info['savename'];
        }
    }
}