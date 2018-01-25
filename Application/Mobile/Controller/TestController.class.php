<?php

namespace Mobile\Controller;

/**
 * 测试专用
 */
class TestController extends CommonController
{
    public function a(){
    	$data['data'] = I('');
    	$this->returnAjaxSuccess($data);
    }
}