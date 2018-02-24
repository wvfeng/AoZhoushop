<?php
namespace Common\Controller;

class CollectController extends CommonController
{
    /**
     * 收藏管理
     * @param null $UserID
     * @param string $type
     * @param null $ShopID
     * @param null $CollectID
     */
    public function manage($type = 'list',$ShopID = null,$CollectID = null){
        if(empty($type)) $this->returnAjaxError(['message'=>'操作类型不能为空！']);
        $model = $this->Model;
        $type = strtolower($type);
        if($type == 'list'){
            $this->quickReturn($model->getList($this->userId));
        }elseif($type == 'add'){
            if(empty($ShopID)) $this->returnAjaxError(['message'=>'缺少商品ID!']);
            $this->quickReturn($model->addCollect($this->userId,$ShopID),'收藏');
        }elseif(in_array($type,['delete','remove'])){
            if(empty($ShopID)) $this->returnAjaxError(['message'=>'缺少商品ID!']);
            $this->quickReturn($model->removeCollect($this->userId,$ShopID),'删除收藏');
        }else{
            $this->returnAjaxError(['message'=>'空类型！']);
        }
    }

    //可选的操作
    private $actions = ['add','list','delete','remove'];
    public function _empty($method, $args){
        if(in_array(strtolower($method),$this->actions)) $this->CallAction($method);
        parent::_empty();
    }

    public function CallAction($method){
        $this->manage($method,I('ShopID',null),I('CollectID',null));
    }
}