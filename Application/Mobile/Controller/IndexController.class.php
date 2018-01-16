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

    
}