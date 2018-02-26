<?php
namespace Computer\Controller;
/**
 * 首页接口
 */
class IndexController extends CommonController
{	
    public function index(){
        $data['slide'] = $this->slide();
        $data['shangxin'] = $this->getshop('今日上新');
        $data['tejia'] = $this->getshop('今日特价',4);
        $data['pinpai'] = $this->getshop('热门品牌',4);
        $data['tequan'] = $this->getshop('会员特权',3);
        $data['jiankang'] = $this->GetClassifyShop(20,4);
        $data['yingyang'] = $this->GetClassifyShop(21,4);
        $data['meizhuang'] = $this->GetClassifyShop(22,4);
        $data['shenghuo'] = $this->GetClassifyShop(23,4);
        $this->quickReturn($data);
    }
    //获取商品
    protected function getshop($typestr,$limit,$sort='desc'){
        $db = M('shop');
        $map['type'] = array('like','%'.$typestr.'%');
        $data = $db->where($map)->limit($limit)->field('img,tit,price,rate,id,classify_id,oldprice')
        ->order('id '.$sort)->select();
        foreach ($data as $key => &$v) {
            $v['classifyname'] = M('classify')->where(['id'=>$v['classify_id']])->getField('classname');
        }
        return $data;
    }
    //获取分类商品
    protected function GetClassifyShop($id,$limit,$sort='desc'){
        $ClassifyDb = M('classify');
        $ShopDb = M('shop');
        $classify = $ClassifyDb->where(['uid'=>$id])->select();
        if(empty($classify)){
            return false;
        }
        foreach ($classify as $key => $v) {
            $ClassifyId[$key] = $v['id']; 
        }
        $map['classify_id'] = array('in',$ClassifyId);
        return $ShopDb->where($map)->limit($limit)->field('img,tit,price,rate,id,classify_id,oldprice')
        ->order('id '.$sort)->select();
    }
    //获取轮播图
    protected function slide(){
        $db = M('setup');
        return $db->where(['models'=>1,'type'=>1])->select();
    }
    //首页中间广告图片
    public function banner(){
        $db = M('setup');
        $data['data'] = $db->where(['models'=>1,'type'=>2])->field('img,link')->find();
        $this->quickReturn($data);
    }
}