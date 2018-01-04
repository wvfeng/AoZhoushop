<?php
namespace Admin\Controller;
use Think\Controller;
class ShopController extends Controller {
    public function index(){
    	$table = M('shop');
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
    		$res = D('Shop')->find(I('id'));
            $res['sliedimg'] = explode('|*|',$res['sliedimg']);
            foreach ($res['sliedimg'] as $key => $v) {
                if(empty($v)){
                    unset($res['sliedimg'][$key]);
                }
            }
    		$this->assign('res',$res);
    	}
    	$this->display();
    }
    public function doadd(){
        $data['sliedimg'] = implode('|*|', I('slide')).'|*|';
    	$data['tit'] = I('tit');
        $data['introduce'] = I('introduce');
        $data['integral'] = I('integral');
        $data['price'] = I('price');
        $data['detail'] = I('detail');
    	$data['img'] = I('img');
    	if(I('id')){
    		$res = D('Shop')->doadd(I('id'),$data);
    	}else{
    		$data['date'] = date("Y-m-d H:i:s");
    		$res = D('Shop')->doadd('',$data);
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
    	$res = D('Shop')->doadd(I('id'),$data);
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
        $upload->rootPath  =      './Public/shopimg/'; // 设置附件上传根目录
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
    //发送物流
    public function wuliu(){
        if(!I('log')){
            $this->error('信息不能为空');
        }
        if(!I('no')){
            $this->error('信息不能为空');
        }
        if(!I('fahuo_date')){
            $this->error('信息不能为空');
        }
        if(!I('id')){
            $this->error('非法操作');
        }
        $data['log'] = I('log');
        $data['no'] = I('no');
        $data['fahuo_date'] = I('fahuo_date');
        $data['type'] = 2;
        $res = M('order')->where(['id'=>I('id')])->save($data);

        if($res!==false){
            $this->redirect('duihuan');
        }
    }
    //上下架
    public function doupdown(){
        $res = M('shop')->where(['id'=>I('id')])->save(['status'=>I('status')]);
        if($res!==false){
            redirect(I('server.HTTP_REFERER'));
        }else{
            $this->error('操作失败');
        }
    }
}