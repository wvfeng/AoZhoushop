<?php
namespace Admin\Controller;
use Think\Controller;
class CouponsController extends Controller {
    public function index(){
    	$table = M('coupons');
        $map = ['status'=>1];
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
    		$res = M('coupons')->find(I('id'));
    		$this->assign('res',$res);
    	}
    	$this->display();
    }
    public function doadd(){
        $data['yname'] = I('yname');
        $data['ymoney'] = I('ymoney');
        $data['ynum'] = I('ynum');
        $data['ystart_date'] = I('ystart_date');
        $data['yend_date'] = I('yend_date');
    	if(I('id')){
    		$res = M('coupons')->where(['id'=>I('id')])->save($data);
    	}else{
            $data['status'] = 1;
    		$res = M('coupons')->add($data);
    	}
    	if($res!==false){
    		$this->redirect('index');
    	}
    }
    public function remove(){
    	if(!I('id')){
    		$this->error('非法操作');
    	}
        $data = ['status'=>0];
    	$res = M('coupons')->where(['id'=>I('id')])->save($data);
    	if($res !== false){
            $this->ajaxReturn('1');
    	}else{
    		$this->error('出错');
    	}
    	
    }
}