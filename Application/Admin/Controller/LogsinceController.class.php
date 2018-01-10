<?php
namespace Admin\Controller;
use Think\Controller;
class LogsinceController extends Controller {
    public function index(){
    	$table = M('Logsince');
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
    		$res = M('Logsince')->find(I('id'));
    		$this->assign('res',$res);
    	}
    	$this->display();
    }
    public function doadd(){
        $data['wname'] = I('wname');
        $data['wiphone'] = I('wiphone');
        $data['wsort'] = I('wsort');
    	if(I('id')){
    		$res = M('Logsince')->where(['id'=>I('id')])->save($data);
    	}else{
            $data['wtype'] = 1;
            $data['status'] = 1;
    		$data['date'] = date("Y-m-d H:i:s");
    		$res = M('Logsince')->add($data);
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
    	$res = M('Logsince')->where(['id'=>I('id')])->save($data);
    	if($res !== false){
            $this->ajaxReturn('1');
    	}else{
    		$this->error('出错');
    	}
    	
    }
    //上下架
    public function doupdown(){
        $res = M('Logsince')->where(['id'=>I('id')])->save(['wtype'=>I('wtype')]);
        if($res!==false){
            redirect(I('server.HTTP_REFERER'));
        }else{
            $this->error('操作失败');
        }
    }
}