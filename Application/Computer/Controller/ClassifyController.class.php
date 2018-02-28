<?php
namespace Computer\Controller;

class ClassifyController extends CommonController
{	
	//返回分类
	/*parm:
	level 分类级别
	sort  排序 asc desc
	id    上一级ID
	*/
    public function ClassifyList(){
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
            case 'all':
                $data['data'] = $db->where(['level'=>1])->order('id '.I('sort'))->select();
                foreach ($data['data'] as $key => &$v) {
                    $v['children'] = $db->where(['level'=>2,'uid'=>$v['id']])->order('id '.I('sort'))->select();
                }
                break;
    	}
    	if(empty($data['data'])){
    		$this->returnAjaxError($data);
    	}else{
    		$this->returnAjaxSuccess($data);
    	}
    	
    }
    //分类详情
    //parm:id分类的ID 
    //type:price,
    //sort:desc asc
    //type:排序1销量2新品3价格
    public function ClassifyDetail(){
    	$db = M('shop');
    	switch (I('type')) {
    		case 1:
    			$type = 'sales';
    			break;
    		case 2:
    			$type = 'id';
    			break;
    		case 3:
    			$type = 'price';
    			break;
    	}
    	if(!I('id')){
    		$this->_empty();
    	}
    	if(I('sort')!='asc'&&I('sort')!='desc'){
    		$this->_empty();
    	}
    	if(!empty($type)){
    		$data['data'] = $db->where(['classify_id'=>I('id')])->limit($this->page())
    	->order($type.' '.I('sort'))->field('img,tit,price,rate,id')->select();
	    }else{
	    	$data['data'] = $db->where(['classify_id'=>I('id')])->limit($this->page())->field('img,tit,price,rate,id')->select();
	    }
    	
    	if(empty($data['data'])){
    		$this->returnAjaxError($data);
    	}else{
    		$this->returnAjaxSuccess($data);
    	}
    }
}