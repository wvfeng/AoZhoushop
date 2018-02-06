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
    public function Collect($type = 'list',$ShopID = null,$CollectID = null){
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
}