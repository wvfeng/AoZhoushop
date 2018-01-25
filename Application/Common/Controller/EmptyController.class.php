<?php
namespace Common\Controller;
use Think\Controller\RestController;
use Common\Controller\CommonController as Common;
/**
 * Class EmptyController
 * @package Common\Controller
 * 空控制器
 */
class EmptyController extends RestController
{
    /**
     * 空控制器
     */
    public function _empty(){
        Common::returnAjaxError([
            'message'=>'无法加载控制器:'.CONTROLLER_NAME,
            'data'   => ['访问位置'=>MODULE_NAME.'\\'.CONTROLLER_NAME.'\\'.ACTION_NAME]
        ]);
    }
}