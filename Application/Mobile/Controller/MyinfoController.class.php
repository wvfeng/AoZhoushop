<?php

namespace Mobile\Controller;
/**
 * 个人信息控制器
 */
class MyinfoController extends CommonController
{
    /**
     * 获取个人数据
     * @param null $id
     */
    public function getUserInfo(){
        $this->quickReturn($this->Model->getUserInfo($this->userId),'获取');
    }

    /**
     * 更新个人信息
     */
    public function UpdateUserInfo(){
        $this->Model->create();
        $this->id = $this->userId;
        //$this->id = url_decode($this->id);  //解密用户ID
        $this->quickReturn($this->Model->save(),'修改');
    }

    /**
     * 收藏管理
     * @param null $UserID
     * @param string $type
     * @param null $ShopID
     * @param null $CollectID
     */
    public function Collect($type = 'list',$ShopID = null,$CollectID = null){
        if(empty($type)) $this->returnAjaxError(['message'=>'操作类型不能为空！']);
        $model = D('Common/Collect');
        $type = strtolower($type);
        //if(!empty($UserID)) $UserID = url_decode($UserID);
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