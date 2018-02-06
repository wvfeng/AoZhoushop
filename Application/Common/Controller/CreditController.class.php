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
        $model = D('Credit');
        $model->create();
        $model->id = $this->userId;
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