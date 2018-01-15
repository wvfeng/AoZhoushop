<?php
namespace Mobile\Controller;

/**
 * 分类接口
 */
class ClassifyController extends CommonController
{	
	//返回分类
	/*parm:
	level 分类级别
	sort  排序 asc desc
	id    上一级ID
	*/
    public function classify_list(){
    	$db = M('classify');
    	if(!I('level')){
    		$this->_empty();
    	}
    	if(I('sort')!='asc'&&I('sort')!='desc'){
    		$this->_empty();
    	}
    	switch (I('level')) {
    		case 1:
    			$data['data'] = $db->where(['level'=>1])->order('id '.I('sort'))->select();
    			break;
    		case 2:
    			if(!I('id')){
		    		$this->_empty();
		    	}
    			$data['data'] = $db->where(['level'=>2,'uid'=>I('id')])->order('id '.I('sort'))->select();
    			break;
    	}
    	if(empty($data['data'])){
    		$this->returnAjaxError($data);
    	}else{
    		$this->returnAjaxSuccess($data);
    	}
    	
    }
    //分类详情
    //parm:id分类的ID sort
    public function classify_detail(){
    	$db = M('shop');
    	if(!I('id')){
    		$this->_empty();
    	}
    	if(I('sort')!='asc'&&I('sort')!='desc'){
    		$this->_empty();
    	}
    	$data['data'] = $db->where(['classify_id'=>I('id')])->page($this->page())
    	->order('id '.I('sort'))->field('img,tit,price,rate')->select();
    	if(empty($data['data'])){
    		$this->returnAjaxError($data);
    	}else{
    		$this->returnAjaxSuccess($data);
    	}
    }
}