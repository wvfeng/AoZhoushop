<?php
namespace Admin\Controller;
use Think\Controller;
class ClassifyController extends Controller {
    public function index(){
    	$table = M('classify');
		$count = $table->where($map)->count();
		$Page = new \Think\Page($count,25);
		foreach($map as $key=>$val) {
		    $Page->parameter[$key]   =   urlencode($val);
		}
		$show = $Page->show();
		$list = $table->where($map)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
    }
    public function add(){
    	$this->display();
    }
    public function edit(){
    	if(I('id')){
    		$res = D('Classify')->find(I('id'));
    		$this->assign('res',$res);
    	}
    	$this->display();
    }
    public function doadd(){
    	$data['classname'] = I('classname');
    	if(I('id')){
    		$res = D('Classify')->doadd(I('id'),$data);
    	}else{
    		$data['date'] = date("Y-m-d H:i:s");
    		$res = D('Classify')->doadd('',$data);
    	}
    	if($res!==false){
    		$this->redirect('index');
    	}
    }
    public function remove(){
    	if(!I('id')){
    		$this->error('非法操作');
    	}
    	$res = D('Classify')->remove(I('id'));
    	if($res !== false){
            $this->ajaxReturn('1');
    	}else{
    		$this->error('出错');
    	}
    	
    }
}