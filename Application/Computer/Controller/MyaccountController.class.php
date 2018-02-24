<?php
namespace Computer\Controller;

/**
 * 我的账户
 */
class MyaccountController extends CommonController
{	
	//订单
	/*parm:YWtFLFRnLE1UVXhOemc0TmpBd01Dd3hMR2h2ZFhKeg
	id    商品ID
	*/
    public function allOrder(){
        $userId = url_decode(I('userId'));
        if(empty($this->isuser($userId))){
            $this->_empty();
        }
    	$db = M('order');
        if(I('type')){
            $map = array('type'=>I('type'));
        }
        $data['data'] = $db->where($map)->where('user_id='.$userId.' and status=1')->limit($this->page())->field('date,id,shop_id,num,type')->select();
        foreach ($data['data'] as $k => &$v) {
            $shopIdArr = explode("|*|",$v['shop_id']);
            $shopNumArr = explode("|*|",$v['num']);
            foreach ($shopIdArr as $kl => $vl) {
                $shopDetail = M('shop')->where(['id'=>$vl])->field('img,sliedimg,tit,tit_en,oldprice')->find();
                if(!empty($shopDetail)){
                    $v['shopDetail'][$kl] = $shopDetail;
                    $v['shopDetail'][$kl]['shopPayNum'] = $shopNumArr[$kl];
                }
            }
        }
    	if(empty($data['data'])){ 
    		$this->returnAjaxError($data);
    	}else{
    		$this->returnAjaxSuccess($data);
    	}
    }
    //删除订单
    public function deleteOrder(){
        $userId = url_decode(I('userId'));
        if(empty($this->isorder(I('id')))){
            $this->_empty();
        }
        if(empty($this->isuser($userId))){
            $this->_empty();
        }
        $res = M('order')->where(['user_id'=>$userId,'id'=>I('id')])->save(['status'=>0]);
        if(!empty($res)){
            $this->returnAjaxSuccess($data['data']=['成功']);
        }else{
            $this->returnAjaxError($data['data']=['失败']);
        }
    }
    //是否有这个用户
    protected function isuser($id){
        return M('user')->where(['id'=>$id])->count();
    }
    //是否有这个订单
    protected function isorder($id){
        return M('order')->where(['id'=>$id])->count();
    }
    //猜你喜欢
    public function youLike(){
        $user_id = url_decode(I('userId'));
        $orderid = M('order')->where(['user_id'=>$user_id])->order('id desc')->limit(1)->getField('id');

        $shop = explode('|*|',M('order')->where(['id'=>$orderid])->getField('shop_id'));
        foreach ($shop as $key => &$v) {
            $classify_id[$key] = M('shop')->where(['id'=>$v])->getField('classify_id');
        }
        $mapClassify['classify_id'] = array('in',array_unique($classify_id));
        $mapId['id'] = array('not in',$shop);
        $data['data'] = M('shop')->where($mapClassify)->where($mapId)->limit(4)->field('img,id,tit,price,rate')->select();

        if(!empty(count($data['data']))){
            $this->returnAjaxSuccess($data);
        }else{
            $data['data'] = M('shop')->limit(4)->field('img,id,tit,price,rate')->select();
            $this->returnAjaxSuccess($data);
        }
    }
}