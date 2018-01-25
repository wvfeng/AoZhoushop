<?php
namespace Mobile\Controller;

/**
 * 网站设置接口
 */
class SetupController extends CommonController
{	
	//banner接口
	/*parm:
	type    类型1首页轮播2首页中间广告位3分类页banner
	*/
    public function index(){
        if(empty($this->issetup(I('type')))){
            $this->_empty();
        }
    	$db = M('setup');
        $data['data'] = $db->where(['type'=>I('type')])->field('img,link,type')->select();
    	if(empty($data['data'])){
    		$this->returnAjaxError($data);
    	}else{
    		$this->returnAjaxSuccess($data);
    	}
    }
    //是否有这个商品
    protected function issetup($id){
        return M('setup')->where(['type'=>$id])->count();
    }
}