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
    	if(empty($data['data'])){
    		$this->returnAjaxError($data);
    	}else{
    		$this->returnAjaxSuccess($data);
    	}
    }
    /*加入购物车
      id商品ID
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
        $data = ['id'=>$id];
        $olddata[] = $data;
        //没登录，商品添加到这里
        session('cart',$olddata);
        //如果用户登录，存入数据库
        session('user_id',1);
        if(session('user_id')){
            foreach (session('cart') as $key => $v) {
                $iscart = M('cart')->where(['shop_id'=>$v['id'],'user_id'=>session('user_id')])->count();
                if(empty($iscart)){
                    M('cart')->add(['shop_id'=>$v['id'],'user_id'=>session('user_id')]);
                }
            }
        }
        //查询是否添加成功
        if(session('user_id')){
            $isreturn = M('cart')->where(['shop_id'=>I('id'),'user_id'=>session('user_id')])->count();
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
        if(session('user_id')){
            $cart = M('cart')->join("RIGHT JOIN mall_shop ON mall_shop.id=mall_cart.shop_id")
            ->where(['mall_cart.user_id'=>session('user_id')])->field('mall_shop.img,mall_shop.tit,mall_shop.tit_en,mall_shop.num,mall_shop.price')->select();
            $this->quickReturn($cart);
        }else{
            foreach (session('cart') as $key => &$v) {
                $shop = M('shop')->field('img,tit,tit_en,num,price')->where(['id'=>$v['id']])->find();
                if(!empty($shop)){
                    $data[$key] = $shop;
                }
            }
            $this->quickReturn($data);
        }
    }
    //删除购物车商品,传入商品id[]
    public function cartdelete(){
        $id = I('id');
        foreach ($id as $key => $v) {
            if(empty($this->isshop($v))){
                $this->_empty();
            }
            //删除表购物车
            M('cart')->where(['user_id'=>session('user_id'),'shop_id'=>$v])->delete();
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
        $id = I('id');
        $num = I('num');
        $total = I('total');
        //如果没有这个商品，报错
        foreach ($id as $key => $v) {
            if(empty($this->isshop($v))){
                $this->_empty();
            }
            if(M('shop')->where(['id'=>$v])->getField('num')<=0){
                $this->returnAjaxError(['data'=>['msg'=>'库存不足','shopname'=>M('shop')->where(['id'=>$v])->getField('tit')]]);
            }
        }
        $data['shop_id'] = implode('|*|',$id);
        $data['num'] = implode('|*|',$num);
        $data['user_id'] = session('user_id');
        $data['date'] = date('Y-m-d');
        $data['type'] = 1;
        $data['money'] = $total;
        $res = M('order')->add($data);
        if(!empty($res)){
            $this->returnAjaxSuccess(['data'=>['msg'=>'成功','orderid'=>$res]]);
        }else{
            $this->returnAjaxError(['data'=>['msg'=>'失败']]);
        }

    }
    //是否有这个商品
    protected function isshop($id){
        return M('shop')->where(['id'=>$id])->count();
    }
}