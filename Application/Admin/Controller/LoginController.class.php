<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function index()
    {   
    	$this->display();
    }

    public function login()
    {   
    	if(empty($_REQUEST['name']) || empty($_REQUEST['password'])){
    		$this->error('请填写登录信息');
    	}
    	$userinfo = D('Admin')->where(array('name'=>I('post.name')))->find();
    	if(empty($userinfo)){
    		$this->error('账号不存在');
    	}else{
    		if($userinfo['password']!=md5(I('post.password'))){
    			$this->error('密码错误');
    		}
    		if($userinfo['status']!=1){
    			$this->error('账号已经被关闭');
    		}
    		session('userinfo',$userinfo);
    		$this->success('登陆成功', U('Index/index'));
    	}
    }
    public function out(){
        session('userinfo',null);
        exit('<script type="text/javascript">
                if(window.top==window.self){
                    window.location.href="'.U('Admin/Index/login').'";
                }else{
                    parent.window.location.href="'.U('Admin/Index/login').'";
                }
              </script>');
    }
}
