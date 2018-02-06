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
        $data['data'] = $db->where($map)->where('user_id='.$userId.' and status=1')->page($this->page())->field('date,id,shop_id,num,type')->select();
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
}