<?php
namespace Computer\Controller;
use Common\Controller\ShopController as Shop;
/**
 * 商品详情接口
 */
class ShopController extends Shop
{
    //商品详情
    /*parm:
    id    商品ID
    */
    public function shopDetail(){
        if(empty($this->isshop(I('id')))){
            $this->_empty();
        }
        $db = M('shop');
        $data['data'] = $db->where(['id'=>I('id')])->field('sliedimg,tit,price,specifications,origin,
            storage,rate,detail,oldprice,num,instructions,weight')->find();
        if(empty($data['data'])){
            $this->returnAjaxError($data);
        }else{
            $this->returnAjaxSuccess($data);
        }
    }
    //其他推荐
    public function otherShop(){
        if(empty($this->isshop(I('id')))){
            $this->_empty();
        }
        $db = M('shop');
        $limit = I('limit',4);
        $classifyId = $db->where(['id'=>I('id')])->getField('classify_id');
        $data['data'] = $db->where(['classify_id'=>$classifyId])
            ->field('img,tit,tit_en,rate,oldprice')->limit($limit)->select();
        if(empty($data['data'])){
            $data['data'] = $db->order('id desc')->limit($limit)->field('img,tit,tit_en,rate,oldprice')->select();
        }
        if(empty($data['data'])){
            $this->returnAjaxError($data);
        }else{
            $this->returnAjaxSuccess($data);
        }
    }
    /*加入购物车
      id商品ID
      num数量,不要传，固定1
      pick_type送货方式1物流2上门
    */
    public function addcart(){
        if(empty($this->isshop(I('id')))){
            $this->_empty();
        }
        $num = 1;
        $id = I('id');
        $pick_type = I('pick_type');
        $userId = url_decode(I('userId'));
        if(session('cart')!=null){
            $olddata = session('cart');
        }
        //商品数据这里输入
        $data = ['id'=>$id,'num'=>$num,'pick_type'=>$pick_type];
        $olddata[] = $data;
        //没登录，商品添加到这里
        session('cart',$olddata);
        //如果用户登录，存入数据库
        if(!empty($userId)){
            foreach (session('cart') as $key => $v) {
                $iscart = M('cart')->where(['shop_id'=>$v['id'],'user_id'=>$userId])->count();
                if(empty($iscart)){
                    M('cart')->add(['shop_id'=>$v['id'],'user_id'=>$userId,'num'=>$v['num'],'pick_type'=>$pick_type]);
                }else{
                    M('cart')->where(['shop_id'=>$v['id'],'user_id'=>$userId])->setInc('num');
                }
            }
        }
        //查询是否添加成功
        if(!empty($userId)){
            $isreturn = M('cart')->where(['shop_id'=>I('id'),'user_id'=>$userId])->count();
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
        $userId = url_decode(I('userId'));
        if(!empty($userId)){
            $cart = M('cart')->join("RIGHT JOIN mall_shop ON mall_shop.id=mall_cart.shop_id")
                ->where(['mall_cart.user_id'=>$userId])
                ->field('mall_shop.img,mall_shop.tit,mall_shop.tit_en,mall_shop.num as kucun_num,mall_shop.oldprice,mall_cart.num as cart_num')->select();
            $this->quickReturn($cart);
        }else{
            foreach (session('cart') as $key => &$v) {
                $shop = M('shop')->field('img,tit,tit_en,num as kucun_num,oldprice')->where(['id'=>$v['id']])->find();
                $shop['cart_num'] = $v['num'];
                if(!empty($shop)){
                    $data[$key] = $shop;
                }
            }
            $this->quickReturn($data);
        }
    }
    //删除购物车商品,传入商品id[]
    public function cartdelete(){
        $userId = url_decode(I('userId'));
        $id = I('id');
        foreach ($id as $key => $v) {
            if(empty($this->isshop($v))){
                $this->_empty();
            }
            //删除表购物车
            M('cart')->where(['user_id'=>$userId,'shop_id'=>$v])->delete();
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
        $userId = url_decode(I('userId'));
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
        $data['user_id'] = $userId;
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