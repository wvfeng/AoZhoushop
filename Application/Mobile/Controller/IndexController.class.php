<?php
namespace Mobile\Controller;
/**
 * 首页接口
 */
class IndexController extends CommonController
{	
    public function index(){
        $data['fenlei'] = $this->classify();
        $data['shangxin'] = $this->getshop('今日上新',4);
        $data['tejia'] = $this->getshop('今日特价',3);
        $data['pinpai'] = $this->getshop('热门品牌',4);
        $data['tequan'] = $this->getshop('会员特权',2);
        $this->quickReturn($data);
    }
    //获取一级分类
    protected function classify(){
    	$db = M('classify');
    	return $db->where(['level'=>1])->select();
    }
    //获取商品
    protected function getshop($typestr,$limit,$sort='desc'){
        $db = M('shop');
        $map['type'] = array('like','%'.$typestr.'%');
        $data = $db->where($map)->limit($limit)->field('img,tit,price,rate,id,classify_id')
        ->order('id '.$sort)->select();
        foreach ($data as $key => &$v) {
            $v['classifyname'] = M('classify')->where(['id'=>$v['classify_id']])->getField('classname');
        }
        return $data;
    }

}