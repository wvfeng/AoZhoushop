<?php
namespace Common\Controller;

class CreditController extends CommonController
{
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
        $this->Model->create();
        $this->Model->u_id = $this->userId;
        $this->quickReturn($this->Model->add(),'申请'.$type);
    }

    /**
     * 添加物流系信息
     */
    public function addExpress(){
        $this->Model->create();
        $this->quickReturn($this->Model->save(),'添加物流信息');
    }

    /**
     * 售后列表
     */
    public function creditList(){
        $fields = ['update_time'];
        $this->quickReturn($this->Model->field($fields,true)->where(['u_id'=>$this->userId])->relation('shop')->limit($this->page())->select(),'查询');
    }

    public function getShopInfo($shopId = null){
        if(empty($shopId)) $this->quickReturn(null,'查询');
        $this->quickReturn(D('Shop')->getShopInfoMin($shopId),'查询');
    }
}