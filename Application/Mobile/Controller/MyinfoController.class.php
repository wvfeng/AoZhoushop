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
    public function getUserInfo($PHPSESSION){
//        session_destroy();
//        session_id($PHPSESSION);
//        session_start();
        cookie('PHPSESSION',$PHPSESSION);
        var_dump($_SESSION);
        var_dump($_COOKIE);
        die;
        $this->quickReturn($this->Model->getUserInfo(60/*$this->UserID*/),'获取');
    }

    /**
     * 更新个人信息
     */
    public function UpdateUserInfo(){
        $this->Model->create();
        $this->id = $this->UserID;
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
            $this->quickReturn($model->getList($this->UserID));
        }elseif($type == 'add'){
            if(empty($ShopID)) $this->returnAjaxError(['message'=>'缺少商品ID!']);
            $this->quickReturn($model->addCollect($this->UserID,$ShopID),'收藏');
        }elseif(in_array($type,['delete','remove'])){
            if(empty($ShopID)) $this->returnAjaxError(['message'=>'缺少商品ID!']);
            $this->quickReturn($model->removeCollect($this->UserID,$ShopID),'删除收藏');
        }else{
            $this->returnAjaxError(['message'=>'空类型！']);
        }
    }

    /**
     * 退换货/售后管理
     * @param null $UserID
     * @param null $ShopID
     * @param null $type
     * @param null $content
     */
    public function creditOrder($ShopID = null,$type = null,$content = null){
        if(empty($ShopID)) $this->returnAjaxError(['message'=>'缺少商品ID!']);
        if(empty($type)) $this->returnAjaxError(['message'=>'操作类型不能为空!']);
        if(in_array(strtolower($type),['退货','换货','售后','1','2','3'])) $this->returnAjaxError(['message'=>'类型错误!']);
        $model = D('Credit');
        $model->create();
        $model->id = $this->UserID;
        $this->quickReturn($model->add(),'申请'.$type);
    }

    /**
     * 添加物流系信息
     */
    public function addExpress(){
        $model = D('Credit');
        $model->create();
        $this->quickReturn($model->save(),'添加物流信息');
    }

    /**
     * 售后列表   暂不需要
     */
    /*public function creditList(){
        var_dump(eval('return strlen(pow(10,10));'));
    }*/
}