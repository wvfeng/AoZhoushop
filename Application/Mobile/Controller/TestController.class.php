<?php

namespace Mobile\Controller;

/**
 * 测试专用
 */
class TestController extends CommonController
{
    public function a(){
    	$this->returnAjaxError(I(''),'a');
    }
}