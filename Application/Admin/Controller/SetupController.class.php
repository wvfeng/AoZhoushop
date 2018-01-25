<?php
namespace Admin\Controller;
use Think\Controller;
class SetupController extends Controller {
    public function index(){
    	$table = M('setup');
		$count = $table->count();
		$Page = new \Think\Page($count,25);
		foreach($map as $key=>$val) {
		    $Page->parameter[$key]   =   urlencode($val);
		}
		$show = $Page->show();
		$list = $table->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
    }
    public function add(){
    	$this->display();
    }
    public function edit(){
    	if(I('id')){
    		$res = D('setup')->find(I('id'));
    		$this->assign('res',$res);
    	}
    	$this->display();
    }
    public function doadd(){
    	$data['link'] = I('link');
        $data['img'] = I('img');
        $data['type'] = I('type');
    	if(I('id')){
    		$res = D('setup')->doadd(I('id'),$data);
    	}else{
    		$data['date'] = date("Y-m-d H:i:s");
    		$res = D('setup')->doadd('',$data);
    	}
    	if($res!==false){
    		$this->redirect('index');
    	}
    }
    public function remove(){
    	if(!I('id')){
    		$this->error('非法操作');
    	}
    	$res = D('setup')->remove(I('id'));
    	if($res !== false){
            $this->ajaxReturn('1');
    	}else{
    		$this->error('出错');
    	}
    }
    public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     13145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Public/slide/'; // 设置附件上传根目录
        $upload->autoSub = true;
        $upload->subName = array('date','Ymd');
        // 上传单个文件 
        $info   =   $upload->uploadOne($_FILES['file']);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
             echo $info['savepath'].$info['savename'];
        }
    }
}