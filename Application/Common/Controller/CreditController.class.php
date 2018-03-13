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
    public function creditOrder($ShopID = null,$type = null,$id = null,$content = null){
        $this->returnAjaxError(['data'=>I('post.')]);
        if(empty($ShopID)) $this->returnAjaxError(['message'=>'缺少商品ID!']);
        if(empty($type)) $this->returnAjaxError(['message'=>'操作类型不能为空!']);
        if(empty($id)) $this->returnAjaxError(['message'=>'订单ID不能为空!']);
        $types = [1=>'退货',2=>'换货',3=>'售后','1','2','3'];
        if(!in_array($type,$types)) $this->returnAjaxError(['message'=>'类型错误!']);
        if(is_numeric($type)) $type = $types[$type];
        $data = $this->Model->create();
        $data['u_id'] = $this->userId;
        $res = $this->Model->chedate($data);
        if($res === false) $this->returnAjaxError(['message'=>'申请'.$type.'失败！','data'=>['Credit_message'=>$this->Model->Credit_message]]);
        $images = array_filter(str_replace('&quot;','',explode('&quot;,&quot;',preg_replace('/\[|\]/','',I('post.img')))));
        $this->Model->startTrans();
        $this->quickReturn($this->Model->add($data,['images'=>$images]),'申请'.$type);
    }

    /**
     * 添加物流系信息
     */
    public function addExpress($ShopID = null){
        $this->Model->where(['s_id'=>$ShopID,'u_id'=>$this->userId])->find();
        if(empty($creditOrder)) $this->returnAjaxError(['message'=>'CODE_ORDER_ERR','status'=>'CODE_ORDER_ERR']);
        $creditOrder = $this->Model->create();
        $this->quickReturn($this->Model->where(['s_id'=>$ShopID,'u_id'=>$this->userId])->save($creditOrder),'添加物流信息');
    }

    /**
     * 售后列表
     */
    public function creditList(){
        $fields = ['update_time'];
        $data = $this->Model->field($fields,true)->where(['u_id'=>$this->userId])->relation('shop')->limit($this->page())->select();
        foreach ($data as $key=>$value){
            $data[$key]['create_time'] = date('Y-m-d',$data[$key]['create_time']);
        }
        $this->quickReturn($data,'查询');
    }

    public function getShopInfo($shopId = null){
        if(empty($shopId)) $this->quickReturn(null,'查询');
        $this->quickReturn(D('Shop')->getShopInfoMin($shopId),'查询');
    }
}