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
        $fields = ['id','o_id','s_id','u_id','content','is_get','type','status','company_id','LogisticCode','tel','from_unixtime(create_time, "%Y-%m-%d") create_time'];
        $data = $this->Model->field($fields)->where(['u_id'=>$this->userId])->relation('shop')->limit($this->page())->select();
        $this->quickReturn($data,'查询');
    }

    //获取退货订单详情
    public function getcreditshop($ShopID = null,$OrderID = null){
        $fields = ['S.id','C.type','C.status','from_unixtime(C.create_time, "%Y-%m-%d") create_time','S.tit','S.price','S.img','O.paytype','C.content','O.shop_id','O.num'];
        $data = $this->Model->alias('C')->field($fields)->where(['C.s_id'=>$ShopID,'C.o_id'=>$OrderID,'u_id'=>$this->userId])
            ->join('__SHOP__ S ON S.id = C.s_id')
            ->join('__ORDER__ O ON O.id = C.o_id')->find();
        $data['num'] = explode ('|*|',$data['num'])[array_flip(explode ('|*|',$data['shop_id']))[$data['id']]];
        unset($data['shop_id']);
        $this->quickReturn($data,'查询');
    }

    public function getShopInfo($shopId = null){
        if(empty($shopId)) $this->quickReturn(null,'查询');
        $this->quickReturn(D('Shop')->getShopInfoMin($shopId),'查询');
    }
}