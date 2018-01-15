<?php

namespace Mobile\Controller;
/**
 * 个人信息控制器
 */
class MyinfoController extends CommonController
{
    //获取个人数据
    public function getIndexInfo($id = null){
        if(empty($id)) $this->returnAjaxError(['message'=>'用户ID不能为空！']);
        $this->quickReturn($this->Model->getIndexInfo($id));
    }

    public function test($str){
        echo url_encode($str).PHP_EOL;
        echo url_decode(url_encode($str));
    }
}