<?php
namespace Mobile\Controller;
/**
 * 首页接口
 */
class IndexController extends CommonController
{	
    public function index(){
        print_r($this->classify());die;
        $this->classify();
    }
    //获取一级分类
    protected function classify(){
    	$db = M('classify');
    	$data = $db->where(['level'=>1])->select();
        return $data;
    }
    public function ceshi(){
        // session('userInfo','1');
        // print_r(11);die;
        $db = M('admin');
        $con = $db->where()->select();
        return $con;
    }
    
}