<?php

namespace Service\Model;
use Think\Model;

/**
 * Class Collect
 * @package Common\Model
 * 收藏模型库
 */

class CollectModel extends Model
{
    /**
     * 联结商品表
     * @var array
     */
    protected $_link = [
        'shop'=> [
            'mapping_type'  => self::BELONGS_TO,
            'class_name'    => 'shop',
            'foreign_key'   => 's_id',
            'as_fields'     => 'img,tit,tit_en,price,rate'
        ],
    ];

    /**
     * 字段映射
     * @var array
     */
    protected $_map = [
        //'表单' => '字段名'
    ];

    /**
     * 自动添加创建时间
     * @param $data
     * @param $options
     */
    public function _before_insert(&$data, $options)
    {
        parent::_before_insert($data, $options); // TODO: Change the autogenerated stub
        $data['create_time'] = time();
    }

    /**
     * 获取收藏列表
     * @param $id
     * @return mixed
     */
    public function getList($id){
        $list = $this->field(['id','s_id'])->where(['u_id'=>$id])->relation('shop')->limit($this->page())->select();
//        foreach ($list as $key=>$item) {
//            $list[$key]['id']  = url_encode($item['id']);
//            $list[$key]['s_id']  = url_encode($item['s_id']);
//        }
        return $list;
    }

    /**
     * 添加收藏
     * @param $UserID
     * @param $ShopID
     * @return mixed
     */
    public function addCollect($UserID,$ShopID){
        $where = ['u_id'=>$UserID,'s_id'=>$ShopID];
        if($this->checkCollect($where)){
            return true;
        }else{
            return $this->add($where);
        }
    }

    public function checkCollect($where){
        return $this->where($where)->find();
    }

    /**
     * 删除收藏
     * @param $UserID
     * @param $ShopID
     * @return mixed
     */
    public function removeCollect($UserID,$ShopID = null){
        if(empty($ShopID)){
            $where = ['id'=>$UserID];
        }else{
            $where = ['u_id'=>$UserID,'s_id'=>$ShopID];
        }

        if($this->checkCollect($where)){
            return $this->where($where)->limit(1)->delete();
        }else{
            return true;
        }
    }
}