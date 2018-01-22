<?php

namespace Mobile\Controller;
/**
 * 个人信息控制器
 */
class MyinfoController extends CommonController
{
    //获取个人数据
    public function getUserInfo($id = null){
        if(empty($id)) $this->returnAjaxError(['message'=>'用户ID不能为空！']);
        $this->quickReturn($this->Model->getUserInfo($id));
    }

    public function UpdateUserInfo(){
        $this->Model->create();
        //$this->id = url_decode($this->id);  //解密用户ID
        $this->quickReturn($this->Model->save(),'修改');
    }

    public function Collect($UserID =null,$ShopID = null,$CollectID = null,$type = 'list'){
        if(empty($type)) $this->returnAjaxError(['message'=>'操作类型不能为空！']);
        $model = D('Common/Collect');
        $type = strtolower($type);
        if(!empty($UserID)) $UserID = url_decode($UserID);
        if($type == 'list'){
            if(empty($UserID)) $this->returnAjaxError(['message'=>'缺少用户ID!']);
            $this->quickReturn($model->getList($UserID));
        }elseif($type == 'add'){
            if(empty($UserID) || empty($ShopID)) $this->returnAjaxError(['message'=>'缺少用户或商品ID!']);
            $this->quickReturn($model->addCollect($UserID,$ShopID),'收藏');
        }elseif(in_array($type,['delete','remove'])){
            if(empty($CollectID)) $this->returnAjaxError(['message'=>'缺少收藏ID!']);
            $this->quickReturn($model->removeCollect($CollectID),'删除收藏');
        }else{
            $this->returnAjaxError(['message'=>'空类型！']);
        }
    }

    public function creditOrder($UserID =null,$ShopID = null,$type = null,$content = null){
        if(empty($UserID) || empty($ShopID)) $this->returnAjaxError(['message'=>'缺少用户或商品ID!']);
        if(empty($type)) $this->returnAjaxError(['message'=>'操作类型不能为空!']);
        $model = D('Credit');
        $model->create();
        $this->quickReturn($model->save(),'申请'.$type);
    }
}