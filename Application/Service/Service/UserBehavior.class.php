<?php
namespace Service\Service;

use Service\Model\RankModel;
use Service\Model\MemberOrder;
use Think\Exception;

class UserBehavior
{
    static private $instance;
    private $config;

    private function __construct($config)
    {
        $this -> config = $config;
    }

    public function __get($model)
    {
        $model = eval("return \\Common\\Model\\$model::class;die;");
        return $this -> $model = new $model;
    }

    static public function getInstance($config)
    {
        if(!self::$instance instanceof self) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }


    /*捕获错误*/
    public function _call($name, $arguments)
    {
        throw new Exception("Calling object method '$name' " . implode(', ', $arguments). "<br/>");
    }

    /**
     * 验证是否存在并获取会员等级
     * @param integer $memberId 用户主键
     * @return integer
     */
    protected function obtainMembershipGrade($memberId)
    {
        return $this->RankModel->find($memberId);
    }

    static protected function orderNumber() {
        $order_id_main = date('YmdHis') . rand(10000000,99999999);
        $order_id_len = strlen($order_id_main);
        $order_id_sum = 0;
        for($i=0; $i<$order_id_len; $i++){
            $order_id_sum += (int)(substr($order_id_main,$i,1));
        }
        return  $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
    }
}