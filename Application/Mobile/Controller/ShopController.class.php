<?php
namespace Mobile\Controller;

/**
 * 商品详情接口
 */
class ShopController extends CommonController
{	
	//商品详情
	/*parm:
	id    商品ID
	*/
    public function shop_detail(){
        if(empty($this->isshop(I('id')))){
            $this->_empty();
        }
    	$db = M('shop');
        $data['data'] = $db->where(['id'=>I('id')])->field('sliedimg,tit,price,specifications,origin,
            storage,rate,detail,oldprice')->find();
        $data['data']['shoucang'] = M('collect')->where(['u_id'=>url_decode(I('userId')),'s_id'=>I('id')])->count();
    	if(empty($data['data'])){
    		$this->returnAjaxError($data);
    	}else{
    		$this->returnAjaxSuccess($data);
    	}
    }
    /*加入购物车
      id商品ID
      selected前台需求要加的！
    */
    public function addcart(){
        if(empty($this->isshop(I('id')))){
            $this->_empty();
        }
        $id = I('id');
        if(session('cart')!=null){
            $olddata = session('cart');
        }
        //商品数据这里输入
        $data = ['id'=>$id,'selected'=>false];
        $olddata[] = $data;
        //没登录，商品添加到这里
        session('cart',$olddata);
        //如果用户登录，存入数据库
        session('user_id',1);
        if(url_decode(I('userId'))){
            foreach (session('cart') as $key => $v) {
                $iscart = M('cart')->where(['shop_id'=>$v['id'],'user_id'=>url_decode(I('userId'))])->count();
                if(empty($iscart)){
                    M('cart')->add(['shop_id'=>$v['id'],'user_id'=>url_decode(I('userId')),'num'=>1]);
                }else{
                    M('cart')->where(['shop_id'=>$v['id'],'user_id'=>url_decode(I('userId'))])->setInc('num');
                }
            }
        }
        //查询是否添加成功
        if(url_decode(I('userId'))){
            $isreturn = M('cart')->where(['shop_id'=>I('id'),'user_id'=>url_decode(I('userId'))])->count();
        }else{
            foreach (session('cart') as $key => $v) {
                if($v['id']==I('id')){
                    $isreturn = true;
                }
            }
        }
        if(empty($isreturn)){
            $this->returnAjaxError(['data'=>['msg'=>'失败']]);
        }else{
            $this->returnAjaxSuccess(['data'=>['msg'=>'成功']]);
        }
        
    }
    //查询购物车
    public function cartlist(){
        if(url_decode(I('userId'))){
            $cart = M('cart')->join("RIGHT JOIN mall_shop ON mall_shop.id=mall_cart.shop_id")
            ->where(['mall_cart.user_id'=>url_decode(I('userId'))])->field('mall_cart.num as cart_num,mall_cart.selected,mall_shop.img,
                mall_shop.tit,mall_shop.tit_en,mall_shop.num,mall_shop.price,mall_shop.id,mall_shop.weight,mall_shop.specifications')->select();
            $this->quickReturn($cart);
        }else{
            foreach (session('cart') as $key => &$v) {
                $shop = M('shop')->field('img,tit,tit_en,num,price,id')->where(['id'=>$v['id']])->find();
                if(!empty($shop)){
                    $data[$key] = $shop;
                }
            }
            $this->quickReturn($data);
        }
    }
    //删除购物车商品,传入商品id[]
    public function cartdelete(){
        $id = explode(',',I('id'));
        if(empty($id[0])){
            $this->returnAjaxError(['data'=>['msg'=>'没有参数哦！','type'=>false]]);
        }
        foreach ($id as $key => $v) {
            if(empty($this->isshop($v))){
                $this->_empty();
            }
            //删除表购物车
            M('cart')->where(['user_id'=>url_decode(I('userId')),'shop_id'=>$v])->delete();
        }
        //删除session购物车
        foreach (session('cart') as $key => &$v) {
            if(in_array($v['id'],$id)){
                unset($_SESSION['cart'][$key]);
            }
        }
        $this->returnAjaxSuccess(['data'=>['msg'=>'成功']]);
    }
    //购物车商品入订单
    public function cartorder(){
        $id = explode(',',I('id'));
        $num = explode(',',I('num'));
        $total = I('total');
        if(empty($id[0])){
            $this->returnAjaxError(['data'=>['msg'=>'没有参数哦！','type'=>false]]);
        }
        if(count($id)!=count($num)){
            $this->returnAjaxError(['data'=>['msg'=>'商品和数量不一致','type'=>false]]);
        }
        
        //如果没有这个商品，报错
        $istotal = 0;
        foreach ($id as $key => $v) {
            if(empty($this->isshop($v))){
                $this->_empty();
            }
            if(M('shop')->where(['id'=>$v])->getField('num')<=0){
                $this->returnAjaxError(['data'=>['msg'=>'库存不足','shopname'=>M('shop')->where(['id'=>$v])->getField('tit')]]);
            }
            $istotal[$key] = M('shop')->where(['id'=>$v])->getField('price')*$num[$key];
        }
        if(array_sum($istotal)!=$total){
            $this->returnAjaxError(['data'=>['msg'=>'总值参数错误','type'=>false]]);
        }
        $data['shop_id'] = implode('|*|',$id);
        $data['num'] = implode('|*|',$num);
        $data['user_id'] = url_decode(I('userId'));
        $data['date'] = date('Y-m-d');
        $data['type'] = 1;
        $data['money'] = $total;
        $res = M('order')->add($data);
        if(!empty($res)){
            $this->returnAjaxSuccess(['data'=>['msg'=>'成功','orderid'=>$res,'type'=>true]]);
        }else{
            $this->returnAjaxError(['data'=>['msg'=>'失败']]);
        }

    }
    //是否有这个商品
    protected function isshop($id){
        return M('shop')->where(['id'=>$id])->count();
    }
}